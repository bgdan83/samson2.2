<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();


//test_dump($arResult);

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');

?>
<table>
	<tr>
		<td>Дата:</td>
		<td><?=$arResult['rows'][0]['UF_DATE_TIME_BID']?></td>
	</tr>
	<tr>
		<td>ФИО:</td>
		<?if($arResult['rows'][0]["UF_USER_ID"] != NULL):?>
			<td><a href="<?=$arResult['rows'][0]['USER_LINK']?>"><?=$arResult['rows'][0]['UF_FIO_USER']?></a></td>
		<?else:?>
			<td><?=$arResult['rows'][0]['UF_FIO_USER']?></td>
		<?endif;?> 
	</tr>
	<tr>
		<td>Телефон:</td>
		<td><?=$arResult['rows'][0]['UF_PHONE']?></td>
	</tr>
	<tr>
		<td>Артикул:</td>
		<td><?=$arResult['rows'][0]['UF_VENDOR_CODE']?></td>
	</tr>
	<tr>
		<td>Название:</td>
		<td><a href="<?=$arResult['rows'][0]['GOODS_LINK']?>"><?=$arResult['rows'][0]['GOODS_NAME']?></a></td>
	</tr>
	<tr>
		<td>Желаемая цена:</td>
		<td><?=$arResult['rows'][0]['UF_LIKE_PRICE']?></td>
	</tr>
	<tr>
		<td>Цена на сайте:</td>
		<td><?=$arResult['rows'][0]['UF_SITE_PRICE']?></td>
	</tr>
	<tr>
		<td>Фото:</td>
		<td><img src="<?=$arResult['rows'][0]['PREVIEW_PICTURE']['SRC']?>"></td>
	</tr>
	<tr>
		<?if($arResult['rows'][0]['UF_CONDITION'] != 1):?>
			<td>Комментарий:</td>
			<td>
				<form id="login_form" method="post" action="">
					<p id="login_error">Не заполнено обязательное поле</p>	
					<textarea rows="2" cols="35" id="comment" name="comment"></textarea>
					<input type="hidden" name="id" value="<?=$arResult['rows'][0]['ID']?>"></textarea>
					<input type="submit" value="Обработано">
				</form>
			</td>
		<?else:?>
			<td>Комментарий:</td>
			<td><?=$arResult['rows'][0]['UF_COMMENT']?></td>
		<?endif;?>
	</tr>
</table>

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

