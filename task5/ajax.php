<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
?>


<?
if(CModule::IncludeModule('iblock'))
{
	if(isset($_POST['data']))
	{
		$data_id = json_decode($_POST['data']); 
	  
	   foreach ($data_id as $id)
	   {   
		   CIBlockElement::CounterInc($id);
		   
	   }
	   
	}
}
?>




