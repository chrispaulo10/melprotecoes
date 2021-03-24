$(document).ready(function() {
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
        "%C3%80" : "À", 
        "%C3%81" : "Á", 
        "%C3%82" : "Â", 
        "%C3%83" : "Ã", 

        "%C3%A0" : "à", 
        "%C3%A1" : "á", 
        "%C3%A2" : "â",
        "%C3%A3" : "ã", 

        "%C3%88" : "È",
        "%C3%89" : "É",
        "%C3%8A" : "Ê", 

        "%C3%A8" : "è",
        "%C3%A9" : "é",
        "%C3%AA" : "ê",

        "%C3%8C" : "Ì",
        "%C3%8D" : "Í",
        "%C3%8E" : "Î", 

        "%C3%AC" : "ì", 
        "%C3%AD" : "í",
        "%C3%AE" : "î",

        "%C3%92" : "Ò", 
        "%C3%93" : "Ó",  
        "%C3%94" : "Ô", 
        "%C3%95" : "Õ",

        "%C3%B2" : "ò",
        "%C3%B3" : "ó", 
        "%C3%B4" : "ô", 
        "%C3%B5" : "õ", 

        "%C3%99" : "Ù",
        "%C3%9A" : "Ú",
        "%C3%9B" : "Û",

        "%C3%B9" : "ù", 
        "%C3%BA" : "ú",
        "%C3%BB" : "û",

        "%C3%87" : "Ç", 
        "%C3%A7" : "ç", 

        "%C3%9D" : "Ý", 
        "%C3%BD" : "ý", 
    };

    const url_atual = window.location.href;

    let page = url_atual.split("/");
    let titulo = page[page.length-1].split("-");
    let local = "";

    for (let index = 3; index < titulo.length; index++) {
        local += `${titulo[index]} `;
    }
    
    $.each(chars_especiais, function(codigo, char) {
        local = local.replace(codigo, char);
    });

    $(".local").text(local);
    document.title = `Redes de Proteção ${titleize(local)} | Mel Redes de Proteções`;

    if (page[page.length-1] == "") {
        $.get("back-end/controller/ControllerListagem.php", function(retorno) {
            var regioes = JSON.parse(retorno);
    
            $.each(regioes, function(idx, regiao) {

                $.each(regiao['estados'], function(idx, estados) {

                    $.each(estados['cidades'], function(idx, cidade) {

                    });
                });
            });
        });
    }
});