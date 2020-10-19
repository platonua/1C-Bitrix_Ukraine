<?if(!defined('B_PROLOG_INCLUDED')||B_PROLOG_INCLUDED!==true)die();
include(GetLangFileName(dirname(__FILE__)."/", "/platon_paysystem.php"));
if(CModule::IncludeModule('platon.paysystem') && CModule::IncludeModule('sale')) {
	$arResult = array();
	CModulePlatonAcquiring::ProcessResponse($arParams, $arResult);
} 
?>