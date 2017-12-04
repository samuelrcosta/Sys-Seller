<?php
/**
 * This class retrieves and saves data of the orders.
 *
 * @author  adryanoalf
 * @version 1.6.0, 26/11/2017
 * @since   15/11/2017
 */
class Pedidos extends model{

    /**
     * This function retrieves all data from an order, by using it's ID.
     *
     * @param   $id int for the order ID number saved in the database.
     * @return  array containing all data retrieved.
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
        $p = new Produtos();
        foreach($sql->fetchAll() as $prod){
            $result['produtos'] += $prod['quantidade'];
            $result['prod_obj'][$prod['id_produto']] = $p->getProduto($prod['id_produto']);
        }

        $c = new Clientes();
        $cliente = $c->getCliente($result['id_cliente']);
        $result['cliente'] = $cliente['nome'];

        return $result;
    }

    /**
     * This function retrieves all data from all orders in database.
     *
     * @return  array containing all data retrieved.
     */
    public function getPedidos(){
        $result = array();

        $sql = "SELECT * FROM vendas WHERE status='1'";
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
     * This function retrieves all data from all orders found.
     *
     * @param   $termo  string researched
     *
     * @return  array containing all data retrieved.
     */
    public function pesquisarPedido($termo){
        $sql = "SELECT *,vendas.id as id FROM vendas LEFT JOIN clientes ON clientes.id = vendas.id_cliente WHERE (nome LIKE ? OR vendas.id LIKE ?) AND status = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array("%".strtolower($termo)."%", "%".strtolower($termo)."%", 1));
            $result = array();

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
     *
     * @param   $cliente        int for the client ID number saved in the database.
     * @param   $produtos       array for the products of this order.
     * @param   $quantidade     array for the number of products in this order.
     * @param   $tipo_pagamento int for the payment type.
     */
    public function cadastrarPedido($cliente, $produtos, $quantidade, $tipo_pagamento){
        $p = new Produtos();
        $total = 0;
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d H:i:s");
        for($i = 0; $i < count($produtos); $i++){
            $total = $total + ($p->getProduto($produtos[$i])['preco'] * $quantidade[$i]);
        }
        $sql = "INSERT INTO vendas (id_cliente, tipo_pagamento, data_venda, total) VALUES (?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($cliente, $tipo_pagamento, $data, $total));

        $sql = "SELECT id FROM vendas WHERE id_cliente = ? ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($cliente));
        $id_venda = $sql->fetch()['id'];

        for($i = 0; $i < count($produtos); $i++){
            $sql = "INSERT INTO vendas_produtos (id_venda, id_produto, quantidade, preco) VALUES (?, ?, ?, ?)";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($id_venda, $produtos[$i], $quantidade[$i], $p->getProduto($produtos[$i])['preco']));
        }
        $log = new Logs();
        $log->registrarLog(1, "Cadastrar Pedido", "Cadastro do pedido: ".$id_venda, $id_venda);
    }

    /**
     * This function edit an order in database by using it's ID.
     *
     * @param   $id             int for the order ID.
     * @param   $cliente        int for the client ID number saved in the database.
     * @param   $produtos       array for the products of this order.
     * @param   $quantidade     array for the number of products in this order.
     * @param   $tipo_pagamento int for the payment type.
     */
    public function editarPedido($id, $cliente, $produtos, $quantidade, $tipo_pagamento){
        $p = new Produtos();
        $total = 0;
        for($i = 0; $i < count($produtos); $i++){
            $total = $total + ($p->getProduto($produtos[$i])['preco'] * $quantidade[$i]);
        }
        $sql = "UPDATE vendas SET id_cliente = ?, tipo_pagamento = ?, total = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($cliente, $tipo_pagamento, $total, $id));

        $sql = "DELETE FROM vendas_produtos WHERE id_venda = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));

        for($i = 0; $i < count($produtos); $i++){
            $sql = "INSERT INTO vendas_produtos (id_venda, id_produto, quantidade, preco) VALUES (?, ?, ?, ?)";
            $sql = $this->db->prepare($sql);
            $sql->execute(array($id, $produtos[$i], $quantidade[$i], $p->getProduto($produtos[$i])['preco']));
        }
        $log = new Logs();
        $log->registrarLog(2, "Editar Pedido", "Edição do pedido: ".$id, $id);
    }

    /**
     * This function disable an order in database by using it's ID.
     *
     * @param   $id     integer for the order ID.
     */
    public function excluirPedido($id){
        $sql = "UPDATE vendas SET status = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(2, $id));
        $log = new Logs();
        $log->registrarLog(3, "Excluir Pedido", "Exclusão do pedido: ".$id, $id);
    }
}
?>
