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

        public function consultarTextos($id) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT textos_link_page.* FROM " .self::TABELA. " 
                        INNER JOIN textos_link_page ON id_link_page_fk = " .self::TABELA. ".id
                        WHERE link_page.id = :id 
                        ORDER BY posicao
                        LIMIT 8";

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

        public function editarTextos($id, $textos) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "";

                for ($i=1; $i <= 8; $i++) { 
                    $sql .= "UPDATE textos_link_page 
                            SET titulo = :titulo$i, texto = :texto$i
                            WHERE id_link_page_fk = :id AND posicao = $i;
                    ";
                }

                $consulta = $connection->prepare($sql);
                
                $consulta->bindParam(":id", $id);
                
                for ($i=1; $i <= 8; $i++) { 
                    $consulta->bindValue(":titulo$i", $textos["titulo$i"]);
                    $consulta->bindValue(":texto$i", $textos["texto$i"]);
                }
                $consulta->execute();

                $vl = $consulta->rowCount();
                
                return ($vl > 0) ? ["Registro Atualizado com Sucesso!"] : $sql;
            } catch (PDOException $e) {
                return "Erro de editar textos: " . $e->getMessage();
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