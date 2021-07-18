<?php
/**
 * Realizar o log out do sistema
 *
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */
require_once("config.php");

header("Location: " . URL_LOGOUT);
exit();
?>