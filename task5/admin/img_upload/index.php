<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Загрузка фото");
?>
<form action="handler.php" method="post" id="my_form" enctype="multipart/form-data">
  <label for="avatar">Аватар:</label>
	<?echo CFile::InputFile("avatar", 20, $str_IMAGE_ID);?><br>
  <input type="submit" id="submit" value="Отправить">
</form>

<script>
      $('#my_form').on('submit', function(e){
        e.preventDefault();
        var $that = $(this),
        formData = new FormData($that.get(0)); 
        $.ajax({
          url: $that.attr('action'),
          type: $that.attr('method'),
          contentType: false, 
          processData: false, 
          data: formData,
          dataType: 'json',
          success: function(json){
            if(json){
              $that.replaceWith(json);
            }
          }
        });
      });
    );
</script>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>