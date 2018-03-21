<?
    require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php"); //Подключаем служебную часть пролога битрикса
?><?$APPLICATION->IncludeComponent(
	"bitrix:form.result.new",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"CHAIN_ITEM_LINK" => "",
		"CHAIN_ITEM_TEXT" => "",
		"EDIT_URL" => "result_edit.php",
		"AJAX_MODE" => "Y",  // режим AJAX
		  "AJAX_OPTION_SHADOW" => "N", // затемнять область
		  "AJAX_OPTION_JUMP" => "Y", // скроллить страницу до компонента
		  "AJAX_OPTION_STYLE" => "Y", // подключать стили
		  "AJAX_OPTION_HISTORY" => "N",
		"IGNORE_CUSTOM_TEMPLATE" => "N",
		"LIST_URL" => "index.php",
		"SEF_MODE" => "N",
		"SUCCESS_URL" => "",
		"USE_EXTENDED_ERRORS" => "N",
		"VARIABLE_ALIASES" => Array("RESULT_ID"=>"RESULT_ID","WEB_FORM_ID"=>"WEB_FORM_ID"),
		"WEB_FORM_ID" => "3"
	)
);?>