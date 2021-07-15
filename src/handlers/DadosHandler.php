<?php


namespace src\handlers;


use src\models\Usuario;

class DadosHandler
{
    public static function getAllUsuariosEnderecos()
    {
        $selectArray = [
            'usuarios.id_usuario',
            'usuarios.nome_usuario',
            'usuarios.sobrenome_usuario',
            'usuarios.email_usuario',
            'usuarios.telefone_usuario',
            'usuarios.cpf_usuario',
            'usuarios.dt_nascimento',
            'enderecos.cep',
            'enderecos.rua',
            'enderecos.bairro',
            'enderecos.cidade',
            'enderecos.tipo_endereco_id',
            'usuarios.dt_cadastro',
            'usuarios.dt_alteracao_cadastro',
        ];

        return Usuario::select($selectArray)
            ->innerJoin('enderecos', 'usuarios.id_usuario', '=', 'enderecos.usuario_id')
            ->orderBy('usuarios.id_usuario')
            ->get();
    }

    public static function getUsuarioById(int $usuarioId)
    {
        $selectArray = [
            'usuarios.id_usuario',
            'usuarios.nome_usuario',
            'usuarios.sobrenome_usuario',
            'usuarios.email_usuario',
            'usuarios.telefone_usuario',
            'usuarios.cpf_usuario',
            'usuarios.dt_nascimento',
            'enderecos.cep',
            'enderecos.rua',
            'enderecos.bairro',
            'enderecos.cidade',
            'enderecos.uf',
            'enderecos.numero',
            'enderecos.complemento',
            'enderecos.tipo_endereco_id',
            'usuarios.dt_cadastro',
            'usuarios.dt_alteracao_cadastro',
        ];

        return Usuario::select($selectArray)
            ->innerJoin('enderecos', 'usuarios.id_usuario', '=', 'enderecos.usuario_id')
            ->where('usuarios.id_usuario', $usuarioId)
            ->get();
    }
}