<?php
    require_once "../database/Conexao.class.php";

    class LinkPage {

        public const SEM_REGISTROS = "NENHUM RESULTADO";
        public const TABELA = "link_page";

        /*======================================================================================*/

        public function listagem() {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT
                            " .self::TABELA. ".id, id_categoria_fk, h1, url, title, description, og_title, site_name, keywords, titulo
                        FROM " .self::TABELA. "
                        INNER JOIN categoria_link ON id_categoria_fk = categoria_link.id
                        ";

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

        public function cadastrar($id_categoria, $h1, $url, $title, $description, $og_title, $site_name, $keywords) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "INSERT INTO " .self::TABELA. " 
                        VALUES (null, :id_categoria, :h1, :url, :title, :description, :og_title, :site_name, :keywords)";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":id_categoria", $id_categoria);
                $consulta->bindValue(":h1", $h1);
                $consulta->bindValue(":url", $url);
                $consulta->bindValue(":title", $title);
                $consulta->bindValue(":description", $description);
                $consulta->bindValue(":og_title", $og_title);
                $consulta->bindValue(":site_name", $site_name);
                $consulta->bindValue(":keywords", $keywords);
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

        public function editar($id, $id_categoria, $h1, $url, $title, $description, $og_title, $site_name, $keywords) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "UPDATE " .self::TABELA. "  
                        SET id_categoria_fk = :id_categoria, h1 = :h1, url = :url, title = :title, 
                            description = :description, og_title = :og_title, site_name = :site_name, keywords = :keywords
                        WHERE id = :id";

                $consulta = $connection->prepare($sql);

                $consulta->bindParam(":id", $id);
                $consulta->bindValue(":id_categoria", $id_categoria);
                $consulta->bindValue(":h1", $h1);
                $consulta->bindValue(":url", $url);
                $consulta->bindValue(":title", $title);
                $consulta->bindValue(":description", $description);
                $consulta->bindValue(":og_title", $og_title);
                $consulta->bindValue(":site_name", $site_name);
                $consulta->bindValue(":keywords", $keywords);

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