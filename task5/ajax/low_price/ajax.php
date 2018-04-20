<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if(isset($_POST['form_data'])){
	
	parse_str($_POST['form_data'], $form_data);	
    //$form_data = json_encode($form_data);
    $like_price = floatval($form_data['like_price']);   
    $fio = htmlspecialcharsEx($form_data['fio']);   
    $phone = intval($form_data['phone']);   
    
    //Подготовка:
	if (CModule::IncludeModule('highloadblock')) {
	   $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
	   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
	   $strEntityDataClass = $obEntity->getDataClass();
	

	//Добавление:

	$arElementFields = array(
		  'UF_LIKE_PRICE' => $like_price,
		  'UF_FIO_USER' => $fio,
	      'UF_PHONE' => $phone
	   );
	$obResult = $strEntityDataClass::add($arElementFields);
	$ID = $obResult->getID();
	$bSuccess = $obResult->isSuccess();

    }  
}