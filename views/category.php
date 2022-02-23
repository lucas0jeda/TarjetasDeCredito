<?php $cards = $parametros['tarjetas'];  $categorie = $parametros['categoria'];   ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Category</title>
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


    <!-- Start Category -->
    <div class="main-container category">
        <div class="container">
            <div class="row">
                <div class="col-12" id="startInformationCategory">
                    <h1 class="lbl-bold"><?php echo str_replace('-',' ',$categorie->titulo_categoria); ?></h1>
                    <p class="md-font-size">
                    <?php echo $categorie->informacion; ?>
                    </p>
                </div>
            </div>
 
            <div class="recommended-cards-group" id="cards">
                <?php foreach($cards as $card):   ?>
                    <div class="recommended-card custom-card">
                        <div class="row">
                            <div class="col-12 col-md-4 col-lg-3">
                                <div class="custom-card-image">
                                    <img src="./images/cardsImg/<?php echo $card['imagen']; ?>" alt="<?php echo $card['imagen']; ?>" />
                                </div>
                                <div class="custom-card-buttons d-none d-md-block">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                                </div>
                            </div>
                            <div class="col-12 col-md-8 col-lg-9 custom-card-info">
                                <h2><?php echo $card['nombre']; ?></h2>
                                <!---<p class="card-title-hint">
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
                                </p> --->

                                <div class="custom-card-buttons d-md-none">
                                    <a href="#" class="btn btn-primary">Pedir ahora</a>
                                    <a href="#" class="btn btn-outline-primary">Mas detalles</a>
                                </div>

                                <div class="row no-gutters card-features">
                                    <div class="col-12 col-md-4 feature">
                                        <h6 class="lbl-bold">Emisor</h6>
                                        <p class="d-none d-md-block">
                                        <?php echo $card['NombreEmisor']; ?>
                                        </p>
                                        <p class="d-md-none">
                                        <?php echo $card['NombreEmisor']; ?>
                                        </p>
                                    </div>
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
                                        <p>
                                        <?php echo $card['uso']; ?>
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
                                    </div>
                                </div>
                            </div>
                        </div><!--FIN ROW--->
                    </div>
                <?php endforeach; ?>
            </div>

            <div class="row">
                <div class="col-12">
                    <h3 class="lbl-bold">What is Chase?</h3>
                    <p class="xs-font-size">
                        JPMorgan Chase Bank N.A., or Chase Bank, is a national bank and credit card issuer. That
                        means the company grants cards to qualifying consumers. It partners with two networks, which
                        process charges made at retailers. The primary networks are Visa and Mastercard. Most Chase
                        credit cards are Visa cards, except the IHG Rewards Club Premier, which is a Mastercard.
                    </p>
                    <p class="xs-font-size">
                        Chase credit cards are best known for their generous sign-up bonuses and boosted redemption
                        travel rewards. In some cases, such as the Sapphire and Freedom cards, products can be
                        partnered to fully use the Ultimate Rewards portal. A good to excellent credit score is
                        typically needed for this brand, with its portfolio of business, cashback, travel and
                        balance transfer products.
                    </p>
                    <p class="xs-font-size">
                        Chase credit cards can be used internationally in most locations. Along with rewards that
                        come with travel and dining in the U.S., some Chase cards reward you for foreign travel.
                        Also, in the case of such cards as the Sapphire products, there is no foreign transaction
                        fee, which applies to both foreign travel and foreign purchases.
                    </p>
                </div>
            </div>

            <div class="row">
                <div class="col-12">
                    <h3 class="lbl-bold">How many Chase credit cards can I have?</h3>
                    <p class="xs-font-size">
                        While in theory there is no limit to the number of Chase cards you can hold, the Chase 5/24
                        rule requires that you not open more than 5 cards of all issuers in a 24-month period in
                        order to be approved for a Chase credit card:
                    </p>
                    <ul class="xs-font-size">
                        <li>
                            IHG Rewards Club Premier Card
                        </li>
                        <li>
                            Disney Rewards Visa
                        </li>
                        <li>
                            Ritz-Carlton Rewards
                        </li>
                        <li>
                            Marriott Rewards Premier Business
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