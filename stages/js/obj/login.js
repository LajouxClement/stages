/* global link */

$(document).ready(function () {

    if (localStorage.getItem("nomResp") !== null && localStorage.getItem("login") !== null && localStorage.getItem("pass") !== null && localStorage.getItem("noResp") !== null) {
        $('#formLogin').empty();
        $.ajax({
            url: link + "parse.php?page=login",
            method: 'POST',
            data: {
                loginStore: localStorage.getItem("nomResp"),
                login: localStorage.getItem("login"),
                pass: localStorage.getItem("pass")
            },
            dataType: 'json', // wait answer
            beforeSend: function () {
                $('#waitLogin').append('<img src="img/ajax-loading.gif" alt="Loading" class="img-responsvie center-block" /><br /> <div class="alert alert-info">Patientez pendant que nous vous connectons</div>');
            },
            success: function (data) {
                data.loginOk === "ok" ? location.replace("content.html") : alert("Connexion fail!"); //alert should not happen
            }
        });
    }

    var $form = $('#formLogin');
    var $login = $('#login');
    var $pass = $('#pass');
    $form.submit(function (e) {
        e.preventDefault();
        if ($login.val().trim() === "" || $pass.val().trim() === "") {
            /** LOGIN **/
            if ($login.val().trim() === "") {
                $login.parent('div').addClass('has-error');
                $login.parent('div').hasClass('has-success') ? $login.parent('div').removeClass('has-success') : '';
            } else {
                $login.parent('div').addClass('has-success');
                $login.parent('div').hasClass('has-error') ? $login.parent('div').removeClass('has-error') : '';
            }
            /** PASS **/
            if ($pass.val().trim() === "") {
                $pass.parent('div').addClass('has-error');
                $pass.parent('div').hasClass('has-success') ? $pass.parent('div').removeClass('has-success') : '';
            } else {
                $pass.parent('div').addClass('has-success');
                $pass.parent('div').hasClass('has-error') ? $pass.parent('div').removeClass('has-error') : '';
            }
        } else {
            $.ajax({
                method: "POST",
                url: link + "parse.php?page=login",
                data:  $form.serialize(),
                dataType: 'json',
                success: function (data) {
                    if (typeof (Storage) !== "undefined") {
                        if (data.responsable !== "") {
                            // Stockage du nom du responsable qui s'est connect� dans le local storage
                            localStorage.removeItem("nomResp");
                            localStorage.removeItem("civilite");
                            localStorage.removeItem("login");
                            localStorage.removeItem("pass");
                            localStorage.removeItem("noResp");

                            localStorage.setItem("nomResp", data.responsable);
                            localStorage.setItem("civilite", data.civilite);
                            localStorage.setItem("login", data.login);
                            localStorage.setItem("pass", data.pass);
                            localStorage.setItem("noResp", data.identifiant);
                            $('#bodyForm').html("<div class='alert alert-success'> <strong><span class='glyphicon glyphicon-ok'></span></strong> Vous êtes désormais connecté.</div>");
                            setTimeout(function () {
                                location.replace("content.html");
                            }, 1000);
                        }
                    } else {
                        alert('localStorage isn\'t supported');
                    }
                },
                error: function () {
                    $('#bodyForm').prepend("<div class='alert alert-danger alert-dismissible text-center'>"
                            + "<button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>"
                            + "<strong><span class='glyphicon glyphicon-remove'></span></strong>"
                            + "Identifiants incorrects.</div>");
                }
            });
        }
    });
    $login.blur(function () {
        if ($login.val().trim() === "") {
            $login.parent('div').addClass('has-error');
            $login.parent('div').hasClass('has-success') ? $login.parent('div').removeClass('has-success') : '';
        } else {
            $login.parent('div').addClass('has-success');
            $login.parent('div').hasClass('has-error') ? $login.parent('div').removeClass('has-error') : '';
        }
    });
    $pass.blur(function () {
        if ($pass.val().trim() === "") {
            $pass.parent('div').addClass('has-error');
            $pass.parent('div').hasClass('has-success') ? $pass.parent('div').removeClass('has-success') : '';
        } else {
            $pass.parent('div').addClass('has-success');
            $pass.parent('div').hasClass('has-error') ? $pass.parent('div').removeClass('has-error') : '';
        }
    });
});