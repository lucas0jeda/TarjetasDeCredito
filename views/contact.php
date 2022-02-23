<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Contact</title>
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


    <!-- Start contact -->
    <div class="main-container contact">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="lbl-bold">Contactános</h1>
                    <p>
                        Envianos tus comentarios, opiniones y propuestas.
                    </p>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-7">
                    <div class="contact-top-note">
                        <p>
                            Si estás esperando la respuesta de una tarjeta, ponete en contacto directamente con el
                            emisor.<a href="#">Lista teléfonos de emisores</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12 col-lg-6">
                    <form>
                        <div class="form-group">
                            <select class="form-control">
                                <option>General question</option>
                                <option>Option No.1</option>
                                <option>Option No.2</option>
                                <option>Option No.3</option>
                                <option>Option No.4</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control" placeholder="Your Email">
                        </div>
                        <div class="form-group">
                            <textarea class="form-control" placeholder="Your Message..." rows="6"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Send</button>
                    </form>
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
<script src="public/jsndex.js"></script>
</body>

</html>