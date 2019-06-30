<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>TimeTables</title>
    <!-- Bootstrap core CSS-->
    <link rel="stylesheet" href="/back/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="/back/view/css/main.css">
    <link rel="stylesheet" href="/back/view/css/icons.css">
    <link rel="stylesheet" href="/back/view/css/all.css">
    <!-- Custom styles for this template-->
    <style>
        
    </style>
</head>

<body class="fixed-nav sticky-footer bg-dark" id="page-top">
    <!-- Navigation-->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <a class="navbar-brand" href="/back">TimeTables</a>
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav navbar-sidenav" id="exampleAccordion">
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Dashboard">
                    <a class="nav-link" href="index.html">
                        <i class="fa fa-fw fa-dashboard"></i>
                        <span class="nav-link-text">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseComponents" data-parent="#exampleAccordion">
                        <i class="fa fa-fw fa-wrench"></i>
                        <span class="nav-link-text">Mantenimientos</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseComponents">
                        <li>
                            <a href="/back/upkeeps/employee">Empleados</a>
                        </li>
                        <li>
                            <a href="cards.html">Cards</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Components">
                    <a class="nav-link nav-link-collapse collapsed" data-toggle="collapse" href="#collapseHorarios" data-parent="#exampleAccordion">
                        <i class="far fa-fw fa-clock"></i>
                        <span class="nav-link-text">Horarios</span>
                    </a>
                    <ul class="sidenav-second-level collapse" id="collapseHorarios">
                        <li>
                            <a href="/back/process/employee">Empleados</a>
                        </li>
                        <li>
                            <a href="/back/process/tmtbweekly">H. Semanales</a>
                        </li>
                        <li>
                            <a href="/back/process/tmtbvalid">Vigente</a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item" data-toggle="tooltip" data-placement="right" title="Link">
                    <a class="nav-link" href="/../">
                        <i class="fa fa-fw fa-link"></i>
                        <span class="nav-link-text">WebSite</span>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav sidenav-toggler">
                <li class="nav-item">
                    <a class="nav-link text-center" id="sidenavToggler">
                        <i class="fa fa-fw fa-angle-left"></i>
                    </a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" id="nameManager">
                        <i class="fas fa-user-tie mr-1"></i>
                         Hola Juan Perez!
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="modal" data-target="#exampleModal">
                    <i class="fas fa-sign-out-alt mr-1"></i>Salir</a>
                </li>

            </ul>
        </div>
    </nav>
    <div class="content-wrapper">
        <div class="container-fluid">
            <?php
            //CONSTRUIMOS EL CONTAINER
            $configurationTemplate = new ConfigurationTemplate();
            $configurationTemplate->addContainer();
            ?>
        </div>
    </div>
    <!-- /.container-fluid-->
    <!-- /.content-wrapper-->
    <footer class="sticky-footer">
        <div class="container">
            <div class="text-center">
                <small>Copyright © Your Website 2018</small>
            </div>
        </div>
    </footer>
    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fa fa-angle-up"></i>
    </a>
    <!-- Logout Modal-->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Listo para salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Salir" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-sm btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <button class="btn btn-sm btn-danger" type="button" id="btnSalir">Salir</button>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="/back/view/js/bootstrap-native-v4.js"></script>
    <script type="text/javascript" src="/back/view/js/main.js"></script>
    <script type="text/javascript" src="/back/view/js/Alert.js"></script>
    <script type="text/javascript" src="/back/view/js/Pagination.js"></script>
    <script type="text/javascript" src="/back/view/js/session.js"></script>
    <?php
    $configurationTemplate = new ConfigurationTemplate();
    $configurationTemplate->addScripts();
    ?>
</body>

</html>