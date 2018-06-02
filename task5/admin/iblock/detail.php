<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("");
$APPLICATION->SetTitle(false);
?><?$APPLICATION->IncludeComponent(
	"mycomponent:detail.similar", 
	".default", 
	array(
		"IBLOCKS" => array(
			0 => "1",
		),
		"IBLOCK_TYPE" => "news",
		"PROPERTY_CODE" => array(
			0 => "9",
			1 => "",
		),
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>