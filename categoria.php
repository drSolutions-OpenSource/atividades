<?php
/**
 * Página de Categoria - Incluir ou alterar uma categoria
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
require_once("classes/cor.php");
$categorias = new categoria(BANCO_DE_DADOS);
$categorias_buscar = new categoria(BANCO_DE_DADOS);
$cores = new cor(BANCO_DE_DADOS);

/* Inserir ou alterar a categoria no banco de dados */
if (isset($_POST["fid"])) {
    $id = $_POST["fid"];
    $nome = $_POST["fnome"];
    $cor = $_POST["fcor"];

    if (strlen($id)) {
        $categorias->atualizar_categoria($id, $nome, $cor);
    }
    else {
        $categorias->inserir_categoria($nome, $cor);
    }
    header("Location: categorias.php");
    exit();
}

/* Carregar os arquivos HTML */
$base = file_get_contents("html/base.html");
$centro = file_get_contents("html/centro_categoria.html");
$linha_categoria = file_get_contents("html/lateral_linha_categoria.html");
$select_cor = file_get_contents("html/centro_categoria_cor.html");

/* Buscar uma categoria no banco de dados */
if (isset($_GET["id"])) {
    $categoria_linha = $categorias_buscar->buscar_categoria(intval($_GET["id"]));
}
else {
    $categoria_linha = [null, "", "", null];
}

/* Listagem de cores */
$listagem_cores = $cores->buscar_cores();
$cores_html = "";
foreach ($listagem_cores as $listagem_cores_linha) {
    $linha_cor = $select_cor;
    $linha_cor = str_replace("#@ID_COR@#", $listagem_cores_linha[0], $linha_cor);
    $linha_cor = str_replace("#@NOME_COR@#", $listagem_cores_linha[1], $linha_cor);
    $linha_cor = str_replace("#@SELECIONADA@#", "#@SELECIONADA" . $listagem_cores_linha[0] . "@#", $linha_cor);
    $cores_html .= $linha_cor;
}
$cores_html2 = $cores_html;
if ($categoria_linha[3] > 0) {
    $cores_html2 = str_replace("#@SELECIONADA" . $categoria_linha[3] . "@#",  "selected=\"selected\"" , $cores_html);
}

/* Buscar as categorias e transformá-las em um conetúdo HTML */
$categorias_db = $categorias->buscar_categorias();
if (count($categorias_db)) {
    $linhas_categorias = "";

    foreach ($categorias_db as $categoria_db_linha) {
        $linha = $linha_categoria;
        $linha = str_replace("#@ID_CATEGORIA@#", $categoria_db_linha[0], $linha);
        $linha = str_replace("#@NOME_CATEGORIA@#", $categoria_db_linha[1], $linha);
        $linha = str_replace("#@COR_CATEGORIA@#", $categoria_db_linha[2], $linha);
        $linhas_categorias .= $linha;
    }
}
else {
    $linhas_categorias = "";
}

/* Exibir a página */
$conteudo = str_replace("#@CENTRO@#", $centro, $base);
$conteudo = str_replace("#@ID@#", $categoria_linha[0], $conteudo);
$conteudo = str_replace("#@NOME@#", $categoria_linha[1], $conteudo);
$conteudo = str_replace("#@CATERORIAS@#", $linhas_categorias, $conteudo);
$conteudo = str_replace("#@SELECT_CORES@#", $cores_html2, $conteudo);
echo $conteudo;
?>