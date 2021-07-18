<?php
/**
 * Página Categorias - Incluir, aleterar ou excluir uma categoria
 *
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */
require_once("config.php");
require_once("classes/categoria.php");
$categorias = new categoria(BANCO_DE_DADOS);

/* Excluir uma categoria */
if (isset($_GET["excluir"]) && isset($_GET["id"])) {
    $categorias->excluir_categoria(intval($_GET["id"]));
}

/* Carregar os arquivos HTML */
$base = file_get_contents("html/base.html");
$centro = file_get_contents("html/centro_categorias.html");
$linha_simples = file_get_contents("html/centro_categorias_linha.html");
$linha_categoria = file_get_contents("html/lateral_linha_categoria.html");

/* Buscar as atividades que serão exibidas */
$categorias_centro = $categorias->buscar_categorias();

/* Buscar as categorias e transformá-las em um conetúdo HTML */
$categorias_db = $categorias->buscar_categorias();
if (count($categorias_db)) {
    $linhas_categorias = "";
    foreach ($categorias_db as $categoria_linha) {
        $linha = $linha_categoria;
        $linha = str_replace("#@ID_CATEGORIA@#", $categoria_linha[0], $linha);
        $linha = str_replace("#@NOME_CATEGORIA@#", $categoria_linha[1], $linha);
        $linha = str_replace("#@COR_CATEGORIA@#", $categoria_linha[2], $linha);
        $linhas_categorias .= $linha;
    }
}
else {
    $linhas_categorias = "";
}

/* Transformar a lista de categorias em um conteúdo HTML */
if (count($categorias_centro)) {
    $linhas = "";
    foreach ($categorias_centro as $linha_db) {
        $linha = $linha_simples;
        $linha = str_replace("#@ID@#", $linha_db[0], $linha);
        $linha = str_replace("#@NOME@#", $linha_db[1], $linha);
        $linhas .= $linha;
    }
} 
else {
    $linhas = "<br/>Nenhuma categoria cadastrada!";
}

/* Exibir a página */
$conteudo = str_replace("#@CENTRO@#", $centro, $base);
$conteudo = str_replace("#@LINHAS@#", $linhas, $conteudo);
$conteudo = str_replace("#@CATERORIAS@#", $linhas_categorias, $conteudo);
echo $conteudo;
?>