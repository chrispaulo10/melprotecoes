<?php
    
    require_once '../models/LinkPage.class.php'; 

    $linkPage = new LinkPage();

    $retorno = "";

    if (isset($_GET['listagem'])) $retorno = $linkPage->listagem();

    if (isset($_GET['consultar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $linkPage->consultar($id);
    }

    if (isset($_GET['deletar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $linkPage->deletar($id);
    }

    if (isset($_POST['cadastrar'])) {
        $id_categoria = $_POST['id_categoria'] ?? "";
        $h1 = $_POST['h1'] ?? "";
        $url = $_POST['url'] ?? "";
        $title = $_POST['title'] ?? "";
        $description = $_POST['description'] ?? "";
        $og_title = $_POST['og_title'] ?? "";
        $site_name = $_POST['site_name'] ?? "";
        $keywords = $_POST['keywords'] ?? "";

        $retorno = "Preencha todos os campos!";

        if (
            !empty($h1) ||
            !empty($url) ||
            !empty($title) ||
            !empty($description) ||
            !empty($og_title) ||
            !empty($site_name) ||
            !empty($keywords)
        ) 
            $retorno = $linkPage->cadastrar($id_categoria, $h1, $url, $title, $description, $og_title, $site_name, $keywords);
    }

    if (isset($_POST['editar'])) {
        $id = $_POST['id'] ?? "";
        $id_categoria = $_POST['id_categoria'] ?? "";
        $h1 = $_POST['h1'] ?? "";
        $url = $_POST['url'] ?? "";
        $title = $_POST['title'] ?? "";
        $description = $_POST['description'] ?? "";
        $og_title = $_POST['og_title'] ?? "";
        $site_name = $_POST['site_name'] ?? "";
        $keywords = $_POST['keywords'] ?? "";

        $retorno = "Preencha todos os campos!";

        if ( 
            !empty($id) ||
            !empty($h1) ||
            !empty($url) ||
            !empty($title) ||
            !empty($description) ||
            !empty($og_title) ||
            !empty($site_name) ||
            !empty($keywords)
        )
            $retorno = $linkPage->editar($id, $id_categoria, $h1, $url, $title, $description, $og_title, $site_name, $keywords);
    }

    
    echo json_encode($retorno);