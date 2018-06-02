<? require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");?>
<?
if(isset($_POST['form_data'])){
	
	parse_str($_POST['form_data'], $form_data);	
    //$form_data = json_encode($form_data);
    $comment = htmlspecialcharsEx($form_data['comment']);   
    $id = intval($form_data['id']);   
    
	
    //Подготовка:
	if (CModule::IncludeModule('highloadblock')) {
	   $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
	   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
	   $strEntityDataClass = $obEntity->getDataClass();
	

	//Добавление:
	    $arElementFields = array(
		  'UF_COMMENT' => $comment,
		  'UF_CONDITION' => 1,
		  'UF_DATE_TIME_COMMENT' => new \Bitrix\Main\Type\DateTime,
	    );
	    $obResult = $strEntityDataClass::update($id, $arElementFields);
	    $ID = $obResult->getID();
	    $bSuccess = $obResult->isSuccess();

    }  
}