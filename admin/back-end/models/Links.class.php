<?php
    require_once "../database/Conexao.class.php";

    class Links {

        public const SEM_REGISTROS = "Nenhum Resultado";
        public const TABELA = "links";

        /*======================================================================================*/

        public function listagem() {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT * FROM " .self::TABELA. " ";

                $consulta = $connection->prepare($sql);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $regioes = $consulta->fetchAll($connection::FETCH_ASSOC);
                    $dados = $regioes;
                } else $dados = self::SEM_REGISTROS;

                return $dados;

            } catch (PDOException $e) {
                return "Erro de listar links: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function consultar($id) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT * FROM " .self::TABELA. "  WHERE id = :id LIMIT 1";

                $consulta = $connection->prepare($sql);

                $consulta->bindParam(":id", $id);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $regioes = $consulta->fetchAll($connection::FETCH_ASSOC);
                    $dados = $regioes;
                } else $dados = self::SEM_REGISTROS;

                return $dados;

            } catch (PDOException $e) {
                return "Erro de consultar link: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function cadastrar($link, $texto, $img) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "INSERT INTO " .self::TABELA. "  VALUES (null, :link, :texto, :img)";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":link", $link);
                $consulta->bindValue(":texto", $texto);
                $consulta->bindValue(":img", $img);

                $consulta->execute();

                $vl = $consulta->rowCount();
                
                return ($vl > 0) ? ["Registro Inserido com Sucesso!"] : self::SEM_REGISTROS;

            } catch (PDOException $e) {
                return "Erro de consultar link: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function editar($id, $link, $texto, $img) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "UPDATE " .self::TABELA. "  
                        SET link = :link, texto = :texto, nome_img = :img
                        WHERE id = :id";

                $consulta = $connection->prepare($sql);

                $consulta->bindParam(":id", $id);
                $consulta->bindValue(":link", $link);
                $consulta->bindValue(":texto", $texto);
                $consulta->bindValue(":img", $img);

                $consulta->execute();

                $vl = $consulta->rowCount();
                
                return ($vl > 0) ? ["Registro Atualizado com Sucesso!"] : self::SEM_REGISTROS;

            } catch (PDOException $e) {
                return "Erro de editar link: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function deletar($id) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "DELETE FROM " .self::TABELA. "  WHERE id = :id";

                $consulta = $connection->prepare($sql);

                $consulta->bindParam(":id", $id);

                $consulta->execute();

                $vl = $consulta->rowCount();

                return ($vl > 0) ? ["Registro Deletado com Sucesso!"] : self::SEM_REGISTROS;

            } catch (PDOException $e) {
                return "Erro de deletar link: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/ 
    }