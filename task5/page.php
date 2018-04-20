<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Регистрация");


if (CModule::IncludeModule('highloadblock')) {
	   $arHLBlock = Bitrix\Highloadblock\HighloadBlockTable::getById(1)->fetch();
	   $obEntity = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($arHLBlock);
	   $strEntityDataClass = $obEntity->getDataClass();
	

	//Добавление:

	$arElementFields = array(
	      'UF_PHONE' => 1234567,
		  'UF_FIO_USER' => 'Вася',
		  'UF_LIKE_PRICE' => 200.10
	   );
	$obResult = $strEntityDataClass::add($arElementFields);
	$ID = $obResult->getID();
	$bSuccess = $obResult->isSuccess();
    echo $bSuccess;
    } 

?>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>