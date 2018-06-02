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

<img src="<?=$arResult["DETAIL_PICTURE"]["SRC"]?>" style="float: left;"/>
<?echo $arResult["NAME"];?>
<?foreach( $arItem['PROPERTIES'] as $arProp):?>
	<?if(!empty($arProp['VALUE'])):?>
		<p><?=$arProp["NAME"]?>: <?=$arProp["VALUE"]?></p>
	<?endif;?>
<?endforeach;?>

<p><?echo $arResult["DETAIL_TEXT"];?></p>


<div style="clear:both"></div>
<h3>похожие новости:</h3>	
<?foreach($arResult["SIM"] as $arItem):?>
		
<p><a href="<?=$arItem["DETAIL_LINK"]; ?>"><?=$arItem["NAME"];?></a></p>
					
<?endforeach;?>



		

