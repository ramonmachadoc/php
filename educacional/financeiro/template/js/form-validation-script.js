$(document).ready(function () {

//PRODUTO 
    if ($("#FormAddProduto").validate()) {
        $("#nome").rules("add", {
            required: true,
            minlength: 5,
            remote: {
                url: "../produto/ValidateExists/",
                type: "post"
            }
        });
    }

    if ($("#FormEditProduto").validate()) {
        $("#nome").rules("add", {
            required: true,
            minlength: 5

        });
    }

//FORNECEDOR
    if ($("#FormAddFornecedor").validate()) {
        $("#razaosocial").rules("add", {
            required: true,
            minlength: 5,
            remote: {
                url: "../fornecedor/ValidateExists/",
                type: "post"
            }
        });
    }

    $("#FormEditFornecedor").validate();



//CATEGORIA
    if ($("#FormAddCategoria").validate()) {
        $("#cat_tx_descricao").rules("add", {
            required: true,
            minlength: 5,
            remote: {
                url: "../categoria/ValidateExists/",
                type: "post"
            }
        });
    }



    if ($("#FormEditCategoria").validate()) {
        $("#cat_tx_descricao").rules("add", {
            required: true,
            minlength: 5

        });
    }

//RECEBER PAGAMENTO ALUNO
    $("#FormReceberPagamentoA").validate();


//PAGAMENTO MATRICULA 
    $("#FormPagMatricula").validate();


    if ($("#FormNotificacao").validate()) {
        $("#descricao").rules("add", {
            required: true,
            minlength: 5

        });
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