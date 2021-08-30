$(document).ready(function() {
    $.get("back-end/controller/ControllerListagem.php", {
        listar_links_page : true
    }, function(retorno) {
        const dados = JSON.parse(retorno);

        let dropdowns = {}

        $.each(dados, function(idx, link) {
            let titulo = ((link.titulo).toLowerCase()).replaceAll(" ", "-");

            $.each(chars_especiais, function(char, letra) {
                titulo = titulo.replaceAll(char, letra);
            })

            if (typeof dropdowns[titulo] == "undefined") {
                dropdowns[titulo] = [];
            }

            dropdowns[titulo].push({
                url: link.url, title: link.title
            });
        })
        
        $.each(dropdowns, function(id, dados) {
            $.each(dados, function(idx, link) {
                $(`.${id}`).append(`
                    <li><a href="${link.url}">${link.title}</a></li>
                `);
            });
        })
    });
});