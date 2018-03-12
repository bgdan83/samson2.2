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

<?$idItem = htmlspecialcharsEx($_REQUEST['ELEMENT_ID']);?>
<img src="<?=$arResult["ITEMS"][$idItem]["DETAIL_PICTURE"]["SRC"]?>" style="float: left;"/>
<?echo $arResult["ITEMS"][$idItem]["NAME"];?>
<?foreach( $arResult["ITEMS"][$idItem]['PROPERTIES'] as $arProp):?>
	<?if(!empty($arProp['VALUE'])):?>
        <p><?=$arProp["NAME"]?>: <?=$arProp["VALUE"]?></p>
	<?endif;?>
<?endforeach;?>

<p><?echo $arResult["ITEMS"][$idItem]["DETAIL_TEXT"];?></p>

<?
$tmpName =  preg_replace("|[,.:;]+|","", $arResult["ITEMS"][$idItem]["NAME"]);
$arName = explode(" ", $tmpName);
unset($arResult["ITEMS"][$idItem]);
?>
<div style="clear:both"></div>
<h3>похожие новости:</h3>	
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?foreach($arName as $name):?>
	
		<?if( (stripos($arItem{"NAME"}, substr($name, 0, 5))  !== false) && strlen($name)>= 4):?>
			<p><a href="<?=$APPLICATION->GetCurPageParam("ELEMENT_ID=". $arItem['ID'], array("ELEMENT_ID")); ?>"><?=$arItem["NAME"];?></a></p>
			<?break;?>
		
		<?endif;?>	
	<?endforeach;?>

<?endforeach;?>
				
		

