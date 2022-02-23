<?php  $cards = $parametros['card']; $emisor = $parametros['emisor'];  ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Emisor</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
          integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="./css/layout.css" rel="stylesheet" />
</head>

<body>
<div id="fb-root"></div>
<script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/es_ES/sdk.js#xfbml=1&version=v9.0&appId=220855171284916&autoLogAppEvents=1"
        nonce="4cUG8Msg"></script>

<div class="App">
<?php include __DIR__.'/../views/header.php'; ?>


    <!-- Main Container -->
    <div class="main-container emisor">
        <div class="card-cover-img">
            <div class="card-cover-img-overlay" id="datosEmisor">
                <div class="card-brand">
                    <img src="images/emisorImg/logos/<?php echo $emisor->logo; ?>" width="100" height="35" alt="Card Brand Image" />
                </div>
                <h1>Tarjetas de crédito <?php echo $emisor->nombre; ?> </h1>
                <p>
                <?php echo $emisor->descripcion; ?>
                </p>
            </div>
        </div>

        <div class="container">
            <div class="recommended-cards-group" id="cardsEmisor">
                <h3 class="lbl-bold text-align-center main-title">Tarjetas <?php echo $emisor->nombre; ?></h3>
                <?php foreach($cards as $card): ?>
                    <div class="recommended-card custom-card">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="custom-card-image">
                                    <img src="./images/cardsImg/<?php echo $card['imagen']; ?>" />
                                </div>
                                <div class="custom-card-buttons d-none d-md-block">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-9 custom-card-info">
                                <h1><?php echo $card['nombre']; ?></h1>
                                <div class="custom-card-buttons d-md-none">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                                </div>
                                <div class="row no-gutters card-features">
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Tipo</h6>
                                        <p class="d-none d-md-block">
                                          <?php echo $card['tipo']; ?>
                                        </p>
                                        <p class="d-md-none">
                                            <?php echo $card['tipo']; ?>
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Uso</h6>
                                        <p class="d-none d-md-block">
                                            <?php echo $card['uso']; ?>
                                        </p>
                                        <p class="d-md-none">
                                            <?php echo $card['uso']; ?>
                                        </p>
                                    </div>
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Cashback</h6>
                                        <p>
                                            <?php echo ($card['cashback'] ? 'Si' : 'No'); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="card-details">
                                    <p>
                                        <i class="fa fa-check"></i>
                                        <?php echo $card['costo_de_emision']; ?>
                                    </p>
                                    <p>
                                        <i class="fa fa-check"></i>
                                        <?php echo $card['costo_primer_anio']; ?>
                                    </p>
                                    <div class="show-more-details">
                                        <a href="javascript:void(0)" class="show-more-lnk">
                                            Show More
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <div class="more-details">
                                            <p>
                                                <i class="fa fa-check"></i>
                                                No penalty APR. Paying late won't automatically raise your interest rate
                                                (APR). Other account pricing and terms apply
                                            </p>
                                            <p>
                                                <i class="fa fa-check"></i>
                                                Contactless Cards - The security of a chip card, with the convenience of
                                                a
                                                tap
                                            </p>
                                            <p>
                                                <i class="fa fa-check"></i>
                                                Access your FICO® Score for free within Online Banking or your Mobile
                                                Banking app
                                            </p>
                                        </div>
                                        <a href="javascript:void(0)" class="show-less-lnk d-none">
                                            Show Less
                                            <i class="fa fa-angle-up"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>
        <div class="spacer-50"></div>
    </div>
    <!--- End Main Container -->

    <!-- Footer -->
    <div class="container-fluid">
        <div class="footer-email-section row">
            <div class="col-12 col-md-12 col-lg-2"></div>
            <div class="col-12 col-md-12 col-lg-8 email-section-body text-align-center">
                <h1>Stay on top of industry trends and new offers with our weekly newsletter.</h1>
                <form id="email-form">
                    <input type="email" class="email" placeholder="Enter your email address" />
                    <input type="button" class="subscribe" value="Subscribe" />
                </form>
            </div>
            <div class="col-12 col-md-12 col-lg-2"></div>
        </div>
    </div>
    <footer>
        <div class="container">
            <div class="row no-gutters">
                <div class="col-12 col-md-4 logo-section">
                    <a href="#" class="logo">Tarjetas de Credito.com.uy</a>
                    <div class="follow-us-section">
                        <div class="fb-page" data-href="https://www.facebook.com.com.uy/"
                             data-tabs="" data-width="350" data-height="50" data-small-header="true"
                             data-adapt-container-width="false" data-hide-cover="true" data-show-facepile="false">
                            <blockquote cite="https://www.facebook.com.com.uy/"
                                        class="fb-xfbml-parse-ignore"><a
                                    href="https://www.facebook.com.com.uy/">Tarjetas de Crédito
                                    Uruguay</a></blockquote>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-3">
                    <h3>La Empresa</h3>
                    <ul>
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Novedades</a></li>
                        <li><a href="#">Prensa</a></li>
                        <li><a href="#">Empleos</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-3">
                    <h3>Contacto</h3>
                    <ul>
                        <li><a href="#">Atencion al cliente</a></li>
                        <li><a href="#">publicadad & acuerdos</a></li>
                        <li><a href="#">Contactanos</a></li>
                    </ul>
                </div>
                <div class="col-12 col-md-2">
                    <h3>La Empresa</h3>
                    <ul>
                        <li><a href="#">Sobre nosotros</a></li>
                        <li><a href="#">Novedades</a></li>
                        <li><a href="#">Prensa</a></li>
                        <li><a href="#">Empleos</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a429ba45aa.js" crossorigin="anonymous"></script>
<script src="public/js/EmisoresPublic.js"></script>
</body>

</html>