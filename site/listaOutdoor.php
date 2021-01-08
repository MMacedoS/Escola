<?php include_once 'topo.php';
 
 $dados=$p->buscarOutdoors();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>lista de Outdoor</title>

    <style>
        .lista {
        margin: 70px 0 0 0;
        }
        #customers {
            font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 97%;
        }
        #button {
            margin: 0px !important;
            width:50px !important;
        }
        
        #customers td, #customers th {
            border: 1px solid #ddd;
            padding: 8px;
        }
        #customers th {
            width:2%;
        }
        
        #customers tr:nth-child(even){background-color: #f2f2f2;}
        
        #customers tr:hover {background-color: #ddd;}
        
        #customers th {
            padding-top: 12px;
            padding-bottom: 12px;
            text-align: left;
            background-color: #4CAF50;
            color: white;
        }
    </style>
</head>
<body>
<div class="lista">
        <h2>Lista dos Outdoors</h2>

    <table id="customers">
       <tr>        
            <th>Nome</th>
            <th>Link</th>
            <th>Status</th>
            <th>titulo</th>
            <th colspan="2">Ação</th>
        </tr>
        <?php foreach($dados as $key=>$value){?>
        <tr>
            <td><?=$value['nome_album']?></td>
            <td><?= substr($value['link'],0,15).'...'?></td>
            <td><?=$value['status']?></td>
            <td><?=$value['titulo']?></td>
            <td><a href="listaOutdoor.php?edita=<?=$value['id_album']?>"><img width="30px" src="../image/ico-editar.png" alt="editar"></a></td>
            <td><a href="listaOutdoor.php?deleta=<?=$value['id_album']?>"><img width="30px" src="../image/deleta.png" alt="deleta"></a></td>            
        </tr>
        <?php
    } ?>
    </table>

    </div>
</body>
</html>

<?php 
    if(isset($_GET['deleta']))
    {   
        $id=$_GET['deleta'];
        $deleta=$pdo->prepare('DELETE FROM album WHERE id_album=:id');
        $deleta->bindValue(':id',$id);
        $deleta->execute();
         if($deleta){  
        echo "<script>window.location='listaOutdoor.php';</script>";
         }
    }
?>