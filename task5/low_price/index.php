<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Хочу дешевле");
?><?
//global $USER;
//$arrFilter = array('UF_USER_ID' => $USER->GetID());
?>
<?$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.list",
	"user_bid",
	Array(
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "Y",
		"COMPONENT_TEMPLATE" => "user_bid",
		"DETAIL_URL" => "",
		"FILTER_NAME" => "arrFilter",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "",
		"SORT_FIELD" => "ID",
		"SORT_ORDER" => "DESC"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>