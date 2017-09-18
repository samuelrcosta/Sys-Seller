<?php
class loginController extends controller{
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
    public function logout(){
        $u = new Usuarios();
        if($u->logOff() == -1){
            header('Location:'.BASE_URL."/login");
        }
    }
}