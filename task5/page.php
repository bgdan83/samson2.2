<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");

?>

<?$APPLICATION->IncludeComponent(
	"mycomponent:low_price_highloadblock_list",
	"",
	Array(
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "N",
		"DETAIL_URL" => "",
		"FOR_ADMIN" => "Y",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => ""
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>