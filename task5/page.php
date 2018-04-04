<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>
<?
if(CModule::IncludeModule('iblock'))
{
	$arFilter = Array("IBLOCK_ID"=>2);
	$res = CIBlockElement::GetList(Array("SORT"=>"ASC"), $arFilter, false, false, Array("ID","NAME", "SHOW_COUNTER"));
	while($ar_fields = $res->GetNext())
	{
	    echo "У элемента ". $ar_fields[ID] .$ar_fields[NAME]. " ".$ar_fields[SHOW_COUNTER]." показов<br>";
	}
}


?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>