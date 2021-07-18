<?php
/**
 * Página Inicial - Exibe a lista de atividades
 *
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */
require_once("config.php");
require_once("classes/atividade.php");
require_once("classes/categoria.php");
$atividades = new atividade(BANCO_DE_DADOS);
$categorias = new categoria(BANCO_DE_DADOS);

/* Concluir ou excluir uma atividade */
if (isset($_GET["concluido"]) && isset($_GET["id"])) {
    $atividades->concluir_atividade(intval($_GET["id"]));
}
if (isset($_GET["excluir"]) && isset($_GET["id"])) {
    $atividades->excluir_atividade(intval($_GET["id"]));
}

/* Carregar os arquivos HTML */
$base = file_get_contents("html/base.html");
$centro = file_get_contents("html/centro_home.html");
$linha_simples = file_get_contents("html/centro_home_linha.html");
$linha_simples_completa = file_get_contents("html/centro_home_linha_completa.html");
$linha_categoria = file_get_contents("html/lateral_linha_categoria.html");

/* Buscar as atividades que serão exibidas */
$titulo_centro = "Todas as atividades";
$atividades_db = $atividades->buscar_atividades(0, 0);
if (isset($_GET["hoje"])) {
    $titulo_centro = "Atividades de hoje";
    $atividades_db = $atividades->buscar_atividades(1, 0);
} 
elseif (isset($_GET["breve"])) {
    $titulo_centro = "Atividades em breve";
    $atividades_db = $atividades->buscar_atividades(2, 0);
}

/* Buscar as atividades que serão exibidas, separando por categoria */
$categoria_centro = "";
if (isset($_GET["categoria"])) {
    $categoria_centro = " - " . $categorias->buscar_categoria(intval($_GET["categoria"]))[1];
    $atividades_db = $atividades->buscar_atividades(0, intval($_GET["categoria"]));
}

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

/* Transformar as atividades em um conteúdo HTML */
if (count($atividades_db)) {
    $linhas = "";
    foreach ($atividades_db as $atividade_linha) {
        if (strlen($atividade_linha[4]) > 0) {
            $linha = $linha_simples_completa;
            $linha = str_replace("#@DESCRICAO@#", $atividade_linha[4], $linha);
        } else {
            $linha = $linha_simples;
        }
        $linha = str_replace("#@ID@#", $atividade_linha[0], $linha);
        $linha = str_replace("#@COR@#", $atividade_linha[1], $linha);
        $linha = str_replace("#@TITULO@#", $atividade_linha[2], $linha);
        $linha = str_replace("#@DATA@#", $atividade_linha[3], $linha);
        $linhas .= $linha;
    }
} 
else {
    $linhas = "<br/>Nenhuma atividade cadastrada!";
}

/* Exibir a página */
$conteudo = str_replace("#@CENTRO@#", $centro, $base);
$conteudo = str_replace("#@TITULO_CENTRO@#", $titulo_centro, $conteudo);
$conteudo = str_replace("#@CATEGORIA@#", $categoria_centro, $conteudo);
$conteudo = str_replace("#@LINHAS@#", $linhas, $conteudo);
$conteudo = str_replace("#@CATERORIAS@#", $linhas_categorias, $conteudo);
echo $conteudo;
?>