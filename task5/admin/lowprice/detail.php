<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
$APPLICATION->SetTitle("Заявка");
?><?$APPLICATION->IncludeComponent("bitrix:highloadblock.view", "low_price_detail", Array(
	"BLOCK_ID" => "1",	// ID инфоблока
		"CHECK_PERMISSIONS" => "N",	// Проверять права доступа
		"LIST_URL" => "index.php",	// Путь к странице списка записей
		"ROW_ID" => $_REQUEST["ID"],	// Значение ключа записи
		"ROW_KEY" => "ID",	// Ключ записи
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>