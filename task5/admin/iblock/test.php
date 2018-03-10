<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Тест");
?>
<?
Cmodule::IncludeModule('iblock');
$arProperty = array();
$rsProp = CIBlockProperty::GetList(array("sort"=>"asc", "name"=>"asc"), array("ACTIVE"=>"Y", "IBLOCK_ID"=>1));
while ($arr=$rsProp->Fetch())
{
	$arProperty[$arr['ID']] = $arr['NAME'];
	
}
test_dump($arProperty);
?>


<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>