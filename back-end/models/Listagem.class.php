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
                    } else $dados = $regioes;
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

                $consulta = $connection->prepare($sql);
                ($id_regiao > 0) && $consulta->bindParam("id_regiao", $id_regiao);

                $consulta->execute();

                $vl = $consulta->rowCount();

                $dados = [];

                if ($vl > 0) {
                    $estados = $consulta->fetchAll($connection::FETCH_ASSOC);

                    if ($all) {
                        $cidades = $this->cidades();

                        foreach ($estados as $indice => $estado) {
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

        public function cidades($id_estado = 0) {
            $conexao = new Conexao();
            $connection = $conexao->conectar();

            try {
                $sql = "SELECT * FROM `cidades`";
                ($id_estado > 0) && $sql .= "WHERE id_estado_fk = :id_estado";

                $consulta = $connection->prepare($sql);
                ($id_estado > 0) && $consulta->bindParam("id_estado", $id_estado);

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
    }