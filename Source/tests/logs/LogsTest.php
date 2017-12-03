<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Logs.php';

final class LogsTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testAcesso(){
        $db = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $db;
        $l = new Logs();

        $logs = count($l->getLogAcesso());
        $this->assertEquals(0, $logs);

        require(__DIR__.'/../../logging.php');

        $logs = count($l->getLogAcesso());
        $this->assertGreaterThan(0, $logs);
    }

    public function testGetLogs(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $l = new Logs();

        $result = $l->getLogs();

        $this->assertEquals(2, $result[0]['id']);
        $this->assertEquals(3, $result[0]['id_registro']);
        $this->assertEquals('2017-11-26 15:00:00', $result[0]['data_ocorrencia']);
        $this->assertEquals(3, $result[0]['severidade']);
        $this->assertEquals(1, $result[0]['id_usuario']);
        $this->assertEquals('Excluir Cliente', $result[0]['resultado']);
        $this->assertEquals('Exclusão do cliente: Nome Teste', $result[0]['descricao']);
        $this->assertEquals('Administrador', $result[0]['nomeUsuario']);
        $this->assertEquals(1, $result[1]['id']);
        $this->assertEquals(2, $result[1]['id_registro']);
        $this->assertEquals('2017-11-23 13:00:00', $result[1]['data_ocorrencia']);
        $this->assertEquals(2, $result[1]['severidade']);
        $this->assertEquals(1, $result[1]['id_usuario']);
        $this->assertEquals('Editar Cliente', $result[1]['resultado']);
        $this->assertEquals('Edição do cliente: Nome Teste', $result[1]['descricao']);
        $this->assertEquals('Administrador', $result[1]['nomeUsuario']);
    }

    public function testrRegistrarLog(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $_SESSION['cLogin'] = 1;
        $l = new Logs();

        $severidade = 1;
        $resultado = 'Cadastrar Cliente';
        $descricao = 'Cadastro do cliente: Teste';
        $id_registro = 2;

        $l->registrarLog($severidade, $resultado, $descricao, $id_registro);
        $sql = "SELECT * FROM logs ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();
        $this->assertEquals($severidade, $result['severidade']);
        $this->assertEquals($resultado, $result['resultado']);
        $this->assertEquals($descricao, $result['descricao']);
        $this->assertEquals($id_registro, $result['id_registro']);
        $this->assertEquals(1, $result['id_usuario']);
    }


    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::sysseller:');
            $db->exec('CREATE TABLE `usuarios` (`id` int(11) NOT NULL, `nome` varchar(150) NOT NULL, `email` varchar(150) NOT NULL, `senha` varchar(150) NOT NULL)');
            $db->exec('CREATE TABLE `logs` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_registro` int(11) NOT NULL, `data_ocorrencia` datetime NOT NULL, `severidade` int(11) NOT NULL, `id_usuario` int(11) NOT NULL, `resultado` varchar(200) NOT NULL, `descricao` text NOT NULL)');
            $this->conn =  $this->createDefaultDBConnection($db, ':sysseller:');
        }

        return $this->conn;
    }

    /**
     * @coversNothing
     */
    public function getDataSet()
    {
        return $this->createXMLDataSet(__DIR__."/SysSeller.xml");
    }
}
?>
