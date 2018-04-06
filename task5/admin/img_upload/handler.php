<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Новая страница (1)");
?>

<?
    if(!empty($_FILES['avatar'])) 
	{
		if($_FILES['avatar']['type'] != "image/jpeg")
		{
			echo "Неверный тип файла!";
		} 
		else
		{
		$req = false; 
		ob_start();
		$arr_file=Array(
				"name" => $_FILES['avatar']['name'],
				"size" => $_FILES['avatar']['size'],
				"tmp_name" => $_FILES['avatar']['tmp_name'],
				"type" => "",
				"old_file" => "",
				"del" => "Y",
				"MODULE_ID" => "iblock");
		$fid = CFile::SaveFile($arr_file, "iblock");
		if (strlen($fid)>0):
		echo CFile::ShowImage($fid, 200, 200, "border=0", "", true);
?>
		<a href="attach_download.php?file=<?=$fid?>">Скачать файл</a>
		<?
		endif;
		$req = ob_get_contents();
		ob_end_clean();
		echo $req; 
		exit;
        }
    }	
?>
	
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>