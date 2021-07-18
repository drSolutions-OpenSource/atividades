<?php
/**
 * Página de Atividade - Incluir ou alterar uma atividade
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

/* Inserir ou alterar a atividade no banco de dados */
if (isset($_POST["fid"])) {
    $id = $_POST["fid"];
    $titulo = $_POST["ftitulo"];
    $data = $_POST["fdata"];
    $descricao = $_POST["fdescricao"];
    $categoria = $_POST["fcategoria"];

    if (strlen($id)) {
        $atividades->atualizar_atividade($id, $titulo, $data, $descricao, $categoria);
    }
    else {
        $atividades->inserir_atividade($titulo, $data, $descricao, $categoria);
    }
    header("Location: index.php");
    exit();
}

/* Carregar os arquivos HTML */
$base = file_get_contents("html/base.html");
$centro = file_get_contents("html/centro_atividade.html");
$linha_categoria = file_get_contents("html/lateral_linha_categoria.html");
$select_categoria = file_get_contents("html/centro_atividade_categoria.html");

/* Buscar uma atividade no banco de dados */
if (isset($_GET["id"])) {
    $atividade_linha = $atividades->buscar_atividade(intval($_GET["id"]));
}
else {
    $atividade_linha = [null, 0, "", "", ""];
}

/* Buscar as categorias e transformá-las em um conetúdo HTML */
$categorias_db = $categorias->buscar_categorias();
if (count($categorias_db)) {
    $linhas_categorias = "";
    $linhas_select = "";

    foreach ($categorias_db as $categoria_linha) {
        $linha = $linha_categoria;
        $linha = str_replace("#@ID_CATEGORIA@#", $categoria_linha[0], $linha);
        $linha = str_replace("#@NOME_CATEGORIA@#", $categoria_linha[1], $linha);
        $linha = str_replace("#@COR_CATEGORIA@#", $categoria_linha[2], $linha);
        $linhas_categorias .= $linha;

        $linha_select = $select_categoria;
        $linha_select = str_replace("#@ID_CATEGORIA@#", $categoria_linha[0], $linha_select);
        $linha_select = str_replace("#@NOME_CATEGORIA@#", $categoria_linha[1], $linha_select);

        if ($categoria_linha[0] == $atividade_linha[1]) {
            $linha_select = str_replace("#@SELECIONADA@#", "selected=\"selected\"", $linha_select);
        }
        else {
            $linha_select = str_replace("#@SELECIONADA@#", "", $linha_select);
        }
        $linhas_select .= $linha_select;
    }
}
else {
    $linhas_categorias = "";
    $linhas_select = "";
}

/* Exibir a página */
$conteudo = str_replace("#@CENTRO@#", $centro, $base);
$conteudo = str_replace("#@ID@#", $atividade_linha[0], $conteudo);
$conteudo = str_replace("#@TITULO@#", $atividade_linha[2], $conteudo);
$conteudo = str_replace("#@DATA@#", $atividade_linha[3], $conteudo);
$conteudo = str_replace("#@DESCRICAO@#", $atividade_linha[4], $conteudo);
$conteudo = str_replace("#@SELECT" . $atividade_linha[1] . "@#", "selected=\"selected\"", $conteudo);
$conteudo = str_replace("#@CATERORIAS@#", $linhas_categorias, $conteudo);
$conteudo = str_replace("#@SELECT_CATEGORIAS@#", $linhas_select, $conteudo);
echo $conteudo;
?>