<!DOCTYPE html>
<style>
	input[type=number]::-webkit-inner-spin-button { 
    -webkit-appearance: none;
    cursor:pointer;
    display:block;
    width:8px;
    color: #333;
    text-align:center;
    position:relative;
}
   input[type=number] { 
   -moz-appearance: textfield;
   appearance: textfield;
   margin: 0; 
}


</style>
<html lang=pt-br>
	<head>
		  <title> 	</title>
		  <meta name="viewport" content="width=device-width, initial-scale=1" />
		  
		  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
		  <link rel="stylesheet" type="text/css" href="estilo.css" />
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
<body class="container">

<?php

include_once("conexaoPG.php");



?>
<h1 align="center"> Dados do Participante </h1>

<?php
if(!@($conexao=pg_connect("host=$host dbname=$dbname port=$porta user=$user password=$passw"))) {
    print "Não foi possível estabelecer uma conexão com o banco de dados.";
 } else { 
    $sql = "SELECT str_nome_inscrito, num_codigo_inscrito, num_cpf_inscrito FROM tb_inscrito where cod_prova = 11 order by str_nome_inscrito asc"; 
    $result = pg_exec($conexao, $sql); 
  
    /* Escreve resultados até que não haja mais linhas na tabela */ 
    
    
 $sqli = "SELECT count(*) as total from tb_inscrito where cod_prova = 11"; 
$resultando = pg_exec($conexao, $sqli); 

for($i=0; $consultando = @pg_fetch_array($resultando, $i); $i++) { 
echo '<html><body><b>TOTAL DE INSCRITOS: '.$consultando['total'].'</b>';


}








    for($i=0; $consulta = @pg_fetch_array($result, $i); $i++) { }

?>


 <div>
     <table class="table table-bordered table-striped">
    
         <tr>
             <th>Inscrito</th>
             <th>Codigo De Inscrição</th>
             <th>CPF</th>
             <th>Gerar Folhas</th>
             

             <form action="certificadosPDF.php" method="POST" target="_blank">
                

                 <td>
                 <select name="intervalos">
                            <option value="1595~1644">1~50</option>
                            <option value="1645~1694">51~100</option>
                            <option value="1695~1744">101~150</option>
                            <option value="1745~1794">151~200</option>
                            <option value="1795~1844">201~250</option>
                            <option value="1845~1894">251~300</option>
                        </select>
                 
                 <button type="submit" class="btn btn-danger" >GERAR LOTE</button></td>
                 <input type="hidden" value="geral" name="gerar">
             
             </form>


<?php
             for($i=0; $consulta = @pg_fetch_array($result, $i); $i++) { 
             
       
       
       ?>
         <form action="certificadosPDF.php" method="POST" target="_blank">
             <tr>
                 <td><?php print " $consulta[str_nome_inscrito]";?> </td>
                 <td><?php print " $consulta[num_codigo_inscrito]";?> </td>
                 <td><?php print " $consulta[num_cpf_inscrito]";?></td>
                 
                
                 <td><button type="submit" class="btn btn-primary" >GERAR</button></td>
                
                 
                 
             
             </tr>
             <input type="hidden" value="<?php print " $consulta[str_nome_inscrito]"?>" name="nome">
             <input type="hidden" value="<?php print " $consulta[num_cpf_inscrito]"?>" name="cpf">
             <input type="hidden" value="<?php print " $consulta[num_codigo_inscrito]"?>" name="num_codigo_inscrito">	
             <input type="hidden" value="especifica" name="gerar">
             
             </form>

<?php
} }



pg_close($conexao); 












 
?>