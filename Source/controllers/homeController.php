<?php
class homeController extends controller{
    public function index(){
        $dados = array(
            'titulo' => 'HomePage',
        );
        $this->loadTemplate('home', $dados);
    }
}