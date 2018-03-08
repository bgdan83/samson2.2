<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
IncludeTemplateLangFile(__FILE__);
?>
<!-- workarea -->
					</div>
				</div>
				<div class="sb_sidebar">
					<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"left_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "left",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "left",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "left_menu"
	),
	false
);?>
					<div class="sb_event">
						<div class="sb_event_header"><h4>Ближайшие события</h4></div>
						<p><a href="">29 августа 2012, Москва</a></p>
						<p>Семинар производителей мебели России и СНГ, Обсуждение тенденций.</p>
					</div>
					<div class="sb_action">
						<a href=""><img src="<?=SITE_TEMPLATE_PATH?>/content/11.png" alt=""/></a>
						<h4>Акция</h4>
						<h5><a href="">Мебельная полка всего за 560 Р</a></h5>
						<a href="" class="sb_action_more">Подробнее &rarr;</a>
					</div>
					<div class="sb_reviewed">
							<img src="<?=SITE_TEMPLATE_PATH?>/content/8.png" class="sb_rw_avatar" alt=""/>
							<span class="sb_rw_name">Сергей Антонов</span>
							<span class="sb_rw_job">Руководитель финансового отдела “Банк+”</span>
							<p>“Покупал офисные стулья и столы, остался очень доволен! Низкие цены, быстрая доставка, обслуживание на высоте! Спасибо!”</p>
							<div class="clearboth"></div>
							<div class="sb_rw_arrow"></div>
					</div>
				</div>
				<div class="clearboth"></div>
			</div>
		</div>

		<div class="ft_footer">
			<div class="ft_container">
				<div class="ft_about">
					<h4><?=GetMessage("ABOUT_STORE")?></h4>
					<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"bottom_menu", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "bottom",
		"DELAY" => "N",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "N",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"ROOT_MENU_TYPE" => "bottom",
		"USE_EXT" => "N",
		"COMPONENT_TEMPLATE" => "bottom_menu"
	),
	false
);?>
				</div>
				<div class="ft_catalog">
					<h4><?=GetMessage("PRODUCT_CATALOG")?></h4>
					<ul>
						<li><a href="">Кухни</a></li>
						<li><a href="">Кровати и кушетки</a></li>
						<li><a href="">Гарнитуры</a></li>
						<li><a href="">Тумобчки и прихожие</a></li>
						<li><a href="">Спальни и матрасы</a></li>
						<li><a href="">Аксессуары</a></li>
						<li><a href="">Столы и стулья</a></li>
						<li><a href="">Каталоги мебели</a></li>
						<li><a href="">Раскладные диваны</a></li>
						<li><a href="">Кресла</a></li>
					</ul>
					
				</div>
				<div class="ft_contacts">
					<h4><?=GetMessage("CONTACT_INFO")?></h4>
					<!-- vCard        http://help.yandex.ru/webmaster/hcard.pdf      -->
					<p class="vcard">
						<span class="adr">
							<span class="street-address">ул. Летняя стр.12, офис 512</span>
						</span>
						<span class="tel"><?$APPLICATION->IncludeComponent(
													"bitrix:main.include",
													"",
													Array(
														"AREA_FILE_SHOW" => "file",
														"AREA_FILE_SUFFIX" => "inc",
														"EDIT_TEMPLATE" => "",
														"PATH" => "/include/phone.php"
													)
												);?></span>
						<strong><?=GetMessage("FOOTER_TIME")?></strong> <br/> 
						<span class="workhours"><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	Array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"PATH" => "/include/workTime.php"
	)
);?></span><br/>
					</p>
					<ul class="ft_solcial">
						<li><a href="" class="fb"></a></li>
						<li><a href="" class="tw"></a></li>
						<li><a href="" class="ok"></a></li>
						<li><a href="" class="vk"></a></li>
					</ul>
					<div class="ft_copyright">© 2000 - 2012 "<?=GetMessage("FURNITURE_SHOP")?>" </div>
					
					
				</div>
				
				<div class="clearboth"></div>
			</div>
		</div>
	</div>
</body>
</html>