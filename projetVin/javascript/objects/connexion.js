
$(document).ready(function() {
	var cptIp = readCookie('vin_compteurIp');
	var oldIp = $("#oldIp").val();
	var timeoutID;
	
	if (cptIp > 3){
		delayedAlert();
	}
	
    $("#btnConnexion").click(function(e) {
        //alert();
        e.preventDefault();
        var chpPwd = $("#pwd").val();
        var chpEmail = $("#email").val();
		var chpIp = $("#ipuser").val();

		//alert("coucou : " + chpIp);
        $.ajax({
                method: "POST",
                url: link+"parse.php?page=login",
                data:  "email=" +chpEmail+ "&psw=" + chpPwd,
                dataType: 'json',
                success: function (data) {
					
                    $.each(data,function(key,value){
                        //alert(value.identifiant);
                        if(value.identifiant!="null"){
							createCookie('vin_compteurIp',0,15); //15minutes, à changé si nécessaire
                            $.post(link+"membre/createSession.php", {"droit":value.droit,"identifiant":value.identifiant,"idUser":value.idUser}, function(results) {
                               // alert(results); // alerts 'Updated'
                                $(location).attr('href',link+"index.php");
                            });
                            //$(location).attr('href',link+"index.php");
                        }
                        else{
                            $("#info").css("display","block");
							cptIp++;
							createCookie('vin_compteurIp',cptIp,15); //15minutes, à changé si nécessaire
							
							if (cptIp > 3){
								delayedAlert();
							}
							
							if (oldIp != chpIp){
								oldIp = chpIp;
							}
							
							"cpt :" + cptIp + ", oldip:" + oldIp;
                        }
                    });
                },
                error: function () {
                    alert('Problème .ajax - function(data)');
                }
            });
            e.preventDefault();
                
    });
	
	function createCookie(name,value,minutes) {
	if (minutes) {
		var date = new Date();
		date.setTime(date.getTime()+(minutes *60*1000));
		var expires = "; expires="+date.toGMTString();
	}
	else var expires = "";
	document.cookie = name+"="+value+expires+"; path=/";
	}

	function readCookie(name) {
		var nameEQ = name + "=";
		var ca = document.cookie.split(';');
		for(var i=0;i < ca.length;i++) {
			var c = ca[i];
			while (c.charAt(0)==' ') c = c.substring(1,c.length);
			if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
		}
		return null;
	}

	function eraseCookie(name) {
		createCookie(name,"",-1);
	}

	function delayedAlert() {
		$("#btnConnexion").prop('disabled', true);
		timeoutID = window.setTimeout(slowAlert, 10 * 1000); //10 secondes, à changer quand il faudra
	}

	function slowAlert() {
		$("#btnConnexion").prop('disabled', false);
	}

	function clearAlert() {
	  window.clearTimeout(timeoutID);
	}
    
});