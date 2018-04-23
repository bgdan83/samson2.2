<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Цена ниже");
?><?$APPLICATION->IncludeComponent("bitrix:highloadblock.list", "low_price", Array(
	"BLOCK_ID" => "1",	// ID инфоблока
		"CHECK_PERMISSIONS" => "N",	// Проверять права доступа
		"DETAIL_URL" => "",	// Путь к странице просмотра записи
		"FILTER_NAME" => "",	// Идентификатор фильтра
		"PAGEN_ID" => "page",	// Идентификатор страницы
		"ROWS_PER_PAGE" => "",	// Разбить по страницам количеством
		"SORT_FIELD" => "ID",	// Поле сортировки
		"SORT_ORDER" => "DESC",	// Направление сортировки
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>