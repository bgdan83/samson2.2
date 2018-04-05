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




$filter = Array
(
   "LOGIN" => htmlspecialcharsEx($_REQUEST['LOGIN']),
   "EMAIL" => htmlspecialcharsEx($_REQUEST["email"]),
);
$rsUsers = CUser::GetList(($by="last_login"), ($order="desc"), $filter);
/* $page = $APPLICATION->GetCurPage();
$arPage = explode("/", $page);
$arPage[count($arPage)-1] = "";
$page = implode("/", $arPage); */
$dir = $APPLICATION->GetCurDir();
while($arItem = $rsUsers->GetNext())
{
	$arResult["ITEMS"][] = array(
							'ID' => $arItem['ID'],
							'LOGIN' => $arItem["LOGIN"],
							'NAME' => $arItem['NAME']."&nbsp".$arItem['LAST_NAME'],
							'EMAIL' => $arItem["EMAIL"],
							'LAST_LOGIN' => $arItem["LAST_LOGIN"],
							'DETAIL_PAGE_URL' => $dir .  mb_strtolower($arItem['LOGIN']),
	);		
}

$this->IncludeComponentTemplate();

?>
