<?php
/**
 * This class is the Controller of the Logs.
 *
 * @author  samuelrcosta
 * @version 1.0.0, 26/11/2017
 * @since   26/11/2017
 */
class logsController extends controller{
    /**
     * This function verifies if the user is logged in.
     * If so, it shows a list of all orders.
     */
    public function index(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $u = new Usuarios();
        $l = new Logs();
        $logs = $l->getLogs();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Logs',
            'nome' => $dados['nome'],
            'logs' => $logs
        );
        $this->loadTemplate('logs', $dados);
    }

    public function acesso(){
        if(!isset($_SESSION['cLogin']) || empty($_SESSION['cLogin'])){
            header('Location:'.BASE_URL."/login");
        }
        $u = new Usuarios();
        $l = new Logs();
        $logs = $l->getLogAcesso();
        $logsDay = $l->getLogDay();
        $logsMonth = $l->getLogMonth();
        $dados = $u->getDados($_SESSION['cLogin']);
        $dados = array(
            'titulo' => 'Logs de acesso',
            'nome' => $dados['nome'],
            'logs' => $logs,
            'log_dia' => $logsDay,
            'log_mes' => $logsMonth,
        );
        $this->loadTemplate('logsAcesso', $dados);
    }
}
?>
