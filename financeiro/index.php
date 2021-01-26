<?php
require_once "../Control/conexao.php";
@session_start();
$pagina1="Contrato";
    $pagina2="paginas";
    $pagina3="cadastros";
    
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
<link rel="shortcut icon" href="../image/logo.png">
    <title>Painel Administrativo</title>
    
  <!-- Bootstrap core JavaScript-->
  <script  src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

                    <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

                    <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js" defer></script>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Administrativo</div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-fw fa-tachometer-alt"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Contratos</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?opcao=<?=$pagina2?>&tipo=lista">Contratos Assinados</a>    
                        <a class="collapse-item" href="index.php?opcao=<?=$pagina1?>&tipo=contrato_cliente">Assinar Contrato</a>    
                        <a class="collapse-item" href="index.php?opcao=<?=$pagina1?>&tipo=contrato_visual">Visualizar Contrato</a>  
                         <a class="collapse-item" href="index.php?opcao=<?=$pagina2?>&tipo=enviarEmail">Enviar E-mail</a> 
                    </div>
                </div>
            </li>
             <!-- Nav Item - Pages Collapse Menu -->
             <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseCad" aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-fw fa-cog"></i>
                    <span>Cadastros</span>
                </a>
                <div id="collapseCad" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="index.php?opcao=<?=$pagina3?>&tipo=turmas">Turmas</a>    
                        <a class="collapse-item" href="index.php?opcao=<?=$pagina3?>&tipo=professores">Professores</a>    
                        <a class="collapse-item" href="index.php?opcao=<?=$pagina3?>&tipo=estudantes">Estudantes</a>  
                         <a class="collapse-item" href="index.php?opcao=<?=$pagina3?>&tipo=disciplinas">Disciplinas</a> 
                         <a class="collapse-item" href="index.php?opcao=<?=$pagina3?>&tipo=bimestres">Bimestres</a> 
                    </div>
                </div>
            </li>

            <!-- Nav Item - Utilities Collapse Menu -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
                    <i class="fas fa-fw fa-wrench"></i>
                    <span>Relatórios</span>
                </a>
                <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <h6 class="collapse-header"></h6>
                        <a class="collapse-item" href="utilities-color.html">Financeiro</a>
                        <a class="collapse-item" href="utilities-border.html">Relatorios</a>
                        <a class="collapse-item" href="utilities-animation.html">Animations</a>
                        <a class="collapse-item" href="utilities-other.html">Other</a>
                    </div>
                </div>
            </li>
            


            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

            <!-- Sidebar Message -->


        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    
                    <!-- Topbar Search -->
                    <form class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <!-- <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2"> -->
                            <div class="input-group-append">
                                <!-- <h1></h1> -->
                                <!-- <button class="btn btn-primary" type="button"> -->
                                    <!-- <i class="fas fa-search fa-sm"></i> -->
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                 <?php $busca_contratos= $pdo->query("SELECT * FROM mural_tesouraria order by id_mural_tesouraria desc ");
                                 $busca_contratos=$busca_contratos->fetchAll(PDO::FETCH_ASSOC);
                                 $count=count($busca_contratos);
                                 ?>
                                <span class="badge badge-danger badge-counter"><?=$count?>+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <?php for ($i=0; $i < 3; $i++) { 
                                    # code...?>
                                
                                  <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                <div>
                                        <div class="small text-gray-500"><?=@$busca_contratos[$i]['data'];?></div>
                                        <span class="font-weight-bold"><?=@$busca_contratos[$i]['titulo'];?></span>
                                    </div>
                                </a>
                                <?php } ?>
                                
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <!-- <span class="badge badge-danger badge-counter">7</span> -->
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                               
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?=$_SESSION['nome']?></span>
                                <img class="img-profile rounded-circle" src="img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                               
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="../config.php?acao=quebra">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i> Logout
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">



                    <!-- Page Heading -->
                    <?php if(!@$_GET['tipo']){?>
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Painel de Controle</h1>
                    <?php }?>
                    </div>

                    <!-- Content Row -->
                    <!-- <div class="row"> -->

                    <!-- Earnings (Monthly) Card Example -->
                    <?php if(!@$_GET['opcao']){?>
                    <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                            <a href="index.php?opcao=<?=$pagina2?>&tipo=lista">
                            <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Contratos Assinados</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$count?></div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                        
                                    </div>
                                </div>
                            </div>
                            </a>    
                        </div>

    </div>
                    <?php }
                     switch(@$_GET['opcao'])
                            {
                                case $pagina1:
                                    switch (@$_GET['tipo']) {
                                        case 'contrato_cliente':
                                            echo "<script>window.open('../Contrato/contrato_fornecedor.php', '_blank');</script>";
                                            
                                            // include_once($pagina1."/".$_GET['tipo'].'.php');
                                            break;
                                        
                                        case 'contrato_visual':
                                            # code...
                                            // include_once($pagina1."/".$_GET['tipo'].'.php');
                                           
                                            echo "<script>window.open('../Contrato/contrato.php', '_blank');</script>";
                                            break;
                                      
                                    }
                                   
                                break;
                                case $pagina2:
                                    switch (@$_GET['tipo']){
                                        case 'lista':
                                            # code...
                                            include_once($pagina2."/".$_GET['tipo'].'.php');
                                            break;
                                        case 'enviarEmail':
                                                # code...
                                                include_once($pagina2."/".$_GET['tipo'].'.php');
                                            break;
                                    }
                                break;
                                case $pagina3:
                                    switch (@$_GET['tipo']){
                                        case 'turmas':
                                            include_once($pagina3."/".$_GET['tipo'].'.php');
                                        break;
                                        case 'professores':
                                            include_once($pagina3."/".$_GET['tipo'].'.php');
                                        break;
                                        case 'estudantes':
                                            include_once($pagina3."/".$_GET['tipo'].'.php');
                                        break;
                                        case 'disciplinas':
                                            include_once($pagina3."/".$_GET['tipo'].'.php');
                                        break;
                                        case 'bimestres':
                                            include_once($pagina3."/".$_GET['tipo'].'.php');
                                        break;
                                    }
                               
                                
                            }

                        // if($_GET['opcao']==$pagina1){
                            
                        // }
                    ?>





                  
</body>

</html>

