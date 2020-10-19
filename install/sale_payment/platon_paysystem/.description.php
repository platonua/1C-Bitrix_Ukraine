<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();

if(!CModule::IncludeModule('platon.paysystem')) {
	return;
}

include(GetLangFileName(dirname(__FILE__)."/", "/platon_paysystem.php"));

	$psTitle = GetMessage("PLATON_PAYSYSTEM_DTITLE");
	$psDescription = GetMessage("PLATON_PAYSYSTEM_DDESCR");

	$arPSCorrespondence = array(
		"WEB_KEY"	=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_KEY"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_KEY_DESC"),

		),
		"WEB_PASSWORD"	=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_PASSWORD"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_PASSWORD_DESC"),

		),
		"WEB_URL"	=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_WEB_URL"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_WEB_URL_DESC"),
            'DEFAULT' => array(
                'PROVIDER_VALUE' => 'https://secure.platononline.com/payment/auth',
                'PROVIDER_KEY' => 'VALUE',
            )
		),
		"SUCCESS"	=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_SUCCESS"),
			"DESCR" => GetMessage("PLATON_PAYSYSTEM_SUCCESS_DESC"),

		),
		"CANCEL"	=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_CANCEL"),
			"DESCR" => GetMessage("PLATON_PAYSYSTEM_CANCEL_DESC"),

		),
        "ORDER_ID"	=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_ORDER_ID"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_ORDER_ID_DESC"),
            'GROUP' => 'PAYMENT',
            'DEFAULT' => array(
                'PROVIDER_VALUE' => 'ID',
                'PROVIDER_KEY' => 'PAYMENT',
            )
		),
		"SUMM"		=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_SUMM"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_SUMM_DESC"),
            //'GROUP' => 'PAYMENT',
            'DEFAULT' => array(
                'PROVIDER_VALUE' => 'SUM',
                'PROVIDER_KEY' => 'PAYMENT',
            )
		),
		"CURR"		=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_CURRENCY"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_CURRENCY_DESC"),
            //'GROUP' => 'PAYMENT',
            'DEFAULT' => array(
                'PROVIDER_VALUE' => 'CURRENCY',
                'PROVIDER_KEY' => 'PAYMENT',
            )
		),
		"USER_ID"		=> array(
			"NAME"	=> GetMessage("PLATON_PAYSYSTEM_USER_ID"),
			"DESCR"	=> GetMessage("PLATON_PAYSYSTEM_USER_ID_DESC"),
            'DEFAULT' => array(
                'PROVIDER_VALUE' => 'ID',
                'PROVIDER_KEY' => 'USER',
            )
		),
	);
?>