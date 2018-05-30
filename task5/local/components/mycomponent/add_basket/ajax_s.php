<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");
if(isset($_REQUEST['name_startsWith']) || $_SERVER['HTTP_X_REQUESTED_WITH']=='XMLHttpRequest')
{	
    if(CModule::IncludeModule("iblock"))
		{
		    $dbItems = \Bitrix\Iblock\ElementTable::getList(array(
				'select' => array('NAME', 'CODE'),
				'filter' => array(
				    'IBLOCK_ID' => 2, 
				    'CODE' => "%" . $_REQUEST['name_startsWith'] . "%"),
				'limit' => 10,
				));
			while ($arItem = $dbItems->fetch()){  
				$code[$arItem['NAME']] = $arItem['CODE'];			
			} 	
		}
	
	echo json_encode(array(code => $code)); 
}
?>