<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Заявка");
?><?$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.view", 
	".default", 
	array(
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "N",
		"LIST_URL" => "index.php",
		"ROW_ID" => $_REQUEST["ID"],
		"ROW_KEY" => "ID",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>