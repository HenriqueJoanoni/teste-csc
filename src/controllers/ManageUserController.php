<?php


namespace src\controllers;


use core\Controller;
use src\handlers\CadastroHandler;
use src\handlers\DadosHandler;
use src\handlers\HandlerFunctions;

class ManageUserController extends Controller
{
    const INSERT = 'insert-dados';
    const UPDATE = 'update-dados';

    /**
     * Visualizar pagina de cadastro
     */
    public function cadastrarUsuario()
    {
        $tipoEndereco = CadastroHandler::getTipoEndereco();

        $this->render('registrar-usuario', [
            'tipoEndereco' => $tipoEndereco
        ]);
    }

    /**
     * Enviar os dados do cadastro
     */
    public function enviarCadastro()
    {
        $usuario = $this->trataDados($_POST, self::INSERT);

        $user = CadastroHandler::cadastrarDados($usuario);

        if (false !== $user) {
            $this->redirect('/');
        } else {
            $this->redirect('/cadastrar-usuario');
        }
    }

    /**
     * Visualizar os dados do usuário
     */
    public function visualizarUsuario()
    {
        $usuarioId = $this->recuperaId($_GET);

        $user = DadosHandler::getUsuarioById($usuarioId);

        $dados = $this->trataDados($user[0], self::UPDATE);

        $this->render('visualizar-usuario',[
            'dados' => $dados
        ]);
    }

    /**
     * Visualizar pagina de edição dos dados do usuário
     */
    public function editarUsuario()
    {
        $usuarioId = $this->recuperaId($_GET);

        $tipoEndereco = CadastroHandler::getTipoEndereco();

        $usuario = DadosHandler::getUsuarioById($usuarioId);

        $dados = $this->trataDados($usuario[0], self::UPDATE);

        $this->render('editar-usuario', [
            'dados' => $dados,
            'tipoEndereco' => $tipoEndereco
        ]);
    }

    /**
     * Enviar os dados de edição do usuário
     */
    public function enviarEdicao()
    {
        $usuario = $this->trataDados($_POST, self::INSERT);

        CadastroHandler::editarUsuario($usuario);

        $this->redirect('/');
    }

    /**
     * Excluir o usuário do banco de dados
     */
    public function excluirUsuario()
    {
        $idUsuario = $this->recuperaId($_GET);

        CadastroHandler::deletaDados($idUsuario);

        $this->redirect('/');
    }

    /**
     * Trata todos os dados do usuário
     */
    private function trataDados(array $dadosUsuario, string $tipo)
    {
        if ($tipo === self::INSERT) {
            /** USUARIO */
            $nome = filter_input(INPUT_POST, 'nomeUsuario', FILTER_SANITIZE_STRING);
            $sobrenome = filter_input(INPUT_POST, 'sobrenomeUsuario', FILTER_SANITIZE_STRING);
            $email = filter_input(INPUT_POST, 'emailUsuario', FILTER_SANITIZE_EMAIL);
            $telefone = filter_input(INPUT_POST, 'telefoneUsuario', FILTER_SANITIZE_STRING);
            $cpf = filter_input(INPUT_POST, 'cpfUsuario', FILTER_SANITIZE_STRING);
            $dataNascimento = filter_input(INPUT_POST, 'dataNascimento', FILTER_SANITIZE_STRING);

            /** ENDERECO */
            $cep = filter_input(INPUT_POST, 'cep', FILTER_SANITIZE_STRING);
            $rua = filter_input(INPUT_POST, 'rua', FILTER_SANITIZE_STRING);
            $uf = filter_input(INPUT_POST, 'uf', FILTER_SANITIZE_STRING);
            $numero = filter_input(INPUT_POST, 'numero', FILTER_SANITIZE_STRING);
            $complemento = filter_input(INPUT_POST, 'complemento', FILTER_SANITIZE_STRING);
            $bairro = filter_input(INPUT_POST, 'bairro', FILTER_SANITIZE_STRING);
            $cidade = filter_input(INPUT_POST, 'cidade', FILTER_SANITIZE_STRING);
            $tipoEndereco = $dadosUsuario['selectTipoEndereco'];

            return [
                'id_usuario' => !empty($dadosUsuario['id_usuario']) ? $dadosUsuario['id_usuario'] : '',
                'nome' => $nome,
                'sobrenome' => $sobrenome,
                'email' => $email,
                'telefone' => HandlerFunctions::clearStr($telefone),
                'cpf' => HandlerFunctions::clearStr($cpf),
                'dataNascimento' => HandlerFunctions::date_fmt(
                    $dataNascimento,
                    'd/m/Y',
                    'Y-m-d'),
                'cep' => $cep,
                'rua' => $rua,
                'uf' => $uf,
                'numero' => $numero,
                'complemento' => $complemento,
                'bairro' => $bairro,
                'cidade' => $cidade,
                'tipoEndereco' => $tipoEndereco
            ];
        }

        if ($tipo === self::UPDATE) {
            return [
                'id_usuario' => $dadosUsuario['id_usuario'],
                'nome' => ucwords($dadosUsuario['nome_usuario']),
                'sobrenome' => ucwords($dadosUsuario['sobrenome_usuario']),
                'email' => $dadosUsuario['email_usuario'],
                'telefone' => HandlerFunctions::inputPhoneMask($dadosUsuario['telefone_usuario']),
                'cpf' => HandlerFunctions::inputCpf($dadosUsuario['cpf_usuario']),
                'dataNascimento' => HandlerFunctions::date_fmt(
                    $dadosUsuario['dt_nascimento'],
                    'Y-m-d',
                    'd/m/Y'),
                'cep' => $dadosUsuario['cep'],
                'rua' => $dadosUsuario['rua'],
                'uf' => $dadosUsuario['uf'],
                'numero' => $dadosUsuario['numero'],
                'complemento' => $dadosUsuario['complemento'],
                'bairro' => $dadosUsuario['bairro'],
                'cidade' => $dadosUsuario['cidade'],
                'tipoEndereco' => $dadosUsuario['tipo_endereco_id']
            ];
        }
    }

    /**
     * Recupera o ID do usuário na URL
     */
    private function recuperaId(array $request)
    {
        $info = explode('/', filter_input(INPUT_GET,'request',FILTER_SANITIZE_STRING));
        return $info[1];
    }
}