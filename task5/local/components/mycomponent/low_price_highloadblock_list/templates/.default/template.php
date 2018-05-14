<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//test_dump($arResult);

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');

?>

<form action="" method="get">
    <p><label>Состояние </label>
    <select name="cond">
    <option value="0">Новый</option>
    <option value="1">Обработан</option>
    </select></p>
	
    <p><label>Дата </label>
	<input type="text" name="date" placeholder="24.04.2018"></p>
	
	<p><label>Артикул </label>
	<input type="text" name="vendor_code"></p>
    
    <p><label>Сортировка по дате </label>
    <select name="sort_type">
    <option value="ASC">Возрастание</option>
    <option value="DESC">Убывание</option>
    </select></p>
	<input type="submit" value="Submit">

	<p><label>Экспорт в XML</label>
	<input type="submit" value="Экспорт" name='button'></p>
</form>

<table id="result-table">
	<tr>
		<th><?=$arResult['fields']["UF_DATE_BID"]["EDIT_FORM_LABEL"]?></th>
		<th><?=$arResult['fields']["UF_CONDITION"]["EDIT_FORM_LABEL"]?></th>
		<th>Название товара</th>
		<th><?=$arResult['fields']["UF_VENDOR_CODE"]["EDIT_FORM_LABEL"]?></th>
	</tr>
<?foreach($arResult['rows'] as $row):?>
	<tr class="<?=$row['ID']?>">
		<td><?=$row["UF_DATE_BID"]?></td>
		<td><?=$arResult['fields']["UF_CONDITION"]['SETTINGS']['LABEL'][$row["UF_CONDITION"]]?></td>
		<td><?=$row["GOODS_NAME"]?></td>
		<td><?=$row["UF_VENDOR_CODE"]?></td>
	</tr>	
<?endforeach?>
</table>
<?php
if ($arParams['ROWS_PER_PAGE'] > 0):
	$APPLICATION->IncludeComponent(
		'bitrix:main.pagenavigation',
		'',
		array(
			'NAV_OBJECT' => $arResult['nav_object'],
			'SEF_MODE' => 'N',
		),
		false
	);
endif;
?>
<script type="text/javascript">
BX.ready(function(){ 
	var table = document.getElementById('result-table');
	var trList= table.getElementsByTagName('tr');
	for (var i=1;i<trList.length;i++){
		
	     var id = trList[i].classList.item(0);
		 
		 $('.' + id).fancybox({type: 'ajax', href: "detail.php?ID=" + id }); 
	}
})
</script>

