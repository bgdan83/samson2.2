<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentDescription = array(
	"NAME" => GetMessage('MY_BASKET_COMPONENT_NAME'),
	"DESCRIPTION" => GetMessage('MY_BASKET_COMPONENT_DESCRIPTION'),
	//"ICON" => "images/hl_list.gif",
	"CACHE_PATH" => "Y",
	"SORT" => 10,
	"PATH" => array(
		"ID" => "project",
		"CHILD" => array(
			"ID" => "mybasket",
			"NAME" => GetMessage('MY_BASKET_COMPONENT_CATEGORY_TITLE'),
			
		),
	),
);

?>