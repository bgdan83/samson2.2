<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$APPLICATION->SetTitle("Заявка");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:low_price_highloadblock_list", 
	"detail_low_price", 
	array(
		"BLOCK_ID" => "1",
		"DETAIL_URL" => "",
		"FOR_ADMIN" => "N",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "",
		"COMPONENT_TEMPLATE" => "detail_low_price"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>