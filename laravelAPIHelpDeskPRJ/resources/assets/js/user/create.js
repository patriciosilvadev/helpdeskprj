$(document).ready(userCreateDocumentReady = function () {

    $("#organizacao_origem").select2();
    $("#organizacao_visivel").select2();
    $("#status").select2();
    $("#roles").select2();

    buscarOrganizacoes();
    buscarPerfis();

    $("#btnSalvar").on("click", function () {
        salvar();
    });
});

function buscarPerfis() {
    var request = $.ajax({
        url: "/api/role/",
        method: "GET",
        dataType: "json",
        headers: window.axios.defaults.headers.common,
        beforeSend: function () {
            $("#roles").after("<div class='load_perm spinner_dots'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div>");
        },
        complete: function () {
            $(".load_perm").remove();
        }
    })
        .done(function (json) {
            $("#roles").empty();
            $.each(json.data, function (index, el) {
                $("#roles").append("<option value='" + el.id + "'>" + el.name + "</option>");
            });
        })
        .fail(function (data) {
            alert("ERRO");
            console.log(data);
        });
    return request;
}


function buscarOrganizacoes() {
    $.ajax({
        url: "/api/organizacao/",
        method: "GET",
        dataType: "json",
        headers: window.axios.defaults.headers.common,
        data: {
            status: [1]
        },
        beforeSend: function () {
            $("#organizacao_visivel,#organizacao_origem").after("<div class='load_org spinner_dots'><div class='bounce1'></div><div class='bounce2'></div><div class='bounce3'></div></div>");
        },
        complete: function () {
            $(".load_org").remove();
        }
    })
    .done(function (json) {
        $.each(json.data, function (index, el) {
            $("#organizacao_visivel,#organizacao_origem").append("<option value='" + el.id + "'>" + el.nome + "</option>");
        });

    })
    .fail(function (data) {
        alert("ERRO: " + data);
    });
}

function salvar() {
    $("#alert").remove();
    var dismiss = $("<button type='button' data-dismiss='alert' class='close'>×</button>");
    var msg = $("<div class='msg'></div>");
    var dialog = $("<div class='alert fade in d-none' id='alert'></div>");

    $(dialog).append(dismiss);
    $(dialog).append(msg);
    $("#formCadastrarUser").prepend(dialog);

    $(".is-invalid").removeClass(".is-invalid");
    $(".invalid-feedback").html("");
    $.ajax({
        url: "/api/user/",
        method: "POST",
        dataType: "json",
        headers: window.axios.defaults.headers.common,
        data: {
            name: $("#name").val(),
            last_name: $("#last_name").val(),
            email: $("#email").val(),
            login: $("#login").val(),
            documento: $("#documento").val(),
            password: $("#password").val(),
            password_confirmation: $("#password_confirmation").val(),
            data_nascimento: $("#data_nascimento").val(),
            sexo: $("input[name='sexo']:checked").val(),
            status: $("#status").val(),
            organizacao_origem: $("#organizacao_origem").val(),
            organizacao_visivel: $("#organizacao_visivel").val(),
            roles: $("#roles").val()

        }
    })
    .done(function (data) {
        console.log(data);

        $(msg).html("Sucesso!");
        $(dialog).alert();
        $(dialog).addClass("alert-success");
        $(dialog).removeClass("d-none");
        setTimeout(function () {
            $(dialog).addClass("show");
        }, 200);
        window.location.href = "/user";
    })
    .fail(function (data) {
        console.log(data);
        if (data.status == 422) {
            $.each(data.responseJSON.errors, function (key, value) {
                $("#" + key).addClass("is-invalid");
                $("#" + key + "_feedback").html(value);
            });
            $(msg).html(data.responseJSON.message);
            $(dialog).alert();
            $(dialog).addClass("alert-danger");
            $(dialog).removeClass("d-none");

            setTimeout(function () {
                $(dialog).addClass("show");
            }, 200);
        } else {
            $(msg).html(data.responseJSON.message);
            $(dialog).alert();
            $(dialog).addClass("alert-danger");
            $(dialog).removeClass("d-none");

            setTimeout(function () {
                $(dialog).addClass("show");
            }, 200);
        }
    });
}