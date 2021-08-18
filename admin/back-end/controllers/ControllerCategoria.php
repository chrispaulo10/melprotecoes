<?php
    
    require_once '../models/Categorias.class.php'; 

    $categorias_link = new Categorias();

    $retorno = "";

    if (isset($_GET['listagem'])) $retorno = $categorias_link->listagem();

    if (isset($_GET['consultar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $categorias_link->consultar($id);
    }

    if (isset($_GET['deletar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $categorias_link->deletar($id);
    }

    if (isset($_POST['cadastrar'])) {
        $titulo = $_POST['titulo'] ?? "";
        $retorno = "Preencha todos os campos!";

        if ( !(empty($titulo)) ) $retorno = $categorias_link->cadastrar($titulo);
    }

    if (isset($_POST['editar'])) {
        $id = $_POST['id'] ?? "";
        $titulo = $_POST['titulo'] ?? "";
        $retorno = "Preencha todos os campos!";

        if ( !(empty($id)) || !(empty($titulo)) ) $retorno = $categorias_link->editar($id, $titulo);
    }

    
    echo json_encode($retorno);