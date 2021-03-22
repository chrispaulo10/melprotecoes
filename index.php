<?php
    $prefixo = "pages/";

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
        // CIDADES DA ZONA LESTE
        "redes-de-protecao-na-zona-leste" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-aricanduva" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-arthur-alvim" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-belenzinho" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-cangaíba" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-no-carrão" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-cidade-tiradentes" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-cidade-ermelino-matarazzo" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-guaianazes" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-itaim-paulista" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-itaquera" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-no-jardim-analia-franco" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-na-mooca" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-patriarca" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-na-penha" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-sao-mateus" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-sao-mateus" => $prefixo."protecao-zona-leste",
        // CIDADES DA ZONA OESTE
        "redes-de-protecao-na-zona-oeste" => $prefixo."protecao-zona-oeste",
        // CIDADES DA ZONA SUL

        // CIDADES DA ZONA NORTE

        // CIDADES DO CENTRO SP
        
        // CIDADES DO ABCD

        // CIDADES DE GUARULHOS

        // CIDADES DO INTERIOR

        // CIDADES NO LITORAL SP

    //  "URL" => "NOME ARQUIVO"
    );

    $page = $nao_encontrado = '404';

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
    } else $page = 'index';

    $page .= '.html';

    if (!file_exists($page)) $page = $nao_encontrado.'.html';

    require $page;

?>
