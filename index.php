<?php
    require "back-end/models/Rotas.class.php";

    $prefixo = "pages/";
    $extensao = ".html";

    $listagem = new Listagem();
    
    $regioes = $listagem->regioes(false, true);
    $links = $listagem->links();

    $rotas = array(
        "" => "index". $extensao,
        "home" => "index". $extensao,
        "home#" => "index". $extensao,
        "404" => "404". $extensao,
        "blog" => [
            "" => "blog",
            "detalhes" => "blog-details"
        ],
        "redes-de-protecao" => $prefixo."redes-de-protecao". $extensao,
        "cerca-de-piscina" => $prefixo."cerca-piscina". $extensao,
        "tela-para-pets" => $prefixo."tela-gatos". $extensao,
        "mosquiteira" => $prefixo."mosquiteira". $extensao,
        "limitadores" => $prefixo."limitadores". $extensao,
        "redes-esportivas" => $prefixo."redes-esportivas". $extensao,
        "grades" => $prefixo."grades" . $extensao,
        "capas" => $prefixo."capas". $extensao,
        "seja-um-parceiro" => $prefixo."seja-um-parceiro". $extensao,
    //  "URL" => "NOME ARQUIVO"
);

foreach ($regioes as $key => $regiao) {
    $regiao['regiao'] = mb_strtolower(str_replace(" ", "-", $regiao['regiao']), 'UTF-8');
    $rotas["redes-de-protecao-{$regiao['regiao']}"] = "{$prefixo}regioes/protecao-" . substr(str_replace("zona-", "", $regiao['regiao']), 3) . ".php";

    foreach ($regiao['cidades'] as $key => $cidade) {
        $cidade['nome'] = mb_strtolower(str_replace(" ", "-", $cidade['nome']), 'UTF-8');
        $rotas["redes-de-protecao-{$cidade['nome']}"] = $rotas["redes-de-protecao-{$regiao['regiao']}"];
    }
}

// if (is_array($links)) {
//     foreach ($links as $idx => $link) {
//         $link['link'] = mb_strtolower(str_replace(" ", "-", $link['link']), 'UTF-8');
//         $rotas["{$link['link']}"] = "{$prefixo}conteudos/tela-conteudos.php";
//     }
// }

echo '<pre>'; 
var_dump($rotas);
exit;

$page = $nao_encontrado = '404' . $extensao;

if (isset($_GET['url'])) {
    $url            = $_GET['url'];
    $url_dividida   = explode('/', $_GET['url']);

    if (count($url_dividida) == 1 && array_key_exists($url_dividida[0], $rotas) && !is_array($rotas[$url_dividida[0]])) {
        $page = $rotas[$url_dividida[0]];
    } else if (array_key_exists($url_dividida[0], $rotas)) {
        $indice = $url_dividida[0];
        $rota = $rotas[$indice];

        if (isset($url_dividida[1])) {
            if ($url_dividida[1] == "") {
                header("Location: ../$url_dividida[0]");
            } else {
                if (array_key_exists($url_dividida[1], $rota)) $page = $rota[$url_dividida[1]] . $extensao;
                else $page = $nao_encontrado;
            }
        } else $page = $rota[''] . $extensao;
    } else $page = $nao_encontrado;
} else $page = 'index' . $extensao;

if (!file_exists($page)) $page = $nao_encontrado;
else {
    $chars_especiais = [
        "%C3%80" => "À",
        "%C3%81" => "Á",
        "%C3%82" => "Â",
        "%C3%83" => "Ã",

        "%C3%A0" => "à",
        "%C3%A1" => "á",
        "%C3%A2" => "â",
        "%C3%A3" => "ã",

        "%C3%88" => "È",
        "%C3%89" => "É",
        "%C3%8A" => "Ê",

        "%C3%A8" => "è",
        "%C3%A9" => "é",
        "%C3%AA" => "ê",

        "%C3%8C" => "Ì",
        "%C3%8D" => "Í",
        "%C3%8E" => "Î",

        "%C3%AC" => "ì",
        "%C3%AD" => "í",
        "%C3%AE" => "î",

        "%C3%92" => "Ò",
        "%C3%93" => "Ó",
        "%C3%94" => "Ô",
        "%C3%95" => "Õ",

        "%C3%B2" => "ò",
        "%C3%B3" => "ó",
        "%C3%B4" => "ô",
        "%C3%B5" => "õ",

        "%C3%99" => "Ù",
        "%C3%9A" => "Ú",
        "%C3%9B" => "Û",

        "%C3%B9" => "ù",
        "%C3%BA" => "ú",
        "%C3%BB" => "û",

        "%C3%87" => "Ç",
        "%C3%A7" => "ç",

        "%C3%9D" => "Ý",
        "%C3%BD" => "ý",
    ];

    $url_completa = $_SERVER["REQUEST_URI"];
    $url_particionada = explode('/', $url_completa);

    $titulo = explode('-', end($url_particionada));
    $local = "";

    $n = ($titulo[0]." ".($titulo[1]??'')." ".($titulo[2]??'') == "redes de protecao") ? 3 : 0;

    for ($i = $n; $i < count($titulo); $i++) {
        $local .= $titulo[$i] . " ";
    }

    foreach ($chars_especiais as $codigo => $char) {
        $url_completa = str_replace($codigo, $char, $url_completa);
        $local = str_replace($codigo, $char, $local);
    }
    
    $canonical = $url_completa;
    $title = "Redes de Proteção em " . ucwords($local) . "| Mel Redes de Proteção";
    $h1 = "Redes de Proteção em <span class='text-capitalize'>" . ucwords($local). "</span>";

    $descricao = "Buscando Redes de proteção em ${local} com qualidade e preço justo entre em contato agora ligue para (11) 2682-3893. Rede de Proteção em ${local}.";
    $descricaoConteudo = "Buscando ${local}com qualidade e preço justo entre em contato agora ligue para (11) 2682-3893. ${local} Mel Proteções.";
    $keywords = "Redes de Proteção em ${local}, rede de proteção em ${local}, tela de proteção em ${local}, telas de proteção em ${local}, Redes de Proteção para janelas em ${local}, rede de proteção em ${local} para apartamento, tela de proteção em ${local} para gatos, telas de proteção em ${local} para quadra, Redes de Proteção em ${local} para sacada, rede de proteção em ${local} para piscinas, tela de proteção em ${local} escadas, telas de proteção em ${local} para mezaninos.";
}

require $page;