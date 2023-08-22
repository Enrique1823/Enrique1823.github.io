<?php
include("admin/bd.php");
$sentencia=$conexion->prepare("SELECT * FROM `recetas_normales`");
$sentencia->execute();
$lista_recetas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM `recetas_desplegable`");
$sentencia->execute();
$lista_recetas_desplegable=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM `tbl_entradas`");
$sentencia->execute();
$lista_entradas=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM `tbl_equipo`");
$sentencia->execute();
$lista_equipo=$sentencia->fetchAll(PDO::FETCH_ASSOC);

$sentencia=$conexion->prepare("SELECT * FROM `tbl_configuraciones`");
$sentencia->execute();
$lista_configuraciones=$sentencia->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>MODERN-KITCHEN</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/logoapp.png" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />
    </head>
    <body id="page-top">
        <!-- Navigation-->
        <nav class="navbar navbar-expand-lg navbar-dark fixed-top" id="mainNav">
            <div class="container">
              <!--  <a class="navbar-brand" href="#page-top"><img src="assets/img/descarga.png
                "  alt="..." /></a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu desplegable
                    <i class="fas fa-bars ms-1"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">
                    <ul class="navbar-nav text-uppercase ms-auto py-4 py-lg-0">
                        <li class="nav-item"><a class="nav-link" href="#services">ICONOS</a></li>
                        <li class="nav-item"><a class="nav-link" href="#portfolio">RECETAS</a></li>
                        <li class="nav-item"><a class="nav-link" href="#about">RECETAS CORTAS</a></li>
                        <li class="nav-item"><a class="nav-link" href="#team">EQUIPO</a></li>
                        <li class="nav-item"><a class="nav-link" href="#contact">CONTACTO</a></li>
                        <li class="nav-item"><a class="nav-link" href="login.php">CERRAR SESIÓN</a></li>
                      
                    </ul>
                </div>
            </div>
        </nav>


        <header class="masthead">
            <div class="container">
                <div class="masthead-subheading"> <?php echo $lista_configuraciones[0]['valor'];?></div>
                <div class="masthead-heading text-uppercase"><?php echo $lista_configuraciones[1]['valor'];?></div>
                <a class="btn btn-primary btn-xl text-uppercase" href="#<?php echo $lista_configuraciones[3]['valor'];?>"><?php echo $lista_configuraciones[2]['valor'];?></a>
            </div>
        </header>


        <section class="page-section" id="services">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[4]['valor'];?></h2>
          
                </div>
                <div class="row text-center"> 
                <?php foreach($lista_recetas as $registros){ ?>
                    <div class="col-md-4">

                        <span class="fa-stack fa-4x">
                            <i class="fas fa-circle fa-stack-2x text-success"></i>
                            <i class="fas <?php echo $registros["icono"];?> fa-stack-1x fa-inverse"></i>
                        </span>
                        <h4 class="my-3"><?php echo $registros["titulo"];?></h4>
                        <p class="text-muted"> <?php echo $registros["descripcion"];?></p>
                    </div>
                <?php } ?>

                   

                </div>
            </div>
        </section>
      


        <section class="page-section bg-light" id="portfolio">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[5]['valor'];?></h2>
                        <br/>
                </div>
                <div class="row">

                <?php foreach($lista_recetas_desplegable as $registros){ ?>

                    <div class="col-lg-4 col-sm-6 mb-4">
                        <div class="portfolio-item">
                            <a class="portfolio-link" data-bs-toggle="modal" href="#portfolioModal1<?php echo $registros["ID"];?>">
                                <div class="portfolio-hover">
                                    <div class="portfolio-hover-content"><i class="fas fa-plus fa-3x"></i></div>
                                </div>
                                <img class="img-fluid" src="assets/img/portfolio/<?php echo $registros["imagen"];?>" alt="..." />
                            </a>
                            <div class="portfolio-caption">
                                <div class="portfolio-caption-heading"><?php echo $registros["titulo"];?></div>
                                <div class="portfolio-caption-subheading text-muted"><?php echo $registros["subtitulo"];?></div>
                            </div>
                        </div>
                    </div>




                    <div class="portfolio-modal modal fade" id="portfolioModal1<?php echo $registros["ID"];?>"" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="close-modal" data-bs-dismiss="modal"><img src="assets/img/close-icon.svg" alt="Close modal" /></div>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-8">
                                <div class="modal-body">
                                    <h2 class="text-uppercase"><?php echo $registros["titulo"];?></h2>
                                    <p class="item-intro text-muted"><?php echo $registros["subtitulo"];?></p>
                                    <img class="img-fluid d-block mx-auto" src="assets/img/portfolio/<?php echo $registros["imagen"];?>" alt="..." />
                                    <p>INGREDIENTES:<BR/> <br/> <?php echo $registros["ingredientes"];?></p>
                                    <p>PREPARAMIENTO:<br/> <br/> <?php echo $registros["descripcion"];?></p>
                                  
                                    <ul class="list-inline">
                                        
                                    <button class="btn btn-primary btn-xl text-uppercase" data-bs-dismiss="modal" type="button">
                                        <i class="fas fa-xmark me-1"></i>
                                        Cerrar receta
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                    <?php } ?>
                </div>

            </div>
        </section>

        <section class="page-section" id="about">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[6]['valor'];?></h2>
                    
                </div>        
                <ul class="timeline">

                <?php
                $contador=1;
                foreach($lista_entradas as $registros){ 
                    
                    ?>
                    <li <?php echo( ($contador%2)==0)?'class="timeline-inverted"':""?>>
                        <div class="timeline-image"><img class="rounded-circle img-fluid" src="assets/img/about/<?php echo $registros['imagen'];?>" alt="..." /></div>
                        <div class="timeline-panel">
                            <div class="timeline-heading">
                    
                                <h4 class="subheading"><?php echo $registros['titulo'];?></h4>
                            </div>
                            </br> INGREDIENTES:
                            <div class="timeline-body"><p class="text-muted"><?php echo $registros['ingredientes'];?></p></div>
                </br> PREPARAMIENTO:
                <div class="timeline-body"><p class="text-muted"><?php echo $registros['Preparamiento'];?></p></div>
                        </div>
                    </li>
                    <?php $contador++;   
                 } ?>

                    <li class="timeline-inverted">
                        <div class="timeline-image">
                            <h4> </br>
                            <?php echo $lista_configuraciones[7]['valor'];?>
                            </h4>
                        </div>
                    </li>              
                </ul>
            </div>
        </section>
        <!-- Team-->
        <section class="page-section bg-light" id="team">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[8]['valor'];?></h2>
                </div>
                <div class="row">

                 

                <?php foreach($lista_equipo as $registros){ ?>

                    <div class="col-lg-4">
                        <div class="team-member">
                            <img class="mx-auto rounded-circle" src="assets/img/team/<?php echo $registros['imagen'];?>" alt="..." />
                            <h4> <?php echo $registros['nombreCompleto'];?></h4>
                            <p class="text-muted"> <?php echo $registros['puesto'];?></p>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros['twitter'];?>" aria-label="Parveen Anand Twitter Profile"><i class="fab fa-twitter"></i></a>
                            <a class="btn btn-dark btn-social mx-2" href="<?php echo $registros['facebook'];?>" aria-label="Parveen Anand Facebook Profile"><i class="fab fa-facebook-f"></i></a>

                        </div>
                    </div>



                    <?php } ?>

                </div>




                <div class="row">
 
                </div>
            </div>
        </section>
       
        <!-- Contact-->
        <section class="page-section" id="contact">
            <div class="container">
                <div class="text-center">
                    <h2 class="section-heading text-uppercase"><?php echo $lista_configuraciones[9]['valor'];?></h2>
                    <h3 class="section-subheading text-muted"><?php echo $lista_configuraciones[12]['valor'];?></h3>
                    </div>

            </div>
        </section>
        <!-- Footer-->
        <footer class="footer py-4">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-lg-4 text-lg-start">Copyright &copy; Modern Kitchen 2023</div>
                    <div class="col-lg-4 my-3 my-lg-0">
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones[10]['valor'];?>" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                        <a class="btn btn-dark btn-social mx-2" href="<?php echo $lista_configuraciones[11]['valor'];?>" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>

                    </div>
                    <div class="col-lg-4 text-lg-end">
                        <a class="link-dark text-decoration-none me-3" href="#!">Privacy Policy</a>
                        <a class="link-dark text-decoration-none" href="#!">Terms of Use</a>
                    </div>
                </div>









































                

            </div>
        </footer>
      
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>



       
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="js/scripts.js"></script>
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <!-- * *                               SB Forms JS                               * *-->
        <!-- * * Activate your form at https://startbootstrap.com/solution/contact-forms * *-->
        <!-- * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *-->
        <script src="https://cdn.startbootstrap.com/sb-forms-latest.js"></script>
    </body>
</html>
