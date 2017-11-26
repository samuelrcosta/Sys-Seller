<?php
/**
 * This class retrieves and saves data of the user.
 *
 * @author  samuelrcosta
 * @version 1.2.0, 26/11/2017
 * @since   18/09/2017
 */
class Usuarios extends model{

    /**
     * This function verify if the input is valid for any account registered.
     * If valid returns it's ID, otherwise return -1 for false.
     *
     * @param   $email    string for the email registered for the account.
     * @param   $senha    string for the current password.
     * @return  Integer for the user ID, or -1 for 'user not found'.
     */
    public function logIn($email, $senha){
        $sql = "SELECT id FROM usuarios WHERE email = ? AND senha = ?";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($email, md5($senha)));
        $sql = $sql->fetch(PDO::FETCH_ASSOC);
        if($sql && count($sql)){
            $_SESSION['cLogin'] = $sql['id'];
            $log = new Logs();
            $log->registrarLog(1, "Login no sistema", "Usuário: ".$email." fez o login.", $sql['id']);
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
     * @param   $id int for the user ID number saved in the database.
     * @return  array containing all data retrieved.
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
