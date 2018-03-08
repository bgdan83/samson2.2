<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle(false);
?><?$APPLICATION->IncludeComponent(
	"mycomponent:detail.similar",
	"",
	Array(
		"IBLOCKS" => array("1"),
		"IBLOCK_TYPE" => "news"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>