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





$obCache = new CPHPCache();
$cacheLifeTime = $arParams['CACHE_TIME'];
$cacheID = "";
$cachePath = "/cache_test/";
if($obCache->InitCache($cacheLifeTime, $cacheID  ,$cachePath ))
{
	$arVars = $obCache->GetVars();
	$arResult = $arVars['arResult'];
	$obCache->Output();
} 
elseif($obCache->StartDataCache())
{
	$filter = Array(
       "LOGIN" => $_REQUEST['LOGIN'],  
    );
	$rsUsers = CUser::GetList(($by="DATE_REGISTER"), ($order="desc"), $filter,  array('NAV_PARAMS' => array('nTopCount' => 3),));

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
								'DATE_REGISTER' => $arItem["DATE_REGISTER"],
		);		
	}
    $this->IncludeComponentTemplate();
	$obCache->endDataCache(
		array(
			'arResult' => $arResult,
		)
	);
}


?>
