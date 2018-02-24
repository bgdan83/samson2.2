<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница");
?><?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"form_auth", 
	array(
		"COMPONENT_TEMPLATE" => "form_auth",
		"REGISTER_URL" => "/user/registration.php",
		"FORGOT_PASSWORD_URL" => "/user/",
		"PROFILE_URL" => "/user/profile.php",
		"SHOW_ERRORS" => "Y"
	),
	false
);?><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>