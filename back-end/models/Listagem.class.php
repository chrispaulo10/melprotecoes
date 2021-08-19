<?php
    require_once "../database/Conexao.class.php";

    class Listagem {

        public const SEM_REGISTROS = "NENHUM REGISTRO ENCONTRADO";

        /*======================================================================================*/

        public function regioes($estados = true, $cidades = true) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT * FROM `regioes`";

                $sql .= " ORDER BY id";

                $consulta = $connection->prepare($sql);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $regioes = $consulta->fetchAll($connection::FETCH_ASSOC);

                    if ($estados) {
                        $estados = $this->estados($cidades);

                        foreach ($regioes as $indice => $regiao) {
                            $regiao['estados'] = [];

                            foreach ($estados as $indice => $estado) {
                                if ($estado['id_regiao_fk'] == $regiao['id']) {
                                    array_push($regiao['estados'], $estado);
                                }
                            }

                            array_push($dados, $regiao);
                        }
                    } else if ($cidades) {
                        $cidades = $this->cidades(false, $cidades);

                        foreach ($regioes as $indice => $regiao) {
                            $regiao['cidades'] = [];

                            foreach ($cidades as $indice => $cidade) {
                                if ($cidade['id_regiao_fk'] == $regiao['id']) {
                                    array_push($regiao['cidades'], $cidade);
                                }
                            }

                            array_push($dados, $regiao);
                        }
                    }
                    else $dados = $regioes;
                } else $dados = self::SEM_REGISTROS;

                return $dados;

            } catch (PDOException $e) {
                return "Erro de listar aluno: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function estados($all = true, $id_regiao = 0) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT * FROM `estados`";
                ($id_regiao > 0) && $sql .= "WHERE id_regiao_fk = :id_regiao";

                $sql .= " ORDER BY estados.nome";

                $consulta = $connection->prepare($sql);
                ($id_regiao > 0) && $consulta->bindParam("id_regiao", $id_regiao);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $estados = $consulta->fetchAll($connection::FETCH_ASSOC);

                    if ($all) {
                        foreach ($estados as $indice => $estado) {
                            $cidades = $this->cidades($estado['id']);
    
                            $estado['cidades'] = [];

                            foreach ($cidades as $indice => $cidade) {
                                if ($cidade['id_estado_fk'] == $estado['id']) {
                                    array_push($estado['cidades'], $cidade);
                                }
                            }

                            array_push($dados, $estado);
                        }
                    } else $dados = $estados;
                } else $dados = self::SEM_REGISTROS;

                return $dados;

            } catch (PDOException $e) {
                return "Erro de listar aluno: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function cidades($id_estado = 0, $regiao = false) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $colunas = '*';

                ($id_estado == 0 && $regiao) && $colunas = "id_regiao_fk, cidades.nome";

                $sql = "SELECT $colunas FROM `cidades`";

                if ($id_estado > 0) {
                    $sql .= " WHERE id_estado_fk = :id_estado";
                } else if ($regiao) {
                    $sql .= " INNER JOIN estados ON estados.id = id_estado_fk	
                            INNER JOIN regioes ON regioes.id = id_regiao_fk
                    ";
                }

                $sql .= " ORDER BY cidades.nome";

                $consulta = $connection->prepare($sql);

                if ($id_estado > 0) {
                    ($id_estado > 0) && $consulta->bindParam("id_estado", $id_estado);
                }

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = NULL;

                if ($vl > 0) {
                    $dados = $consulta->fetchAll($connection::FETCH_ASSOC);
                } else {
                    $dados = self::SEM_REGISTROS;
                }

                return $dados;

            } catch (PDOException $e) {
                return "Erro de listar aluno: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function links() {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT link FROM links";

                $consulta = $connection->prepare($sql);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $dados = $consulta->fetchAll($connection::FETCH_ASSOC);
                } else $dados = self::SEM_REGISTROS;

                return $dados;

            } catch (PDOException $e) {
                return "Erro de consultar link: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function nomeCidade($cidade) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT nome FROM cidades WHERE nome = :cidade LIMIT 1";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":cidade", $cidade);
                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $dados = $consulta->fetchAll($connection::FETCH_ASSOC);
                } else $dados = self::SEM_REGISTROS;

                return $dados;

            } catch (PDOException $e) {
                return "Erro de consultar link: " . $e->getMessage();
            } catch (Exception $e) {
                return "Erro: " . $e->getMessage();
            }
        }

        /*======================================================================================*/

        public function pegarDadosLink($link) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT * FROM links WHERE link = :link LIMIT 1";

                $consulta = $connection->prepare($sql);

                $consulta->bindValue(":link", $link);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $regioes = $consulta->fetch($connection::FETCH_ASSOC);
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

        public function pegarLinksPageNav() {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT
                            link_page.id, url, title, titulo
                        FROM link_page
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
    }