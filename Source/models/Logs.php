<?php
/**
 * This class retrieves and saves data of the logs.
 *
 * @author  samuelrcosta
 * @version 1.1.0, 26/11/2017
 * @since   25/11/2017
 */
class Logs extends model{

    /**
     * This function register a new log.
     *
     * @param   $severidade     int for the severity of the event.
     * @param   $resultado      string for action of the event.
     * @param   $descricao      string for description of the event.
     * @param   $id_registro    int for the id
     */
    public function registrarLog($severidade, $resultado, $descricao, $id_registro){
        date_default_timezone_set('America/Sao_Paulo');
        $data = date("Y-m-d H:i:s");
        $sql = "INSERT INTO logs (data_ocorrencia, severidade, id_usuario, resultado, descricao, id_registro) VALUES (?, ?, ?, ?, ?, ?)";
        $sql = $this->db->prepare($sql);
        $sql->execute(array($data, $severidade, $_SESSION['cLogin'], $resultado, $descricao, $id_registro));
    }

    /**
     * This function retrieves all data from all logs in database.
     *
     * @return  array containing all data retrieved.
     */
    public function getLogs(){
        $sql = "SELECT *, (SELECT usuarios.nome FROM usuarios WHERE usuarios.id = logs.id_usuario limit 1) as nomeUsuario FROM logs ORDER BY id DESC";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function getLogDay(){
        $sql = "SELECT * FROM log_dia ORDER BY id DESC LIMIT 5";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function getLogMonth(){
        $sql = "SELECT * FROM log_mes ORDER BY id DESC LIMIT 5";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }

    public function getLogAcesso(){
        $sql = "SELECT * FROM log_link ORDER BY id DESC LIMIT 50";
        $sql = $this->db->prepare($sql);
        $sql->execute();
        return $sql->fetchAll();
    }
}
