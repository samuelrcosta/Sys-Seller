<?php
/**
 * This class retrieves and saves data of the user.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/06/2017
 * @since   0.1
 */
class Produtos extends model{

    /**
     * This function retrieves all data from an product, by using it's ID.
     *
     * @param   $id The product ID number saved in the database.
     * @return  An array containing all data retrieved.
     */
    public function getProduto($id){
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        return $sql;
    }
    
    /**
     * This function retrieves all data from all products in database.
     *
     * @return  An array containing all data retrieved.
     */
    public function getProdutos(){
        $sql = "SELECT * FROM produtos";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $sql = $sql->fetchAll();
        return $sql;
    }
    
    
    /**
     * This function register a product.
     *
     * @param   $codigo     A string for the product code.
     * @param   $nome       A string for the product name.
     * @param   $categoria  A string for the product category.
     * @param   $descricao  A string for the product description.
     * @param   $preco      A float for the product price.
     */
    public function cadastrarProduto($codigo, $nome, $categoria, $descricao, $preco){
        $sql = "INSERT INTO produtos SET codigo = ?, nome = ?, categoria = ?, descricao = ?, preco = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($codigo, $nome, $categoria, $descricao, $preco));
    }
    
    
    /**
     * This function edit a product in database by using it's ID.
     *
     * @param   $id         A integer for the product ID.
     * @param   $codigo     A string for the product code.
     * @param   $nome       A string for the product name.
     * @param   $categoria  A string for the product category.
     * @param   $preco      A float for the product price.
     * @param   $descricao  A string for the product description.
     */
    public function editarProduto($id, $codigo, $nome, $categoria, $descricao, $preco){
        $sql = "UPDATE produtos SET codigo = ?, nome = ?, categoria = ?, descricao = ?, preco = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($codigo, $nome, $categoria, $descricao, $preco, $id));
    }
    
    /**
     * This function delete a product in database by using it's ID.
     *
     * @param   $id     A integer for the product ID.
     */
    public function excluirProduto($id){
        $sql = "DELETE FROM produtos WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
    }
}
?>
