<?php

require __DIR__ . '/../vendor/autoload.php';

use Pansiere\ControleFinanceiro\Controller\Controller;

session_start();

$page = rtrim(string: strtok(string: $_SERVER['REQUEST_URI'], token: '?'), characters: '/') ?: '/';

if (!isset($_SESSION['usuario_id']) && $page !== '/autenticacao/login' && $page !== '/autenticacao/registro' && $page !== '/autenticacao/registro/registrar' && $page !== '/autenticacao/login/validar') {
    header(header: 'Location: /autenticacao/login');
    exit;
}

$controller = new Controller();

switch ($page) {
    case '/dashboard':
        $controller->dashboard();
        break;

    case '/autenticacao/login':
        $controller->paginaLogin();
        break;

    case '/autenticacao/logout':
        $controller->logout();
        break;

    case '/autenticacao/login/validar':
        $controller->validarLogin(email: $_POST['email'], senha: $_POST['senha']);
        break;

    case '/autenticacao/registro':
        $controller->paginaRegistro();
        break;

    case '/autenticacao/registro/registrar':
        $controller->registrarUsuario(nome: $_POST['nome'], email: $_POST['email'], senha: $_POST['senha']);
        break;

    case '/transacao/adicionar':
        $controller->paginaAdicionarTransacao();
        break;

    case '/transacao/adicionar/salvar':
        $controller->salvarTransacao(tipo: $_POST['tipo'], categoriaNome: $_POST['categoriaNome'], descricao: $_POST['descricao'], valor: $_POST['valor'], data: $_POST['data']);
        break;

    case '/transacao/editar':
        $controller->paginaEditarTransacao(transacaoId: $_GET['transacaoId']);
        break;

    case '/transacao/editar/atualizar':
        $controller->editarTransacao(categoriaId: $_POST['categoriaId'], transacaoId: $_POST['transacaoId']);
        break;

    case '/transacao/deletar':
        $controller->deletarTransacao(transacaoId: $_POST['transacaoId']);
        break;

    case '/categorias':
        $controller->paginaCategorias();
        break;

    case '/categoria/salvar':
        $controller->salvarCategoria(categoriaNome: $_POST['categoriaNome']);
        break;

    case '/categoria/deletar':
        $controller->deletarCategoria(categoriaId: $_POST['categoriaId']);
        break;

    case '/categoria/editar':
        $controller->editarCategoria(categoriaNome: $_POST['categoriaNome'], editarCategoriaId: $_POST['editarCategoriaId']);
        break;

    default:
        header(header: "location: /dashboard");
}
