<?php

namespace src\handlers;

use src\models\Usuario;
use src\models\Endereco;
use src\models\Tipo_endereco;


class CadastroHandler
{
    public static function cadastrarDados(array $usuario)
    {
        $arrayInsert = [
            'nome_usuario' => $usuario['nome'],
            'sobrenome_usuario' => $usuario['sobrenome'],
            'email_usuario' => $usuario['email'],
            'telefone_usuario' => $usuario['telefone'],
            'cpf_usuario' => $usuario['cpf'],
            'dt_nascimento' => $usuario['dataNascimento']
        ];

        $user = Usuario::insert($arrayInsert)->execute();

        $arrayInsert = [
            'cep' => $usuario['cep'],
            'rua' => $usuario['rua'],
            'uf' => $usuario['uf'],
            'numero' => $usuario['numero'],
            'bairro' => $usuario['bairro'],
            'cidade' => $usuario['cidade'],
            'complemento' => $usuario['complemento'],
            'tipo_endereco_id' => $usuario['tipoEndereco'],
            'usuario_id' => $user
        ];

        $address = Endereco::insert($arrayInsert)->execute();

        return true;
    }

    public static function editarUsuario(array $dadosUsuario)
    {
        $arrayInsert = [
            'nome_usuario' => $dadosUsuario['nome'],
            'sobrenome_usuario' => $dadosUsuario['sobrenome'],
            'email_usuario' => $dadosUsuario['email'],
            'telefone_usuario' => $dadosUsuario['telefone'],
            'cpf_usuario' => $dadosUsuario['cpf'],
            'dt_nascimento' => $dadosUsuario['dataNascimento'],
            'dt_alteracao_cadastro' => date('Y-m-d H:i:s')
        ];

        Usuario::update($arrayInsert)
            ->where('id_usuario', $dadosUsuario['id_usuario'])
            ->execute();


        $arrayInsert = [
            'cep' => $dadosUsuario['cep'],
            'rua' => $dadosUsuario['rua'],
            'uf' => $dadosUsuario['uf'],
            'numero' => $dadosUsuario['numero'],
            'bairro' => $dadosUsuario['bairro'],
            'cidade' => $dadosUsuario['cidade'],
            'complemento' => $dadosUsuario['complemento'],
            'tipo_endereco_id' => $dadosUsuario['tipoEndereco']
        ];

        Endereco::update($arrayInsert)
            ->where('usuario_id', $dadosUsuario['id_usuario'])
            ->execute();

        return true;
    }

    public static function getTipoEndereco()
    {
        return Tipo_endereco::select()->get();
    }

    public static function deletaDados(int $usuarioId)
    {
        Endereco::delete()->where('usuario_id', $usuarioId)->execute();

        Usuario::delete()->where('id_usuario', $usuarioId)->execute();
    }
}