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

}
