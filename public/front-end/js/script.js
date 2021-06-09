
$(document).ready(function () {
    /* load Logo */
    $('#logotipo').fadeTo("slow", 1);
    $('.passo1').fadeIn();
    $('.passo1').animate({top: '0'});

    /* Tela 1 - Campos vazios? */
    $(function () {
        $("#formulario input, #formulario textarea").keyup(function () {
            var vazios = 0;
            // verifica campos vazios passo1
            $(".passo1 textarea").each(function () {
                // conta textarea vazia
                $(this).val() == "" ? vazios++ : "";
            });
            $(".passo1 input").each(function () {
                // conta input vazios
                $(this).val() == "" ? vazios++ : "";
            });
            if (vazios < 1) {
                $('.proximo1 .btn-default').addClass('none');
                $('.proximo1 .btn-primary').removeClass('none');
            }

            // verifica campos vazios passo2
            $(".passo2 textarea").each(function () {
                // conta textarea vazia
                $(this).val() == "" ? vazios++ : "";
            });
            $(".passo2 input").each(function () {
                // conta input vazios
                $(this).val() == "" ? vazios++ : "";
            });
            if (vazios <= 1) {
                $('.proximo2 .btn-default').addClass('none');
                $('.proximo2 .btn-primary').removeClass('none');
            }
            // verifica campos vazios passo3
            $(".passo3 textarea").each(function () {
                // conta textarea vazia
                $(this).val() == "" ? vazios++ : "";
            });
            $(".passo3 input").each(function () {
                // conta input vazios
                $(this).val() == "" ? vazios++ : "";
            });
            if (vazios <= 1) {
                $('.proximo3 .btn-default').addClass('none');
                $('.proximo3 .btn-primary').removeClass('none');
            }
        });
    });
    /* Passar pelas telas */

    /* ir segunda tela */
    $('.proximo1 .btn-primary').click(function () {
        $('.passo1').hide();
        $('.passo2').fadeIn();
        $('.proximo2').fadeIn();
        $('.passo2').animate({top: '0'});
    });
    /* ir terceira tela */
    $('.proximo2 .btn-primary').click(function () {
        $('.passo2').hide();
        $('.passo3').show();
        $('.proximo3').fadeIn();
        $('.passo3').animate({top: '0'});
        $('.proximo2').hide();

    });

    /* Voltar pelas telas */
    /* Voltar primeira tela */
    $("#voltar-passo1").click(function (e) {
        e.preventDefault();
        $('.passo1').fadeIn();
        $('.passo2').hide();
        $('.proximo2').hide();
    });

    $("#voltar-passo2").click(function (e) {
        e.preventDefault();
        $('.passo2').show();
        $('.passo3').hide();
        $('.proximo3').hide();
        $('.proximo2').show();
    });

    //$('#recursos').click(function(){
    //
    //});
    //    $('#nada').click(function(){
    //        $('#recursos option').find('selected'){
    //            $(this).option
    //        }
    //});

});

