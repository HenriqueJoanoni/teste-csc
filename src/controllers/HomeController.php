<?php

namespace src\controllers;

use \core\Controller;
use src\handlers\DadosHandler;
use src\handlers\HandlerFunctions;

class HomeController extends Controller
{

    public function teste()
    {
        $this->render('modalMaps');
    }

    public function index()
    {
        $dados = DadosHandler::getAllUsuariosEnderecos();

        $usuarios = $this->tratarDadosUsuarios($dados);

        $this->render('home', [
            'usuarios' => $usuarios
        ]);
    }

    private function tratarDadosUsuarios(array $dados)
    {
        foreach ($dados as $dado) {
            $info[] = [
                'id_usuario' => $dado['id_usuario'],
                'nome_usuario' => ucwords($dado['nome_usuario'].$dado['sobrenome_usuario']),
                'telefone_usuario' => HandlerFunctions::inputPhoneMask($dado['telefone_usuario']),
                'cpf_usuario' => HandlerFunctions::inputCpf($dado['cpf_usuario']),
                'dt_nascimento' => HandlerFunctions::date_fmt($dado['dt_nascimento'],'Y-m-d','d/m/Y'),
                'rua' => $dado['rua'],
                'bairro' => $dado['bairro'],
                'cidade' => $dado['cidade'],
                'tipo_endereco_id' => ($dado['tipo_endereco_id'] == 1) ? 'Residencial' : 'Comercial',
                'dt_cadastro' => HandlerFunctions::date_fmt($dado['dt_cadastro'], 'Y-m-d H:i:s'),
                'dt_alteracao_cadastro' => (!empty($dado['dt_alteracao_cadastro'])) ?
                                            HandlerFunctions::date_fmt($dado['dt_alteracao_cadastro'], 'Y-m-d') :
                                            'N/D'
            ];
        }

        return $info;
    }
}