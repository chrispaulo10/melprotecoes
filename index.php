<?php
    require "back-end/models/Rotas.class.php";

    $chars_especiais = [
        "À" => "A",
        "Á" => "A",
        "Â" => "A",
        "Ã" => "A",

        "à" => "a",
        "á" => "a",
        "â" => "a",
        "ã" => "a",

        "È" => "E",
        "É" => "E",
        "Ê" => "E",

        "è" => "e",
        "é" => "e",
        "ê" => "e",

        "Ì" => "I",
        "Í" => "I",
        "Î" => "I",

        "ì" => "i",
        "í" => "i",
        "î" => "i",

        "Ò" => "O",
        "Ó" => "O",
        "Ô" => "O",
        "Õ" => "O",

        "ò" => "o",
        "ó" => "o",
        "ô" => "o",
        "õ" => "o",

        "Ù" => "U",
        "Ú" => "U",
        "Û" => "U",

        "ù" => "u",
        "ú" => "u",
        "û" => "u",

        "Ç" => "C",
        "ç" => "c",

        "Ý" => "Y",
        "ý" => "y",
    ];
    
    $prefixo = "pages/";
    $extensao = ".html";

    $listagem = new Listagem();
    
    $regioes = $listagem->regioes(false, true);
    $links = $listagem->links();
    $link_page = $listagem->linksPage();

    $rotas_sp = [];

    $rotas = array(
        "" => "index". $extensao,
        "home" => "index". $extensao,
        "home#" => "index". $extensao,
        "404" => "index". $extensao,
        "blog" => [
            "" => "blog",
            "detalhes" => "blog-details"
        ],
        "redes-de-protecao" => $prefixo."redes-de-protecao". $extensao,
        "cerca-de-piscina" => $prefixo."cerca-de-piscina". $extensao,
        "tela-para-pets" => $prefixo."tela-gatos". $extensao,
        "mosquiteira" => $prefixo."mosquiteira". $extensao,
        "limitadores" => $prefixo."limitadores". $extensao,
        "redes-esportivas" => $prefixo."redes-esportivas". $extensao,
        "grades" => $prefixo."grades" . $extensao,
        "capas" => $prefixo."capas". $extensao,
        "seja-um-parceiro" => $prefixo."seja-um-parceiro". $extensao,
        "laudos" => $prefixo."laudos". $extensao,
    //  "URL" => "NOME ARQUIVO"
);

// foreach ($regioes as $key => $regiao) {
//     $regiao['regiao'] = mb_strtolower(str_replace(" ", "-", $regiao['regiao']), 'UTF-8');

//     $rotas["redes-de-protecao-{$regiao['regiao']}"] = "{$prefixo}regioes/protecao-" . substr(str_replace("zona-", "", $regiao['regiao']), 3) . ".php";
//     $rotas["cerca-de-piscina-{$regiao['regiao']}"] = "{$prefixo}piscina/regioes/piscina-" . substr(str_replace("zona-", "", $regiao['regiao']), 3) . ".php";

//     if (substr(str_replace("zona-", "", $regiao['regiao']), 3) == 'são-paulo') {
//         $rotas_sp["redes-de-protecao-{$regiao['regiao']}"] = $rotas["redes-de-protecao-{$regiao['regiao']}"];
//         $rotas_sp["cerca-de-piscina-{$regiao['regiao']}"] = $rotas["cerca-de-piscina-{$regiao['regiao']}"];
//     }

//     foreach ($regiao['cidades'] as $key => $cidade) {
//         foreach ($chars_especiais as $codigo => $char) {
//             $cidade['nome'] = str_replace($codigo, $char, $cidade['nome']);
//         }

//         $cidade['nome'] = mb_strtolower(str_replace(" ", "-", $cidade['nome']), 'UTF-8');
//         $rotas["redes-de-protecao-{$cidade['nome']}"] = $rotas["redes-de-protecao-{$regiao['regiao']}"];
//         $rotas["cerca-de-piscina-{$cidade['nome']}"] = $rotas["cerca-de-piscina-{$regiao['regiao']}"];

//         if (substr(str_replace("zona-", "", $regiao['regiao']), 3) == 'são-paulo') {
//             $rotas_sp["redes-de-protecao-{$cidade['nome']}"] = $rotas["redes-de-protecao-{$regiao['regiao']}"];
//             $rotas_sp["cerca-de-piscina-{$cidade['nome']}"] = $rotas["cerca-de-piscina-{$regiao['regiao']}"];
//         }
//     }
// }

// if (is_array($links)) {
//     foreach ($links as $idx => $link) {
//         $link['link'] = mb_strtolower(str_replace(" ", "-", $link['link']), 'UTF-8');
        
//         foreach ($chars_especiais as $codigo => $char) {
//             $link['link'] = str_replace($codigo, $char, $link['link']);
//         }

//         $rotas["{$link['link']}"] = "{$prefixo}conteudos/tela-conteudos.php";
//     }
// }

$pagina_links_page = 'tela-manual';

if (!empty($link_page)) {
    foreach ($link_page as $idx => $link) {
        $link['url'] = mb_strtolower(str_replace(" ", "-", $link['url']), 'UTF-8');
        
        foreach ($chars_especiais as $codigo => $char) {
            $link['titulo'] = str_replace($codigo, $char, $link['titulo']);
        }

        $rotas["{$link['url']}"] = "{$prefixo}".mb_strtolower(str_replace(" ", "-", $link['titulo']), 'UTF-8').".php";
    }
}

// echo '<pre>'; 
// var_dump($rotas);
// exit;

// $listagem->siteMap($rotas_sp);

$qtd_param_url = 0;
$link = '';

$page = $nao_encontrado = 'index' . $extensao;

if (isset($_GET['url'])) {
    $url            = $_GET['url'];
    $url_dividida   = explode('/', $_GET['url']);
    $qtd_param_url = count($url_dividida);
    $link = $url_dividida[0];

    if ($qtd_param_url == 1 && array_key_exists($url_dividida[0], $rotas) && !is_array($rotas[$url_dividida[0]])) {
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
if ($page != "index.html" &&
        (mb_strpos($page, "regioes/") === false &&
        mb_strpos($page, "conteudos/") === false &&
        mb_strpos($page, "piscina/") === false)
    ) {
        $url_completa = $_SERVER["REQUEST_URI"];
        $url_particionada = explode('/', $url_completa);
        
        $url_link = $url_particionada[count($url_particionada) - 1];

        $dados_link = $listagem->consultarLinkPage($url);
    } else if ($page != "index.html") {
        $url_completa = $_SERVER["REQUEST_URI"];
        $url_particionada = explode('/', $url_completa);

        $titulo = explode('-', end($url_particionada));

        $texto = ($titulo[0] == "cerca") ? "Cerca de Piscina" : "Redes de Proteção"; 

        $local = "";

        for ($i = 0; $i < count($titulo); $i++) {
            $local .= $titulo[$i] . " ";
        }
        
        $replace = ($titulo[0] == "cerca") ? "cerca de piscina" : "redes de protecao";

        $local_pesquisa = str_replace($replace, "", $local);

        if ( is_array($pesquisa = $listagem->links($local)) )
            $local = $pesquisa[0]['link'];
        else if ( is_array($pesquisa = $listagem->nomeCidade($local_pesquisa) ))
            $local = $pesquisa[0]['nome'];
        else 
            $local = $local_pesquisa;
        
        $canonical = $url_completa;
        $title = "{$texto} em " . ucwords($local) . " | Mel {$texto}";
        $titleConteudo = ucwords($local) . " | Mel {$texto}";
        $h1 = "{$texto} em <span class='text-capitalize'>" . ucwords($local). "</span>";

        $descricao = "Buscando {$texto} em ${local} com qualidade e preço justo entre em contato agora ligue para (11) 2682-3893. Rede de Proteção em ${local}.";
        $descricaoConteudo = "Buscando ${local} com qualidade e preço justo entre em contato agora ligue para (11) 2682-3893. ${local} Mel Proteções.";
        $keywords = "{$texto} em ${local}, rede de proteção em ${local}, tela de proteção em ${local}, telas de proteção em ${local}, Redes de Proteção para janelas em ${local}, rede de proteção em ${local} para apartamento, tela de proteção em ${local} para gatos, telas de proteção em ${local} para quadra, Redes de Proteção em ${local} para sacada, rede de proteção em ${local} para piscinas, tela de proteção em ${local} escadas, telas de proteção em ${local} para mezaninos.";
    } else {
        if ($qtd_param_url > 1) {
            $dir = "";

            for ($i=1; $i < $qtd_param_url; $i++) { 
                $dir .= "../";
            }

            header("Location: {$dir}{$link}");
        }
    }
}

require $page;