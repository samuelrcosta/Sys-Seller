<?php
class produtosController extends controller{
    public function index(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $u = new Usuarios();
        $p = new Produtos();
        $produtos = $p->getProdutos();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Produtos',
            'nome' => $dados['nome'],
            'produtos' => $produtos
        );
        $this->loadTemplate('produtos', $dados);
    }

    public function cadastrar(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $p = new Produtos();
        if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['preco']) && !empty($_POST['preco'])){
            $codigo = addslashes($_POST['codigo']);
            $nome = addslashes($_POST['nome']);
            $categoria = addslashes($_POST['categoria']);
            $descricao = addslashes($_POST['descricao']);
            $preco = addslashes(str_replace(",", ".", str_replace(".", "", $_POST['preco'])));
            $p->cadastrarProduto($codigo, $nome, $categoria, $descricao, $preco);
            header("Location: ".BASE_URL."/produtos");
        }
        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Cadastrar Produto',
            'nome' => $dados['nome']
        );
        $this->loadTemplate('CadastrarProduto', $dados);
    }
}