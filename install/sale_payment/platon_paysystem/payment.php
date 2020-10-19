<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
include(GetLangFileName(dirname(__FILE__)."/", "/platon_paysystem.php"));
if(!CModule::IncludeModule('platon.paysystem') || !CModule::IncludeModule('sale')) {
	/*if(method_exists('CModule', 'IncludeModuleEx') && CModule::IncludeModuleEx('platon.paysystem') == MODULE_DEMO_EXPIRED) {
		echo ShowError('The demo period has expired');
	} */
	return;
}
$arResult = array();
$name_submit = GetMessage("PLATON_PAYSYSTEM_PAYMENT_DOP_SEND");
CModulePlatonAcquiring::OrderPayComponentResult($arParams, $arResult);
//if($GLOBALS["USER"]->IsAdmin()){echo '<pre>'; print_r($arParams); print_r($arResult); echo '</pre>';}
?>
<div>
	<?//=GetMessage("PLATON_PAYSYSTEM_PAYMENT_DOP_INFO")?>
	<?=GetMessage("PLATON_PAYSYSTEM_PAYMENT_DOP_TTL")?>: <strong><?=$arResult["FIELDS"]["AMOUNT"]?> <?=$arResult["FIELDS"]["CURRENCY"]?></strong><br />
    <?if(empty($arResult["ERRORS"])):?>
    <table border="0" cellspacing="20"><tr>
            <?
            if(!empty($arResult["RECURRING_FORM"])):
                $name_submit = GetMessage("PLATON_PAYSYSTEM_PAYMENT_ELSE_SEND");
            ?>
        <td>
            <form method="post" action="<?=$arResult["FIELDS"]["ACTION_URL"]?>">
            <?foreach($arResult["RECURRING_FORM"] as $key=>$value):?>
        		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach;?>
        		<input type="submit" value="<?=GetMessage("PLATON_PAYSYSTEM_PAYMENT_RECURRING_SEND",array('#CARD#'=>$arResult['FIELDS']['RC_CARD']))?>" />
        	</form>
        </td>
            <?endif;?>
        <td>
            <form method="post" action="<?=$arResult["FIELDS"]["ACTION_URL"]?>">
            <?foreach($arResult["FORM"] as $key=>$value):?>
        		<input type="hidden" name="<?=$key?>" value="<?=$value?>" />
            <?endforeach;?>
        		<input type="submit" value="<?=$name_submit?>" />
        	</form>
        </td>
        <td><img src="<?=BX_ROOT?>/php_interface/include/sale_payment/platon_paysystem/platon.png" style="margin-left: 100px;" alt="" /></td>
    </tr></table>
    <?else:?>
    <p><?foreach($arResult["ERRORS"] as $str_error) ShowMessage($str_error);?></p>
    <?endif;?>
</div>