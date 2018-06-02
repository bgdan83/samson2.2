<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//test_dump($arResult);

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');

?>

<table>
	<tr>
		<th><?=$arResult['fields']["UF_DATE_BID"]["EDIT_FORM_LABEL"]?></th>
		<th><?=$arResult['fields']["UF_CONDITION"]["EDIT_FORM_LABEL"]?></th>
		<th><?=$arResult['fields']["UF_COMMENT"]["EDIT_FORM_LABEL"]?></th>
		<th>Название товара</th>
		<th>Ссылка на товар</th>
		<th><?=$arResult['fields']["UF_VENDOR_CODE"]["EDIT_FORM_LABEL"]?></th>
	</tr>
<?foreach($arResult['rows'] as $row):?>
	<tr>
		<td><?=$row["UF_DATE_BID"]?></td>
		<td><?=$arResult['fields']["UF_CONDITION"]['SETTINGS']['LABEL'][$row["UF_CONDITION"]]?></td>
		<td><?=$row["UF_COMMENT"]?></td>
		<td><?=$row["GOODS_NAME"]?></td>
		<td><a href='<?=$row["GOODS_LINK"]?>'><?=$row["GOODS_LINK"]?></td>
		<td><?=$row["UF_VENDOR_CODE"]?></td>
	</tr>	
<?endforeach?>
</table>


