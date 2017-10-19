<<<<<<< HEAD
<?php
/**
 * This class retrieves and saves data of clients.
 *
 * @author  adryanoalf
 * @version 0.3.0, 18/06/2017
 * @since   0.3
 */
class Clientes extends model {

    /**
     * This function retrieves all data from a client, by using it's ID.
     *
     * @param   $id The client ID saved in the database.
     * @return  An array containing the data from the user.
     */
    public function getCliente($id) {
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        return $sql;
    }

    /**
     * This function retrieves all data from all clients in database.
     *
     * @return  An array containing all data retrieved.
     */
    public function getClientes() {
        $sql = "SELECT * FROM clientes WHERE status_interno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(1));
        $sql = $sql->fetchAll();
        return $sql;
    }

}
?>
=======
<?php
/**
 * This class retrieves and saves data of the client.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 10/16/2017
 * @since   0.1
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
    }

    /**
     * This function edit a client in database by using it's ID.
     *
     * @param   $id             A integer for the client ID.
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
    public function editarCliente($id, $nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email){
        $sql = "UPDATE clientes SET nome = ?, cpf_cnpj = ?, endereco = ?, bairro = ?, cep = ?, cidade = ?, estado = ?, tipo_pessoa = ?, telefone = ?, celular = ?, email = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email, $id));
    }

    /**
     * This function disable a client in database by using it's ID.
     *
     * @param   $id     A integer for the client ID.
     */
    public function excluirCliente($id){
        $sql = "UPDATE clientes SET status_interno = ? WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(2, $id));
    }

    /**
     * This function retrieves all data from an client, by using it's ID.
     *
     * @param   $id The client ID number saved in the database.
     * @return  An array containing all data retrieved.
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
     * @return  An array containing all data retrieved.
     */
    public function getClientes(){
        $sql = "SELECT * FROM clientes WHERE status_interno = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array(1));
        $sql = $sql->fetchAll();
        return $sql;
    }
}
>>>>>>> master
