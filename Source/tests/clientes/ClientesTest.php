<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Clientes.php';

final class ClientesTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetCliente(){

        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Clientes();

        $result = $c->getCliente(1);

        $this->assertEquals('Nome Teste', $result['nome']);
        $this->assertEquals('000.111.222-33', $result['cpf_cnpj']);
        $this->assertEquals('Rua dos testes N 999', $result['endereco']);
        $this->assertEquals('Setor dos testes', $result['bairro']);
        $this->assertEquals('99999-999', $result['cep']);
        $this->assertEquals('Testolandia', $result['cidade']);
        $this->assertEquals('Goias', $result['estado']);
        $this->assertEquals('PF', $result['tipo_pessoa']);
        $this->assertEquals('(62) 3344-5566', $result['telefone']);
        $this->assertEquals('(62) 98877-6655', $result['celular']);
        $this->assertEquals('teste@adm.com.br', $result['email']);
        $this->assertEquals(1, $result['status_interno']);
    }

    public function testGetClientes(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $c = new Clientes();

        $result = $c->getClientes();

        $this->assertEquals('Nome Teste', $result[0]['nome']);
        $this->assertEquals('000.111.222-33', $result[0]['cpf_cnpj']);
        $this->assertEquals('Rua dos testes N 999', $result[0]['endereco']);
        $this->assertEquals('Setor dos testes', $result[0]['bairro']);
        $this->assertEquals('99999-999', $result[0]['cep']);
        $this->assertEquals('Testolandia', $result[0]['cidade']);
        $this->assertEquals('Goias', $result[0]['estado']);
        $this->assertEquals('PF', $result[0]['tipo_pessoa']);
        $this->assertEquals('(62) 3344-5566', $result[0]['telefone']);
        $this->assertEquals('(62) 98877-6655', $result[0]['celular']);
        $this->assertEquals('teste@adm.com.br', $result[0]['email']);
        $this->assertEquals(1, $result[0]['status_interno']);
    }

    public function testCadastrarCliente(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Clientes();

        $nome = "Segundo Teste";
        $cpf_cnpj = "999.888.111-00";
        $endereco = "Rua das Flores";
        $bairro = "Centro";
        $cep = "75400-000";
        $cidade = "Goiania";
        $estado = "Goiás";
        $tipo_pessoa = "PF";
        $telefone = "(62) 3332-4545";
        $celular = "(62) 98877-5544";
        $email = "segundoteste@adm.com.br";

        $c->cadastrarCliente($nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email);
        $sql = "SELECT * FROM clientes ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();
        $this->assertEquals($nome, $result['nome']);
        $this->assertEquals($cpf_cnpj, $result['cpf_cnpj']);
        $this->assertEquals($endereco, $result['endereco']);
        $this->assertEquals($bairro, $result['bairro']);
        $this->assertEquals($cep, $result['cep']);
        $this->assertEquals($cidade, $result['cidade']);
        $this->assertEquals($estado, $result['estado']);
        $this->assertEquals($tipo_pessoa, $result['tipo_pessoa']);
        $this->assertEquals($telefone, $result['telefone']);
        $this->assertEquals($celular, $result['celular']);
        $this->assertEquals($email, $result['email']);
        $this->assertEquals(1, $result['status_interno']);
    }

    public function testEditarCliente(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Clientes();

        $id = 2;
        $nome = "Terceiro Teste";
        $cpf_cnpj = "555.555.555-22";
        $endereco = "Rua das Acácias";
        $bairro = "Bueno";
        $cep = "75400-555";
        $cidade = "Goianira";
        $estado = "Goiás";
        $tipo_pessoa = "PF";
        $telefone = "(62) 3332-6666";
        $celular = "(62) 98877-9999";
        $email = "terceiroteste@adm.com.br";

        $c->editarCliente($id, $nome, $cpf_cnpj, $endereco, $bairro, $cep, $cidade, $estado, $tipo_pessoa, $telefone, $celular, $email);
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEquals($id, $result['id']);
        $this->assertEquals($nome, $result['nome']);
        $this->assertEquals($cpf_cnpj, $result['cpf_cnpj']);
        $this->assertEquals($endereco, $result['endereco']);
        $this->assertEquals($bairro, $result['bairro']);
        $this->assertEquals($cep, $result['cep']);
        $this->assertEquals($cidade, $result['cidade']);
        $this->assertEquals($estado, $result['estado']);
        $this->assertEquals($tipo_pessoa, $result['tipo_pessoa']);
        $this->assertEquals($telefone, $result['telefone']);
        $this->assertEquals($celular, $result['celular']);
        $this->assertEquals($email, $result['email']);
        $this->assertEquals(1, $result['status_interno']);
    }

    public function testExcluirCliente(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $c = new Clientes();

        $id = 1;

        $c->excluirCliente($id);
        $sql = "SELECT * FROM clientes WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEquals(2, $result['status_interno']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::sysseller:');
            $db->exec('CREATE TABLE `clientes` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(200) NOT NULL, `cpf_cnpj` varchar(20), `endereco` varchar(200), `bairro` varchar(100), `cep` varchar(20), `cidade` varchar(50), `estado` varchar(50), `tipo_pessoa` varchar(5), `telefone` varchar(20), `celular` varchar(20), `email` varchar(100), `status_interno` INTEGER NOT NULL) ');
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
