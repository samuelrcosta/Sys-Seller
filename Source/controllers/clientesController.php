<?php
/**
 * This class controls all functions about clients.
 *
 * @author  adryanoalf
 * @version 0.3.0, 18/06/2017
 * @since   0.3
 */
class clientesController extends controller {

    /**
     * This function shows the clients list.
     */
    public function index() {
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])) {
            header('Location:'.BASE_URL."/login");
        }
        $u = new Usuarios();
        $c = new Clientes();
        $clientes = $c->getClientes();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Clientes',
            'nome' => $dados['nome'],
            'clientes' => $clientes
        );
        $this->loadTemplate('clientes', $dados);
    }

    public  function cadastrar(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])) {
            header('Location:'.BASE_URL."/login");
        }

        $c = new Clientes();
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {
          $nome = addslashes($_POST['nome']);
          $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
          $endereco = addslashes($_POST['endereco']);
          $bairro = addslashes($_POST['bairro']);
          $cep = addslashes($_POST['cep']);
          $cidade = addslashes($_POST['cidade']);
          $estado = addslashes($_POST['estado']);
          $tipo_pessoa = addslashes($_POST['tipo_pessoa']);
          $telefone = addslashes($_POST['telefone']);
          $celular = addslashes($_POST['celular']);
          $email = addslashes($_POST['email']);
          $c->cadastrarCliente($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email);
            header("Location: ".BASE_URL."/clientes");

        }

        $u = new Usuarios();
        $c = new Clientes();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Clientes',
            'nome' => $dados['nome']
        );
        $this->loadTemplate('CadastrarCliente', $dados);
}



    public function editar($id){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }


        $c = new Clientes();
        if(isset($_POST['nome']) && !empty($_POST['nome'])) {
          $nome = addslashes($_POST['nome']);
          $cpf_cnpj = addslashes($_POST['cpf_cnpj']);
          $endereco = addslashes($_POST['endereco']);
          $bairro = addslashes($_POST['bairro']);
          $cep = addslashes($_POST['cep']);
          $cidade = addslashes($_POST['cidade']);
          $estado = addslashes($_POST['estado']);
          $tipo_pessoa = addslashes($_POST['tipo_pessoa']);
          $telefone = addslashes($_POST['telefone']);
          $celular = addslashes($_POST['celular']);
          $email = addslashes($_POST['email']);
          $c->editarCliente($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email);
            header("Location: ".BASE_URL."/clientes");
        }

        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $cliente = $c->getCliente(base64_decode(base64_decode(addslashes($id))));
        $dados = array(
            'titulo' => 'Clientes',
            'nome' => $dados['nome']
        );

        $this->loadTemplate('EditarCliente', $dados);
    }


        public function excluir($id){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $c = new Clientes();
        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $c->excluirCliente(base64_decode(base64_decode(addslashes($id))));
        header("Location: ".BASE_URL."/clientes");
    }
}
