<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
IncludeTemplateLangFile(__FILE__);
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	
	<title><?$APPLICATION->ShowTitle()?></title>
	<link rel="stylesheet" href="/local/templates/.default//template_style.css"/>
	<script type="text/javascript" src="/local/templates/.default/js/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="/local/templates/.default/js/slides.min.jquery.js"></script>
	<script type="text/javascript" src="/local/templates/.default/js/jquery.carouFredSel-6.1.0-packed.js"></script>
	<script type="text/javascript" src="/local/templates/.default/js/functions.js"></script>
	<link rel="stylesheet" type="text/css" media="all" href="/local/templates/.default/js/fancybox/jquery.fancybox-1.3.4.css">
    <script type="text/javascript" src="/local/templates/.default/js/fancybox/jquery.fancybox-1.3.4.js"></script>
	<?$APPLICATION->ShowHead();?>
	<!--[if gte IE 9]><style type="text/css">.gradient {filter: none;}</style><![endif]-->
</head>
<body>
<?$APPLICATION->ShowPanel();?>
	<div class="wrap">
		<div class="hd_header_area">
			<div class="hd_header">
				<table>
					<tr>
						<td rowspan="2" class="hd_companyname">
							<h1><a href=""><?$APPLICATION->IncludeComponent(
												"bitrix:main.include",
												"",
												Array(
													"AREA_FILE_SHOW" => "file",
													"AREA_FILE_SUFFIX" => "inc",
													"EDIT_TEMPLATE" => "",
													"PATH" => "/include/logo.php"
												)
											);?></a></h1>
						</td>
						<td rowspan="2" class="hd_txarea">
							<span class="tel"><?$APPLICATION->IncludeComponent(
													"bitrix:main.include",
													"",
													Array(
														"AREA_FILE_SHOW" => "file",
														"AREA_FILE_SUFFIX" => "inc",
														"EDIT_TEMPLATE" => "",
														"PATH" => "/include/phone.php"
													)
												);?></span>	<br/>	
							<?=GetMessage('WORK_TIME')?> 
							<span class="workhours"><?$APPLICATION->IncludeComponent(
															"bitrix:main.include",
															"",
															Array(
																"AREA_FILE_SHOW" => "file",
																"AREA_FILE_SUFFIX" => "inc",
																"EDIT_TEMPLATE" => "",
																"PATH" => "/include/workTime.php"
															)
														);?></span>	
							<p><?$APPLICATION->ShowProperty('name_view_product')?></p>																				
						</td>
						<td style="width:232px">
							<form action="">
								<div class="hd_search_form" style="float:right;">
									<input placeholder="Поиск" type="text"/>
									<input type="submit" value=""/>
								</div>
							</form>
						</td>
					</tr>
					<tr>
						<td style="padding-top: 11px;">
							<span class="hd_singin"><a id="hd_singin_but_open" href="">Войти на сайт</a>
							<div class="hd_loginform">
								<span class="hd_title_loginform">Войти на сайт</span>
								<form name="" method="" action="">
					
									<input placeholder="Логин"  type="text">
									<input  placeholder="Пароль"  type="password">			
									<a href="/" class="hd_forgotpassword">Забыли пароль</a>
									
									<div class="head_remember_me" style="margin-top: 10px">
										<input id="USER_REMEMBER_frm" name="USER_REMEMBER" value="Y" type="checkbox">
										<label for="USER_REMEMBER_frm" title="Запомнить меня на этом компьютере">Запомнить меня</label>
									</div>				
									<input value="Войти" name="Login" style="margin-top: 20px;" type="submit">
									</form>
								<span class="hd_close_loginform">Закрыть</span>
							</div>
							</span><br>
							<a href="" class="hd_signup">Зарегистрироваться</a>
						</td>
					</tr>
				</table>
					<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"top_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "3",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "top",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "top_menu"
	),
	false
);?>
			</div>
		</div>
		
		<!--- // end header area --->
		<?$APPLICATION->IncludeComponent(
			"bitrix:breadcrumb",
			"nav_item",
			Array(
				"PATH" => "",
				"SITE_ID" => "s1",
				"START_FROM" => "0"
			)
		);?>
		<div class="main_container page">
			<div class="mn_container">
				<div class="mn_content">
					<div class="main_post">
					    <div class="main_title">
							<p class="title"><?$APPLICATION->ShowTitle(false)?></p>
						</div>
						<!-- workarea -->