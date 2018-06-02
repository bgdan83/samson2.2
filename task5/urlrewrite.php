<?
$arUrlRewrite = array(
	array(
		"CONDITION" => "#^/admin/user_new/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "LOGIN=\$1",
		"PATH" => "/admin/users/detail.php",
	),
	array(
		"CONDITION" => "#^/admin/users/([a-zA-Z0-9\\.\\-_]+)/?.*#",
		"RULE" => "LOGIN=\$1",
		"PATH" => "/admin/users/detail.php",
	),
	array(
		"CONDITION" => "#^/services/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/services/index.php",
	),
	array(
		"CONDITION" => "#^/products/#",
		"RULE" => "",
		"ID" => "bitrix:catalog",
		"PATH" => "/products/index.php",
	),
);

?>