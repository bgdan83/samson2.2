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


$login = htmlspecialcharsEx($_REQUEST['LOGIN']);

$filter = Array
(
   "LOGIN" => $login
);
$rsUsers = CUser::GetList(($by="last_login"), ($order="desc"), $filter);
$page = $APPLICATION->GetCurPage();
$arPage = explode("/", $page);
$arPage[count($arPage)-1] = "";
$page = implode("/", $arPage);
while($arItem = $rsUsers->GetNext())
{
	$arResult["ITEMS"][] = array(
							'ID' => $arItem['ID'],
							'LOGIN' => $arItem["LOGIN"],
							'NAME' => $arItem['NAME']."&nbsp".$arItem['LAST_NAME'],
							'EMAIL' => $arItem["EMAIL"],
							'LAST_LOGIN' => $arItem["LAST_LOGIN"],
							'DETAIL_PAGE_URL' => $page .  $arItem['LOGIN'],
	);		
}

$this->IncludeComponentTemplate();

?>
