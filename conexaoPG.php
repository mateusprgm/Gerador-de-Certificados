<?php

$host = "";
$porta = "";
$dbname = "";
$user = "";
$passw = "";



if(!@($conexao=pg_connect("host=$host dbname=$dbname port=$porta user=$user password=$passw"))) {
    print "Não foi possível estabelecer uma conexão com o banco de dados.";
 } else { 
  //  $sql = "SELECT str_nome_inscrito FROM tb_inscrito"; 
  //  $result = pg_exec($conexao, $sql); 
  
    /* Escreve resultados até que não haja mais linhas na tabela */ 
//  for($i=0; $consulta = @pg_fetch_array($result, $i); $i++) { 
 //      echo " $consulta[str_nome_inscrito]<br>"; 
  //  } 
 //   pg_close($conexao); 
 }



?>