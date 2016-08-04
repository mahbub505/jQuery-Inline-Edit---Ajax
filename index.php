<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery Inline Edit </title>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

</head>
<body>
 <form>
    <input type="hidden" id="hiddenField" name="hiddenField" />
    <input type="hidden" id="fee_feeid_1" name="feeid_1" value="1" />
    <input type="hidden" id="fee_feeid_2" name="feeid_2" value="2" />
    <input type="hidden" id="fee_feeid_3" name="feeid_3" value="3" />
</form>

<p id="feeid_1">Please edit me.1..</p>
<p id="feeid_2">Please edit me...</p>
<p id="feeid_3">Please edit me.2..</p>


  <script>
$( document ).ready(function() {
  // js fiddle link without ajax
  // http://jsfiddle.net/egstudio/aFMWg/1/

    $.fn.inlineEdit = function(replaceWith, connectWith) {

    $(this).hover(function() {
        $(this).addClass('hover');
    }, function() {
        $(this).removeClass('hover');
    });

    $(this).click(function() {

        var elem = $(this);

        elem.hide();
        elem.after(replaceWith);
        replaceWith.focus();
       var fee = $('#fee_'+$(this).attr('id')).val();

        replaceWith.blur(function() {

            if ($(this).val() != "") {
                connectWith.val($(this).val()).change();
                elem.text($(this).val());
                var current_text = $(this).val();
               
                  $.ajax({
                      url: 'ajax.php',
                      data: { fee_id: fee,amount:current_text},
                        dataType: 'jsonp',
                        type: "post",     

                        success: function (response) {

                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                           console.log(textStatus, errorThrown);
                        }


                    });
                 
            }

            $(this).remove();
            elem.show();
        });
    });
};

   var replaceWith = $('<input name="temp" type="text" />'),
    connectWith = $('input[name="hiddenField"]');

$('p').inlineEdit(replaceWith, connectWith);



});
  </script>
  
  
<style>
    /* Making look nice */
body { padding: 1em; font-family: Arial; font-size: 14px; }
input[type="text"] { padding: 0.4em; font-family: Arial; }

/* Inline Edit */
p.hover { background: #fffbe1; }
</style>

</body>
</html>