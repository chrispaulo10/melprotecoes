var id_link_page = 0;
var controller = "back-end/controllers/ControllerLinkPage.php";

$("#cadastrar_link_page").click(function() {
    const dados = {
        cadastrar : true,
        id_categoria : $('#id_categoria').val(),
        h1 : $('#h1').val(),
        url : $('#url').val(),
        title : $('#title').val(),
        description : $('#description').val(),
        og_title : $('#og_title').val(),
        site_name : $('#site_name').val(),
        keywords : $('#keywords').val(),
    }
    
    const i = $(`#icone_cadastrar`);
    const button = $(`#cadastrar_link_page`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  

        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $('#h1').val("");
            $('#url').val("");
            $('#title').val("");
            $('#description').val("");
            $('#og_title').val("");
            $('#site_name').val("");
            $('#keywords').val("");
            
            $.growl.notice( {message : resposta[0]} );

            $('#dataTable').DataTable().destroy();
            listar();
        } else {
            $.growl.warning( {message : resposta} );
        }
    });
});

/*====================================================================================*/

function categorias() {
    $.get("back-end/controllers/ControllerCategoria.php?listagem", function (retorno) {
        $(".select_categorias").html("");
        
        let resposta = JSON.parse(retorno);
    
        if (Array.isArray(resposta)) {
            $.each(resposta, function (idx, categoria) {
                $(".select_categorias").append(`
                    <option value="${categoria.id}">${categoria.titulo}</option>
                `);
            });
        } else {
            $(".select_categorias").append(`
                <option value="">CADASTRE UMA CATEGORIA</option>
            `);
        }
    
        $('#dataTable').DataTable();
    });
}
categorias();

function listar() {
    $.get(controller + "?listagem", function (retorno) {
        $("#tbody_link_page").html("");
        
        let resposta = JSON.parse(retorno);
    
        if (Array.isArray(resposta)) {
            $.each(resposta, function (idx, link) {
                $("#tbody_link_page").append(`
                    <tr id="linkpage_${link.id}">
                        <td>${link.id}</td>
                        <td>${link.titulo}</td>
                        <td>${link.title}</td>
                        <td>${link.keywords}</td>
                        <td>
                            <button class="btn btn-info btn-circle btn-md" onClick="consultar_textos(${link.id})" title="Textos">
                                <i class="fas fa-file-alt"></i>
                            </button>
                            <button class="btn btn-warning btn-circle btn-md" onClick="consultar_link_page(${link.id})" title="Editar">
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
}
listar();

/*====================================================================================*/

function consultar_link_page(id) {
    id_link_page = id;

    const dados = {
        consultar : true,
        id,
    }

    $.get(controller, dados, function (retorno) {
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#novo_id_categoria").val(resposta[0].id_categoria_fk);
            $("#novo_h1").val(resposta[0].h1);
            $("#novo_url").val(resposta[0].url);
            $("#novo_title").val(resposta[0].title);
            $("#novo_description").val(resposta[0].description);
            $("#novo_og_title").val(resposta[0].og_title);
            $("#novo_site_name").val(resposta[0].site_name);
            $("#novo_keywords").val(resposta[0].keywords);
        
            $("#modal_editar").modal("show");
        } else {
            $.growl.error( {message : resposta[0]} );
        }
    });
}

/*====================================================================================*/

$("#editar_link_page").click(function() {
    const dados = {
        editar : true,
        id : id_link_page,
        id_categoria : $('#novo_id_categoria').val(),
        h1 : $('#novo_h1').val(),
        url : $('#novo_url').val(),
        title : $('#novo_title').val(),
        description : $('#novo_description').val(),
        og_title : $('#novo_og_title').val(),
        site_name : $('#novo_site_name').val(),
        keywords : $('#novo_keywords').val(),
    }
    
    const i = $(`#icone_editar`);
    const button = $(`#editar_link_page`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  
        
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#modal_editar").modal("hide");

            id_link_page = 0;

            $('#novo_h1').val("");
            $('#novo_url').val("");
            $('#novo_title').val("");
            $('#novo_description').val("");
            $('#novo_og_title').val("");
            $('#novo_site_name').val("");
            $('#novo_keywords').val("");
            
            $.growl.notice( {message : resposta[0]} );
            $('#dataTable').DataTable().destroy();
            listar();
        } else {
            $.growl.warning( {message : resposta} );
        }
    });
})

/*====================================================================================*/

$("#deletar_link_page").click(function () {
    const dados = {
        deletar : true,
        id : id_link_page,
    }

    const i = $(`#icone_deletar`);
    const button = $(`#deletar_link_page`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.get(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  

        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {            
            $.growl.notice( {message : resposta[0]} );

            $("#modal_delete").modal('hide');
            $(`#linkpage_${id_link_page}`).fadeOut('slow');

            setTimeout(() => {
                $(`#linkpage_${id_link_page}`).remove();
                id_link_page = 0;
            }, 1000);
        } else {
            $.growl.error( {message : resposta} );
        }
    });
});

/*====================================================================================*/

function deletar(id) 
{
    id_link_page = id;

    $("#modal_delete").modal('show');
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

function consultar_textos(id) {
    id_link_page = id;

    const dados = {
        consultarTextos : true,
        id,
    }

    $.get(controller, dados, function (retorno) {
        let resposta = JSON.parse(retorno);

        $("#modal_textos form").html("");
        if (Array.isArray(resposta)) {
            $.each(resposta, function(idx, texto) {
                $("#modal_textos form").append(`
                    <div class="form-row">
                        <div class="col-6">
                            <label for="titulo${texto.posicao}">Titulo ${texto.posicao}</label>
                            <input 
                                type="text" class="form-control" id="titulo${texto.posicao}" 
                                placeholder="Titulo" value="${texto.titulo}"
                            >
                        </div>
                        <div class="col-6">
                            <label for="subtitulo${texto.posicao}">Subtitulo ${texto.posicao}</label>
                            <input 
                                type="text" class="form-control" id="subtitulo${texto.posicao}" 
                                placeholder="Subtitulo" value="${texto.subtitulo}"
                            >
                        </div>
                        <div class="col-12">
                            <label for="texto${texto.posicao}">Texto ${texto.posicao}</label>
                            <textarea id="texto${texto.posicao}" rows="3">${texto.texto}</textarea>
                        </div>
                    </div>
                `);
            });

            $("#modal_textos").modal("show");
        } else {
            $.growl.error( {message : resposta} );
        }
    });
}
$("#editar_textos").click(function() {
    const dados = {
        editarTextos : true,
        id : id_link_page,
    }

    for (let index = 1; index <= 8; index++) {
        dados["titulo"+index] = $(`#titulo${index}`).val();
        dados["subtitulo"+index] = $(`#subtitulo${index}`).val();
        dados["texto"+index] = $(`#texto${index}`).val();
    }
    
    const i = $(`#icone_editar_textos`);
    const button = $(`#editar_textos`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  
        
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            id_link_page = 0;

            $.growl.notice( {message : resposta[0]} );
        } else {
            $.growl.warning( {message : resposta} );
        }
    });
})
