<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новый юзер");
?><?$APPLICATION->IncludeComponent(
	"mycomponent:user_last_registration",
	".default",
	Array(
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "1200",
		"CACHE_TYPE" => "A",
		"COMPONENT_TEMPLATE" => ".default"
	)
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>