$(document).ready(function () {
    const url_atual = window.location.href;
    let page = url_atual.split("/");
    let titulo = page[page.length - 1].split("-");
    let local = "";

    let n = ((titulo[0]+" "+(titulo[1]??"")+" "+(titulo[2]??"")) == "redes de protecao") ? 3 : 0;

    for (let index = n; index < titulo.length; index++) {
        local += `${titulo[index]} `;
    }

    if (titulo[0]+" "+(titulo[1]??"")+" "+(titulo[2]??"")) {
        $.get("back-end/controller/ControllerListagem.php", {nome_cidade:local}, function (retorno) {
            if (retorno.indexOf("enhum") == -1)
                $(".local").text(JSON.parse(retorno)[0].nome)
        });
    }

    // if (page[page.length - 1] == "" || page[page.length - 1] == 'home') {
    $.get("back-end/controller/ControllerListagem.php", function (retorno) {
        var regioes = JSON.parse(retorno);

        $.each(regioes, function (idx, regiao) {
            let html_regiao = `
                        <li>
                            <!-- REGIÃO -->
                            <a data-toggle="collapse" href="#regiao_${regiao.id}" class="collapsed"> Redes de Proteção <span class='text-capitalize'> ${regiao.regiao} </span><i class="icofont-simple-up"></i></a>
                            <!-- ESTADOS -->
                            <div id="regiao_${regiao.id}" class="collapse" data-parent=".faq-list">
                                <ul class="faq-list2 mt-1">
            `;

            $.each(regiao['estados'], function (idx, estado) {
                html_regiao += `
                                    <li style="padding-bottom: 3px; padding-top: 3px;">
                                        <a data-toggle="collapse" href="#estado_${estado.id}" class="collapsed" style="font-size: 16.5px;">${estado.nome} <i class="icofont-simple-up"></i></a>
                                        <!-- CIDADES -->
                                        <div id="estado_${estado.id}" class="collapse" data-parent=".faq-list2">
                                            <div class="list-group-links">
                                    
                `;

                $.each(estado['cidades'], function (idx, cidade) {
                    html_regiao += `                        
                                                <a class="links_cidades" href="redes-de-protecao-${(cidade.nome).replaceAll(" ", "-").toLowerCase()}">
                                                    <span class="list-link">Redes de Proteção em ${cidade.nome}</span>
                                                </a>
                    `;
                });

                html_regiao += ` 
                                            </div>
                                        </div>
                                    </li>
                `;
            });

            html_regiao += `
                            </ul>
                        </div>            
                    </li>
            `;

            $("#regioes").append(html_regiao);
        });
    });
    // }

    // if (page[page.length - 1] == "" || page[page.length - 1] == 'home') {
    $.get("back-end/controller/ControllerListagem.php?listar_links", function(retorno) {
        const links = JSON.parse(retorno);

        $("#links").html("");

        $.each(links, function(idx, link) {
            $("#links").append(`                    
                <div class="col-md-4 col-sm-6 col-xs-12">
                    <div class="footer-content">
                        <ul>
                            <li> 
                                <a href="${(link.link).replaceAll(" ", "-").toLowerCase()}" class="text-light">
                                    ${link.link}
                                </a>
                                </li>
                            </ul>
                    </div>
                </div>
            `);
        });
    });
    // }
});


$("#enviar_email").click(function () {
    const button = $(this);
    button.prop('disabled', true);

    // const class_icone = $("#icone-enviar_email").attr('class');
    // $("#icone-enviar_email").removeClass().addClass("fa fa-sync-alt fa-spin");

    const dados = {
        enviar_email: true,
        email: $("#email").val(),
        nome: $("#nome").val(),
        fone: $("#fone").val(),
        assunto: $("#assunto").val(),
        mensagem: $("#mensagem").val(),
    };

    $.post("back-end/controller/ControllerMail.php", dados, function (retorno) {
        button.prop('disabled', false);
        // $("#icone-enviar_email").removeClass().addClass(class_icone);

        $("#email").val('')
        $("#nome").val('')
        $("#fone").val('')
        $("#assunto").val('')
        $("#mensagem").val('')

        const mensagem = JSON.parse(retorno);

        $("#alerta_mail").removeClass().addClass(`alert alert-${mensagem.tipo} mt-2`);
        $("#alerta_mail").text(mensagem.resposta);
        $("#alerta_mail").show("fast");
        
        setTimeout(() => {
            $("#alerta_mail").fadeOut("slow");
        }, 3000);
    });
});


$("#btn_pesquisa").click(function() {
    const button = $(this);
    const div_resultados = $("#div-resultados_pesquisa");

    div_resultados.html("");
    
    let pesquisa = ($("#input_pesquisa").val()).toLowerCase().replaceAll(" ", "-");
    let qtd_resultados = 0;
    
    if (pesquisa.length >= 3) {
        button.prop("disabled", true);
        
        setTimeout(() => {
            $(".links_cidades").each(function(idx, value) {
                let link = $(this);
                let a_href = link.attr('href');
        
                if (a_href.indexOf(pesquisa) > -1) {
                    div_resultados.append(`
                        <a href="${a_href}" class="list-group-item list-group-item-action">${link[0].children[0].innerText}</a>
                    `);
                    // console.log(link[0]);
                    qtd_resultados++;
                }
            });

            if (qtd_resultados == 0) {
                div_resultados.append(`
                    <a class="list-group-item list-group-item-action">Nenhum local encontrado</a>
                `);
            }
        
            button.prop("disabled", false);        
        }, 100);
    }
});