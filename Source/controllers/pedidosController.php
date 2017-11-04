<?php
/**
 * This class is the Controller of the Orders.
 *
 * @author  adryanoalf
 * @version 0.4.0, 11/03/2017
 * @since   0.4
 */
class pedidosController extends controller{
    /**
     * This function verifies if the user is logged in.
     * If so, it shows a list of all orders.
     */
    public function index(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $u = new Usuarios();
        $p = new Pedidos();
        $pedidos = $p->getPedidos();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Pedidos',
            'nome' => $dados['nome'],
            'pedidos' => $pedidos
        );
        $this->loadTemplate('pedidos', $dados);
    }

    /**
     * This function verifies if the user is logged in.
     * If so, the user can register an order.
     * After registering an order, it stores the product details in database.
     */
    public function novo(){
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
        $c = new Clientes();
        $p = new Produtos();
        $produtos = $p->getProdutos();
        $clientes = $c->getClientes();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Novo Pedido',
            'nome' => $dados['nome'],
            'clientes' => $clientes,
            'produtos' => $produtos
        );
        $this->loadTemplate('NovoPedido', $dados);
    }

    /**
     * This function verifies if the user is logged in.
     * If so, the user can edit an order.
     * After editing an order, it updates the database.
     */
    public function editar($id){

    }

    /**
     * This function verifies if the user is logged in.
     * If so, the user can delete an order.
     * After deleting an order, it updates the database.
     */
    public function excluir($id){

    }
}
