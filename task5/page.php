<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
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
        formData = new FormData($that.get(0)); // создаем новый экземпляр объекта и передаем ему нашу форму (*)
        $.ajax({
          url: $that.attr('action'),
          type: $that.attr('method'),
          contentType: false, // важно - убираем форматирование данных по умолчанию
          processData: false, // важно - убираем преобразование строк по умолчанию
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