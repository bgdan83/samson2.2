<?

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!empty($arResult['ERROR']))
{
	echo $arResult['ERROR'];
	return false;
}

$GLOBALS['APPLICATION']->SetAdditionalCSS('/bitrix/js/highloadblock/css/highloadblock.css');

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');

?>
<form action="" method="post">
    <label>Состояние </label>
    <select name="cond">
    <option value="0">Новый</option>
    <option value="1">Обработан</option>
    </select>
	<input type="submit" value="Submit">
</form>
<form action="" method="post">
    <label>Дата </label>
	<input type="text" name="date" placeholder="24.04.2018">
	<input type="submit" value="Submit">
</form>
<form action="" method="post">
	<label>Артикул </label>
	<input type="text" name="vendor_code">
    <input type="submit" value="Submit">
</form>
<form action="" method="post">
    <label>Сортировка по дате </label>
    <select name="date_sort">
    <option value="ASC">Возрастание</option>
    <option value="DESC">Убывание</option>
    </select>
	<input type="submit" value="Submit">
</form>
<div class="reports-result-list-wrap">
<div class="report-table-wrap">
<div class="reports-list-left-corner"></div>
<div class="reports-list-right-corner"></div>

<table cellspacing="2" class="reports-list-table" id="report-result-table">
	<!-- head -->
	<tr>
		<? $i = 0; foreach(array_keys($arResult['tableColumns']) as $col): ?>
		<?
		$i++;

		if ($i == 1)
		{
			$th_class = 'reports-first-column';
		}
		else if ($i == count($arResult['viewColumns']))
		{
			$th_class = 'reports-last-column';
		}
		else
		{
			$th_class = 'reports-head-cell';
		}
        if ($col == 'ID' 
		    || $col == 'UF_LINK_GOODS' 
		    || $col == 'UF_COMMENT' 
			|| $col == 'UF_DATE_TIME_BID'
			|| $col == 'UF_SITE_PRICE'
			|| $col == 'UF_PHOTO'
			|| $col == 'UF_LIKE_PRICE'
			|| $col == 'UF_PHONE'
			|| $col == 'UF_FIO_USER'
			|| $col == 'UF_LINK_USER')
	    {  
	        continue;
		}
	    else {
		// title
		    $arUserField = $arResult['fields'][$col];
		    $title = $arUserField["LIST_COLUMN_LABEL"]? $arUserField["LIST_COLUMN_LABEL"]: $col;
        }
		// sorting
		$defaultSort = 'DESC';
		//$defaultSort = $col['defaultSort'];

		if ($col === $arResult['sort_id'])
		{
			$th_class .= ' reports-selected-column';

			if($arResult['sort_type'] == 'ASC')
			{
				$th_class .= ' reports-head-cell-top';
			}
		}
		else
		{
			if ($defaultSort == 'ASC')
			{
				$th_class .= ' reports-head-cell-top';
			}
		}

		?>
		<th class="<?=$th_class?>" colId="<?=htmlspecialcharsbx($col)?>" defaultSort="<?=$defaultSort?>">
			<div class="reports-head-cell"><?if($defaultSort):
				?><span class="reports-table-arrow"></span><?
			endif?><span class="reports-head-cell-title"><?=htmlspecialcharsex($title)?></span></div>
		</th>
		<? endforeach; ?>
	</tr>

	<!-- data -->
	<? foreach ($arResult['rows'] as $row): ?>
	<tr class="reports-list-item">
		<? $i = 0; foreach(array_keys($arResult['tableColumns']) as $col): ?>
		<?
		$i++;
		if ($i == 1)
		{
			$td_class = 'reports-first-column';
		}
		else if ($i == count($arResult['viewColumns']))
		{
			$td_class = 'reports-last-column';
		}
		else
		{
			$td_class = '';
		}

		//if (CReport::isColumnPercentable($col))
		if (false) // numeric rows
		{
			$td_class .= ' reports-numeric-column';
		}
        if ($col == 'ID' 
		    || $col == 'UF_LINK_GOODS' 
			|| $col == 'UF_COMMENT' 
			|| $col == 'UF_DATE_TIME_BID'
			|| $col == 'UF_SITE_PRICE'
			|| $col == 'UF_PHOTO'
			|| $col == 'UF_LIKE_PRICE'
			|| $col == 'UF_FIO_USER'
			|| $col == 'UF_PHONE'
			|| $col == 'UF_LINK_USER')
	    {  
	        continue;
		}
	    else {
		    $finalValue = $row[$col];
        }
		if ($col === 'ID' && !empty($arParams['DETAIL_URL']))
		{
			$url = str_replace(
				array('#ID#', '#BLOCK_ID#'),
				array($finalValue, intval($arParams['BLOCK_ID'])),
				$arParams['DETAIL_URL']
			);

			$finalValue = '<a href="'.htmlspecialcharsbx($url).'">'.$finalValue.'</a>';
		}

		?>
		<td class="<?=$td_class?>"><span class="btn<?=$row['ID']?>"><?=$finalValue?></span></td>
		<script>
			$(document).ready(function(){  
			    $('.btn<?=$row['ID']?>').fancybox({type: 'ajax', href: "detail.php?ID=<?=$row['ID']?>"});
			})
		</script>
		<? endforeach; ?>
	</tr>
	<? endforeach; ?>

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


<form id="hlblock-table-form" action="" method="get">
	<input type="hidden" name="BLOCK_ID" value="<?=htmlspecialcharsbx($arParams['BLOCK_ID'])?>">
	<input type="hidden" name="sort_id" value="">
	<input type="hidden" name="sort_type" value="">
</form>

<script type="text/javascript">
	BX.ready(function(){
		var rows = BX.findChildren(BX('report-result-table'), {tag:'th'}, true);
		for (i in rows)
		{
			var ds = rows[i].getAttribute('defaultSort');
			if (ds == '')
			{
				BX.addClass(rows[i], 'report-column-disabled-sort')
				continue;
			}

			BX.bind(rows[i], 'click', function(){
				var colId = this.getAttribute('colId');
				var sortType = '';

				var isCurrent = BX.hasClass(this, 'reports-selected-column');

				if (isCurrent)
				{
					var currentSortType = BX.hasClass(this, 'reports-head-cell-top') ? 'ASC' : 'DESC';
					sortType = currentSortType == 'ASC' ? 'DESC' : 'ASC';
				}
				else
				{
					sortType = this.getAttribute('defaultSort');
				}

				var idInp = BX.findChild(BX('hlblock-table-form'), {attr:{name:'sort_id'}});
				var typeInp = BX.findChild(BX('hlblock-table-form'), {attr:{name:'sort_type'}});

				idInp.value = colId;
				typeInp.value = sortType;

				BX.submit(BX('hlblock-table-form'));
			});
		}
	});
</script>

</div>
</div>