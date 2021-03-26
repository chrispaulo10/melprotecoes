$(document).ready(function () {
    function titleize(text) {
        var words = text.split(" ");

        for (var a = 0; a < words.length; a++) {
            if (words[a] != "") {
                var w = words[a];
                words[a] = w[0].toUpperCase() + w.slice(1);
            }
        }

        return words.join(" ");
    }

    const chars_especiais = {
        "%C3%80": "À",
        "%C3%81": "Á",
        "%C3%82": "Â",
        "%C3%83": "Ã",

        "%C3%A0": "à",
        "%C3%A1": "á",
        "%C3%A2": "â",
        "%C3%A3": "ã",

        "%C3%88": "È",
        "%C3%89": "É",
        "%C3%8A": "Ê",

        "%C3%A8": "è",
        "%C3%A9": "é",
        "%C3%AA": "ê",

        "%C3%8C": "Ì",
        "%C3%8D": "Í",
        "%C3%8E": "Î",

        "%C3%AC": "ì",
        "%C3%AD": "í",
        "%C3%AE": "î",

        "%C3%92": "Ò",
        "%C3%93": "Ó",
        "%C3%94": "Ô",
        "%C3%95": "Õ",

        "%C3%B2": "ò",
        "%C3%B3": "ó",
        "%C3%B4": "ô",
        "%C3%B5": "õ",

        "%C3%99": "Ù",
        "%C3%9A": "Ú",
        "%C3%9B": "Û",

        "%C3%B9": "ù",
        "%C3%BA": "ú",
        "%C3%BB": "û",

        "%C3%87": "Ç",
        "%C3%A7": "ç",

        "%C3%9D": "Ý",
        "%C3%BD": "ý",
    };

    const url_atual = window.location.href;
    let page = url_atual.split("/");

    if (page[page.length - 1] == "" || page[page.length - 1] == 'home') {
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
                                                    <a href="redes-de-protecao-${(cidade.nome).replace(" ", "-").toLowerCase()}">
                                                        <span class="list-link">Redes de Proteção ${cidade.nome}</span>
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
    }
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
        assunto: $("#assunto").val(),
        mensagem: $("#mensagem").val(),
    };

    $.post("back-end/controller/ControllerMail.php", dados, function (retorno) {
        button.prop('disabled', false);
        // $("#icone-enviar_email").removeClass().addClass(class_icone);

        $("#email").val('')
        $("#nome").val('')
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