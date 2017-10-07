<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Usuarios.php';

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
        $sql = "SELECT * FROM produtos ORDER BY desc";
        $sql = $this->db->prepare($sql);
        $sql->executar();
        $result = $sql->fetch();
        $this->assertEquals($codigo, "456");
        $this->assertEquals($nome, 'Segundo Teste');
        $this->assertEquals($descricao, "Produtos com foco em qualidade");
        $this->assertEquals($preco, $result['preco']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::sysseller:');
            $db->exec('CREATE TABLE `produtos` (`id` int(11) NOT NULL AUTO_INCREMENT, `codigo` varchar(100) DEFAULT NULL, `nome` varchar(150) NOT NULL, `categoria` varchar(150) DEFAULT NULL, `descricao` text, `preco` double NOT NULL)');
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
