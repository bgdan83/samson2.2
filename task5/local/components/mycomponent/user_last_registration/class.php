<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();


use \Bitrix\Main\Application; 
use \Bitrix\Main\Web\Uri;
use \Bitrix\Main\UserTable;
/** @var CBitrixComponent $this */
/** @var array $arParams */
/** @var array $arResult */
/** @var string $componentPath */
/** @var string $componentName */
/** @var string $componentTemplate */
/** @global CDatabase $DB */
/** @global CUser $USER */
/** @global CMain $APPLICATION */


class UserLastRegistration extends CBitrixComponent
{

	function listUsers(int $limit, array $filter)
	{
		
		$rsUsers = UserTable::getList(array(
										'select'  => array(  'ID',
															'LOGIN',
															'NAME',
															'LAST_NAME',
															'EMAIL',
															'LAST_LOGIN',
															'DATE_REGISTER'),
										'filter'  => $filter,
										'order'   => array('DATE_REGISTER' => 'DESC'),
										'limit'   => $limit, 
										
									));

		
		$request = Application::getInstance()->getContext()->getRequest();
        $dir = $request->getRequestedPageDirectory(); 
		while($arItem = $rsUsers->fetch())
		{
			$arResult["ITEMS"][] = array(
									'ID' => $arItem['ID'],
									'LOGIN' => $arItem['LOGIN'],
									'NAME' => $arItem['NAME']."&nbsp".$arItem['LAST_NAME'],
									'EMAIL' => $arItem['EMAIL'],
									'LAST_LOGIN' => $arItem['LAST_LOGIN'],
									'DETAIL_PAGE_URL' => $dir . "/" . mb_strtolower($arItem['LOGIN']),
									'DATE_REGISTER' => $arItem['DATE_REGISTER'],
			);		
		}

		return $arResult;
	}

	public function executeComponent()
	{ 
	    if($this->StartResultCache(false)){

			$this -> arResult = $this->listUsers(3, array('LID' => SITE_ID));

			$this -> IncludeComponentTemplate();
		}
	}
}




?>
