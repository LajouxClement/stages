/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$( document ).ready(function() {
    //on centre les éléments de la navbar sur des petits écrans au chargement de la page
    resizeDropdownNavBar();
    //resizeMenuAdmin();
    
    //on fait pareil lorsque l'on change la taille de la fenêtre manuellement
    $( window ).resize(function() {
        resizeDropdownNavBar();
        if($( ".buttonMenu" ).data( "menu" )==false){
            hideMenuAdmin();
        }
        else if($( ".buttonMenu" ).data( "menu" )==true){
            showMenuAdmin();
        }
    });
    $("#burgerMenu").on("click", function () {
	$(this).toggleClass("active");
    });

    $(".dropdownStyle").click(function(){
        var largeur_fenetre = $(window).width();
        if(largeur_fenetre>768)
        {
           $(".dropdown-menu").slideToggle();
        }
        else
        {
           // alert($(".dropdownStyle").attr("aria-expanded"));
            if($(".dropdownStyle").attr("aria-expanded")=="false"){
                $(".dropdown-menu").css("display","inherit");
            }
            else if($(".dropdownStyle").attr("aria-expanded")=="true"&& $(this).parent().attr("class")=="dropdown encadre open"){
                $(".dropdown-menu").css("display","none");
            }
            //$(".dropdown-menu").css("display","inherit");
        }
    });
    
    //lorsque l'on clique sur la croix, on enlève le login
    $("#burgerMenu").click(function(){
        var largeur_fenetre = $(window).width();
        if(largeur_fenetre<=768 && $(this).attr("aria-expanded")=="false")
        {
           $(".dropdown-menu").css("display","none");
        }

    });    
    
    //navigation du menu admin
    $("#buttonMenu").click(function(){
        var data = $( ".buttonMenu" ).data( "menu" );
        if(data==false){
            showMenuAdmin(17);
            $( "#main").addClass("moveToLeft");
            $(".buttonMenu").data("menu",true);
            $("#ouvrir").css('display','none');
            $("#fermer").css('display','inline-block');
        }
        else if(data==true){
            hideMenuAdmin();
            $( "#main").removeClass();
            $(".buttonMenu").data("menu",false);
            $("#ouvrir").css('display','inline-block');
            $("#fermer").css('display','none');
        }

        
    });
    
    
 
    
    
    function resizeDropdownNavBar(){
        var largeur_fenetre = $(window).width();
            if(largeur_fenetre<768)
            {
                $(".boiteLien").removeClass('pull-right');
                $(".boiteLien").css("padding-right","15px");
                $(".dropdownStyle").css("padding-bottom","0px");
            }
            else
            {
                $(".boiteLien").addClass('pull-right');
                $(".boiteLien").css("padding-right","150px");
                $(".dropdownStyle").css("padding-bottom","30px");
            }
    }
    
    function showMenuAdmin(){
        $("#menuAdmin").css({
                        transform:"translate(-250px,0)"
                        });
    }
    
    function hideMenuAdmin(){
        $("#menuAdmin").css({
                        transform:"translate(-3000px,0)"
                        });
    }
});

