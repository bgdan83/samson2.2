<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();
global $USER;
$userId = $USER->GetID();
$rsUsers = \Bitrix\Main\UserTable::getList(array(
									'select'  => array(  
														'NAME',
														'LAST_NAME',
														'SECOND_NAME',
														'PERSONAL_PHONE',
                                    ),
									'filter'  => array('LID' => SITE_ID,
													   'ID' => $userId
									)
));        


while($arItem = $rsUsers->fetch())
{
	$arResult['USER'] = array(
							'NAME' => $arItem['NAME']
								."&nbsp".$arItem['LAST_NAME']
								."&nbsp".$arItem['SECOND_NAME'],
							'PERSONAL_PHONE' => $arItem['PERSONAL_PHONE']
	);		
}