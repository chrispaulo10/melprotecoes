<?php
    $prefixo = "pages/";

    $rotas = array(
        "" => "index",
        "Início" => "index",
        "404" => "404",
        "blog" => [
            "" => "blog",
            "detalhes" => "blog-details"
        ],
        "CercadePiscina" => $prefixo."cerca-piscina",
        "ProtecaoZonaLeste" => $prefixo."protecao-zona-leste",
        "ProtecaoZonaOeste" => $prefixo."protecao-zona-oeste",
        "RedesdeProtecao" => $prefixo."redes-de-protecao",
        "TelaGatos" => $prefixo."tela-gatos",
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
