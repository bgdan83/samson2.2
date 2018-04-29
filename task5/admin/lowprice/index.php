<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Цена ниже");
if(isset($_GET['cond']))
{
	$cond = intval($_POST['cond']);
	$arrFilter = array('UF_CONDITION' => $cond);
}
if(isset($_GET['vendor_code']))
{
    $vendor_code = trim(htmlspecialcharsEx($_GET['vendor_code']));
    $arrFilter = array('UF_VENDOR_CODE' => $vendor_code);
}
if(isset($_GET['date']))
{
    $date = htmlspecialcharsEx($_GET['date']);
    $arrFilter = array('UF_DATE_BID' => $date);
}
if(isset($_GET['date_sort']))
{
    $date_sort = htmlspecialcharsEx($_GET['date_sort']);
   
}
?><?$APPLICATION->IncludeComponent(
	"bitrix:highloadblock.list", 
	"low_price", 
	array(
		"BLOCK_ID" => "1",
		"CHECK_PERMISSIONS" => "N",
		"COMPONENT_TEMPLATE" => "low_price",
		"DETAIL_URL" => "detail.php?ID=#ID#",
		"FILTER_NAME" => "arrFilter",
		"PAGEN_ID" => "page",
		"ROWS_PER_PAGE" => "20",
		"SORT_FIELD" => "UF_DATE_BID",
		"SORT_ORDER" => $date_sort
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>