<?php
    require_once "../database/Conexao.class.php";

    class Categorias {

        public const SEM_REGISTROS = "NENHUM RESULTADO";
        public const TABELA = "categoria_link";

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

        public function cadastrar($titulo) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "INSERT INTO " .self::TABELA. "  VALUES (null, :titulo)";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":titulo", $titulo);

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

        public function editar($id, $titulo) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "UPDATE " .self::TABELA. "  
                        SET titulo = :titulo
                        WHERE id = :id";

                $consulta = $connection->prepare($sql);

                $consulta->bindParam(":id", $id);
                $consulta->bindValue(":titulo", $titulo);

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