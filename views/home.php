<?php $categories = $parametros['categories']; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Tarjetas de Crédito</title>
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


    <div class="main-container">
        <div class="container">
            <div class="row">
                <div class="col-12 top-title">
                    <h1>Las mejores tarjetas de crédito en Uruguay</h1>
                    <p> Compara, informate y elegí la tarjeta de crédito o débito ideal
                        para vos</p>
                </div>
            </div>
            <div class="row cards-links-group" id="categorias">
                <?php foreach($categories as $category): ?>
                    <div class="col-12 col-md-6 col-lg-4">
                        <a href="<?php echo $category['url']; ?>">
                            <?php echo $category['titulo_categoria'];  ?>
                            <span class="material-icons">
                                arrow_forward
                            </span>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="row justify-content-md-center">
                <div class="col-2">
                    <button type="button" id="btnMostrarMasCategorias" class="btn btn-link" value="0" style="color: #2764B6;" onclick="mostrarMasCategorias()">
                        Show More
                    </button>
                </div>
            </div>

            <div class="row">
                <div class=" col-12">
                    <div class="newspaper-section">
                        <span>As seen on:</span>
                        <img src="./images/imgNewsPappers/bloomberg.png" alt="bloomberIMG" />
                        <img src="./images/imgNewsPappers/ent.png" alt="bloomberIMG" />
                        <img src="./images/imgNewsPappers/fox.png" alt="bloomberIMG" />
                        <img src="./images/imgNewsPappers/new.png" alt="bloomberIMG" />
                        <img src="./images/imgNewsPappers/rep.png" alt="bloomberIMG" />
                        <img src="./images/imgNewsPappers/wall.png" alt="bloomberIMG" />
                    </div>
                </div>
            </div>

            <!---<div class="recommended-cards-group">
                <div class="recommended-cards-title">
                    <h1>Las 10 tarjetas recomendadas</h1>
                    <p>
                        Éstas son las mejores tarjetas del mercado según diferentes criterios de evaluación.<br />
                    </p>
                </div>

                recommended card1

                <div class="recommended-card custom-card">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-3 custom-card-image">
                            <img src="./images/cardsImg/card1.jfif" alt="card1" />
                        </div>
                        <div class="col-12 col-md-8 col-lg-7 custom-card-info">
                            <h1>American Express Gold Card</h1>
                            <p class="card-title-hint">
                                <span>iExcelente!</span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star">
                                    star_rate
                                </span>
                                <span>19 oponioniones</span>
                            </p>
                            <p class="card-info-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus
                                labore molestias, voluptatibus perferendis rem provident, fuga
                                deserunt ab accusamus praesentium <br />quos dolore ratione excepturi
                                commodi enim non maiores magni odit consectetur voluptas velit
                                laboriosam!
                            </p>
                        </div>
                        <div class="col-12 col-md-12 col-lg-2 custom-card-buttons">
                            <a href="#" class="btn btn-primary">Pedir ahora</a>
                            <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                        </div>
                    </div>
                </div>

                recommended card2

                <div class="recommended-card custom-card">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-3 custom-card-image">
                            <img src="./images/cardsImg/card2.jfif" alt="card1" />
                        </div>
                        <div class="col-12 col-md-8 col-lg-7 custom-card-info">
                            <h1>American Express Gold Card</h1>
                            <p class="card-title-hint">
                                <span>iExcelente!</span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star">
                                    star_rate
                                </span>
                                <span>19 oponioniones</span>
                            </p>
                            <p class="card-info-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus
                                labore molestias, voluptatibus perferendis rem provident, fuga
                                deserunt ab accusamus praesentium quos dolore ratione excepturi
                                commodi enim non maiores magni odit consectetur voluptas velit
                                laboriosam!
                            </p>
                        </div>
                        <div class="col-12 col-md-12 col-lg-2 custom-card-buttons">
                            <a href="#" class="btn btn-primary">Pedir ahora</a>
                            <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                        </div>
                    </div>
                </div>

                recommended card3

                <div class="recommended-card custom-card">
                    <div class="row">
                        <div class="col-12 col-md-4 col-lg-3 custom-card-image">
                            <img src="./images/cardsImg/card3.jfif" alt="card1" />
                        </div>
                        <div class="col-12 col-md-8 col-lg-7 custom-card-info">
                            <h1>American Express Gold Card</h1>
                            <p class="card-title-hint">
                                <span>iExcelente!</span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span class="material-icons custom-star active-star">
                                    star_rate
                                </span>
                                <span>19 oponioniones</span>
                            </p>
                            <p class="card-info-body">
                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minus
                                labore molestias, voluptatibus perferendis rem provident, fuga
                                deserunt ab accusamus praesentium quos dolore ratione excepturi
                                commodi enim non maiores magni odit consectetur voluptas velit
                                laboriosam!
                            </p>
                        </div>
                        <div class="col-12 col-md-12 col-lg-2 custom-card-buttons">
                            <a href="#" class="btn btn-primary">Pedir ahora</a>
                            <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                        </div>
                    </div>
                </div>
                <div class="text-align-center">
                    <a href="#" class="more-cards-link">
                        Ver todas las tarjetas
                        <span class="material-icons">
                            arrow_right_alt
                        </span>
                    </a>
                </div>
            </div>--->

            <div class="we-are-section row">
                <div class="col-12 col-md-5">
                    <img src="./images/bg_3.jpg" alt="img" width="500" height="300" />
                </div>
                <div class="col-12 col-md-7">
                    <h1>Somos TarjetasdeCredito.com.uy</h1>
                    <p>
                        Hacemos que elegir una tarjeta de crédito o débito sea fácil.

                        Con información actualizada de todas las tarjetas del país, podrás
                        comparar, leer opiniones y solicitar las tarjetas que se adapten a tu
                        necesidad. Hemos analizado las tarjetas que no requieren cambiar de
                        banco, se pueden sacar estando en el clearing, sin costo, con los
                        mejores beneficios, no requieren recibo de sueldo, y más.
                    </p>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="footer-email-section row">
                <div class="col-12 col-md-12 col-lg-2"></div>
                <div class="col-12 col-md-12 col-lg-8 email-section-body text-align-center">
                    <h1>Recibí ofertas exclusivas de tarjetas de crédito y débito.</h1>
                    <form id="email-form">
                        <input type="email" class="email" placeholder="Tu dirección de e-mail" />
                        <input type="button" class="subscribe" value="Subscribirme" />
                    </form>
                </div>
                <div class="col-12 col-md-12 col-lg-2"></div>
            </div>
        </div>
        <footer>
            <div class="container">
                <div class="row no-gutters">
                    <div class="col-12 col-md-4 logo-section">
                        <a href="#" class="logo">Tarjetas de Crédito</a>
                        <div class="follow-us-section">
                            <div class="fb-page" data-href="https://www.facebook.com.com.uy/"
                                 data-tabs="" data-width="350" data-height="50" data-small-header="true"
                                 data-adapt-container-width="false" data-hide-cover="true"
                                 data-show-facepile="false">
                                <blockquote cite="https://www.facebook.com.com.uy/"
                                            class="fb-xfbml-parse-ignore"><a
                                            href="https://www.facebook.com.com.uy/">Tarjetas de
                                        Crédito
                                        Uruguay</a></blockquote>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-3">
                        <h3>La Empresa</h3>
                        <ul>
                            <li><a href="#">Sobre nosotros</a></li>
                            <li><a href="#">Novedades</a></li>
                            <li><a href="#">Facebook</a></li>
                            <li><a href="#">Linkedin</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-3">
                        <h3>Contacto</h3>
                        <ul>
                            <li><a href="#">Atencion al cliente</a></li>
                            <li><a href="#">Preguntas frecuentes</a></li>
                            <li><a href="#">Contacto de tarjetasContactanos</a></li>
                        </ul>
                    </div>
                    <div class="col-12 col-md-2">
                        <h3>Top 5 tarjetas</h3>
                        <ul>
                            <li><a href="#">American Express Gold Card</a></li>
                            <li><a href="#">American Express Gold Card</a></li>
                            <li><a href="#">American Express Gold Card</a></li>
                            <li><a href="#">American Express Gold Card</a></li>
                            <li><a href="#">American Express Gold Card</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
    </div>
    <!--end of main container-->
</div>
<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.js"
        integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
<script src="https://kit.fontawesome.com/a429ba45aa.js" crossorigin="anonymous"></script>
<script src="./jss/index.js"></script>
</body>

</html>