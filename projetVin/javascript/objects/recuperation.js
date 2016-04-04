/**
 * Created by Jordan on 15/03/2016.
 */
$(document).ready(function() {
   var cal =  $("#btnRecuperation").val('test');
    $("#btnRecuperation").on('click',function () {
        //alert();
        var chpEmail = $("#emailrecup").val();
        $.ajax({
            method: "POST",
            url: link+"parse.php?page=recup",
            data:  "emailrecup=" +chpEmail,
            dataType: 'json',
            success: function (data) {
                $.each(data,function(key,value){
                    //alert(value.identifiant);
                    if(value.identifiant!="null"){
                        $.post(link+"membre/sendMail.php", {"mail":value.mail,"id":value.identifiant,"codeRecup": value.codeRecup}, function(results) {
                            // alert(results); // alerts 'Updated'
                           // $(location).attr('href',link+"index.php");
                            $('#errjs').html("E-mail envoyé");
                        });
                        //$(location).attr('href',link+"index.php");
                    }
                    else{
                        $('#errjs').text("Adresse mail inconnue dans la base de donnée");
                    }
                });
            },
            error: function (xhr, ajaxOptions, thrownError) {
               $('#errjs').html(xhr.responseText);
                //
            }
        });

    });

});