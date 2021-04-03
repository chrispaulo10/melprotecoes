let id_link = 0;

$("#cadastrar_link").click(function () {
    const dados = {
        cadastrar : true,
        link : $("#link").val(),
        texto : $("#texto").val(),
        img : $("#img").val(),
    }

    $.post("back-end/controller/ControllerLinks.php", dados, function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            $("#link").val("");
            $("#texto").val("");
            $("#img").val("");
            
            $("#mesagem_sucesso").text(resposta[0]);
        } else {
            $("#mesagem_n_sucesso").text(resposta);
        }
    });
});

/*====================================================================================*/

$("#listar_link").click(function () {
    $.get("back-end/controller/ControllerLinks.php?listar", function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            $.each(resposta, function (idx, link) {
                
            });
        } else {
            $("#mesagem_n_sucesso").text(resposta);
        }
    });
});

/*====================================================================================*/

$("#consultar_link").click(function () {
    const dados = {
        consultar : true,
        id : id_link,
    }

    $.get("back-end/controller/ControllerLinks.php", dados, function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            id_link = resposta.id;

            $("#link_edit").val(reposta.link);
            $("#texto_edit").val(reposta.texto);
            $("#img_edit").attr('href', reposta.nome_img);

        } else {
            $("#mesagem_n_sucesso").text(resposta);
        }
    });
});

/*====================================================================================*/

$("#editar_link").click(function () {
    const dados = {
        editar : true,
        link : $("#link_edit").val(),
        texto : $("#texto_edit").val(),
        img : $("#img_edit").val(),
    }

    $.post("back-end/controller/ControllerLinks.php", dados, function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            id_link = 0;

            $("#link_edit").val("");
            $("#texto_edit").val("");
            $("#img_edit").val("");
            
            $("#mesagem_sucesso").text(resposta[0]);
        } else {
            $("#mesagem_n_sucesso").text(resposta);
        }
    });
});

/*====================================================================================*/

$("#deletar_link").click(function () {
    const dados = {
        deletar : true,
        id : id_link,
    }

    $.get("back-end/controller/ControllerLinks.php", dados, function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            id_link = 0;
            
            $("#mesagem_sucesso").text(resposta[0]);
        } else {
            $("#mesagem_n_sucesso").text(resposta);
        }
    });
});

/*====================================================================================*/