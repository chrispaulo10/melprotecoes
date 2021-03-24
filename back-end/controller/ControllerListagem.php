<?php
    
    require_once '../models/Listagem.class.php'; 

    $listagem = new Listagem();

    $retorno = "";

    if (isset($_GET['listar_cidades'])) $retorno = $listagem->cidades($_GET['id_estado'] ?? 0);
    else if (isset($_GET['listar_estados'])) $retorno = $listagem->estados(false, $_GET['id_regiao'] ?? 0);
    else if (isset($_GET['listar_estados_cidades'])) $retorno = $listagem->estados(true, $_GET['id_regiao'] ?? 0);
    else if (isset($_GET['listar_regioes'])) $retorno = $listagem->regioes(false);
    else if (isset($_GET['listar_regioes_estados'])) $retorno = $listagem->regioes(true, false);
    else $retorno = $listagem->regioes();

    echo json_encode($retorno);