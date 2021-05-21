$(document).ready(function() {
    $.get("back-end/controller/ControllerListagem.php", {
        listar_estados_cidades: true,
        id_regiao: 6
    }, function (retorno) {
        const dados = JSON.parse(retorno);

        var col = 4;
        var row = '';
        
        $.each(dados, function (idx, estados) {
            if ($(`#zona${estados.id}`).length > 0) {
                $(`#zona${estados.id}`).html('');

                $.each(estados.cidades, function (idx, cidade) {
                    var link = (cidade.nome).toLowerCase().replaceAll(" ", "-");
                    
                    $.each(chars_especiais, function(char, letra) {
                        link = (link).replaceAll(char, letra);
                    });

                    if (col == 4) {
                        row += `
                            <div class="row">
                        `;
                    }

                    row += `
                        <div class="col-lg-4">
                            <a href="redes-de-protecao-${link}">
                                <h2 style="font-size: 15px; margin-bottom: 0;">
                                    Redes de Proteção em ${cidade.nome}
                                </h2>
                            </a>
                        </div>
                    `;

                    if (col == 12) {
                        row += `
                            </div>
                        `;

                        col = 0;
                    }

                    col += 4;
                });

                if (col > 4) row += "</div>";

                $(`#zona${estados.id}`).append(row);

                row = '';
                col = 4;
            } 
        });
    });
})