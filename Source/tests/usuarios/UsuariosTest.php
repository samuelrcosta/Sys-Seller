<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Usuarios.php';

final class UsuariosTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testLogIn(){

        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();

        $result = $u->logIn('adm@adm.com.br', '123');

        $this->assertEquals('1', $result);

        //Teste do else
        $result = $u->logIn('adm@adm.com.br', '456');
        $this->assertEquals('-1', $result);
    }

    public function testLogOff(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $_SESSION['cLogin'] = '1';
        $u = new Usuarios();
        $u->logOff();
        $this->assertEquals('', $_SESSION['cLogin']);
    }

    public function testGetDados(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $u = new Usuarios();
        $result = $u->getDados(1);
        $this->assertEquals('1', $result['id']);
        $this->assertEquals('Administrador', $result['nome']);
        $this->assertEquals('adm@adm.com.br', $result['email']);
        $this->assertEquals(md5('123'), $result['senha']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::sysseller:');
            $db->exec('CREATE TABLE `usuarios` (`id` int(11) NOT NULL, `nome` varchar(150) NOT NULL, `email` varchar(150) NOT NULL, `senha` varchar(150) NOT NULL)');
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
