<?php
/**
 * Classe que gerencia as Atividades
 *
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */
require_once("banco.php");

/**
 * Classe que gerencia as Atividades
 */
class atividade {
    public $banco;

    function __construct($banco_de_dados) {
        $this->banco = new banco($banco_de_dados);
        $this->banco->conectar($banco_de_dados);
    }

    /**
     * Buscar as atividades no banco de dados
     * @param   int $filtro
     * @param   int $categoria
     * @return  list Atividades
     */
    function buscar_atividades($filtro, $categoria) {
        $resultados = [];

        if ($categoria == 0) {
            if ($filtro == 1) {
                $this->banco->executar_query("SELECT * FROM atividades WHERE concluido = '0' AND data = '" . date('Y-m-d') . "' ORDER BY data ASC, titulo ASC");
            }
            elseif ($filtro == 2) {
                $hoje = date("Y-m-d");
                $futuro = date("Y-m-d", strtotime($hoje. " + 6 days"));
                $this->banco->executar_query("SELECT * FROM atividades WHERE concluido = '0' AND data >= '" . $hoje . "' AND data <= '" . $futuro . "' ORDER BY data ASC, titulo ASC");
            }
            else {
                $this->banco->executar_query("SELECT * FROM atividades WHERE concluido = '0' ORDER BY data ASC, titulo ASC");
            }
        }
        else {
            $this->banco->executar_query("SELECT * FROM atividades WHERE concluido = '0' AND categoria = '" . $categoria . "' ORDER BY data ASC, titulo ASC");
        }

        while ($linha_db = $this->banco->proxima_linha()) {
            $cor = "vermelha";
            if ($linha_db["categoria"] == 2) {
                $cor = "amarela";
            }
            elseif ($linha_db["categoria"] == 3) {
                $cor = "verde";
            }
            elseif ($linha_db["categoria"] == 4) {
                $cor = "azul";
            }

            $date = new DateTime($linha_db["data"]);
            $data = $date->format("d/m/Y");

            $linha = [$linha_db["id"], $cor, $linha_db["titulo"], $data, $linha_db["descricao"]];
            $resultados[] = $linha;
        }

        return $resultados;
    }

    /**
     * Buscar uma atividade no banco de dados
     * @param   int $id
     * @return  list Atividade
     */
    function buscar_atividade($id) {
        $resultado = [];
        $this->banco->executar_query("SELECT * FROM atividades WHERE id = '" . $id . "'");
        $linha_db = $this->banco->proxima_linha();
        $resultado = [$linha_db["id"], $linha_db["categoria"], $linha_db["titulo"], $linha_db["data"], $linha_db["descricao"]];

        return $resultado;
    }

    /**
     * Atualizar uma atividade no banco de dados
     * @param   int $id
     * @param   string  $titulo
     * @param   date    $data
     * @param   string  $descricao
     * @param   int $categoria
     */
    function atualizar_atividade($id, $titulo, $data, $descricao, $categoria) {
        $this->banco->executar_query("UPDATE atividades SET titulo = '" . $titulo . "', data = '" . $data . "', descricao = '" . $descricao . "', categoria = '" . $categoria . "' WHERE id = '" . $id . "'");
    }

    /**
     * Inserir uma atividade no banco de dados
     * @param   string  $titulo
     * @param   date    $data
     * @param   string  $descricao
     * @param   int $categoria
     */
    function inserir_atividade($titulo, $data, $descricao, $categoria) {
        $this->banco->executar_query("INSERT INTO atividades (titulo, data, descricao, categoria) VALUES ('" . $titulo . "', '" . $data . "', '" . $descricao . "', '" . $categoria . "')");
    }

    /**
     * Concluir uma atividade no banco de dados
     * @param   int $id
     */
    function concluir_atividade($id) {
        $this->banco->executar_query("UPDATE atividades SET concluido = '1' WHERE id = '" . $id . "'");
    }

    /**
     * Excluir uma atividade no banco de dados
     * @param   int $id
     */
    function excluir_atividade($id) {
        $this->banco->executar_query("DELETE FROM atividades WHERE id = '" . $id . "'");
    }
}
?>