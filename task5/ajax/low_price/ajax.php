<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if(isset($_POST['form_data'])){
	
	parse_str($_POST['form_data'], $form_data);	
    //$form_data = json_encode($form_data);
    $like_price = floatval($form_data['like_price']);   
    $fio = htmlspecialcharsEx($form_data['fio']);   
    $phone = intval($form_data['phone']);   
    $name_goods = htmlspecialcharsEx($form_data['name_goods']);
	$vendor_code = htmlspecialcharsEx($form_data['vendor_code']);
	$link_goods = $form_data['link_goods'];
	$site_price = floatval($form_data['site_price']);
	$id = intval($form_data['user_id']);
	$user_login = htmlspecialcharsEx($form_data['user_login']);
	$photo = $form_data['photo'];
	
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
		  'UF_NAME_GOODS' => $name_goods,
		  'UF_VENDOR_CODE' => $vendor_code,
		  'UF_LINK_GOODS' => "http://".$_SERVER[HTTP_HOST].$link_goods,
		  'UF_SITE_PRICE' => $site_price,
		  'UF_LINK_USER' => "http://".$_SERVER[HTTP_HOST]."/admin/users/detail.php?LOGIN=".$user_login,
		  'UF_PHOTO' => $photo,
		  'UF_USER_ID' => $id,
	   );
	$obResult = $strEntityDataClass::add($arElementFields);
	$ID = $obResult->getID();
	$bSuccess = $obResult->isSuccess();

    }  
}