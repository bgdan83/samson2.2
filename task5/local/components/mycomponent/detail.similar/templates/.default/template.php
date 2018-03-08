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

<?$idItem = $_REQUEST['ELEMENT_ID'];?>
<?echo $arResult["ITEMS"][$idItem]["NAME"];?>
<p><?echo $arResult["ITEMS"][$idItem]["DETAIL_TEXT"];?></p>

<?
$tmpName =  preg_replace("|[,.:;]+|","", $arResult["ITEMS"][$idItem]["NAME"]);
$tmpName = preg_replace("|\b[\d\w]{1,3}\b|i","",$tmpName); 
$arName = explode(" ", $tmpName);
unset($arResult["ITEMS"][$idItem]);

?>

<h3>похожие новости:</h3>	
<?foreach($arResult["ITEMS"] as $arItem):?>
	<?foreach($arName as $name):?>
	
		<?if( (stripos($arItem{"NAME"}, substr($name, 0, 5))  !== false)):?>
		
		<p><a href="<?=$APPLICATION->GetCurPageParam("ELEMENT_ID=". $arItem['ID'], array("ELEMENT_ID")); ?>"><?=$arItem["NAME"];?></a></p>
		
		<?endif;?>	
	<?endforeach;?>

<?endforeach;?>
				
		

