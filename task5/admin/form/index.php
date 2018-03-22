<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
  

?><?$APPLICATION->IncludeComponent(
	"bitrix:form.result.list", 
	"form_result", 
	array(
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"COMPONENT_TEMPLATE" => "form_result",
		"EDIT_URL" => "result_edit.php",
		"NEW_URL" => "result_new.php",
		"NOT_SHOW_FILTER" => array(
			0 => "fio",
			1 => "description_form",
			2 => "file_form",
			3 => "timeprocc",
			4 => "comment",
			5 => "",
		),
		"NOT_SHOW_TABLE" => array(
			0 => "description_form",
			1 => "file_form",
			2 => "timeprocc",
			3 => "comment",
			4 => "",
		),
		"SEF_MODE" => "N",
		"SHOW_ADDITIONAL" => "N",
		"SHOW_ANSWER_VALUE" => "Y",
		"SHOW_STATUS" => "Y",
		"VIEW_URL" => "result_view.php",
		"WEB_FORM_ID" => "3"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>