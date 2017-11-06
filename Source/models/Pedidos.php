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
        $sql = "SELECT * FROM vendas WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();

        $sql = "SELECT * FROM vendas_produtos WHERE id_venda = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $result['lista'] = $sql->fetchAll();

        $sql = "SELECT * FROM vendas_produtos WHERE id_venda = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $result['produtos'] = 0;
        foreach($sql->fetchAll() as $prod){
            $result['produtos'] += $prod['quantidade'];
        }

        $c = new Clientes();
        $cliente = $c->getCliente($result['id_cliente']);
        $result['cliente'] = $cliente['nome'];

        return $result;
    }

    /**
     * This function retrieves all data from all orders in database.
     *
     * @return  An array containing all data retrieved.
     */
    public function getPedidos(){
        $result = array();

        $sql = "SELECT * FROM vendas";
        $sql = $this->db->prepare($sql);
        $sql->execute();

        foreach ($sql->fetchAll() as $row){
            $sql = "SELECT * FROM vendas_produtos WHERE id_venda = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($row['id']));
            $row['lista'] = $sql->fetchAll();

            $sql = "SELECT * FROM vendas_produtos WHERE id_venda = ?";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($row['id']));
            $row['produtos'] = 0;
            foreach($sql->fetchAll() as $prod){
                $row['produtos'] += $prod['quantidade'];
            }

            $c = new Clientes();
            $cliente = $c->getCliente($row['id_cliente']);
            $row['cliente'] = $cliente['nome'];

            $result[] = $row;
        }
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
        $sql = "UPDATE vendas SET status = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(2, $id));
    }
}
?>
