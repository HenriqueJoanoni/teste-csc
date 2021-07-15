<?php
use core\Router;

$router = new Router();

/** Home */
$router->get('/', 'HomeController@index');

/** CRUD de usuário */
$router->get('/cadastro-usuario', 'ManageUserController@cadastrarUsuario');
$router->post('/cadastrar-usuario', 'ManageUserController@enviarCadastro');

$router->get('/visualizar-usuario/{id}', 'ManageUserController@visualizarUsuario');

$router->get('/editar-usuario/{id}', 'ManageUserController@editarUsuario');
$router->post('/editar-usuario', 'ManageUserController@enviarEdicao');

$router->get('/excluir-usuario/{id}', 'ManageUserController@excluirUsuario');
