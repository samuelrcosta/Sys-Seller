<?php
/**
 * This class is the Controller of the Products.
 *
 * @author  samuelrcosta
 * @version 0.2.0, 10/07/2017
 * @since   0.2
 */
class produtosController extends controller{
    /**
     * This function verifies if the user is logged in.
     * If so, it shows a list of registered products.
     */
     public function index(){
         if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
             header('Location:'.BASE_URL."/login");
         }
         $u = new Usuarios();
         $p = new Produtos();
         $termo = "";
          if (isset($_POST['busca'])){
             $termo = $_POST['busca'];
             $produtos = $p->pesquisarProduto(addslashes($_POST['busca']));
          } else {
              $produtos = $p->getProdutos();
          }
         $dados = $u->getDados($_SESSION['cLogin']);
         $dados = array(
             'titulo' => 'Produtos',
             'nome' => $dados['nome'],
             'produtos' => $produtos,
             'termo' => $termo
         );
         $this->loadTemplate('produtos', $dados);
     }


    /**
     * This function verifies if the user is logged in.
     * If so, the user can register a product.
     * After registering a product, it stores the product details in database.
     */
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

    /**
     * This function verifies if the user is logged in.
     * If so, the user can edit a product.
     * After editing a product, it updates the database.
     */
    public function editar($id){
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
            $p->editarProduto(base64_decode(base64_decode(addslashes($id))), $codigo, $nome, $categoria, $descricao, $preco);
            header("Location: ".BASE_URL."/produtos");
        }
        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $produto = $p->getProduto(base64_decode(base64_decode(addslashes($id))));
        $dados = array(
            'titulo' => 'Editar Produto',
            'nome' => $dados['nome'],
            'produto' => $produto
        );
        $this->loadTemplate('EditarProduto', $dados);
    }

    /**
     * This function verifies if the user is logged in.
     * If so, the user can delete a product.
     * After deleting a product, it updates the database.
     */
    public function excluir($id){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $p = new Produtos();
        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $p->excluirProduto(base64_decode(base64_decode(addslashes($id))));
        header("Location: ".BASE_URL."/produtos");
    }
}
