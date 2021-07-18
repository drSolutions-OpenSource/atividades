<?php
/**
 * Configurações do sistema
 *
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */

/* Arquivo com o banco de dados SQLite3 */
define("BANCO_DE_DADOS", "db/atividades.db");

/* Página de log out para encerrar a autenticação do Apache */
define("URL_LOGOUT", "http://log:out@localhost/atividades/index.php");
// define("URL_LOGOUT", "https://log:out@www.drsolutions.com.br/atividades/");
?>