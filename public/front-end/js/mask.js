try{
$(function() {
    
    (function(a){var c=(a.browser.msie?"paste":"input")+".mask";var b=(window.orientation!=undefined);a.mask={definitions:{"9":"[0-9]",a:"[A-Za-z]","*":"[A-Za-z0-9]"}};a.fn.extend({caret:function(e,f){if(this.length==0){return}if(typeof e=="number"){f=(typeof f=="number")?f:e;return this.each(function(){if(this.setSelectionRange){this.focus();this.setSelectionRange(e,f)}else{if(this.createTextRange){var g=this.createTextRange();g.collapse(true);g.moveEnd("character",f);g.moveStart("character",e);g.select()}}})}else{if(this[0].setSelectionRange){e=this[0].selectionStart;f=this[0].selectionEnd}else{if(document.selection&&document.selection.createRange){var d=document.selection.createRange();e=0-d.duplicate().moveStart("character",-100000);f=e+d.text.length}}return{begin:e,end:f}}},unmask:function(){return this.trigger("unmask")},mask:function(j,d){if(!j&&this.length>0){var f=a(this[0]);var g=f.data("tests");return a.map(f.data("buffer"),function(l,m){return g[m]?l:null}).join("")}d=a.extend({placeholder:"_",completed:null},d);var k=a.mask.definitions;var g=[];var e=j.length;var i=null;var h=j.length;a.each(j.split(""),function(m,l){if(l=="?"){h--;e=m}else{if(k[l]){g.push(new RegExp(k[l]));if(i==null){i=g.length-1}}else{g.push(null)}}});return this.each(function(){var r=a(this);var m=a.map(j.split(""),function(x,y){if(x!="?"){return k[x]?d.placeholder:x}});var n=false;var q=r.val();r.data("buffer",m).data("tests",g);function v(x){while(++x<=h&&!g[x]){}return x}function t(x){while(!g[x]&&--x>=0){}for(var y=x;y<h;y++){if(g[y]){m[y]=d.placeholder;var z=v(y);if(z<h&&g[y].test(m[z])){m[y]=m[z]}else{break}}}s();r.caret(Math.max(i,x))}function u(y){for(var A=y,z=d.placeholder;A<h;A++){if(g[A]){var B=v(A);var x=m[A];m[A]=z;if(B<h&&g[B].test(x)){z=x}else{break}}}}function l(y){var x=a(this).caret();var z=y.keyCode;n=(z<16||(z>16&&z<32)||(z>32&&z<41));if((x.begin-x.end)!=0&&(!n||z==8||z==46)){w(x.begin,x.end)}if(z==8||z==46||(b&&z==127)){t(x.begin+(z==46?0:-1));return false}else{if(z==27){r.val(q);r.caret(0,p());return false}}}function o(B){if(n){n=false;return(B.keyCode==8)?false:null}B=B||window.event;var C=B.charCode||B.keyCode||B.which;var z=a(this).caret();if(B.ctrlKey||B.altKey||B.metaKey){return true}else{if((C>=32&&C<=125)||C>186){var x=v(z.begin-1);if(x<h){var A=String.fromCharCode(C);if(g[x].test(A)){u(x);m[x]=A;s();var y=v(x);a(this).caret(y);if(d.completed&&y==h){d.completed.call(r)}}}}}return false}function w(x,y){for(var z=x;z<y&&z<h;z++){if(g[z]){m[z]=d.placeholder}}}function s(){return r.val(m.join("")).val()}function p(y){var z=r.val();var C=-1;for(var B=0,x=0;B<h;B++){if(g[B]){m[B]=d.placeholder;while(x++<z.length){var A=z.charAt(x-1);if(g[B].test(A)){m[B]=A;C=B;break}}if(x>z.length){break}}else{if(m[B]==z[x]&&B!=e){x++;C=B}}}if(!y&&C+1<e){r.val("");w(0,h)}else{if(y||C+1>=e){s();if(!y){r.val(r.val().substring(0,C+1))}}}return(e?B:i)}if(!r.attr("readonly")){r.one("unmask",function(){r.unbind(".mask").removeData("buffer").removeData("tests")}).bind("focus.mask",function(){q=r.val();var x=p();s();setTimeout(function(){if(x==j.length){r.caret(0,x)}else{r.caret(x)}},0)}).bind("blur.mask",function(){p();if(r.val()!=q){r.change()}}).bind("keydown.mask",l).bind("keypress.mask",o).bind(c,function(){setTimeout(function(){r.caret(p(true))},0)})}p()})}})})(jQuery);

    /* mascaras */
    $('head').append('<script src="js/jquery.mask.js" type="text/javascript"></script>');
    /* mascara data */
    $('.data').mask('99.99.9999');
    /* mascara cpf */
    $('.cpf').mask('999.999.999-99');
    /* mascara horas */
    $('.hora').mask('99:99');
    /* mascara cnpj */
    $('.cnpj').mask('99.999.999/9999-99');
    /* mascara placa */
    $('.placa').mask('aaa-9999');
    /* mascara telefone */
    $('.fone').mask('(99)99999-999?9');
    /* mascara telefone */
    $('.cep').mask('99999-999'); 	
    /* validate style - comentar alinha abaixo para omitir o style */

    $('.validate').submit(function(e) {
		e.stopPropagation();
        var valid = true;       
        $(this).find('.required').each(function(i,elm){				
		
            /* required */
            if ( $(this).hasClass('required') && $.trim( $(this).val() ) == " " ){
                $(this).removeClass('valid').addClass('invalid');
                $(this).focus();
                $(this).parent().find('span').html(requiredMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                valid = false;
                return false;
            }
            else
            {
                $(this).removeClass('invalid').addClass('valid');
                $(this).parent().find('span').fadeOut(500);
            }					
			
            
            /* numeric value */
            if ( $(this).hasClass('required') && $(this).hasClass('numeric') ){
                var nan = new RegExp(/(^-?\d\d*\.\d*$)|(^-?\d\d*$)|(^-?\.\d\d*$)/);
                if (!nan.test($.trim( $(this).val() ))){
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).parent().find('span').html(numericMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    $(this).select();
                    valid = false;
                    return false;
                }
                else{
                    $(this).parent().find('span').fadeOut(500);
                    $(this).removeClass('invalid').addClass('valid');
                }
            }
			
            /* cep value */
            if ( $(elm).hasClass('required') && $(elm).hasClass('cep') ){
				var valcep = $.trim($(this).val().replace('-',''));
				var urlws = 'http://cep.republicavirtual.com.br/web_cep.php?cep='+valcep+'&formato=json';	
				var cepr =  $.ajax({url:urlws,async: false}).responseText;
				console.log(cepr);
				cepr = $.parseJSON(cepr)
				if(cepr.resultado == 0){
					$(this).removeClass('valid').addClass('invalid');
					$(this).select();
					$(this).parent().find('span').html('Cep n�o encontrado, informe um CEP v�lido.').fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
					valid = false;
					return false;								
				}else{
					$(this).parent().find('span').fadeOut(500);
					$(this).removeClass('invalid').addClass('valid');				
				}
            }	
			
         
            /* data */
            if ( $(this).hasClass('data') ){
                
                var sdata = $(this).val();
                if(sdata.length!=10)
                {
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).select();
                    $(this).parent().find('span').html(dataMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    valid = false;
                    return false;   
                }
                var data        = sdata;
                var dia         = data.substr(0,2);
                var barra1      = data.substr(2,1);
                var mes         = data.substr(3,2);
                var barra2      = data.substr(5,1);
                var ano         = data.substr(6,4);
                if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)
                {
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).select();
                    $(this).parent().find('span').html(dataMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    valid = false;
                    return false;            
                }
                if((mes==4||mes==6||mes==9||mes==11) && dia==31){
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).select();
                    $(this).parent().find('span').html(dataMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    valid = false;
                    return false;
                }
                if(mes==2 && (dia>29||(dia==29 && ano%4!=0))){
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).select();
                    $(this).parent().find('span').html(dataMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    valid = false;
                    return false;
                }
                if(ano < 1900)
                {
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).select();
                    $(this).parent().find('span').html(dataMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    valid = false;
                    return false;
                }                
                else{
                    $(this).removeClass('invalid').addClass('valid');
                    $(this).parent().find('span').fadeOut(500);
                }
            } 
            
            /* cpf */
            if ( $(this).hasClass('cpf') ){
                var cpf = $(this).val().replace('.','');
                cpf = cpf.replace('.','');
                cpf = cpf.replace('-','');
                while(cpf.length < 11) cpf = "0"+ cpf;
                var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
                var a = [];
                var b = new Number;
                var c = 11;
                for (i=0; i<11; i++){
                    a[i] = cpf.charAt(i);
                    if (i < 9) b += (a[i] * --c);
                }
                if ((x = b % 11) < 2) {
                    a[9] = 0
                } else {
                    a[9] = 11-x
                }
                b = 0;
                c = 11;
                for (y=0; y<10; y++) b += (a[y] * c--);
                if ((x = b % 11) < 2) {
                    a[10] = 0;
                } else {
                    a[10] = 11-x;
                }
                if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg))
                {
                    $(this).removeClass('valid').addClass('invalid');
                    $(this).select();
                    $(this).parent().find('span').html(cpfMsg).fadeOut(500).fadeIn(500).fadeOut(500).fadeIn(500);
                    valid = false;
                    return false;
                }
                else{
                    $(this).removeClass('invalid').addClass('valid');
                    $(this).parent().find('span').fadeOut(500);
                }
            } 
            

        });
		
    });
});
}catch(err){alert("error in "+err.description);}




