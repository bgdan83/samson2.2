<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */

if(!CModule::IncludeModule("iblock"))
{
	ShowError(GetMessage("IBLOCK_MODULE_NOT_INSTALLED"));
	return;
}

$arFilter = array(
	"IBLOCK_ID" => $arParams["IBLOCKS"],
	"ID" => $_REQUEST["ELEMENT_ID"],
);

$arOrder = array(
	"created" => "desc"
);

$arSelect = array(
    "ID",
	"IBLOCK_ID",
	"NAME",
	"DETAIL_PICTURE",
	"DETAIL_TEXT",
	"PROPERTY_*",
);
	
$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);

while($obElement = $rsItems -> GetNextElement())
{	
	$arItem = $obElement->GetFields();
	
	$arResult = array(
		'ID' => $arItem["ID"],
		'NAME' => $arItem["NAME"],
		'DETAIL_PICTURE' => CFile::GetFileArray($arItem["DETAIL_PICTURE"]),
		'DETAIL_TEXT' => $arItem["DETAIL_TEXT"],	
	);

	$arResult["PROPERTIES"] = $obElement->GetProperties();	
}

$tmpName =  preg_replace("|[,.:;]+|","", $arResult["NAME"]);
$arLooksLike = array(
	"INCLUDE_SUBSECTIONS" => "Y",
	"!ID"                 => intval($arResult["ID"]) 
);
$NameItems = explode(" ", $tmpName);
 
foreach ($NameItems as $item){
	
	if (strlen($item) >= 4){ 
		$itemsArray[] = array("NAME" => "%".substr($item, 0, 6)."%");  
	}
	
}
	
if(is_array($itemsArray)){
		
	$addFArray = array(
		array(array_merge(array("LOGIC" => "OR"), $itemsArray)),
	);
	
	$arF = array_merge($arLooksLike, $addFArray);
	
	$arFilter = array(
		"IBLOCK_ID" => $arParams["IBLOCKS"],
		$arF,
		
	);
	$arOrder = array(
		"created" => "desc"
	);

	$arSelect = array(
		"ID",
		"NAME",	
	);
	
	$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
	while($obElement = $rsItems -> GetNextElement())
	{	
		$arItem = $obElement->GetFields();
		
		
		$arItem["DETAIL_LINK"] = $APPLICATION->GetCurPageParam("ELEMENT_ID=". $arItem['ID'], array("ELEMENT_ID"));
		$arResult["SIM"][] = $arItem;
	}	
}

$this->IncludeComponentTemplate();

?>
