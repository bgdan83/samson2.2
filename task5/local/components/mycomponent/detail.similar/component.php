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
	
);

$arOrder = array(
	"created" => "desc"
);

$arSelect = array(
    "ID",
	"NAME",
	"DETAIL_PICTURE",
	"DETAIL_TEXT",
);

$rsItems = CIBlockElement::GetList($arOrder, $arFilter, false, false, $arSelect);
while($arItem = $rsItems -> GetNext())
{
	$arResult["ITEMS"][$arItem["ID"]] = array(
		'ID' => $arItem["ID"],
		'NAME' => $arItem["NAME"],
		'DETAIL_PICTURE' => $arItem["DETAIL_PICTURE"],
		'DETAIL_TEXT' => $arItem["DETAIL_TEXT"],
	);
}

$this->IncludeComponentTemplate();

?>
