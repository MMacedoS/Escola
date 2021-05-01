<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="initial-scale=1.0, maximum-scale=1.0, width=device-width">
<title>Minhas Notas</title>
<link rel="shortcut icon" href="../image/logo.png">
<link rel="stylesheet" type="text/css" href="css/minhas_notas.css"/>
<link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css"/>
<style>
    .col, .col-1, .col-10, .col-11, .col-12, .col-2, .col-3, .col-4, .col-5, .col-6, .col-7, .col-8, .col-9, .col-auto, .col-lg, .col-lg-1, .col-lg-10, .col-lg-11, .col-lg-12, .col-lg-2, .col-lg-3, .col-lg-4, .col-lg-5, .col-lg-6, .col-lg-7, .col-lg-8, .col-lg-9, .col-lg-auto, .col-md, .col-md-1, .col-md-10, .col-md-11, .col-md-12, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-auto, .col-sm, .col-sm-1, .col-sm-10, .col-sm-11, .col-sm-12, .col-sm-2, .col-sm-3, .col-sm-4, .col-sm-5, .col-sm-6, .col-sm-7, .col-sm-8, .col-sm-9, .col-sm-auto, .col-xl, .col-xl-1, .col-xl-10, .col-xl-11, .col-xl-12, .col-xl-2, .col-xl-3, .col-xl-4, .col-xl-5, .col-xl-6, .col-xl-7, .col-xl-8, .col-xl-9, .col-xl-auto {
    position: unset !important;
}
       .customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        .text-overflow-dynamic-container {
    position: relative;
    max-width: 100%;
    padding: 0 !important;
    display: -webkit-flex;
    display: -moz-flex;
    display: flex;
    vertical-align: text-bottom !important;
}
.text-overflow-dynamic-ellipsis {
    position: absolute;
    white-space: nowrap;
    overflow-y: visible;
    overflow-x: hidden;
    text-overflow: ellipsis;
    -ms-text-overflow: ellipsis;
    -o-text-overflow: ellipsis;
    max-width: 100%;
    min-width: 0;
    width:100%;
    top: 0;
    left: 0;
}
.text-overflow-dynamic-container:after,
.text-overflow-dynamic-ellipsis:after {
    content: '-';
    display: inline;
    visibility: hidden;
    width: 0;
}

        .diminuir {
          display: block;
          white-space: normal;
          overflow: hidden;
          text-overflow: ellipsis;
          height: 40px;          
          
        }
        #button {
            margin: 0px !important;
            width:50px !important;
        }
        
        .customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .customers th {
            width:10%;
        }
        textarea {
            width: 100%!important;
            height: 50px!important;
            padding: 10px!important;
            
        }
        
        .customers tr:nth-child(even){background-color: #f2f2f2;}
        
        .customers tr:hover {background-color: #ddd;}
        
        .customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: center;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>

<body>
<?php require "topo.php"; $data=date('Y');?>
<br>
<center>
<h2>Resultado Final</h2>
</center>
<?php 
	$buscaResultado=$pdo->query("SELECT r.id_resultado, r.media,l.nome,r.situacao,r.recuperacao from resultado_final r inner join disciplinas d on d.id_disciplinas=r.id_disciplinas inner join lista_disc l on l.id_lista=d.disciplina where r.code='$code'  order by l.nome asc;");
	$buscaResultado=$buscaResultado->fetchAll(PDO::FETCH_ASSOC);
?>
<br>
	<table class="customers">
		<tr>
			<th>Disciplina:</th>
			<th>Média Final</th>
			<th>Situação</th>

		</tr>

		
			<?php 
				foreach($buscaResultado as $key=>$res){
					echo '
					<tr>
					<td>'.$res['nome'].'</td>
					';
					if($res['recuperacao']>=6){
					echo '	
					<td>'.$res['recuperacao'].'</td>';
					}else{
						echo 
						'
						<td>'.number_format($res['media']/4,'1').'</td>
						';
					}
					echo'					
					<td>'.$res['situacao'].'</td>
					</tr>
					';
				}
			?>
			
		
	</table>
</body>
</html>