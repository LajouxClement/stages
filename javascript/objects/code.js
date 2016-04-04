/**
 * Created by Jordan on 22/03/2016.
 */
$(document).ready(function() {
    var cal = $("#btnNewPwd").val('test');





    $("#btnNewPwd").on('click', function () {

        //verification :
        var mdp = $("#newpwd").val();
        var verif_mdp = $("#newpwd_verif").val();
        var id= $("#identification").text();

        if (mdp != verif_mdp){
            if(!$('#form_mdp').hasClass('has-error')){
                $('#form_mdp').addClass('has-error');
            }
            $('#newpwd_verif_label').text('confirmation non conforme');
        }
        else
        {
            $.ajax({
                method: "POST",
                url: link + "parse.php?page=code",
                data: "mdp=" + mdp + "&id="+id,
                dataType: 'html',
                success: function (data) {

                        //alert(value.identifiant);
                    if(data != '00000'){ //peut changer quand pas en local
                        $('#errjs').html('Un problème est survenu.');
                    }else
                    {
                        $('#errjs').html('Mot de passe enregistré avec succès');
                    }


                },
                error: function (xhr, ajaxOptions, thrownError) {
                    $('#errjs').html(xhr.responseText);
                    //
                }
            });

        }
    });

        //alert();



});