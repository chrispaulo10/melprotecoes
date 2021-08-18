var id_categoria = 0;
var controller = "back-end/controllers/ControllerCategoria.php";

$("#cadastrar_categoria").click(function() {
    const dados = {
        cadastrar : true,
        titulo : $("#titulo").val(),
    }
    
    const i = $(`#icone_cadastrar`);
    const button = $(`#cadastrar_categoria`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  

        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#titulo").val("");
            
            $.growl.notice( {message : resposta[0]} );

            $('#dataTable').DataTable().destroy();
            listar();
        } else {
            $.growl.warning( {message : resposta} );
        }
    });
});

/*====================================================================================*/

function listar() {
    $.get(controller + "?listagem", function (retorno) {
        $("#tbody_categorias").html("");
        
        let resposta = JSON.parse(retorno);
    
        if (Array.isArray(resposta)) {
            $.each(resposta, function (idx, categoria) {
                $("#tbody_categorias").append(`
                    <tr id="categoria_${categoria.id}">
                        <td>${categoria.id}</td>
                        <td>${categoria.titulo}</td>
                        <td>
                            <button class="btn btn-warning btn-circle btn-md" onClick="consultar_categoria(${categoria.id})" title="Editar">
                                <i class="fas fa-pen"></i>
                            </button>
                            <button class="btn btn-danger btn-circle btn-md" onClick="deletar(${categoria.id})" title="Deletar">
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

function consultar_categoria(id) {
    id_categoria = id;

    const dados = {
        consultar : true,
        id,
    }

    $.get(controller, dados, function (retorno) {
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#novo_titulo").val(resposta[0].titulo);

            $("#modal_editar").modal("show");
        } else {
            $.growl.error( {message : resposta[0]} );
        }
    });
}

/*====================================================================================*/

$("#editar_categoria").click(function() {
    const dados = {
        editar : true,
        id : id_categoria,
        titulo : $("#novo_titulo").val(),
    }
    
    const i = $(`#icone_editar`);
    const button = $(`#editar_categoria`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.post(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  
        
        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {
            $("#modal_editar").modal("hide");

            $(`#categoria_${id_categoria} td:nth-child(2)`).text(dados.titulo);
            id_categoria = 0;

            $("#novo_titulo").val("");
            
            $.growl.notice( {message : resposta[0]} );
        } else {
            $.growl.warning( {message : resposta} );
        }
    });
})


/*====================================================================================*/

$("#deletar_categoria").click(function () {
    const dados = {
        deletar : true,
        id : id_categoria,
    }

    const i = $(`#icone_deletar`);
    const button = $(`#deletar_categoria`);
    const class_icone = mudancasAoFazerRequisicao(i, button);

    $.get(controller, dados, function (retorno) {
        button.prop('disabled', false);
        i.removeClass().addClass(class_icone);  

        let resposta = JSON.parse(retorno)

        if (Array.isArray(resposta)) {            
            $.growl.notice( {message : resposta[0]} );

            $("#modal_delete").modal('hide');
            $(`#categoria_${id_categoria}`).fadeOut('slow');

            setTimeout(() => {
                $(`#categoria_${id_categoria}`).remove();
                id_categoria = 0;
            }, 1000);
        } else {
            $.growl.error( {message : resposta} );
        }
    });
});

/*====================================================================================*/

function deletar(id) 
{
    id_categoria = id;

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

