<?php
/**
 * This class retrieves and saves data of the user.
 *
 * @author  samuelrcosta
 * @version 0.1.0, 09/18/2017
 * @since   0.1
 */
class Usuarios extends model{

    /**
     * This function verify if the input is valid for any account registered.
     * If valid returns it's ID, otherwise return -1 for false.
     *
     * @param   $email    The email registered for the account.
     * @param   $senha    The current password.
     * @return  A positive  Integer for the user ID, or -1 for 'user not found'.
     */
    public function logIn($email, $senha){
        $sql = "SELECT id FROM usuarios WHERE email = ? AND senha = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, md5($senha)));
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql && count($sql)){
            $_SESSION['cLogin'] = $sql['id'];
            return $sql['id'];
        }else{
            return -1;
        }
    }

    /**
     * Function used to unregister the user in the session.
     *
     */
    public function logOff(){
        $_SESSION['cLogin'] = "";
    }

    /**
     * This function retrieves all data from an user, by using it's ID.
     *
     * @param   $id The user ID number saved in the database.
     * @return  An array containing all data retrieved.
     */
    public function getDados($id){
        $sql = "SELECT * FROM usuarios WHERE id = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($id));
        $sql = $sql->fetch();
        return $sql;
    }
}
?>
