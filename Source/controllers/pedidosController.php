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
       $termo = "";
        if (isset($_POST['busca'])){
           $termo = $_POST['busca'];
           $pedidos = $p->pesquisarPedido(addslashes($_POST['busca']));
        } else {
            $pedidos = $p->getPedidos();
        }
       $dados = $u->getDados($_SESSION['cLogin']);
       $dados = array(
           'titulo' => 'Pedidos',
           'nome' => $dados['nome'],
           'pedidos' => $pedidos,
           'termo' => $termo
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
        $v = new Pedidos();
        if(isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['lista']) && !empty($_POST['lista'])){
            $cliente = addslashes($_POST['nome']);
            $tipo_pagamento = addslashes($_POST['tipo_pagamento']);
            $lista = html_entity_decode($_POST['lista']);
            $json = json_decode($lista);
            $produtos = array();
            $quant = array();

            foreach($json as $sacola) {
                $produtos[] = $sacola->id;
                $quant[] = $sacola->qua;
            }

            $v->cadastrarPedido($cliente, $produtos, $quant, $tipo_pagamento);
            header("Location: ".BASE_URL."/pedidos");
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
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $v = new Pedidos();
        if(isset($_POST['id']) && !empty($_POST['id']) && isset($_POST['nome']) && !empty($_POST['nome']) && isset($_POST['lista']) && !empty($_POST['lista'])){
            $id = addslashes(base64_decode(base64_decode($id)));
            $cliente = addslashes($_POST['nome']);
            $tipo_pagamento = addslashes($_POST['tipo_pagamento']);
            $lista = html_entity_decode($_POST['lista']);
            $json = json_decode($lista);
            $produtos = array();
            $quant = array();

            foreach($json as $sacola) {
                $produtos[] = $sacola->id;
                $quant[] = $sacola->qua;
            }

            $v->editarPedido($id, $cliente, $produtos, $quant, $tipo_pagamento);
            header("Location: ".BASE_URL."/pedidos");
        }
        $u = new Usuarios();
        $c = new Clientes();
        $p = new Produtos();
        $venda = $v->getPedido(base64_decode(base64_decode(addslashes($id))));
        $produtos = $p->getProdutos();
        $clientes = $c->getClientes();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Editar Pedido',
            'nome' => $dados['nome'],
            'clientes' => $clientes,
            'produtos' => $produtos,
            'venda' => $venda
        );
        $this->loadTemplate('EditarPedido', $dados);
    }

    /**
     * This function verifies if the user is logged in.
     * If so, the user can delete an order.
     * After deleting an order, it updates the database.
     */
    public function excluir($id){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $p = new Pedidos();
        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $p->excluirPedido(base64_decode(base64_decode(addslashes($id))));
        header("Location: ".BASE_URL."/pedidos");
    }
}
