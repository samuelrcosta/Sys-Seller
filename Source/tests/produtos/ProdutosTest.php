<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Produtos.php';

final class ProdutosTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetProduto(){

        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $p = new Produtos();

        $result = $p->getProduto(1);

        $this->assertEquals('Nome Teste', $result['nome']);
        $this->assertEquals('Teste', $result['codigo']);
        $this->assertEquals('Enxovais', $result['categoria']);
        $this->assertEquals('Produto de Qualidade', $result['descricao']);
        $this->assertEquals(20.5, $result['preco']);

    }

    public function testGetProdutos(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $p = new Produtos();

        $result = $p->getProdutos();

        $this->assertEquals('Nome Teste', $result[0]['nome']);
        $this->assertEquals('Teste', $result[0]['codigo']);
        $this->assertEquals('Enxovais', $result[0]['categoria']);
        $this->assertEquals('Produto de Qualidade', $result[0]['descricao']);
        $this->assertEquals(20.5, $result[0]['preco']);
        $this->assertEquals(1, $result[0]['status_interno']);
    }

    public function testCadastrarProduto(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $p = new Produtos();

        $codigo = "456";
        $nome = "Segundo Teste";
        $categoria = "Gadgets";
        $descricao = "Produtos com foco em qualidade";
        $preco = 123.50;

        $p->cadastrarProduto($codigo, $nome, $categoria, $descricao, $preco);
        $sql = "SELECT * FROM produtos ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();
        $this->assertEquals($codigo, $result['codigo']);
        $this->assertEquals($nome, $result['nome']);
        $this->assertEquals($descricao, $result['descricao']);
        $this->assertEquals($preco, $result['preco']);
        $this->assertEquals(1, $result['status_interno']);
    }

    public function testEditarProduto(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $p = new Produtos();

        $id = 1;
        $codigo = "456";
        $nome = "Segundo Teste";
        $categoria = "Gadgets";
        $descricao = "Produtos com foco em qualidade";
        $preco = 123.50;

        $p->editarProduto($id, $codigo, $nome, $categoria, $descricao, $preco);
        $sql = "SELECT * FROM produtos WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEquals($id, $result['id']);
        $this->assertEquals($codigo, $result['codigo']);
        $this->assertEquals($nome, $result['nome']);
        $this->assertEquals($descricao, $result['descricao']);
        $this->assertEquals($preco, $result['preco']);
        $this->assertEquals(1, $result['status_interno']);
    }

    public function testExcluirProduto(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $p = new Produtos();

        $id = 1;

        $p->excluirProduto($id);
        $sql = "SELECT * FROM produtos WHERE id = ?";
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
            $db->exec('CREATE TABLE `produtos` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `codigo` varchar(100) DEFAULT NULL, `nome` varchar(150) NOT NULL, `categoria` varchar(150) DEFAULT NULL, `descricao` text, `preco` double NOT NULL, `status_interno` INTEGER NOT NULL) ');
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
