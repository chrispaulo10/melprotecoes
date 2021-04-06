<?php
    
    require_once '../models/Links.class.php'; 

    $links = new Links();

    $retorno = "";

    if (isset($_GET['listagem'])) $retorno = $links->listagem();

    if (isset($_GET['consultar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $links->consultar($id);
    }

    if (isset($_GET['deletar'])) {
        $id = $_GET['id'] ?? "";

        $retorno = (empty($id)) ? "Id é obrigatório" : $links->deletar($id);
    }

    if (isset($_POST['cadastrar'])) {
        $link = $_POST['link'] ?? "";
        $texto = $_POST['texto'] ?? "";
        $img = $_POST['img'] ?? "";

        $retorno = "Preencha todos os campos!";

        if ( !(empty($link) || empty($texto)) ) $retorno = $links->cadastrar($link, $texto, $img);
    }

    if (isset($_POST['editar'])) {
        $id = $_POST['id'] ?? "";
        $link = $_POST['link'] ?? "";
        $texto = $_POST['texto'] ?? "";
        $img = $_POST['img'] ?? "";

        $retorno = "Preencha todos os campos!";

        if ( !(empty($link) || empty($texto)) ) $retorno = $links->editar($id, $link, $texto, $img);
    }

    /*===============================================================================================*/
    if (isset($_FILES['img'])) {
        $arquivo = $_FILES["img"]; 
    
        if (!empty($arquivo)) {
            $config = array();
    
            $tamanho = 3 * 1024 * 1024; 
    
            if ($arquivo["size"] > $tamanho) {
                $retorno = "A imagem deve ser de no máximo " . $tamanho/1024 . " mb!";
            } else {
                list($largura, $altura) = getimagesize($arquivo['tmp_name']);
    
                $extensao = explode(".", $arquivo['name']);
                $arquivo_extensao = strtolower(end($extensao));
    
                $lista_extensoes = array('jpeg', 'jpg', 'png');
                $lista_tipos = array('image/jpeg', 'image/jpg', 'image/png');
    
                if (in_array($arquivo_extensao, $lista_extensoes) || in_array($arquivo['type'], $lista_tipos) 
                    || $largura != '' || $altura != '') 
                {
                    $novo_nome = md5(time() . uniqid());
    
                    $nome_completo = $novo_nome . '.' . $arquivo_extensao;
    
                    if (move_uploaded_file($arquivo['tmp_name'], '../../img/links/' . $nome_completo)) {
                        $retorno = [$nome_completo];
                    } else {
                        $retorno = "Não foi possível realizar o upload da imagem!";
                    }
                } else {
                    $retorno = "Arquivo Inválido!";
                }
            }
            
        } else {
            $retorno = "Não foi possível encontrar a imagem!";
        }
    }

    if (isset($_GET['apagar_img'])) {
        if (!unlink('../../img/links/' . $_GET['img'])) $retorno = "erro";
    }
    
    echo json_encode($retorno);