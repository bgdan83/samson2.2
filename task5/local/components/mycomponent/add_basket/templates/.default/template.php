<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//test_dump($arResult);

//$GLOBALS['APPLICATION']->SetTitle('Highloadblock List');
if(isset($_POST['data'])){

  parse_str($_POST['data'], $form_data); 
  
  echo json_encode($form_data); 
  
}
?>

       
<form id="form" action="" method="post">
	
	<div class="step">
		<input class="auto" type="text" name="name_1" value=""  autocomplete="off" />
		<input class="notAuto"  type="text" name="quan_1" value=""  />
	</div>
	<div class="step">
		<input class="auto" type="text" name="name_2" value=""  autocomplete="off" />
		<input class="notAuto"  type="text" name="quan_2" value=""  />
	</div>
	<p><input type="submit"  id="submit"></p>
</form>
<div id="output">Ghbdtn</div>
<script>
BX.message({
   componentPath: '<?=CUtil::JSEscape($componentPath)?>'
});
</script>
