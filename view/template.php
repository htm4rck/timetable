<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>.::Timetables-App::.</title>
    <link rel="icon" href="img/favicon.png">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="/back/view/css/bootstrap.min.css">
    <link rel="stylesheet" href="/back/view/css/all.css">
    <link rel="stylesheet" href="/back/view/css/icon.css">
    <link rel="stylesheet" href="/view/css/style.css">
</head>

<body>
    <!--::header part start::-->
    <header class="main_menu home_menu">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <nav class="navbar navbar-expand-lg navbar-light">
                        <a class="navbar-brand" href="/"> <img src="/view/img/logo.png" alt="logo"> </a>
                        <button class="navbar-toggler text-white" type="button" data-toggle="collapse"
                            data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-ellipsis-v"></i>
                        </button>

                        <div class="collapse navbar-collapse main-menu-item" id="navbarSupportedContent">
                            <ul class="navbar-nav">
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Inicio</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Comunicados</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="/">Contacto</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </header>
    <!-- Header part end-->

    <!-- banner part start-->
    <section class="banner_part">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-6">

                    <div class="banner_text">
                        <div class="banner_text_iner">
                            <h5>TimeTables-App</h5>
                            <h1>By HappyLand</h1>
                            <p>Una herramienta que se adapta al contexto laboral actual;
                                permite a los empleados revisar su carga de tiempo y
                                organizar tareas.
                                Así es posible una gestión innovadora, con horarios flexibles,
                                pero con una buena supervisión.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- banner part start-->

    <!-- about part start-->
    <section class="about_part">
        <div class="container-fluid">
            <div class="row align-items-center">
                <?php
                //CONSTRUIMOS EL CONTAINER
                $configurationTemplate = new ConfigurationTemplate();
                $configurationTemplate->addContainer();
            ?>
            </div>
        </div>
    </section>
    <!-- about part end-->
    <!-- footer part start-->
    <footer class="footer-area">
        <div class="container">
            <div class="row justify-content-between">
                <div class="col-xl-6 col-sm-6 col-lg-4">
                    <div class="single-footer-widget footer_1">
                        <h4>Nosotros</h4>
                        <p>Somos la cadena de centros de entretención familiar líder en Latinoamérica,
                            con más de 25 años de experiencia y 90 locales ubicados en los principales
                            centros comerciales de Chile, Perú, Colombia y México. </p>
                        <button id="btnBack" class="btn btn-sm btn-warning" onclick="goBack()"><i
                                class="fas fa-sign-in-alt"></i></button>
                        <script>
                            function goBack() {
                                window.location = '/back';
                            }
                        </script>
                    </div>
                </div>
                <div class="col-xl-6 col-sm-6 col-lg-6">
                    <div class="single-footer-widget footer_2">
                        <h4>Contactanos</h4>
                        <div class="contact_info">
                            <span class="ti-home"></span>
                            <h5>HappyLand - Chiclayo</h5>
                            <p> Av. Andres Avelino Caceres 222, Chiclayo 14008</p>
                        </div>
                        <div class="contact_info">
                            <span class="ti-headphone-alt"></span>
                            <h5>+51 999 999 999</h5>
                            <p>Lunes a Domingo 9am a 6 pm.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyright_part">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <p class="footer-text m-0">
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                            Copyright &copy;<script>
                                document.write(new Date().getFullYear());
                            </script> All rights reserved | Diseñado por <i class="fa fa-heart-o"
                                aria-hidden="true"></i> by <a href="https://marc-vilchez.herokuapp.com"
                                target="_blank">Master</a>
                            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- footer part end-->
    <script src="/back/view/js/bootstrap-native-v4.js"></script>
    <script src="/back/view/js/Alert.js"></script>
    <script src="/back/view/js/main.js"></script>
    <script src="/view/js/custom.js"></script>
    <?php
    $configurationTemplate = new ConfigurationTemplate();
    $configurationTemplate->addScripts();
    ?>
    <script>
        //alert(window.innerWidth);
    </script>
</body>

</html>