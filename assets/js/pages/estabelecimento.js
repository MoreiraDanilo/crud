$(document).ready(function () {
    $('#estado').change(function () {
        $('#cidade').attr('disabled', 'disabled');
        $('#cidade').html('<option>Carregando...</option>');

        var uf_estado = $('#estado').val();
        var url_ajax = $('#url_cidade_ajax').val();

        $.post(url_ajax, {
            uf_estado: uf_estado
        }, function (data) {
            $('#cidade').html(data);
            $('#cidade').removeAttr('disabled');
        });
    });

    $("#formulario").validate({
        onkeyup: false,
        errorClass: 'text-danger',
        validClass: 'text-success',
        highlight: function (element) {
            $(element).closest('.form-group').removeClass("has-success");
            $(element).closest('.form-group').addClass("has-error");
        },
        unhighlight: function (element) {
            $(element).closest('.form-group').removeClass("has-error");
            $(element).closest('.form-group').addClass("has-success");
        },
        errorPlacement: function (error, element) {
            $(element).closest('.form-group').append(error);
        },
        rules: {
            razaosocial: {
                required: true
            },
            cnpj: {
                required: true,
                validaCNPJ: true
            },
            data_cadastro:{
                validaData: true
            },
            email:{
                validaEmail: true
            },
            telefone:{
                validaTelefone : true
            }
        }, messages: {
            razaosocial: {
                required: 'Razão social obrigatória.'
            },
            cnpj: {
                required: 'CNPJ obrigatório.'
            }
        }
    });

    $('#cnpj').mask('99.999.999/9999-99');
    $('#telefone').mask('(00)0000-00009');
    $('#numero').mask('999');
    $('#data_cadastro').mask('99/99/9999');

    $.validator.addMethod("validaCNPJ", function (cnpj, element) {
        cnpj = jQuery.trim(cnpj);

        // DEIXA APENAS OS NÚMEROS
        cnpj = cnpj.replace('/', '');
        cnpj = cnpj.replace('.', '');
        cnpj = cnpj.replace('.', '');
        cnpj = cnpj.replace('-', '');

        var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
        digitos_iguais = 1;

        if (cnpj.length < 14 && cnpj.length < 15) {
            return this.optional(element) || false;
        }
        for (i = 0; i < cnpj.length - 1; i++) {
            if (cnpj.charAt(i) != cnpj.charAt(i + 1)) {
                digitos_iguais = 0;
                break;
            }
        }

        if (!digitos_iguais) {
            tamanho = cnpj.length - 2
            numeros = cnpj.substring(0, tamanho);
            digitos = cnpj.substring(tamanho);
            soma = 0;
            pos = tamanho - 7;

            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) {
                    pos = 9;
                }
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(0)) {
                return this.optional(element) || false;
            }
            tamanho = tamanho + 1;
            numeros = cnpj.substring(0, tamanho);
            soma = 0;
            pos = tamanho - 7;
            for (i = tamanho; i >= 1; i--) {
                soma += numeros.charAt(tamanho - i) * pos--;
                if (pos < 2) {
                    pos = 9;
                }
            }
            resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
            if (resultado != digitos.charAt(1)) {
                return this.optional(element) || false;
            }
            return this.optional(element) || true;
        } else {
            return this.optional(element) || false;
        }
    }, "CNPJ inválido.");
    
    jQuery.validator.addMethod("validaData",
        function(data, element) {
            var dateRegex = /^(?=\d)(?:(?:31(?!.(?:0?[2469]|11))|(?:30|29)(?!.0?2)|29(?=.0?2.(?:(?:(?:1[6-9]|[2-9]\d)?(?:0[48]|[2468][048]|[13579][26])|(?:(?:16|[2468][048]|[3579][26])00)))(?:\x20|$))|(?:2[0-8]|1\d|0?[1-9]))([-.\/])(?:1[012]|0?[1-9])\1(?:1[6-9]|[2-9]\d)?\d\d(?:(?=\x20\d)\x20|$))?(((0?[1-9]|1[012])(:[0-5]\d){0,2}(\x20[AP]M))|([01]\d|2[0-3])(:[0-5]\d){1,2})?$/;

            if((dateRegex.test(data))){
                return this.optional(element) || true;
            }else{
             return this.optional(element) || false;   
            }
        },"Data inválida."
    );
    
    $.validator.addMethod("validaEmail", 
        function(email, element){
        
        if (email.length == 0){
            return this.optional(element) || false;
        }
        var regex = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.\n\[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
        if(regex.test(email)){
            return this.optional(element) || true;
        }       
        return this.optional(element) || false;
	
    },'Email inválido.');
    
    $.validator.addMethod("validaTelefone", 
        function(telefone){
        
        if((telefone.length < 13) && ($("#categoria").val() === '1') ){
            return false;
        }
        return true;
    },'Campo obrigatório para supermercado.');

    $('.excluir').click(function (e) {

        e.preventDefault();

        $('#confirma').attr('href', $(this).attr('href'));

        $('#Exclusao').modal('show');

    });


});