<?php
/**
 * Classe que gerencia as Categorias
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
 * Classe que gerencia as Categorias
 */
class categoria {
    public $banco;

    function __construct($banco_de_dados) {
        $this->banco = new banco($banco_de_dados);
        $this->banco->conectar($banco_de_dados);
    }

    /**
     * Buscar as categorias no banco de dados
     * @return  list Categorias
     */
    function buscar_categorias() {
        $resultados = [];

        $this->banco->executar_query("SELECT cat.id,cat.nome,LOWER(cor.nome) AS nomecor FROM categorias AS cat LEFT JOIN cores AS cor ON cat.cor = cor.id ORDER BY cat.nome");

        while ($linha_db = $this->banco->proxima_linha()) {
            $linha = [$linha_db["id"], $linha_db["nome"], $linha_db["nomecor"]];
            $resultados[] = $linha;
        }

        return $resultados;
    }

    /**
     * Buscar uma categoria no banco de dados
     * @param   int $id
     * @return  list Categoria
     */
    function buscar_categoria($id) {
        $resultado = [];
        $this->banco->executar_query("SELECT cat.id,cat.nome,cor.nome AS nomecor,cor.id AS idcor FROM categorias AS cat LEFT JOIN cores AS cor ON cat.cor = cor.id WHERE cat.id='" . $id . "'");
        $linha_db = $this->banco->proxima_linha();
        $resultado = [$linha_db["id"], $linha_db["nome"], $linha_db["nomecor"], $linha_db["idcor"]];

        return $resultado;
    }

    /**
     * Atualizar uma categoria no banco de dados
     * @param   int $id
     * @param   string  $nome
     * @param   int $cor
     */
    function atualizar_categoria($id, $nome, $cor) {
        $this->banco->executar_query("UPDATE categorias SET nome = '" . $nome . "', cor = '" . $cor . "' WHERE id = '" . $id . "'");
    }

    /**
     * Inserir uma categoria no banco de dados
     * @param   string  $nome
     * @param   int $cor
     */
    function inserir_categoria($nome, $cor) {
        $this->banco->executar_query("INSERT INTO categorias (nome, cor) VALUES ('" . $nome . "', '" . $cor . "')");
    }

    /**
     * Excluir uma categoria e todas suas atividades no banco de dados
     * @param   int $id
     */
    function excluir_categoria($id) {
        $this->banco->executar_query("DELETE FROM atividades WHERE categoria = '" . $id . "'");
        $this->banco->executar_query("DELETE FROM categorias WHERE id = '" . $id . "'");
    }
}
?>