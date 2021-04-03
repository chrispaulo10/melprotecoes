<?php
    
    require_once '../models/Links.class.php'; 

    $link = new Links();

    $retorno = "";

    if (isset($_GET['listagem'])) $retorno = $link->listagem();

    if (isset($_GET['consultar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $link->consultar($id);
    }

    if (isset($_GET['deletar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $link->deletar($id);
    }

    if (isset($_POST['cadastrar'])) {
        $link = $_GET['link'] ?? "";
        $texto = $_GET['texto'] ?? "";
        $img = $_GET['img'] ?? "";

        $retorno = "Preencha todos os campos!";

        if ( !(empty($link) || empty($texto) || empty($img)) ) $retorno = $link->cadastrar($link, $texto, $img);
    }

    if (isset($_POST['editar'])) {
        $id = $_GET['id'] ?? "";
        $link = $_GET['link'] ?? "";
        $texto = $_GET['texto'] ?? "";
        $img = $_GET['img'] ?? "";

        $retorno = "Preencha todos os campos!";

        if ( !(empty($link) || empty($texto) || empty($img)) ) $retorno = $link->editar($id, $link, $texto, $img);
    }

    echo json_encode($retorno);