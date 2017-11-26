<?php
/**
 * This class retrieves and saves data of the user.
 *
 * @author  samuelrcosta
 * @version 1.1.0, 26/11/2017
 * @since   06/10/2017
 */
class Produtos extends model{

    /**
     * This function retrieves all data from an product, by using it's ID.
     *
     * @param   $id int for the product ID number saved in the database.
     * @return  array containing all data retrieved.
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
     * @return  array containing all data retrieved.
     */
    public function getProdutos(){
        $sql = "SELECT * FROM produtos WHERE status_interno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(1));
        $sql = $sql->fetchAll();
        return $sql;
    }

    /**
     * This function retrieves all data from all products found.
     *
     * @param   $termo  string researched
     *
     * @return  string json containing all data retrieved.
     */
    public function pesquisarProduto($termo){
        $sql = "SELECT * FROM produtos WHERE nome LIKE ? AND status_interno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array("%".strtolower($termo)."%", 1));
        $encode = "";
        while ($row = $sql->fetchAll()) {
            $encode = $row;
        }
        return json_encode($encode);
    }
    
    
    /**
     * This function register a product.
     *
     * @param   $codigo     string for the product code.
     * @param   $nome       string for the product name.
     * @param   $categoria  string for the product category.
     * @param   $descricao  string for the product description.
     * @param   $preco      float for the product price.
     */
    public function cadastrarProduto($codigo, $nome, $categoria, $descricao, $preco){
        $sql = "INSERT INTO produtos (codigo, nome, categoria, descricao, preco, status_interno) VALUES (?, ?, ?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($codigo, $nome, $categoria, $descricao, $preco, 1));
        $sql = "SELECT id FROM produtos ORDER BY id DESC LIMIT 1";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $id = $sql->fetch()['id'];
        $log = new Logs();
        $log->registrarLog(1, "Cadastrar Produto", "Cadastro do produto: ".$nome, $id);
    }
    
    /**
     * This function edit a product in database by using it's ID.
     *
     * @param   $id         integer for the product ID.
     * @param   $codigo     string for the product code.
     * @param   $nome       string for the product name.
     * @param   $categoria  string for the product category.
     * @param   $preco      float for the product price.
     * @param   $descricao  string for the product description.
     */
    public function editarProduto($id, $codigo, $nome, $categoria, $descricao, $preco){
        $sql = "UPDATE produtos SET codigo = ?, nome = ?, categoria = ?, descricao = ?, preco = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($codigo, $nome, $categoria, $descricao, $preco, $id));
        $log = new Logs();
        $log->registrarLog(2, "Editar Produto", "Edição do produto: ".$nome, $id);
    }
    
    /**
     * This function disable a product in database by using it's ID.
     *
     * @param   $id     integer for the product ID.
     */
    public function excluirProduto($id){
        $sql = "SELECT nome FROM produtos WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $nome = $sql->fetch()['nome'];
        $sql = "UPDATE produtos SET status_interno = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(2, $id));
        $log = new Logs();
        $log->registrarLog(3, "Excluir Produto", "Exclusão do produto: ".$nome, $id);
    }
}
?>