<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>arParams: "; print_r($arParams); echo "</pre>";
//echo "<pre>arResult: "; print_r($arResult); echo "</pre>";

//echo "<pre>"; print_r($arResult["arrFORM_FILTER"]); echo "</pre>";
?>
<script>
<!--
function Form_Filter_Click_<?=$arResult["filter_id"]?>()
{
	var sName = "<?=$arResult["tf_name"]?>";
	var filter_id = "form_filter_<?=$arResult["filter_id"]?>";
	var form_handle = document.getElementById(filter_id);

	if (form_handle)
	{
		if (form_handle.className != "form-filter-none")
		{
			form_handle.className = "form-filter-none";
			document.cookie = sName+"="+"none"+"; expires=Fri, 31 Dec 2030 23:59:59 GMT;";
		}
		else
		{
			form_handle.className = "form-filter-inline";
			document.cookie = sName+"="+"inline"+"; expires=Fri, 31 Dec 2030 23:59:59 GMT;";
		}
	}
}
//-->
</script>


 

<?
if (strlen($arResult["FORM_ERROR"]) > 0) ShowError($arResult["FORM_ERROR"]);
if (strlen($arResult["FORM_NOTE"]) > 0) ShowNote($arResult["FORM_NOTE"]);
?>
<div id="content"></div>
<p>
<b>
<a href="result_new.php" id="popupbutton">Создать</a></b>
</p>
<form name="rform_<?=$arResult["filter_id"]?>" method="post" action="<?=POST_FORM_ACTION_URI?>#nav_start">
	<input type="hidden" name="WEB_FORM_ID" value="<?=$arParams["WEB_FORM_ID"]?>" />
	<?=bitrix_sessid_post()?>

	

	
	<p>
	<?=$arResult["pager"]?>
	</p>
	<table class="form-table data-table">
		<?
		/***********************************************
					  table header
		************************************************/
		?>
		<thead>
			<tr>
				
				<th>Дата результата<br /></th>
				<?
				if ($arParams["F_RIGHT"] >= 25)
				{
				?>
				
				<?
				} //endif;($F_RIGHT>=25)
				?>
				<?
				$colspan = 3;
				if (is_array($arResult["arrColumns"]))
				{
					foreach ($arResult["arrColumns"] as $arrCol)
					{
						if (!is_array($arParams["arrNOT_SHOW_TABLE"]) || !in_array($arrCol["SID"], $arParams["arrNOT_SHOW_TABLE"]))
						{
							if (($arrCol["ADDITIONAL"]=="Y" && $arParams["SHOW_ADDITIONAL"]=="Y") || $arrCol["ADDITIONAL"]!="Y")
							{
								$colspan++;
								?>
				<th>
								<?
								if ($arParams["F_RIGHT"] >= 25)
								{
								?>
					<?
								}//endif($F_RIGHT>=25);
								?>
								<?=$arrCol["RESULTS_TABLE_TITLE"]?>
								
				</th><?
							} //endif(($arrCol["ADDITIONAL"]=="Y" && $SHOW_ADDITIONAL=="Y") || $arrCol["ADDITIONAL"]!="Y");
						}
						
						//endif(!is_array($arrNOT_SHOW_TABLE) || !in_array($arrCol["SID"],$arrNOT_SHOW_TABLE));
					} //foreach
				} //endif(is_array($arrColumns)) ;
				?>
				<th>Статус</th>
			</tr>
		</thead>
		
		<?
		/***********************************************
					  table body
		************************************************/
		?>
		<?
		if(count($arResult["arrResults"]) > 0)
		{
			?>
			<tbody>
			<?
			$j=0;
			foreach ($arResult["arrResults"] as $arRes)
			{
				$j++;

			if ($arParams["SHOW_STATUS"]=="Y" || $arParams["can_delete_some"] && $arRes["can_delete"])
			{
				if ($j>1)
				{
			?>
				
			<?
				} //endif ($j>1);
			?>
				
			<?
			} //endif ($SHOW_STATUS=="Y");
			?>
				<tr>
					<td>
					
						<?
						if ($arRes["can_edit"])
						{
						?>
						<?
							if (strlen(trim($arParams["EDIT_URL"]))>0)
							{
								$href = $arParams["SEF_MODE"] == "Y" ? str_replace("#RESULT_ID#", $arRes["ID"], $arParams["EDIT_URL"]) : $arParams["EDIT_URL"].(strpos($arParams["EDIT_URL"], "?") === false ? "?" : "&")."RESULT_ID=".$arRes["ID"]."&WEB_FORM_ID=".$arParams["WEB_FORM_ID"];
						?>
						
								[&nbsp;<span id="btn<?=$arRes["ID"]?>"><?=$arRes["DATE_CREATE"]?></span>&nbsp;]
								<script>  
								$(document).ready(function(){  
								  
									$("#btn<?=$arRes["ID"]?>").click(function(){  
										$.ajax({  
											url: "<?=$arParams["EDIT_URL"].(strpos($arParams["EDIT_URL"], "?") === false ? "?" : "&")."RESULT_ID=".$arRes["ID"]."&WEB_FORM_ID=".$arParams["WEB_FORM_ID"];?>",  
											cache: false,  
											success: function(html){  
												$("#content").html(html);  
											}  
										});  
									});  	  
								});  
							</script>  
							
						<?
							}// endif(strlen(trim($EDIT_URL))>0);
						?>
						<?
						}// endif($can_edit);
						?>

							
						
										
				</td>
				
				<?
				if ($arParams["F_RIGHT"] >= 25)
				{
				?>
				
				<?
				} //endif ($F_RIGHT>=25);
				?>
				<?
				foreach ($arResult["arrColumns"] as $FIELD_ID => $arrC)
				{
					if (!is_array($arParams["arrNOT_SHOW_TABLE"]) || !in_array($arrC["SID"], $arParams["arrNOT_SHOW_TABLE"]))
					{
						if (($arrC["ADDITIONAL"]=="Y" && $arParams["SHOW_ADDITIONAL"]=="Y") || $arrC["ADDITIONAL"]!="Y")
						{
				?>
				<td>
					<?
					$arrAnswer = $arResult["arrAnswers"][$arRes["ID"]][$FIELD_ID];
					if (is_array($arrAnswer))
					{
						foreach ($arrAnswer as $key => $arrA)
						{
						?>
							<?if (strlen(trim($arrA["USER_TEXT"])) > 0) {?><?=$arrA["USER_TEXT"]?><br /><?}?>
							<?if (strlen(trim($arrA["ANSWER_TEXT"])) > 0) {?><?}?>
							<?if (strlen(trim($arrA["ANSWER_VALUE"])) > 0 && $arParams["SHOW_ANSWER_VALUE"]=="Y") {?>(<span class='form-ansvalue'><?=$arrA["ANSWER_VALUE"]?></span>)<?}?>
									<br />
									<?
									if (intval($arrA["USER_FILE_ID"])>0)
									{
										if ($arrA["USER_FILE_IS_IMAGE"]=="Y")
										{
										?>
											<?=$arrA["USER_FILE_IMAGE_CODE"]?>
										<?
										}
										else
										{
										?>
										<a title="<?=GetMessage("FORM_VIEW_FILE")?>" target="_blank" href="/bitrix/tools/form_show_file.php?rid=<?=$arRes["ID"]?>&hash=<?=$arrA["USER_FILE_HASH"]?>&lang=<?=LANGUAGE_ID?>"><?=$arrA["USER_FILE_NAME"]?></a><br />
										(<?=$arrA["USER_FILE_SIZE_TEXT"]?>)<br />
										[&nbsp;<a title="<?=str_replace("#FILE_NAME#", $arrA["USER_FILE_NAME"], GetMessage("FORM_DOWNLOAD_FILE"))?>" href="/bitrix/tools/form_show_file.php?rid=<?=$arRes["ID"]?>&hash=<?=$arrA["USER_FILE_HASH"]?>&lang=<?=LANGUAGE_ID?>&action=download"><?=GetMessage("FORM_DOWNLOAD")?></a>&nbsp;]
										<?
										}
									}
									?>
						<?
						} //foreach
					} // endif (is_array($arrAnswer));
					?>
				</td>
				<td><?
					if ($arParams["can_delete_some"] && $arRes["can_delete"])
					{
						?> <?
					} //endif ($can_delete_some && $can_delete);
					?>
					<?
					if ($arParams["SHOW_STATUS"] == "Y")
					{
					?>
						<?=GetMessage("FORM_STATUS")?>:&nbsp;[&nbsp;<span class="<?=htmlspecialcharsbx($arRes["STATUS_CSS"])?>"><?=htmlspecialchars($arRes["STATUS_TITLE"])?></span>&nbsp;]
						<?
						if ($arRes["can_edit"] && ($arParams["F_RIGHT"] >= 20 || $arParams["F_RIGHT"] >= 15 && ($arParams["USER_ID"]==$arRes["USER_ID"])))
						{
						?>
								
							
					<?
						} // endif (in_array("EDIT",$arrRESULT_PERMISSION) && $F_RIGHT>=15);
					?>
					<?
					} // endif ($SHOW_STATUS == "Y")
					?>
					</td>
					
				<?
					} //endif (($arrC["ADDITIONAL"]=="Y" && $SHOW_ADDITIONAL=="Y") || $arrC["ADDITIONAL"]!="Y") ;
					} // endif (!is_array($arrNOT_SHOW_TABLE) || !in_array($arrC["SID"],$arrNOT_SHOW_TABLE));
				} //foreach
				?>
			</tr>
			<?
			} //foreach
			?>
			
			</tbody>
			
		<?
		}
		?>
		<?
		if ($arParams["HIDE_TOTAL"]!="Y")
		{
		?>
		<tfoot>
			<tr>
				<th colspan="<?=$colspan?>"><?=GetMessage("FORM_TOTAL")?>&nbsp;<?=$arResult["res_counter"]?></th>
			</tr>
		</tfoot>
		<?
		} //endif ($HIDE_TOTAL!="Y");
		?>
	</table>

	<p><?=$arResult["pager"]?></p>
	

	
</form>
 