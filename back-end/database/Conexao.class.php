<?php

    class Conexao {

        function conectar(){

            // NOME BD : u402480197_melprotecoes
            // USER : u402480197_melredes
            // SENHA : K#f:S>F9o

            $host= "mysql:host=localhost;dbname=melprotecoes";
            $user= "root";
            $pass= "";

            try {
                $pdo= new PDO($host, $user, $pass);
                return $pdo;
            } catch (PDOException $e) {
                echo "Erro de login: " . $e->getMessage();
            } catch (Exception $e) {
                echo "Erro: " . $e->getMessage();
            }

        }
    }
?>