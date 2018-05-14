<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if(isset($_POST['form_data'])){
	
	parse_str($_POST['form_data'], $form_data);	
    //$form_data = json_encode($form_data);
    $like_price = floatval($form_data['like_price']);   
    $fio = htmlspecialcharsEx($form_data['fio']);   
    $phone = intval($form_data['phone']);   
	$vendor_code = htmlspecialcharsEx($form_data['vendor_code']);
	$site_price = floatval($form_data['site_price']);
	$user_id = intval($form_data['user_id']);
	$goods_id = intval($form_data['goods_id']);
	
    //Подготовка:
	if (CModule::IncludeModule('highloadblock')) {
	   $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
	   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
	   $strEntityDataClass = $obEntity->getDataClass();
	

	//Добавление:
	$arElementFields = array(
		  'UF_LIKE_PRICE' => $like_price,
		  'UF_FIO_USER' => $fio,
	      'UF_PHONE' => $phone,
		  'UF_DATE_BID' => new \Bitrix\Main\Type\DateTime,
		  'UF_DATE_TIME_BID' => new \Bitrix\Main\Type\DateTime,
		  'UF_VENDOR_CODE' => $vendor_code,
		  'UF_SITE_PRICE' => $site_price,
		  'UF_USER_ID' => $user_id,
		  'UF_GOODS_ID' => $goods_id,
	   );
	$obResult = $strEntityDataClass::add($arElementFields);
	$ID = $obResult->getID();
	$bSuccess = $obResult->isSuccess();
    echo json_encode($bSuccess);
    }  
}