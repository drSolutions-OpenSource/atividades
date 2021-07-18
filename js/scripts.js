/**
 * Sistema para gerenciar a lista de atividades (to do list)
 * PHP 7.0 (ou superior) com SQLite
 *
 * @author  Diego Mendes Rodrigues
 * @since   Julho/2021
 * @version 1.0
 */

/**
 * Enviar o formulário na página do Cadastro de Atividade
 * @returns null
 */
function enviar() {
    var formulario = document.getElementById("formatividade");
    var titulo = document.getElementById("ftitulo").value
    var data_atividade = document.getElementById("fdata").value;

    if (titulo.length <= 0) {
        alert('Digite um título para a atividade');
        return;
    }
    if (data_atividade <= 0) {
        alert('Selecione a data da atividade');
        return;
    }
    formulario.submit();
}

/**
 * Variável que controla qual o ID que é utilizado quando o usuário clica no botão para concluir
 * ou para excluir uma atividade
 */
identificador = 0;

/**
 * Exibir a caixa de confirmação para concluir uma atividade
 * @param {*} id identificador da atividade
 */
function exibir_confirmar(id) {
    var div_confirmar = document.getElementById("confirmar");
    div_confirmar.style.visibility = "visible";
    identificador = id;
}

/**
 * Clique no botão Sim na caixa de conclusão de uma atividade
 */
function btn_conclusao_sim() {
    var div_confirmar = document.getElementById("confirmar");
    div_confirmar.style.visibility = "hidden";
    window.location = "index.php?id=" + identificador + "&concluido=1";
}

/**
 * Clique no botão Não na caixa de conclusão de uma atividade
 */
function btn_conclusao_nao() {
    var div_confirmar = document.getElementById("confirmar");
    div_confirmar.style.visibility = "hidden";
}

/**
 * Exibir a caixa de confirmação para excluir uma atividade
 * @param {*} id identificador da atividade
 */
function exibir_excluir(id) {
    var div_excluir = document.getElementById("excluir");
    div_excluir.style.visibility = "visible";
    identificador = id;
}

/**
 * Clique no botão Sim na caixa de exclusão de uma atividade
 */
function btn_excluir_sim() {
    var div_excluir = document.getElementById("excluir");
    div_excluir.style.visibility = "hidden";
    window.location = "index.php?id=" + identificador + "&excluir=1";
}

/**
 * Clique no botão Não na caixa de exclusão de uma atividade
 */
function btn_excluir_nao() {
    var div_excluir = document.getElementById("excluir");
    div_excluir.style.visibility = "hidden";
}


/**
 * Enviar o formulário na página do Cadastro de Atividade
 * @returns null
 */
 function enviar_categoria() {
    var formulario = document.getElementById("formcategoria");
    var nome = document.getElementById("fnome").value

    if (nome.length <= 0) {
        alert('Digite um nome para a categoria');
        return;
    }
    formulario.submit();
}

/**
 * Exibir a caixa de confirmação para excluir uma categoria
 * @param {*} id identificador da atividade
 */
 function exibir_excluir_categoria(id) {
    var div_excluir = document.getElementById("excluir_categoria");
    div_excluir.style.visibility = "visible";
    identificador = id;
}

/**
 * Clique no botão Sim na caixa de exclusão de uma categoria
 */
function btn_excluir_categoria_sim() {
    var div_excluir = document.getElementById("excluir_categoria");
    div_excluir.style.visibility = "hidden";
    window.location = "categorias.php?id=" + identificador + "&excluir=1";
}

/**
 * Clique no botão Não na caixa de exclusão de uma categoria
 */
function btn_excluir_categoria_nao() {
    var div_excluir = document.getElementById("excluir_categoria");
    div_excluir.style.visibility = "hidden";
}