<?
class CModulePlatonAcquiring {
    /////////////////// formation request payment system /////////////////
	public static function OrderPayComponentResult(&$arParams, &$arResult) {
	    global $DB;
        $arResult = array(
			'ERRORS' => array(),
			'PAYMENT' => array(),
            'MANDATORY' => array(),
            'RECURRING_FORM' => array(),
			'FORM' => array(),
            'FIELDS' => array(),
		);

        $PLATON_PAYSYSTEM_KEY = trim(CSalePaySystemAction::GetParamValue("WEB_KEY"));
        $PLATON_PAYSYSTEM_PASSWORD = trim(CSalePaySystemAction::GetParamValue("WEB_PASSWORD"));
        $arResult['PAYMENT'] = CSalePaySystem::GetByID($GLOBALS['SALE_INPUT_PARAMS']['ORDER']['PAY_SYSTEM_ID'], $GLOBALS['SALE_INPUT_PARAMS']['ORDER']['PERSON_TYPE_ID']);
        //$arResult['ORDER'] = $GLOBALS['SALE_INPUT_PARAMS']['ORDER'];
        $arResult['FIELDS']['ACTION_URL'] = trim(CSalePaySystemAction::GetParamValue("WEB_URL"));
        $arResult['FIELDS']['REQUEST_SUCCESS_URL'] = trim(CSalePaySystemAction::GetParamValue("SUCCESS"));
        $arResult['FIELDS']['REQUEST_ERROR_URL'] = trim(CSalePaySystemAction::GetParamValue("CANCEL"));
        $arResult['FIELDS']['AMOUNT'] = number_format(floatval(CSalePaySystemAction::GetParamValue("SUMM")), 2, '.', '');
        $arResult['FIELDS']['CURRENCY'] = trim(CSalePaySystemAction::GetParamValue("CURR"));
        $arResult['FIELDS']['ORDER'] = trim(CSalePaySystemAction::GetParamValue("ORDER_ID"));
        $arResult['FIELDS']['IP_SERVER'] = strrev($_SERVER["REMOTE_ADDR"]);
        $arResult['FIELDS']['ID_USER'] = CSalePaySystemAction::GetParamValue("USER_ID");

        $res_sql = $DB->Query("select `card`,`rc_id`,`rc_token` from `platon_recurring_payments_code` where `user`='".md5('platon'.$arResult['FIELDS']['ID_USER'])."';", true);
        if(!empty($res_sql)){
            while($row=$res_sql->Fetch()) {
                if(!empty($row)) {
                    $arResult['FIELDS']['RC_CARD'] = '***********'.$row["card"];
                    $arResult['FIELDS']['RC_ID'] = $row["rc_id"];
                    $arResult['FIELDS']['RC_TOKEN'] = $row["rc_token"];
                }
            };
        }

        if(strlen($PLATON_PAYSYSTEM_KEY)==0) $arResult['ERRORS']['ERR_PLATON_PAYSYSTEM_KEY'] = GetMessage('ERR_PLATON_PAYSYSTEM_KEY');
        if(strlen($PLATON_PAYSYSTEM_PASSWORD)==0) $arResult['ERRORS']['ERR_PLATON_PAYSYSTEM_PASSWORD'] = GetMessage('ERR_PLATON_PAYSYSTEM_PASSWORD');
        if(strlen($arResult['FIELDS']['ACTION_URL'])==0) $arResult['ERRORS']['ERR_PLATON_MODULE_URL'] = GetMessage('ERR_PLATON_MODULE_URL');
        if(strlen($arResult['FIELDS']['REQUEST_SUCCESS_URL'])==0) $arResult['ERRORS']['ERR_PLATON_REQUEST_SUCCESS_URL'] = GetMessage('ERR_PLATON_REQUEST_SUCCESS_URL');
        if(empty($arResult['PAYMENT'])) $arResult['ERRORS']['ERR_PLATON_MODULE_PAYSYSTEM'] = GetMessage('ERR_PLATON_MODULE_PAYSYSTEM');

        if(empty($arResult['ERRORS'])){  //simple form
            $arr_data = array(
                'amount'=>$arResult['FIELDS']['AMOUNT'],
                'currency'=>$arResult['FIELDS']['CURRENCY'],
                'name'=>'Buying '.$arResult['FIELDS']['ID_USER'].'/'.$arResult['FIELDS']['ORDER'],
                'recurring'=>'init'
            );
            $data = base64_encode(serialize($arr_data));
            $sign = md5(strtoupper($arResult['FIELDS']['IP_SERVER'].strrev($PLATON_PAYSYSTEM_KEY).strrev($data).strrev($arResult['FIELDS']['REQUEST_SUCCESS_URL']).strrev($PLATON_PAYSYSTEM_PASSWORD)));
            $arResult['FORM']['key'] = $PLATON_PAYSYSTEM_KEY;
            $arResult['FORM']['order'] = $arResult['FIELDS']['ORDER'];
            $arResult['FORM']['data'] = $data;
            $arResult['FORM']['url'] = $arResult['FIELDS']['REQUEST_SUCCESS_URL'];
            if(strlen($arResult['FIELDS']['REQUEST_ERROR_URL'])>0) $arResult['FORM']['error_url'] = $arResult['FIELDS']['REQUEST_ERROR_URL'];
            $arResult['FORM']['sign'] = $sign;

            if(isset($arResult['FIELDS']['RC_CARD'])) { //form regular payments
                unset($arr_data["recurring"]);
                $data = base64_encode(serialize($arr_data));
                $sign = md5(strtoupper($arResult['FIELDS']['IP_SERVER'].strrev($PLATON_PAYSYSTEM_KEY).strrev($data).strrev($arResult['FIELDS']['RC_ID']).strrev($arResult['FIELDS']['RC_TOKEN']).strrev($arResult['FIELDS']['REQUEST_SUCCESS_URL']).strrev($PLATON_PAYSYSTEM_PASSWORD)));
                $arResult['RECURRING_FORM']['key'] = $PLATON_PAYSYSTEM_KEY;
                $arResult['RECURRING_FORM']['order'] = $arResult['FIELDS']['ORDER'];
                $arResult['RECURRING_FORM']['data'] = $data;
                $arResult['RECURRING_FORM']['rc_id'] = $arResult['FIELDS']['RC_ID'];
                $arResult['RECURRING_FORM']['rc_token'] = $arResult['FIELDS']['RC_TOKEN'];
                $arResult['RECURRING_FORM']['url'] = $arResult['FIELDS']['REQUEST_SUCCESS_URL'];
                $arResult['RECURRING_FORM']['sign'] = $sign;
            }
        }
        $arResult['FIELDS']['AMOUNT'] = htmlspecialchars($arResult['FIELDS']['AMOUNT']);
        $arResult['FIELDS']['CURRENCY'] = htmlspecialchars($arResult['FIELDS']['CURRENCY']);
        $arResult['FIELDS']['ORDER'] = htmlspecialchars($arResult['FIELDS']['ORDER']);

	}
    //////////////////// Handling a response from the payment system /////////////////
	public static function ProcessResponse(&$arParams, &$arResult) {
		if(!CModule::IncludeModule('sale')) {
			return;
		}
        $arSite = array();
        $arResult = array(
			'ERRORS' => array(),
            'MESSAGE' => array(),
			'FIELDS' => array(),
			'ORDER' => array(),
            'RESPONSE' => array(),
		);
        if(!empty($_POST)) $arResult["RESPONSE"] = $_POST;
        // get order //
        if(intval($arResult["RESPONSE"]["order"])>0) $arResult["ORDER"] = CSaleOrder::GetByID($arResult["RESPONSE"]["order"]);

        if(!empty($arResult['ORDER'])){
            if($arResult["ORDER"]["PAY_SYSTEM_ID"]!=$arParams["PAY_SYSTEM_ID_NEW"]) $arResult['ERRORS']['ERR_PLATON_ORDER_PLATON'] = GetMessage('ERR_PLATON_ORDER_PLATON');
            if(isset($arResult['ORDER']['LID'])){
                $rsSites = CSite::GetByID($arResult['ORDER']['LID']);
                $arSite = $rsSites->Fetch();
            }
        }

        if(empty($arResult['ERRORS']) && intval($arResult["RESPONSE"]["order"])>0)
        {  // POST checks the simple answer
            $error_payed = true;
            // amount and currency checks
            if($arResult['ORDER']['PRICE']!=$arResult["RESPONSE"]["amount"]) {
                $error_payed = false;
                $arResult["ERRORS"]['ERR_PLATON_PAYSYSTEM_PRICE'] = GetMessage('ERR_PLATON_PAYSYSTEM_PRICE',array("#PRICE#"=>$arResult['ORDER']['PRICE'], "#AMOUNT#"=>$arResult["RESPONSE"]["amount"]));
            }
            if($arResult['ORDER']['CURRENCY']!=$arResult["RESPONSE"]["currency"]) {
                $error_payed = false;
                $arResult["ERRORS"]['ERR_PLATON_PAYSYSTEM_CURRENCY'] = GetMessage('ERR_PLATON_PAYSYSTEM_CURRENCY',array("#CURRENCY1#"=>$arResult['ORDER']['CURRENCY'], "#CURRENCY2#"=>$arResult["RESPONSE"]["currency"]));
            }
            if($arResult["RESPONSE"]["status"]=="REFUND" || $arResult["RESPONSE"]["status"]=="CHARGEBACK") {
                $arResult['FIELDS']['PS_STATUS'] = 'N';
                if($arResult["RESPONSE"]["status"]=="REFUND") $arResult["ERRORS"]['REFUND'] = GetMessage('ERR_PLATON_PAYSYSTEM_REFUND');
                if($arResult["RESPONSE"]["status"]=="CHARGEBACK") $arResult["ERRORS"]['CHARGEBACK'] = GetMessage('ERR_PLATON_PAYSYSTEM_CHARGEBACK');
                $error_payed = false;
            }
            // signature verification
            if($error_payed){
                $PLATON_PAYSYSTEM_PASSWORD = trim(CSalePaySystemAction::GetParamValue("WEB_PASSWORD"));
                $sign = md5(strtoupper(strrev($arResult["RESPONSE"]["email"]).$PLATON_PAYSYSTEM_PASSWORD.$arResult["RESPONSE"]["order"].strrev(substr($arResult["RESPONSE"]["card"],0,6).substr($arResult["RESPONSE"]["card"],-4))));

                if($sign!=$arResult["RESPONSE"]["sign"]) {
                    $arResult["ERRORS"]['ERR_PLATON_PAYSYSTEM_SIGN'] = GetMessage('ERR_PLATON_PAYSYSTEM_SIGN');
                    $arResult['FIELDS']['PS_STATUS'] = 'N';
                } else {
                    $arResult['MESSAGE']['PLATON_SUCCESS_MESSAGE'] = GetMessage('PLATON_SUCCESS_MESSAGE',array("#ORDER_ID#" => $arResult["RESPONSE"]["order"]));
                    $arResult['FIELDS'] = array(
                        'PAYED' => 'Y',
                        'PS_STATUS' => 'Y',
                        'DATE_PAYED' =>  date(CDatabase::DateFormatToPHP(CLang::GetDateFormat('FULL', $arSite["LANGUAGE_ID"]))),
                        'EMP_PAYED_ID' => false,
                    );
                }
            }
            $arResult['FIELDS']['PS_SUM'] = $arResult["RESPONSE"]["amount"]; unset($arResult["RESPONSE"]["amount"]);
            $arResult['FIELDS']['PS_CURRENCY'] = $arResult["RESPONSE"]["currency"]; unset($arResult["RESPONSE"]["currency"]);

            if(isset($arResult["RESPONSE"]["rc_id"]) && isset($arResult["RESPONSE"]["rc_token"])) // new card
            {
                global $DB; $arr_sql=array();
                $us_cod = md5('platon'.$arResult["ORDER"]["USER_ID"]);
                $res_sql = $DB->Query("select count(*) from `platon_recurring_payments_code` where `user`='".$us_cod."';", true);
                if(!empty($res_sql)){
                    while($row=$res_sql->Fetch()) array_push($arr_sql, $row);
                    if($arr_sql[0]["count(*)"]==0) {
                        $res_sql = $DB->Query("insert ignore into `platon_recurring_payments_code` (`user`, `card`, `rc_id`, `rc_token`) VALUES('".$us_cod."','".substr($arResult["RESPONSE"]["card"],-4)."','".$arResult["RESPONSE"]["rc_id"]."','".$arResult["RESPONSE"]["rc_token"]."')", true);
                    } else {
                        $res_sql = $DB->Query("update `platon_recurring_payments_code` set `card`='".substr($arResult["RESPONSE"]["card"],-4)."', `rc_id`='".$arResult["RESPONSE"]["rc_id"]."', `rc_token`= '".$arResult["RESPONSE"]["rc_token"]."' where `user`='".$us_cod."'", true);
                    }
                    unset($arResult["RESPONSE"]["rc_id"]); unset($arResult["RESPONSE"]["rc_token"]);
                }
            }
        }
        
        if(!empty($arResult['ORDER'])) {
            // initialize the parameters of the payment system handler
            CSalePaySystemAction::InitParamArrays($arResult['ORDER'], $arResult['ORDER']['ID']);
            $sDescription = ''; // description of the result of the payment system
            foreach($arResult["RESPONSE"] as $key_responce=>$value_responce){
                if(is_array($value_responce)) $str = implode('; ',$value_responce);
                else $str = $value_responce;
                $sDescription .= $key_responce.': '.$str.'; ';
            }
            $sStatusMessage = ''; // message from the payment system
            $sStatusMessage .= implode('; ', $arResult["ERRORS"]);
            $sStatusMessage .= implode('; ', $arResult["MESSAGE"]);

            $arResult['FIELDS']['PS_STATUS_CODE'] = $arResult["RESPONSE"]["status"];
            $arResult['FIELDS']['PS_STATUS_DESCRIPTION'] = substr($sDescription,0,250);
            $arResult['FIELDS']['PS_STATUS_MESSAGE'] = $sStatusMessage;
            //$arResult['FIELDS']['PS_SUM'] = $arResult['RESPONSE']['amt'];
            //$arResult['FIELDS']['PS_Currency'] = $arResult['RESPONSE']['ccy'];
            $arResult['FIELDS']['PS_RESPONSE_DATE'] = date(CDatabase::DateFormatToPHP(CLang::GetDateFormat('FULL', $arSite["LANGUAGE_ID"])));
            $arResult['FIELDS']['USER_ID'] = $arResult['ORDER']['USER_ID'];

            if($arResult['FIELDS']['PAYED']=='Y' && empty($arResult['ERRORS'])) // изменим статус на оплачено
               CSaleOrder::PayOrder($arResult['ORDER']['ID'], 'Y', true, true, 0, $arResult['FIELDS']);
    		else CSaleOrder::Update($arResult['ORDER']['ID'], $arResult['FIELDS']);
        }
        if(intval($_GET["order"])>0) { // check the contents of the order
            $arResult["ORDER"] = CSaleOrder::GetByID($_GET["order"]);
            if($arResult["ORDER"]["PAYED"]=="Y") {
                if(!empty($arResult["ORDER"]["PS_STATUS_MESSAGE"])) $arResult['MESSAGE']['PS_STATUS_MESSAGE'] = $arResult["ORDER"]["PS_STATUS_MESSAGE"];
                else $arResult['MESSAGE']['PLATON_SUCCESS_MESSAGE'] = GetMessage('PLATON_SUCCESS_MESSAGE',array("#ORDER_ID#"=>$_GET["order"]));
            } else {
                if(!empty($arResult["ORDER"]["PS_STATUS_MESSAGE"])) $arResult['ERRORS']['PS_STATUS_MESSAGE'] = $arResult["ORDER"]["PS_STATUS_MESSAGE"];
                if(!empty($arResult["ORDER"]["REASON_CANCELED"]) && $arResult["ORDER"]["CANCELED"]=='Y') $arResult['ERRORS']['REASON_CANCELED'] = $arResult["ORDER"]["REASON_CANCELED"];
            }
        }

        if(!empty($arResult['ERRORS'])){ // we show a list of errors
            foreach($arResult['ERRORS'] as $value) ShowMessage($value);
        }
        if(!empty($arResult['MESSAGE'])){ // show message list
            foreach($arResult['MESSAGE'] as $value) ShowNote($value);
        }

        //file_put_contents($_SERVER['DOCUMENT_ROOT']."/upload/log.txt", "\n".date('d.m.Y H:i:s').' $arParams='.print_r($arParams,1).' $arResult='.print_r($arResult,1), FILE_APPEND);
	}
}
?>