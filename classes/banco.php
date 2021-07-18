<?php
/**
 * Classe que gerencia o banco de dados SQLite3
 *
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */

/**
 * Classe que gerencia o banco de dados SQLite3
 */
class banco {
    public $db;
    public $results;

    function __construct($banco_de_dados) {
        $this->conectar($banco_de_dados);
    }

    function conectar($banco_de_dados) {
        $this->db = new SQLite3($banco_de_dados);
    }

    function executar_query($query) {
        $this->results = $this->db->query($query);
        return $this->results;
    }

    function proxima_linha() {
        $linha_db = $this->results->fetchArray();
        return $linha_db;
    }
}
?>