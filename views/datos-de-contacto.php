<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Datos de Contacto</title>
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


    <!-- Main container -->
    <div class="main-container contact-info">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="lbl-bold main-title">Datos de contacto de emisores de tarjetas de crédito</h1>
                    <p class="title-hint">
                        A continuación está la info de contacto de la mayoría de emisores de tarjetas de crédito en
                        Uruguay.</p>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <ul class="contact-info-list">
                        <li>
                            <h3 class="card-name">American Express</h3>
                            <p>
                                <span class="card-no">1-800-528-4800</span><br />
                                <a href="#" class="card-service-link">
                                    American Express Customer Service
                                </a>
                            </p>
                        </li>
                        <li>
                            <h3 class="card-name">Bank of America</h3>
                            <p>
                                <span class="card-no">1-800-732-9194</span><br />
                                <a href="#" class="card-service-link">
                                    Bank of America Customer Service
                                </a>
                            </p>
                        </li>
                        <li>
                            <h3 class="card-name">Barclaycard</h3>
                            <p>
                                <span class="card-no">1-888-232-0780</span><br />
                                <a href="#" class="card-service-link">
                                    Barclays Customer Service
                                </a>
                            </p>
                        </li>
                        <li>
                            <h3 class="card-name">Capital One</h3>
                            <p>
                                <span class="card-no">1-800-227-4825</span><br />
                                <a href="#" class="card-service-link">
                                    Capital One Customer Service
                                </a>
                            </p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="spacer-50"></div>
    </div>
    <!--end of main container-->

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
</body>

</html>