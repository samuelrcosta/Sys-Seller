<?php
/**
 * This class retrieves and saves data of the client.
 *
 * @author  samuelrcosta
 * @version 1.5.0, 26/11/2017
 * @since   16/10/2017
 */
class Clientes extends model{

    /**
     * This function register a client.
     *
     * @param   $nome           A string for the client name.
     * @param   $cpf_cnpj       A string for the client CNPJ or CPF.
     * @param   $endereco       A string for the client address.
     * @param   $bairro         A string for the client neighborhood.
     * @param   $cep            A string for the client postal code.
     * @param   $cidade         A string for the client city.
     * @param   $estado         A string for the client state.
     * @param   $tipo_pessoa    A string for the client type (PF to CPF and PJ to CNPJ).
     * @param   $telefone       A string for the client phone.
     * @param   $celular        A string for the client cell phone.
     * @param   $email          A string for the client e-mail.
     */
    public function cadastrarCliente($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email){
        $sql = "INSERT INTO clientes (nome, cpf_cnpj, endereco, bairro, cep, cidade, estado, tipo_pessoa, telefone, celular, email, status_interno) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email, 1));
        $sql = "SELECT id FROM clientes ORDER BY id DESC LIMIT 1";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        $id = $sql->fetch()['id'];
        $log = new Logs();
        $log->registrarLog(1, "Cadastrar Cliente", "Cadastro do cliente: ".$nome, $id);
    }

    /**
     * This function edit a client in database by using it's ID.
     *
     * @param   $id             integer for the client ID.
     * @param   $nome           string for the client name.
     * @param   $cpf_cnpj       string for the client CNPJ or CPF.
     * @param   $endereco       string for the client address.
     * @param   $bairro         string for the client neighborhood.
     * @param   $cep            string for the client postal code.
     * @param   $cidade         string for the client city.
     * @param   $estado         string for the client state.
     * @param   $tipo_pessoa    string for the client type (PF to CPF and PJ to CNPJ).
     * @param   $telefone       string for the client phone.
     * @param   $celular        string for the client cell phone.
     * @param   $email          string for the client e-mail.
     */
    public function editarCliente($id, $nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email){
        $sql = "UPDATE clientes SET nome = ?, cpf_cnpj = ?, endereco = ?, bairro = ?, cep = ?, cidade = ?, estado = ?, tipo_pessoa = ?, telefone = ?, celular = ?, email = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email, $id));
        $log = new Logs();
        $log->registrarLog(2, "Editar Cliente", "Edição do cliente: ".$nome, $id);
    }

    /**
     * This function disable a client in database by using it's ID.
     *
     * @param   $id     integer for the client ID.
     */
    public function excluirCliente($id){
        $sql = "SELECT nome FROM clientes WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $nome = $sql->fetch()['nome'];
        $sql = "UPDATE clientes SET status_interno = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(2, $id));
        $log = new Logs();
        $log->registrarLog(3, "Excluir Cliente", "Exclusão do cliente: ".$nome, $id);
    }

    /**
     * This function retrieves all data from an client, by using it's ID.
     *
     * @param   $id  int for the client ID number saved in the database.
     * @return  array containing all data retrieved.
     */
    public function getCliente($id){
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        return $sql;
    }

    /**
     * This function retrieves all data from all clients in database.
     *
     * @return  array containing all data retrieved.
     */
    public function getClientes(){
        $sql = "SELECT * FROM clientes WHERE status_interno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(1));
        $sql = $sql->fetchAll();
        return $sql;
    }

    /**
     * This function retrieves all data from all clients found.
     *
     * @param   $termo  string researched
     *
     * @return  array containing all data retrieved.
     */
    public function pesquisarCliente($termo){
        $sql = "SELECT * FROM clientes WHERE nome LIKE ? OR email LIKE ? AND status_interno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array("%".strtolower($termo)."%", "%".strtolower($termo)."%", 1));
        return $sql->fetchAll();
    }
}
