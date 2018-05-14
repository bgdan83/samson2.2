<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Цена ниже");

?><?$APPLICATION->IncludeComponent(
	"mycomponent:low_price_highloadblock_list",
	"",
	Array(
		"BLOCK_ID" => "1",
		"DETAIL_URL" => "",
		"FOR_ADMIN" => "Y",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "20"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>