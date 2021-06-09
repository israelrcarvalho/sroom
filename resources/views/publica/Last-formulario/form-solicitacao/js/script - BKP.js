
$(document).ready(function(){
   $('#logotipo').fadeTo( "slow", 1 );

    $("#passo1").click(function(e){
            e.preventDefault();
            var erros = 0;

            // verifica campos vazios
            $(".passo1 input").each(function(){

                    // conta erros
                    $(this).val() == "" ? erros++ : "";
            });
            $(".passo1 textarea").each(function(){

                    // conta erros
                    $(this).val() == "" ? erros++ : "";
            });
            // verifica se ha erros
            if(erros > 0 ){
                  $('.alerta').append().fadeIn().text("Existe(em) campo(os) vazio(os) neste fomulário");
        }else{
                    //return true;	
                    //$("#form1").submit()
                    $('.passo1').hide();
                    $('.passo2').show();
                    $('.alerta').hide();
            }		
    });
    
    $('#passo2').click(function(){
           var erro = 0;
           $('.passo2 input').each(function(){
               $(this).val() == "" ? erro++ : " ";
           });
     
            // verifica se ha erros
            if(erro > 1 ){
                  $('.alerta').append().fadeIn().text("Existe(em) campo(os) vazio(os) neste fomulário");
        }else{
                    //return true;	
                    //$("#form1").submit()
                    $('.passo2').hide();
                    $('.passo3').show();
                    $('.alerta').hide();
                    $('.concluir').show();
            }	
    });      
        
       
        /* Voltar NAVS */
        $("#voltar-passo1").click(function(e){
	e.preventDefault();
                $('.passo1').show();
                $('.passo2').hide();
                $('.alerta').hide();
           });
           
         $("#voltar-passo2").click(function(e){
	e.preventDefault();
                $('.passo2').show();
                $('.passo3').hide();
                $('.alerta').hide();
                $('.concluir').hide();
                
           });   
          
});

