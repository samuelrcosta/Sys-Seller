<?php
/**
 * This class is the Controller of Login.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 09/18/2017
 * @since   0.1
 */
class loginController extends controller{
    
    /**
     * This function handles Login and redirects to Index page.
     */
    public function index(){
        $dados = array();
        $dados['titulo'] = 'Faça o login';
        $dados['aviso'] = '';
        $u = new Usuarios();
        if(isset($_POST['email']) && !empty($_POST['email'])){
            $email = addslashes($_POST['email']);
            $senha = addslashes($_POST['senha']);

            if($u->login($email, $senha)){
                header('Location:'.BASE_URL);
            }else{
                $dados['aviso'] = 'Usuário e/ou senha inválidos.';
            }
        }
        $this->loadTemplate('login', $dados);
    }
    
    /**
     * This function handles logout, redirecting to Login page.
     */
    public function logout(){
        $u = new Usuarios();
        if($_SESSION['cLogin'] == ""){
            header('Location:'.BASE_URL."/login");
        }
    }
}