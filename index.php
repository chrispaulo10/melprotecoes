<?php

    $rotas = array(
        "" => "index",
        "404" => "404",
    //  "URL" => "NOME ARQUIVO"
    );

    $index = $nao_encontrado = '404';

    if (isset($_GET['url'])) {        
        $url            = $_GET['url'];
        $url_dividida   = explode('/', $_GET['url']);

        if (count($url_dividida) == 1 && array_key_exists($url_dividida[0], $rotas)) $index = $url_dividida[0];
    } else $index = '';

    $page = $rotas[$index].'.html';

    if (!file_exists($page)) $page = $nao_encontrado.'.html';

    require $page;

?>
