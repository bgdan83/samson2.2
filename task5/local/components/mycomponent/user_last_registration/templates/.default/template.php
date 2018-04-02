<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>



<?foreach($arResult["ITEMS"] as $arItem):?>
	<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['ID'],$arItem['LOGIN'],$arItem['NAME']."&nbsp".$arItem['LAST_NAME'],$arItem['EMAIL'], $arItem['LAST_LOGIN'], $arItem["DATE_REGISTER"]; ?></a><br>
<?endforeach;?>
					

