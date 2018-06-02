<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Хочу дешевле");
?><?$APPLICATION->IncludeComponent("mycomponent:low_price_highloadblock_list", "local_low_price", Array(
	"BLOCK_ID" => "1",	// ID инфоблока
		"DETAIL_URL" => "",	// Путь к странице просмотра записи
		"FOR_ADMIN" => "N",	// Для аминистратора
		"PAGEN_ID" => "page",	// Идентификатор страницы
		"ROWS_PER_PAGE" => "",	// Разбить по страницам количеством
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>