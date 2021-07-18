<?php
/**
 * Classe que gerencia as Cores
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
 * Classe que gerencia as Cores
 */
class cor {
    public $banco;

    function __construct($banco_de_dados) {
        $this->banco = new banco($banco_de_dados);
        $this->banco->conectar($banco_de_dados);
    }

    /**
     * Buscar as cores no banco de dados
     * @return  list Cores
     */
    function buscar_cores() {
        $resultados = [];

        $this->banco->executar_query("SELECT id,nome FROM cores ORDER BY nome");

        while ($linha_db = $this->banco->proxima_linha()) {
            $linha = [$linha_db["id"], $linha_db["nome"]];
            $resultados[] = $linha;
        }

        return $resultados;
    }
}
?>