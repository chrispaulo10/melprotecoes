let id_link = 0;
const prefixo = "../";
const controller = prefixo + "back-end/controller/ControllerLinks.php";

$("#cadastrar_link").click(function() {
    const i = $(`#icone_editar`);
    const button = $(`#cadastrar_link`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    if ($(`#img`)[0].files[0]) {
        var data = new FormData();
        data.append('img', $(`#img`)[0].files[0]);
        
        $.ajax({
            url: controller,
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            headers,
            success: function(retorno) 
            {   
                var retorno = JSON.parse(retorno);

                if (Array.isArray(retorno)) {
                    img = retorno.resposta;
                    cadastrar_link(img, button, i, class_icone, true)
                } else {
                    cadastrar_link(null, button, i, class_icone, true)
                }
            },
            error: function()
            {
                cadastrar_link(null, button, i, class_icone, true)
            }
        });
    } else {
        cadastrar_link(null, button, i, class_icone)
    }
});

function cadastrar_link(img, button, i, class_icone, upload = false) {
    const dados = {
        cadastrar : true,
        link : $("#link").val(),
        texto : $("#texto").val(),
        img,
    }

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  

        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            $("#link").val("");
            $("#texto").val("");
            $("#img").val("");
            
            $.growl.notice( {message : resposta[0]} );

            if (upload && !img) $.growl.warning( {message : "Somente não foi possível salvar a imagem!"} );
        } else {
            $.get(controller, {apagar_img:1, img});
            $.growl.warning( {message : resposta} );
        }
    });
}

/*====================================================================================*/

$.get(controller + "?listagem", function (retorno) {
    $("#tbody_links").html("");

    let resposta = JSON.parse(retorno);

    if (Array.isArray(resposta)) {
        $.each(resposta, function (idx, link) {
            let img = (link.img == "") ? "defaut.png" : link.img;

            $("#tbody_links").append(`
                <tr>
                    <td>${link.id}</td>
                    <td>${link.link}</td>
                    <td>${link.texto}</td>
                    <td>
                        <img src="img/links/${img}">
                    </td>
                    <td>
                        <button class="btn btn-warning btn-circle btn-md" title="Editar" onClick="consultar_link(${link.id})">
                            <i class="fas fa-pen"></i>
                        </button>
                        <button class="btn btn-danger btn-circle btn-md" onClick="deletar(${link.id})" title="Deletar">
                            <i class="fas fa-trash"></i>
                        </button>
                    </td>
                </tr>
            `);
        });
    } else {
        $.growl.warning( {message : resposta} );
    }

    $('#dataTable').DataTable();
});

/*====================================================================================*/

function consultar_link(id) {
    id_link = id;

    const dados = {
        consultar : true,
        id,
    }

    $.get(controller, dados, function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            $("#link_edit").val(reposta.link);
            $("#texto_edit").val(reposta.texto);
            $("#img_edit").attr('href', reposta.nome_img);

            $("#modal_editar").modal("show");
        } else {
            $.growl.error( {message : resposta} );
        }
    });
}

/*====================================================================================*/

$("#editar_link").click(function () {
    const dados = {
        editar : true,
        id : id_link,
        link : $("#link_edit").val(),
        texto : $("#texto_edit").val(),
        img : $("#img_edit").val(),
    }

    const i = $(`#icone_editar`);
    const button = $(`#editar_link`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  
        
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            id_link = 0;

            $("#link_edit").val("");
            $("#texto_edit").val("");
            $("#img_edit").val("");
            
            $("#mesagem_sucesso").text(resposta[0]);
        } else {
            $.growl.warning( {message : resposta} );
        }
    });
});

/*====================================================================================*/

$("#deletar_link").click(function () {
    const dados = {
        deletar : true,
        id : id_link,
    }

    $.get(controller, dados, function (retorno) {
        let resposta = JSON.parse($retorno)

        if (Array.isArray(resposta)) {
            id_link = 0;
            
            $("#mesagem_sucesso").text(resposta[0]);
        } else {
            $.growl.error( {message : resposta} );
        }
    });
});

/*====================================================================================*/

function deletar(id) 
{
    id_link = id;

    $("#modal_deletar").modal('show');
}

/*====================================================================================*/

function mudancasAoFazerRequisicao(i, button) 
{
    var classe = i.attr('class');

    button.prop('disabled', true);
    i.removeClass().addClass('fas fa-sync-alt fa-spin');

    return classe;
}