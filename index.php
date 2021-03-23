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
        "redes-de-protecao-na-móoca" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-patriarca" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-na-penha" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-são-mateus" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-são-miguel" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-em-sapopemba" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-no-tatuapé" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-no-vila-ema" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-no-vila-formosa" => $prefixo."protecao-zona-leste",
        "redes-de-protecao-no-vila-prudente" => $prefixo."protecao-zona-leste",

        // CIDADES DA ZONA OESTE
        "redes-de-protecao-na-zona-oeste" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-barra-funda" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-em-Bonfiglioli" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-butantã" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-cidade-jardim" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-jaguaré" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-jardim-américa" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-jardim-dracena" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-jardim-europa" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-jardim-paulista" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-no-jardim-paulistano" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-nos-jardins" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-lapa" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-em-perdizes" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-em-pinheiros" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-em-pompéia" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-em-raposo-tavares" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-em-rio-pequeno" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-vila-leopoldina" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-vila-madalena" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-vila-são=francisco" => $prefixo."protecao-zona-oeste",
        "redes-de-protecao-na-vila-sônia" => $prefixo."protecao-zona-oeste",

        // CIDADES DA ZONA SUL
        "redes-de-protecao-na-zona-sul" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-brooklin" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-campo-belo" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-campo-limpo" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-na-cidade-dutra" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-na-funchal" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-em-interlagos" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-ipiranga" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-itaim-bibi" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-jabaquara" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-jardim-são-luís" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-largo-13-de-maio" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-em-moema" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-morumbi" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-em-paraisópolis" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-em-parelheiros" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-em-sacomã" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-em-santo-amaro" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-na-saúde" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-no-socorro" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-na-vila-mariana" => $prefixo."protecao-zona-sul",
        "redes-de-protecao-na-vila-olímpia" => $prefixo."protecao-zona-sul",

        // CIDADES DA ZONA NORTE
        "redes-de-protecao-na-zona-norte" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-na-brasilândia" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-casa-verde" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-freguesia-do-ó" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-jaçanã" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-no-limão" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-mandaqui" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-pirituba" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-santana" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-em-tremembé" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-no-tucuruvi" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-na-vila-guilherme" => $prefixo."protecao-zona-norte",
        "redes-de-protecao-na-vila-maria" => $prefixo."protecao-zona-norte",

        // CIDADES DO CENTRO SP
        "redes-de-protecao-no-centro-sp" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-em-aclimação" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-no-anhangabaú" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-em-bela-vista" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-no-bom-retiro" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-no-brás" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-no-cambuci" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-na-consolação" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-em-higienópolis" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-na-liberdade" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-no-pacaembu" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-em-pari" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-na-paulista" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-na-república" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-em-santa-cecília" => $prefixo."protecao-centro-sp",
        "redes-de-protecao-em-santa-efigênia" => $prefixo."protecao-centro-sp",
        
        // CIDADES DO ABCD
        "redes-de-protecao-em-abcd" => $prefixo."protecao-abcd",
        "redes-de-protecao-no-abcd" => $prefixo."protecao-abcd",
        "redes-de-protecao-em-santo-andré" => $prefixo."protecao-abcd",
        "redes-de-protecao-em-são-bernardo" => $prefixo."protecao-abcd",
        "redes-de-protecao-em-são-caetano" => $prefixo."protecao-abcd",
        "redes-de-protecao-em-diadema" => $prefixo."protecao-abcd",

        // CIDADES DE GUARULHOS
        "redes-de-protecao-em-guarulhos" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-aeroporto" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-água-azul" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-água-chata" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-aracília" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-bananal" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-bela-vista" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-bom-clima" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-bonsucesso" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-cabuçu" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-cabuçu-de-cima" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-cecap" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-capelinha" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-centro" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-cocaia" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-cumbica" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-fátima" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-fortaleza" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-gopouva" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-invernada" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-itaim" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-itapegica" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-lavras" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-macedo" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-maia" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-mato-das-cobras" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-monte-carmelo" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-morro-grande" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-morros" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-paraventi" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-pincaço" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-pimentas" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-ponta-grande" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-porto-da-igreja" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-presidente-dutra" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-sadokim" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-são-joão" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-são-roque" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-no-taboão" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-tanque-grande" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-torres-tobagy" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-tranquilidade" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-em-várzea-do-palácio" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-vila-augusta" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-vila-barros" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-vila-galvão" => $prefixo."protecao-guarulhos",
        "redes-de-protecao-na-vila-rio" => $prefixo."protecao-guarulhos",

        // CIDADES DO INTERIOR
        "redes-de-protecao-em-alphaville" => $prefixo."protecao-interior",
        "redes-de-protecao-em-arujá" => $prefixo."protecao-interior",
        "redes-de-protecao-em-atibaia" => $prefixo."protecao-interior",
        "redes-de-protecao-em-barueri" => $prefixo."protecao-interior",
        "redes-de-protecao-em-caieiras" => $prefixo."protecao-interior",
        "redes-de-protecao-em-carapicuiba" => $prefixo."protecao-interior",
        "redes-de-protecao-em-cotia" => $prefixo."protecao-interior",
        "redes-de-protecao-em-embu-das-artes" => $prefixo."protecao-interior",
        "redes-de-protecao-em-ferraz-de-vasconcelos" => $prefixo."protecao-interior",
        "redes-de-protecao-em-francisco-morato" => $prefixo."protecao-interior",
        "redes-de-protecao-em-franco-da-rocha" => $prefixo."protecao-interior",
        "redes-de-protecao-em-granja-viana" => $prefixo."protecao-interior",
        "redes-de-protecao-em-itapecerica-da-serra" => $prefixo."protecao-interior",
        "redes-de-protecao-em-itapevi" => $prefixo."protecao-interior",
        "redes-de-protecao-em-itaquaquecetuba" => $prefixo."protecao-interior",
        "redes-de-protecao-em-jacareí" => $prefixo."protecao-interior",
        "redes-de-protecao-em-jandira" => $prefixo."protecao-interior",
        "redes-de-protecao-em-mairiporã" => $prefixo."protecao-interior",
        "redes-de-protecao-em-mogí-das-cruzes" => $prefixo."protecao-interior",
        "redes-de-protecao-em-nazaré-paulista" => $prefixo."protecao-interior",
        "redes-de-protecao-em-osasco" => $prefixo."protecao-interior",
        "redes-de-protecao-em-poá" => $prefixo."protecao-interior",
        "redes-de-protecao-em-ribeirão-pires" => $prefixo."protecao-interior",
        "redes-de-protecao-em-rio-grande-da-serra" => $prefixo."protecao-interior",
        "redes-de-protecao-em-santa-bárbara-do-oeste" => $prefixo."protecao-interior",
        "redes-de-protecao-em-santana-do-parnaíba" => $prefixo."protecao-interior",
        "redes-de-protecao-em-são-josé-dos-campos" => $prefixo."protecao-interior",
        "redes-de-protecao-em-são-roque" => $prefixo."protecao-interior",
        "redes-de-protecao-em-suzano" => $prefixo."protecao-interior",
        "redes-de-protecao-em-taboão-da-serra" => $prefixo."protecao-interior",
        "redes-de-protecao-em-vargem-grande-paulista" => $prefixo."protecao-interior",
        
        // CIDADES NO LITORAL SP
        "redes-de-protecao-no-litoral-paulista" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-bertioga" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-caraguatatuba" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-cubatão" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-guarujá" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-ilha-bela" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-ilha-comprida" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-itanhaém" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-mongaguá" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-peruíbe" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-praia-grande" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-santos" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-são-sebastião" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-são-vicente" => $prefixo."protecao-litoral",
        "redes-de-protecao-em-ubatuba" => $prefixo."protecao-litoral",

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
