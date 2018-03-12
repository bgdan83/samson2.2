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

<p>Поиск по email</p>
<form action="index.php" method="GET" >
<input type="text" name="email">
<input type="submit" value="Найти">
</form>
<?$search = "";?>
<?if (!empty($_REQUEST["email"])):?>
    <?$search = htmlspecialcharsEx($_REQUEST["email"]);?>
    <?foreach($arResult["ITEMS"] as $arItem):?>
	    <?if (array_search($search, $arItem)):?>
		
			<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['ID'],$arItem['LOGIN'],$arItem['NAME']."&nbsp".$arItem['LAST_NAME'],$arItem['EMAIL'], $arItem['LAST_LOGIN']; ?></a><br>
			
		<?endif;?>
	<?endforeach;?>

<?else:?>
	
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['ID'],$arItem['LOGIN'],$arItem['NAME']."&nbsp".$arItem['LAST_NAME'],$arItem['EMAIL'], $arItem['LAST_LOGIN']; ?></a><br>
	<?endforeach;?>
					
<?endif;?>
