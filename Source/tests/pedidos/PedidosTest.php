<?php
declare(strict_types=1);

include_once __DIR__.'/../../core/model.php';
include_once __DIR__.'/../../models/Pedidos.php';

final class PedidosTest extends PHPUnit_Extensions_Database_TestCase{

    private $conn = null;

    public function testGetPedido(){

        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;

        $p = new Pedidos();

        $result = $p->getPedido(1);

        $this->assertEquals('Nome Teste', $result['cliente']);
        $this->assertEquals('2', $result['produtos']);
        $this->assertEquals('41', $result['total']);

    }

    public function testGetPedidos(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $p = new Pedidos();

        $result = $p->getPedidos();

        $this->assertEquals('Nome Teste', $result[0]['cliente']);
        $this->assertEquals('2', $result[0]['produtos']);
        $this->assertEquals('41', $result[0]['total']);
    }

    public function testCadastrarPedido(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $_SESSION['cLogin'] = 1;
        $p = new Pedidos();

        $cliente = "1";
        $produto = array(1);
        $quantidade = array(5);
        $tipo_pagamento = 1;

        $p->cadastrarPedido($cliente, $produto, $quantidade, $tipo_pagamento);
        $sql = "SELECT * FROM vendas ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute();
        $result = $sql->fetch();
        $this->assertEquals(1, $result['id_cliente']);
        $this->assertEquals(102.5, $result['total']);
        $this->assertEquals(1, $result['tipo_pagamento']);

        $sql = "SELECT * FROM vendas_produtos WHERE id_venda = ? ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($result['id']));
        $result = $sql->fetch();
        $this->assertEquals(1, $result['id_produto']);
        $this->assertEquals(5, $result['quantidade']);
    }

    public function testEditarPedido(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $_SESSION['cLogin'] = 1;

        $p = new Pedidos();

        $id = "1";
        $cliente = "1";
        $produto = array(1);
        $quantidade = array(4);
        $tipo_pagamento = 2;

        $p->editarPedido($id, $cliente, $produto, $quantidade, $tipo_pagamento);
        $sql = "SELECT * FROM vendas WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEquals($id, $result['id']);
        $this->assertEquals($cliente, $result['id_cliente']);
        $this->assertEquals(82, $result['total']);
        $this->assertEquals(2, $result['tipo_pagamento']);
        $sql = "SELECT * FROM vendas_produtos WHERE id_venda = ? ORDER BY id desc";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEquals($produto[0], $result['id_produto']);
        $this->assertEquals($quantidade[0], $result['quantidade']);
    }

    public function testPesquisarPedido(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $p = new Pedidos();
        $termo = "Teste";
        $result = $p->pesquisarPedido($termo);
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
        $this->assertEquals('2017-11-05 15:39:18', $result[0]['data_venda']);
        $this->assertEquals(41, $result[0]['total']);
    }

    public function testExcluirPedido(){
        $conn = $this->getConnection()->getConnection();

        $GLOBALS['db'] = $conn;
        $_SESSION['cLogin'] = 1;

        $p = new Pedidos();

        $id = 1;

        $p->excluirPedido($id);
        $sql = "SELECT * FROM vendas WHERE id = ?";
        $sql = $GLOBALS['db']->prepare($sql);
        $sql->execute(array($id));
        $result = $sql->fetch();
        $this->assertEquals(2, $result['status']);
    }

    /**
     * @coversNothing
     */
    public function getConnection()
    {
        if(!$this->conn) {

            $db = new PDO('sqlite::sysseller:');
            $db->exec('CREATE TABLE `clientes` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `nome` varchar(200) NOT NULL, `cpf_cnpj` varchar(20), `endereco` varchar(200), `bairro` varchar(100), `cep` varchar(20), `cidade` varchar(50), `estado` varchar(50), `tipo_pessoa` varchar(5), `telefone` varchar(20), `celular` varchar(20), `email` varchar(100), `status_interno` INTEGER NOT NULL) ');
            $db->exec('CREATE TABLE `produtos` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `codigo` varchar(100) DEFAULT NULL, `nome` varchar(150) NOT NULL, `categoria` varchar(150) DEFAULT NULL, `descricao` text, `preco` double NOT NULL, `status_interno` INTEGER NOT NULL) ');
            $db->exec('CREATE TABLE `vendas` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_cliente` int(10) NOT NULL, `data_venda` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP, `tipo_pagamento` int(11) DEFAULT NULL, `total` float NOT NULL, `status` int(10) NOT NULL DEFAULT `1`)');
            $db->exec('CREATE TABLE `vendas_produtos` (`id` INTEGER PRIMARY KEY AUTOINCREMENT, `id_venda` int(11) NOT NULL, `id_produto` int(11) NOT NULL, `quantidade` int(10) NOT NULL DEFAULT `1`, `preco` float DEFAULT NULL)');
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
