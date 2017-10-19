<html lang="pt-BR">
<head>

	<meta charset="UTF-8">
	<title>Cadastro Cliente</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="text/.css" rel="stylesheet">
<style>
  .btn-sample { 
  color: #FFFFFF; 
  background-color: #1BBD20; 
  border-color: #000000; 
  width:70;
  height:45px;
} 
   .btn-danger{
   	color: #FFFFFF;
	background-color: #FF0000;
	border-color: #000000; 
    width:75;
    height:45px;
}
 </style>
</head>
<body>

<div class="container">
    <div class="row">
    
    	<h2>Cadastrar Clientes</h2>
        <form role="form">
        
        <div class="panel-group" id="accordion">
        
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h4 class="panel-title">
                        <a data-toggle="collapse" data-parent="#accordion" href="#collapseDadosGerais">
                            Dados Gerais
                        </a>
                    </h4>
                </div>
                
                <div id="collapseLocalizacao" class="panel-collapse collapse in">
                    <div class="panel-body">   
                          
                        <div class="row">
                        
                            <div class="col-xs-4">
                                <label>Nome</label>
                                <input type="text" class="form-control" id="logradouro" placeholder="Nome">
                            </div>
                            
                             <div class="col-xs-6">
                                <label>Sobrenome</label>
                                <input type="text" class="form-control" placeholder="Sobrenome">
                            </div>
                            
                            <div class="col-xs-2">
                                <label>Número</label>
                                <input type="text" class="form-control" placeholder="Número">
                            </div>
                            
                            <div class="col-xs-2">
                                <label>CPF/CNPJ</label>
                                <input type="text" class="form-control" placeholder="CPF/CNPJ">
                            </div>
                            
                            <div class="col-xs-2">
                              <label class="col-md-4 control-label" for="uf">UF</label>
                                <select id="sexo" name="sexo" class="form-control">
                                  <option value="F">Estado</option>
                                  <option value="M">Masculino</option>
                                </select>
                              </div>
        
                             <div class="col-xs-4">
                                <label>CEP</label>
                                <input type="text" class="form-control" id="complemento" placeholder="CEP">                               
                            </div>
                            
                            <div class="col-xs-3">
                                <label>Cidade</label>
                                <input type="text" class="form-control" id="cidade" placeholder="Cidade">                               
                            </div>
                            
                                 <div class="col-xs-4">
                                <label>Endereco</label>
                                <input type="text" class="form-control" placeholder="Endereço">
                            </div>
                            
                            <div class="col-xs-2">
                              <label class="col-md-4 control-label" for="tp">Pessoa</label>
                                <select id="sexo" name="sexo" class="form-control">
                                  <option value="E">Escolha</option>
                                  <option value="F">Física</option>
                                  <option value="J">Jurídica</option>
                                </select>
                              </div>
        
                      
                                 <div class="col-xs-3">
                                <label>Bairro</label>
                                <input type="text" class="form-control" id="bairro" placeholder="Bairro">                               
                            </div>
                            
                                  
                        
                              
                                 <div class="col-xs-3">
                                <label>Telefone</label>
                                <input type="text" class="form-control" id="telefone" placeholder="Telefone">                               
                            </div>
                            
                               <div class="col-xs-3">
                                <label>Celular</label>
                                <input type="text" class="form-control" id="celular" placeholder="(XX)XXXXX-XXXX">                               
                            </div>
                            
                               <div class="col-xs-4">
                                <label>E-mail</label>
                                <input type="text" class="form-control" id="E-mail" placeholder="E-mail">                               
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
		<!-- panel-group -->               
        </div>
        
		<br/>
        <button type="submit" class="btn-sample">Confirmar</button>
        <button type="submit" class="btn-danger">Voltar</button>
		
        </form>
	</div>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>