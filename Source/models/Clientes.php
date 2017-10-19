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
