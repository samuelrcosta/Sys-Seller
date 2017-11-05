<?php
/**
 * This class retrieves and saves data of the orders.
 *
 * @author  adryanoalf
 * @version 0.4.0, 11/03/2017
 * @since   0.4
 */
class Pedidos extends model{

    /**
     * This function retrieves all data from an order, by using it's ID.
     *
     * @param   $id The order ID number saved in the database.
     * @return  An array containing all data retrieved.
     */
    public function getPedido($id){
        //TODO
        $result = array('id'=>'1','cliente'=>'João','produtos'=>'3','total'=>'23.90');
        return $result;
    }

    /**
     * This function retrieves all data from all orders in database.
     *
     * @return  An array containing all data retrieved.
     */
    public function getPedidos(){
        //TODO
        $result = array(array('id'=>'1','cliente'=>'João','produtos'=>'3','total'=>'23.90'),
                        array('id'=>'2','cliente'=>'Luciana','produtos'=>'1','total'=>'8.50'),
                        array('id'=>'4','cliente'=>'Mário','produtos'=>'17','total'=>'89.35'));
        return $result;
    }


    /**
     * This function register an order.
     */
    public function cadastrarPedido(){
        //TODO
    }

    /**
     * This function edit an order in database by using it's ID.
     *
     * @param   $id     A integer for the order ID.
     */
    public function editarPedido($id){
        //TODO
    }

    /**
     * This function disable an order in database by using it's ID.
     *
     * @param   $id     A integer for the order ID.
     */
    public function excluirPedido($id){
        //TODO
    }
}
?>
