let id_link = 0;
let img_link = "";
const controller = "back-end/controllers/ControllerLinks.php";

$("#cadastrar_link").click(function() {
    const i = $(`#icone_cadastrar`);
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
            success: function(retorno) 
            {   
                var retorno = JSON.parse(retorno);

                if (Array.isArray(retorno)) {
                    img = retorno[0];
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

        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#link").val("");
            $("#texto").val("");
            $("#img").val("");
            
            $.growl.notice( {message : resposta[0]} );

            if (upload && !img) $.growl.warning( {message : "Somente não foi possível salvar a imagem!"} );

            $('#dataTable').DataTable().destroy();
            listar();
        } else {
            $.get(controller, {apagar_img:1, img});
            $.growl.warning( {message : resposta} );
        }
    });
}

/*====================================================================================*/

function listar() {
    $.get(controller + "?listagem", function (retorno) {
        $("#tbody_links").html("");
        
        let resposta = JSON.parse(retorno);
    
        if (Array.isArray(resposta)) {
            $.each(resposta, function (idx, link) {
                let img = (typeof link.nome_img == "undefined" || link.nome_img == "") ? "defauts.jpg" : link.nome_img;

                $("#tbody_links").append(`
                    <tr id="link_${link.id}">
                        <td>${link.id}</td>
                        <td>${link.link}</td>
                        <td>
                            <button type="button" class="btn btn-info btn-sm" onClick="exibirDados('${link.link}', '${link.texto}')">
                                <i class="fas fa-file-alt"></i> Abrir texto
                            </button>
                        </td>
                        <td class='text-center'>
                            <img src="img/links/${img}" class="img-thumbnail" style="width : 150px; heigth : 150px;">
                        </td>
                        <td>
                            <button class="btn btn-warning btn-circle btn-md" title="Editar" onClick="consultar_link(${link.id})">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button class="btn btn-danger btn-circle btn-md" onClick="deletar(${link.id}, '${link.nome_img}')" title="Deletar">
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
}
listar();

/*====================================================================================*/

function consultar_link(id) {
    id_link = id;

    const dados = {
        consultar : true,
        id,
    }

    $.get(controller, dados, function (retorno) {
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#link_edit").val(resposta[0].link);
            $("#texto_edit").val(resposta[0].texto);
            $(`#url_edit`).val(`/${(resposta[0].link).replaceAll(" ", "-").toLowerCase()}`);
            img_link = resposta[0].nome_img;

            $("#modal_editar").modal("show");
        } else {
            $.growl.error( {message : resposta[0]} );
        }
    });
}

/*====================================================================================*/

$("#editar_link").click(function() {
    const i = $(`#icone_editar`);
    const button = $(`#editar_link`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    if ($(`#novo_img`)[0].files[0]) {
        var data = new FormData();
        data.append('img', $(`#novo_img`)[0].files[0]);
        
        $.ajax({
            url: controller,
            data: data,
            processData: false,
            contentType: false,
            type: 'POST',
            success: function(retorno) 
            {   
                var retorno = JSON.parse(retorno);

                if (Array.isArray(retorno)) {
                    img = retorno[0];
                    editar_link(img, button, i, class_icone, true)
                } else {
                    editar_link(null, button, i, class_icone, true)
                }
            },
            error: function()
            {
                editar_link(null, button, i, class_icone, true)
            }
        });
    } else {
        editar_link(null, button, i, class_icone)
    }
})

function editar_link(img, button, i, class_icone, upload = false) {
    const dados = {
        editar : true,
        id : id_link,
        link : $("#link_edit").val(),
        texto : $("#texto_edit").val(),
        img : (img) ? img : img_link
    }

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  
        
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#modal_editar").modal("hide");

            $(`#link_${id_link} td:nth-child(2)`).text(dados.link)
            $(`#link_${id_link} td:nth-child(3)`).html(`            
                <button type="button" class="btn btn-info btn-sm" onClick="exibirDados('${dados.link}', '${dados.texto}')">
                    <i class="fas fa-file-alt"></i> Abrir texto
                </button>
            `)
            $(`#link_${id_link} td:nth-child(4) img`).attr('src', `img/links/${dados.img}`);

            id_link = 0;

            $("#link_edit").val("");
            $("#texto_edit").val("");
            $("#img_edit").val("");
            
            $.growl.notice( {message : resposta[0]} );
            
            if (upload && !img) $.growl.warning( {message : "Somente não foi possível salvar a nova imagem!"} );
            else if (upload) {
                $.get(controller, {apagar_img:1, img:img_link});
            }

            img_link = "";
        } else {
            $.growl.warning( {message : resposta} );
            $.get(controller, {apagar_img:1, img});
        }
    });
};

/*====================================================================================*/

$("#deletar_link").click(function () {
    const dados = {
        deletar : true,
        id : id_link,
    }

    const i = $(`#icone_deletar`);
    const button = $(`#deletar_link`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.get(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  

        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {            
            $.growl.notice( {message : resposta[0]} );

            $("#modal_delete").modal('hide');
            $(`#link_${id_link}`).fadeOut('slow');

            $.get(controller, {apagar_img:1, img:img_link});
            
            setTimeout(() => {
                $(`#link_${id_link}`).remove();
                img_link = '';
                id_link = 0;
            }, 1000);
        } else {
            $.growl.error( {message : resposta} );
        }
    });
});

/*====================================================================================*/

function alterarUrl(novo = "_edit") 
{
    const link = $(`#link${novo}`).val();

    if (link != "")
        $(`#url${novo}`).val(`/${(link).replaceAll(" ", "-").toLowerCase()}`);
}

/*====================================================================================*/

function deletar(id, img) 
{
    id_link = id;
    img_link = img

    $("#modal_delete").modal('show');
}

/*====================================================================================*/

function exibirDados(link, texto)
{
    $("#texto_modal").html(texto);
    $("#link_modal").text(link);
    $("#modalTexto").modal("show");
}

/*====================================================================================*/

function mudancasAoFazerRequisicao(i, button) 
{
    var classe = i.attr('class');

    button.prop('disabled', true);
    i.removeClass().addClass('fas fa-sync-alt fa-spin');

    return classe;
}

/*====================================================================================*/

function limpar_arquivo(novo = '') 
{
    $(`#${novo}label_img`).html("<i class='fas fa-upload'></i> Escolher Arquivo");
    $(`#${novo}img`).val(""); 
    $(`#${novo}btn-limpar`).hide('fast');    
}

/*====================================================================================*/

function validarImagem(novo = '') {  
    if ($(`#${novo}img`).val() != '') {
        var extensoes = ['png', 'jpg', 'jpeg'];
        var input = document.getElementById(`${novo}img`);
        var nome_quebrado = input.files[0].name.split('.');
        var extension = nome_quebrado[nome_quebrado.length-1];
        
        if (extensoes.indexOf(extension.toLowerCase()) > -1) {
            $(`#${novo}label_img`).html(input.files[0].name);
            $(`#${novo}btn-limpar`).show('fast');  
        } else {
            $.growl.warning( {message : "Arquivo inválido"} );

            limpar_arquivo();
        }
    } else {
        limpar_arquivo();
    }
}
