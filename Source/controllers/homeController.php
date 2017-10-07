<?php
/**
 * This class is the Controller of the HomePage.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 09/18/2017
 * @since   0.1
 */
class homeController extends controller{
    
    /**
     * This function verifies if you are logged in, if so, then it shows you
     * the homepage, if not, it sends you to login page.
     */
    public function index(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $u = new Usuarios();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'HomePage',
            'nome' => $dados['nome']
        );
        $this->loadTemplate('home', $dados);
    }
}