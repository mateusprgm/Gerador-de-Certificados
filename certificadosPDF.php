
<?php
  
  
  
    set_time_limit(999999);
	include_once("conexaoPG.php");
	
	$gerar = $_REQUEST['gerar'];
	

	if($gerar == 'especifica'){
		$nome = $_REQUEST['nome'];
		
		$cpf = $_REQUEST['cpf'];
				
		$num_codigo_inscrito = $_REQUEST['num_codigo_inscrito'];
		

		$sql = 'SELECT * FROM tb_inscrito where cod_prova = 11 and  num_codigo_inscrito = '.$num_codigo_inscrito.''; 
	}else{
		$intervalos = $_REQUEST['intervalos'];
		$intervalos = explode('~',$intervalos);

		
		
		
		$sql = 'SELECT * FROM tb_inscrito where cod_prova = 11 and cod_inscrito >= '.$intervalos[0].' and cod_inscrito <= '.$intervalos[1].'order by str_nome_inscrito ASC';
	};
	$result = pg_exec($conexao, $sql); 
	
  

	$html = "

		<html>
			<head>
				 <link rel='stylesheet' href='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css' />                                                                   
				 <script src='https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js'></script>
				 <script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js'></script>
				 <style> 
						 
					hr{border: 0.7px dashed black} 					
					
					#fonte{font-family: helvetica; font-size: 9,99px; }
						 
				 </style>
			</head>
		<body> 
			";

	
	for($j=0; $consulta = @pg_fetch_array($result, $j); $j++) 
	{ 	
		$html .= "   <header id='header'>
		
						<img src='sua_logo_aqui' style='width:720px;'>
									   
					</header>	<br><br>								
												   
					   Nome do Candidato: ".$consulta['str_nome_inscrito']."  <br>          	   
			  
					   CPF: ".$consulta['num_cpf_inscrito']."<br>
			 
					   Número de inscrição ".$consulta['num_codigo_inscrito']."
			<br>
			<hr>									   
												                                                               
			<table border=1 style='1px solid black; margin-left:-20px;'><br><br><br>
	" ;
		for($i = 31; $i <= 60; $i++)
				{
					$html.= "<tr>
								<td width='20px'style='font-size:10px; height:21px' align='center'>$i</td> <td width='730px'> </td> 
							 </tr>";
				}
		
		$html .= "	
			
			<div>
				<img src='rodape.png' style='width:300px; margin-left:-26px;padding-top:5px'>            
				<h7  align='center' style=' font-family:'Arial'  padding-right:10px '><font size='-1' ><b>Pág. 2</b></h7> 
			</div>
			</table>			
				
				<header id='header'>
		
						<img src='sua_logo_aqui_2' style='width:720px;'>
									   
					</header>	<br><br>
			
					Nome do Candidato: ".$consulta['str_nome_inscrito']."<br>         
						  
					CPF: ".$consulta['num_cpf_inscrito']."<br>
						   
					Número de inscrição ".$consulta['num_codigo_inscrito']."
									
					<br>
			<hr>
			
			<table border=1 style='1px solid black; margin-left:-20px;'><br><br><br>
					";

   for($i = 61; $i <= 90; $i++)
   {
		$html.= "<tr>
					<td width='20px' style='font-size:10px; height:21px' align='center'>$i</td> <td width='730px'> </td> 
				</tr>";
			
	}


		$html .= "
		
		

		<div>
			<img src='rodape.png' style='width:300px; margin-left:-26px;padding-top:5px'>            
			<h7  align='center' style=' font-family:'helvetica'  padding-right:10px '><font size='-1' ><b>Pág. 3</b></h7> 
		</div>

		
		</table>";
					
			};
			
			
			$html .= "
			
			</body>              
			</html>";


	

//referenciar o DomPDF com namespace
	use Dompdf\Dompdf;

	// include autoloader
	require_once("dompdf/autoload.inc.php");
	
	//
	
//Criando a Instancia 
	$dompdf = new DOMPDF();
	//modo paisagem landscape modo retrato portrait
	$dompdf->set_paper('A4','portrait');
	// Carrega seu HTML
	$dompdf->load_html($html);

	//Renderizar o html
	$dompdf->render();

	//Exibibir a página
	$dompdf->stream(
		"provas", 
		array(
			"Attachment" => false //Para realizar o download somente alterar para true
		//	"Attachment" => true
		)
	);
	
?>
