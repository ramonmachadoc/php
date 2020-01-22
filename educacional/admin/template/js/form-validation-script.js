$(document).ready(function () {

    $("#FormBolsas").validate();
    $("#FormAddCurso").validate();
    $("#FormEditProfessor").validate();
    $("#FormAddPeriodo").validate();
    $("#FormAddTurma").validate();

    if ($("#FormAddProfessor").validate()) {
        $("#nome").rules("add", {
            required: true,
            minlength: 10,
            remote: {
                url: "../professor/ValidateExists/",
                type: "post"
            }
        });
    }


    if ($("#FormAddBolsa").validate()) {

        $("#porcentagem_minima").rules("add", {digits: true});
        $("#porcentagem_maxima").rules("add", {digits: true});
    }

    if ($("#default").validate()) {

        $("#nome").rules("add", {
            required: true,
            minlength: 10,
            remote: {
                url: "../educacional/ValidateExistsMatricula/",
                type: "post",
                data: {
                     curso: function () {
                        return $("#curso").val();
                    }
                }
            }
        });

        $("#data_nascimento").rules("add", {required: true, date: true});
        $("#email").rules("add", {email: true});

        $("#cpf").rules("add", {
            required: true,
            cpf: true,
            remote: {
                url: "../educacional/ValidateExistsCpf/",
                type: "post",
                data: {
                     curso: function () {
                        return $("#curso").val();
                    }
                }
            }
        });

        jQuery.validator.addMethod("cpf", function (value, element) {
            value = jQuery.trim(value);

            value = value.replace('.', '');
            value = value.replace('.', '');
            cpf = value.replace('-', '');
            while (cpf.length < 11)
                cpf = "0" + cpf;
            var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
            var a = [];
            var b = new Number;
            var c = 11;
            for (i = 0; i < 11; i++) {
                a[i] = cpf.charAt(i);
                if (i < 9)
                    b += (a[i] * --c);
            }
            if ((x = b % 11) < 2) {
                a[9] = 0
            } else {
                a[9] = 11 - x
            }
            b = 0;
            c = 11;
            for (y = 0; y < 10; y++)
                b += (a[y] * c--);
            if ((x = b % 11) < 2) {
                a[10] = 0;
            } else {
                a[10] = 11 - x;
            }

            var retorno = true;
            if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg))
                retorno = false;

            return this.optional(element) || retorno;

        }, "Informe um CPF válido");
    }



    $.extend($.validator.messages, {
        required: "Campo de preenchimento obrigat&oacute;rio.",
        remote: "Por favor, corrija este campo j&aacute; est&aacute; em uso.",
        email: "Por favor, introduza um endere&ccedil;o eletr&oacute;nico v&aacute;lido.",
        url: "Por favor, introduza um URL v&aacute;lido.",
        date: "Por favor, introduza uma data v&aacute;lida.",
        dateITA: "Por favor, introduza uma data v&aacute;lida.",
        dateISO: "Por favor, introduza uma data v&aacute;lida (ISO).",
        number: "Por favor, introduza um n&uacute;mero v&aacute;lido.",
        digits: "Por favor, introduza apenas d&iacute;gitos.",
        creditcard: "Por favor, introduza um n&uacute;mero de cart&atilde;o de cr&eacute;dito v&aacute;lido.",
        equalTo: "Por favor, introduza de novo o mesmo valor.",
        extension: "Por favor, introduza um ficheiro com uma extens&atilde;o v&aacute;lida.",
        maxlength: $.validator.format("Por favor, n&atilde;o introduza mais do que {0} caracteres."),
        minlength: $.validator.format("Por favor, introduza pelo menos {0} caracteres."),
        rangelength: $.validator.format("Por favor, introduza entre {0} e {1} caracteres."),
        range: $.validator.format("Por favor, introduza um valor entre {0} e {1}."),
        max: $.validator.format("Por favor, introduza um valor menor ou igual a {0}."),
        min: $.validator.format("Por favor, introduza um valor maior ou igual a {0}."),
        nifES: "Por favor, introduza um NIF v&aacute;lido.",
        nieES: "Por favor, introduza um NIE v&aacute;lido.",
        cifES: "Por favor, introduza um CIF v&aacute;lido.",
        accept: "Por favor preencha com um tipo MIME v&aacute;lido.",
        cnpj: "Por favor insira um CNPJ v&aacute;lido.",
        time: "Por favor insira um hor&aacute;rio v&aacute;lido.",
        cpf: "Por favor insira um CPF v&aacute;lido.",
        money: "Por favor, especifique o formato de número correto"
    });
});