<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
//test_dump($arResult);
if (!empty($arResult['ERROR']))
{
	ShowError($arResult['ERROR']);
	return false;
}

global $USER_FIELD_MANAGER;

$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/js/highloadblock/css/highloadblock.css');

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock Row');

$listUrl = str_replace('#BLOCK_ID#', intval($arParams['BLOCK_ID']),	$arParams['LIST_URL']);

?>

<a href="<?=htmlspecialcharsbx($listUrl)?>"><?=GetMessage('HLBLOCK_ROW_VIEW_BACK_TO_LIST')?></a><br><br>

<div class="reports-result-list-wrap">
	<div class="report-table-wrap">
		<div class="reports-list-left-corner"></div>
		<div class="reports-list-right-corner"></div>
		<table cellspacing="0" class="reports-list-table" id="report-result-table">
			<!-- head -->
			<tr>
				<th class="reports-first-column" style="cursor: default">
					<div class="reports-head-cell"><span class="reports-head-cell-title"><?=GetMessage('HLBLOCK_ROW_VIEW_NAME_COLUMN')?></span></div>
				</th>
				<th class="reports-last-column" style="cursor: default">
					<div class="reports-head-cell"><span class="reports-head-cell-title"><?=GetMessage('HLBLOCK_ROW_VIEW_VALUE_COLUMN')?></span></div>
				</th>
			</tr>

			<tr>
				<td class="reports-first-column">Дата:</td>
				<td class="reports-last-column"><?=$arResult['row']['UF_DATE_TIME_BID']?></td>
			</tr>
			<tr>
				<td class="reports-first-column">ФИО:</td>
				<?if($arResult['row']["UF_USER_ID"] != NULL):?>
				    <td class="reports-last-column"><a href="<?=$arResult['row']['UF_LINK_USER']?>"><?=$arResult['row']['UF_FIO_USER']?></a></td>
				<?else:?>
				    <td class="reports-last-column"><?=$arResult['row']['UF_FIO_USER']?></td>
				<?endif;?> 
			</tr>
			<tr>
				<td class="reports-first-column">Телефон:</td>
				<td class="reports-last-column"><?=$arResult['row']['UF_PHONE']?></td>
			</tr>
			<tr>
				<td class="reports-first-column">Артикул:</td>
				<td class="reports-last-column"><?=$arResult['row']['UF_VENDOR_CODE']?></td>
			</tr>
			<tr>
				<td class="reports-first-column">Название:</td>
				<td class="reports-last-column"><a href="<?=$arResult['row']['UF_LINK_GOODS']?>"><?=$arResult['row']['UF_NAME_GOODS']?></a></td>
			</tr>
			<tr>
				<td class="reports-first-column">Желаемая цена:</td>
				<td class="reports-last-column"><?=$arResult['row']['UF_LIKE_PRICE']?></td>
			</tr>
            <tr>
				<td class="reports-first-column">Цена на сайте:</td>
				<td class="reports-last-column"><?=$arResult['row']['UF_SITE_PRICE']?></td>
			</tr>
			<tr>
				<td class="reports-first-column">Фото:</td>
				<td class="reports-last-column"><img src="<?=$arResult['row']['UF_PHOTO']?>"></td>
			</tr>
			<tr>
				<?if($arResult['row']['UF_CONDITION'] != 1):?>
					<td class="reports-first-column">Комментарий:</td>
					<td class="reports-last-column">
						<form id="login_form" method="post" action="">
						    <p id="login_error">Не заполнено обязательное поле</p>	
							<textarea rows="2" cols="35" id="comment" name="comment"></textarea>
							<input type="hidden" name="id" value="<?=$arResult['row']['ID']?>"></textarea>
							<input type="submit" value="Обработано">
						</form>
					</td>
				<?else:?>
				    <td class="reports-first-column">Комментарий:</td>
				    <td class="reports-last-column"><?=$arResult['row']['UF_COMMENT']?></td>
				<?endif;?>
			</tr>
		</table>
	</div>
</div>
<script>
$(document).ready(function(){
	$("#login_error").hide();

	$("#login_form").bind("submit", function() {

		if ($("#comment").val().length < 1){
			$("#login_error").show();
			$.fancybox.resize();
			return false;
		}

		//$.fancybox.showActivity();
		var $that = $(this),
		fData = $that.serialize(); 
		console.log(fData);
		$.ajax({
		    url: "/ajax/low_price_admin/ajax.php", 
		    type: $that.attr('method'), 
		    data: {form_data: fData},
		    dataType: 'json',
		    complete: function() {
			   $that.html("Данные сохранены"); 
		    }
		});
		return false;
	});
});
</script>