<?php
/**
 * This class is the Controller of Not Found Pages(404 error).
 *
 * @author  samuelrcosta
 * @version 0.1.0, 09/04/2017
 * @since   0.1
 */
class notfoundController extends controller{
    
    /**
     * This function shows 404 Errors when they happen.
     */
    public function index(){
        $this->loadTemplate('404', array('titulo'=>'Página não encontrada'));
    }
}
?>