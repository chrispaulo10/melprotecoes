<?php
    require "back-end/models/Rotas.class.php";

    $prefixo = "pages/";

    $listagem = new Listagem();
    
    $regioes = $listagem->regioes(false, true);

    $rotas = array(
        "" => "index",
        "home" => "index",
        "404" => "404",
        "blog" => [
            "" => "blog",
            "detalhes" => "blog-details"
        ],
        "redes-de-protecao" => $prefixo."redes-de-protecao",
        "cerca-de-piscina" => $prefixo."cerca-piscina",
        "tela-para-pets" => $prefixo."tela-gatos",
        "mosquiteira" => $prefixo."mosquiteira",
        "limitadores" => $prefixo."limitadores",
        "redes-esportivas" => $prefixo."redes-esportivas",
        "grades" => $prefixo."grades",
        "capas" => $prefixo."capas",
    //  "URL" => "NOME ARQUIVO"
);

foreach ($regioes as $key => $regiao) {
    $regiao['regiao'] = strtolower(str_replace(" ", "-", $regiao['regiao']));
    $rotas["redes-de-protecao-{$regiao['regiao']}"] = "{$prefixo}regioes/protecao-" . substr(str_replace("zona-", "", $regiao['regiao']), 3) . ".php";

    foreach ($regiao['cidades'] as $key => $cidade) {
        $cidade['nome'] = mb_strtolower(str_replace(" ", "-", $cidade['nome']), 'UTF-8');
        $rotas["redes-de-protecao-{$cidade['nome']}"] = $rotas["redes-de-protecao-{$regiao['regiao']}"];
    }
}

// echo '<pre>'; 
// var_dump($rotas);
// exit;

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
                if (array_key_exists($url_dividida[1], $rota)) $page = $rota[$url_dividida[1]];
                else $page = $nao_encontrado;
            }
        } else $page = $rota[''];
    } else $page = $nao_encontrado;
} else $page = 'index' . $extensao;

if (!file_exists($page)) $page = $nao_encontrado;
else {

    $url_completa = $_SERVER["REQUEST_URI"];
    $url_particionada = explode('/', $url_completa);

    $titulo = explode('-', end($url_particionada));
    $local = "";

    for ($i = 3; $i < count($titulo); $i++) {
        $local .= $titulo[$i] . " ";
    }

    $canonical = $url_completa;
    $title = "Redes de Proteção " . ucwords($local) . "| Mel Redes de Proteções";

    $descricao = "Buscando Redes de proteção ${local}com qualidade e preço justo entre em contato agora ligue para (11) 2682-3893. Rede de Proteção ${local}.";
    $keywords = "Redes de Proteção ${local}, rede de proteção ${local}, tela de proteção ${local}, telas de proteção ${local}, Redes de Proteção para janelas ${local}, rede de proteção ${local}para apartamento, tela de proteção ${local}para gatos, telas de proteção ${local}para quadra, Redes de Proteção ${local}para sacada, rede de proteção ${local}para piscinas, tela de proteção ${local}escadas, telas de proteção ${local}para mezaninos.";
}

require $page;
