<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?><?

$arParams['WEB_FORM_ID'] = intval($arParams['WEB_FORM_ID']);
$arParams['RESULT_ID'] = intval($arParams['RESULT_ID']);
if (!$arParams['RESULT_ID']) $arParams['RESULT_ID'] = '';

$arParams['NAME_TEMPLATE'] = empty($arParams['NAME_TEMPLATE'])
	? (method_exists('CSite', 'GetNameFormat') ? CSite::GetNameFormat() : "#NAME# #LAST_NAME#")
	: $arParams["NAME_TEMPLATE"];



if (CModule::IncludeModule("form"))
{
	
	

		$this->IncludeComponentTemplate();
	
}
else
{
	echo ShowError(GetMessage("FORM_MODULE_NOT_INSTALLED"));
}
?>