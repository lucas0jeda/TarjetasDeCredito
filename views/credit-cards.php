<?php $card = $parametros['card']; $moreInformation = $card->MoreInformation; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <link rel="icon" href="./favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Credit Card</title>
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


    <div class="main-container credit-card-profile">

        <div class="card-cover-img" id="iformacionPrincipal">
            <div class="card-brand">
                <img src="images/emisorImg/logos/<?php echo $card->LogoEmisor; ?>" width="100" height="35" alt="Card Brand Image" />
            </div>
            <h1>Tarjeta <?php echo $card->nombre; ?></h1>
            <a href="#" class="card-img-link">
                <img src="images/cardsImg/<?php echo $card->imagen; ?>" width="250" height="155" alt="Card Image" />
            </a>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-12 card-opinion-section">
                    <!--<a href="#" class="btn btn-outline-primary d-none d-lg-inline-block">
                        Escribe tu opinion</a><br />
                    <span class="hint d-none d-lg-inline-block">Leer 736 oponiones</span>-->
                </div>
            </div>
            <div class="row">
                <div class="col-12 card-apply-section" >
                    <a href="<?php echo $card->urlpedido; ?>" class="btn btn-primary">Pedir Ahora</a>
                    <div class="hint">
                        <!--<img src="images/signup-bonuses.svg" width="25" height="25" />
                        ¡Muy elegida por nuestros usuarios!-->
                    </div>
                </div>
            </div>
        </div>

        <div class="container card-info">
            <!--4 columns Features-->
            <div class="row no-gutters card-features" id="PrimeraInformacion">
                <div class="col-6 col-md-3 feature">
                    <h5 class="lbl-bold">EMISOR</h5>
                    <p>
                        <?php echo $card->nombreEmisor; ?>
                    </p>
                </div>
                <div class="col-6 col-md-3 feature">
                    <h5 class="lbl-bold">SELLO</h5>
                    <p>
                        <?php echo $card->nombreSello; ?>
                    </p>
                </div>
                <div class="col-6 col-md-3 feature">
                    <h5 class="lbl-bold">TIPO</h5>
                    <p>
                        <?php echo $card->tipo; ?>
                    </p>
                </div>
                <div class="col-6 col-md-3 feature">
                    <h5 class="lbl-bold">USO</h5>
                    <p>
                        <?php echo $card->uso; ?>
                    </p>
                </div>
            </div>
            <br /> <br />
            <!--3 columns Features-->
            <div class="row no-gutters card-features" id="InformacionSistemaDePuntosInfoBase">
                <div class="col-4 feature">
                    <h5 class="lbl-bold">TASA DE RECOMPENSAS</h5>
                    <p>
                    <?php 
                        function formatearEquivalenciaPuntos($equivalencia){
                            $result = explode('-', $equivalencia);
                            if(count($result) > 1){
                                switch ($result[1]){
                                    case "$":
                                        $result = $result[0] + " Punto = " + $result[2] + " Peso";
                                        break;
                                    case "USD":
                                        $result = $result[0] + " Punto = " + $result[2] + " Dolar";
                                        break;
                                }
                                return $result;
                            }
                            return $equivalencia;
                        }
                        echo formatearEquivalenciaPuntos($moreInformation['sistema_de_puntos']->equivalencia);
                    ?>
                    </p>
                </div>
                <div class="col-4 feature">
                    <h5 class="lbl-bold">NOMBRE</h5>
                    <p>
                        <?php echo $moreInformation['sistema_de_puntos']->Nombre; ?>
                    </p>
                </div>
                <div class="col-4 feature">
                    <h5 class="lbl-bold">CATALOGO</h5>
                    <p>
                        <a href="<?php echo $moreInformation['sistema_de_puntos']->link_de_catalogo; ?>" target="_blank">VER CATALOGO AQUI</a>
                    </p>
                </div>
            </div>

            <div class="row no-gutters card-features" id="InformacionSistemaDePuntosInfoAdicional">
                <div class="col-12 feature">
                    <h5 class="lbl-bold">INFORMACION ADICIONAL</h5>
                    <p>
                    <?php echo $moreInformation['sistema_de_puntos']->informacion_adicional; ?>
                    </p>
                </div>
            </div>
            <br /> <br />
            <!--2 columns Features-->
            <!---<div class="row no-gutters card-features">
                <div class="col-6 feature">
                    <h5 class="lbl-bold">REWARDS RATE</h5>
                    <p>
                        1x - 3x <br /> Points Per Dollar
                    </p>
                </div>
                <div class="col-6 feature">
                    <h5 class="lbl-bold">WELCOME BONUS</h5>
                    <p>
                        50,000 <br /> Points
                    </p>
                </div>
            </div>-->
            <br /> <br />
            <!--1 column Features-->
            <!---<div class="row no-gutters card-features">
                <div class="col-12 feature">
                    <h5 class="lbl-bold">REWARDS RATE</h5>
                    <p>
                        1x - 3x <br /> Points Per Dollar
                    </p>
                </div>
            </div>-->
            <div class="row">
                <div class="col-12 col-md-6 advantages-section" id="tarjetaVentajas">
                    <?php 
                if($card->cashback == "1"){ ?>        
                    <p>
                        <i class="fa fa-check"></i>
                        Cashback
                    </p>
                <?php } ?>
                <?php 
                if($card->programa_de_puntos == "1"){ ?>        
                    <p>
                        <i class="fa fa-check"></i>
                        Programa de Puntos
                    </p>
                <?php } ?>
                <?php 
                if($card->cuenta_bancaria == "0"){ ?>        
                   <p>
                <i class="fa fa-check"></i>
                No se necesita cuenta bancaria
            </p>
                <?php } ?>
               <?php if($card->envio_estado_de_cuenta_email == "1"){ ?>        
                <p>
                <i class="fa fa-check"></i>
                Envio de estado de cuenta por mail
            </p>
                <?php } ?>
                <?php if($card->contactless == "1"){ ?>        
                    <p>
                <i class="fa fa-check"></i>
                Contactless
            </p>
                <?php } ?>
                 

                </div>
                <div class="col-12 col-md-6 disadvantages-section" id="tarjetaDesventajas">
                <?php 
                if($card->cashback != "1"){ ?>        
                    <p>
                        <i class="fa fa-check"></i>
                        Cashback
                    </p>
                <?php } ?>
                <?php 
                if($card->programa_de_puntos != "1"){ ?>        
                    <p>
                        <i class="fa fa-check"></i>
                        Programa de Puntos
                    </p>
                <?php } ?>
                <?php 
                if($card->cuenta_bancaria != "0"){ ?>        
                   <p>
                <i class="fa fa-check"></i>
                No se necesita cuenta bancaria
            </p>
                <?php } ?>
               <?php if($card->envio_estado_de_cuenta_email != "1"){ ?>        
                <p>
                <i class="fa fa-check"></i>
                Envio de estado de cuenta por mail
            </p>
                <?php } ?>
                <?php if($card->contactless != "1"){ ?>        
                    <p>
                <i class="fa fa-check"></i>
                Contactless
            </p>
                <?php } ?>
                 

                </div>
            </div>
            <br /> <br />
            <div class="rates">
                <h3 class="lbl-bold">Requisitos</h3>
                <div class="row">
                    <div class="col-12 col-md-6" id="requisitosUno">
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Edad Minima:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation['requisitos']->edad_minima;   ?>
                            </div>
                        </div>
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Edad Maxima:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation['requisitos']->edad_maxima; ?>
                            </div>
                        </div>
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Cedula de Identidad:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation['requisitos']->cedula_de_identidad; ?>
                            </div>
                        </div>
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Fotocopia de la Cedula de Identidad:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation['requisitos']->fotocopia_CI; ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-6" id="requisitosDos">
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Clering:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation['requisitos']->clering; ?>
                            </div>
                        </div>
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Constancia de Domicilio:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation->requisitos['constancia_de_domicilio']; ?>
                            </div>
                        </div>
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Certificado de Ingresos:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation->requisitos['certificado_de_ingresos']; ?>
                            </div>
                        </div>
                        <div class="rate d-flex">
                            <div class="rate-title">
                                Recibo de Sueldo:
                            </div>
                            <div class="rate-value">
                                <?php echo $moreInformation->requisitos['recibo_de_sueldo']; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" id="requisitosTres">
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Ingresos Minimos:</span> <br/><br/>
                                <?php echo $moreInformation['requisitos']->ingresos_minimos; ?>
                            </p>
                        </div>
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Antiguedad Laboral:</span><br/><br/>
                                <?php echo $moreInformation['requisitos']->antiguedad_laboral; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br /> <br />
            <br /> <br />
            <div class="rates">
                <h3 class="lbl-bold">Beneficios</h3>
                <div class="row">
                    <div class="col-12 col-md-12" id="BeneficiosDesc">
                        <p>
                            <span><?php echo $moreInformation['requisitos']->titulo_beneficio; ?></span> <br/><br/>
                        </p>
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Descripcion:</span> <br/><br/>
                                <?php echo $moreInformation['requisitos']->descripcion; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" id="BeneficiosInfo">
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Informacion Adicional:</span> <br/><br/>
                                <?php echo $moreInformation['requisitos']->informacion_adicional; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <br /> <br /> <br />
            <div class="general-info" id="SegurosTarjeta">

            </div>
            <div class="rates">
                <h3 class="lbl-bold">Seguros</h3>
                <div class="row">
                    <div class="col-12 col-md-12" id="SegurosDesc">
                        <p>
                            <span><?php echo $moreInformation['seguros']->titulo_seguro; ?></span> <br/><br/>
                        </p>
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Descripcion:</span> <br/><br/>
                                <?php echo $moreInformation['seguros']->descripcion; ?> <?php echo $moreInformation['requisitos']->ingresos_minimos; ?>
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-md-12" id="SegurosInfo">
                        <div class="rate d-flex">
                            <p>
                                <span class="lbl-bold">Informacion Adicional:</span> <br/><br/>
                                <?php echo $moreInformation['seguros']->informacion_adicional; ?> <?php echo $moreInformation['requisitos']->ingresos_minimos; ?>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="general-info">
                <!--<h3 class="lbl-bold">This Card: As a Rewards Card</h3>
                <p>Looking past the offer, let's see how this card operates as a rewards earner,</p>
                <p>Using the Citi Rewards Credit Card, you will earn points on Citibank's own Citi Rewards program.
                    As a fairly flexible option, the program provides a wide range of redemption options, while also
                    allowing cardholders to transfer their points to partner programs such as Emirates Skywards,
                    Singapore Airlines KrisFlyer and flybuys.</p>
                <br />

                <h4 class="lbl-bold">Earning Points</h4>
                <ul>
                    <li>Earn 1 Citi reward Point per $1 on all eligible transactions made overseas or online with a
                        merchant that is based overseas</li>
                    <li>Earn 1 Citi reward Point per $1 on all eligible transactions in Australia (up to $10,000 per
                        statement period) </li>
                    <li>Earn 1 Citi reward Point per $1 on all eligible transactions using Citi Payall</li>
                    <li>Earn 2 Citi reward Points per $1 on all eligible transactions made using the Linked Diners
                        Club Card</li>
                </ul>
                <br />
                <p>As you can see from the above earn rate, points are capped at a monthly spend of $10,000 on
                    spending within Australia. While this may not be ideal for bigger spenders, you may still be
                    able to enjoy value by adding to your points total with overseas spending, and purchases made
                    using your linked Diners Club Card</p>
                <br />

                <h4 class="lbl-bold">Diners Club Card</h4>
                <p>How does the linked Diners Club Card work then?</p>
                <br />
                <ul>
                    <li>When you use your Diners card, you will benefit from an uncapped earn rate of 2 Citi reward
                        Points per $1 on all eligible transactions. </li>
                    <li>There are no international transaction fees, reducing your outgoings when spending online or
                        in person at overseas retailers.</li>
                    <li>While acceptance may not be across the board, your Diners Club Card will be accepted in more
                        places than you may think, including Coles,
                        Woolworths, Bunnings, and a wide range of other retailers both here in Australia and
                        overseas (check out the Citi site for a full list).</li>
                    <li>As the two cards are linked, all points earned are held within one balance, which can be
                        managed online.</li>
                </ul>
                <br />

                <h4 class="lbl-bold">Redeeming Points</h4>
                <p>
                    Time to redeem those points? You have a number of options open to you.<br />
                    <b>Pay with Points:</b> When you
                    Pay with Points, you decide which eligible purchases you have made that you want to cover using
                    your points. This essentially allows you to redeem your points against almost anything.
                </p>
                <p>
                    <b>Shop with Points:</b> Allowing you to use your points to shop directly with participating
                    retailers,
                    this is another flexible option. Currently, you can shop direct at Kogan and Apple, with the
                    option to use Points Plus Pay at Apple if you don't have enough points to cover your purchase.
                </p>
                <p>
                    <b>Travel:</b> As travel starts to open up again, you can start planning your next adventure,
                    using the
                    Citi Travel Portal to redeem your Citi reward Points for flights, hotels, car hire and
                    activities, or to create your own itinerary. You can make up the remaining balance with your
                    card if you don't have enough points to cover the cost of your booking.
                </p>-->
            </div>
        </div>

        <!-- <div class="container">
             <div class="recommended-cards-group">
                 <div class="recommended-card custom-card featured-card">
                     <div class="row">
                         <div class="col-12">
                             <span class="featured-icon">
                                 <i class="fa fa-star"></i>
                                 FEATURED CARD
                             </span>
                         </div>
                         <div class="col-12 col-md-4 col-lg-3">
                             <div class="custom-card-image">
                                 <img src="./images/cardsImg/card3.jfif" alt="card1" />
                             </div>
                             <div class="custom-card-buttons d-none d-md-block">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>
                         </div>
                         <div class="col-12 col-md-8 col-lg-9 custom-card-info">
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

                             <div class="custom-card-buttons d-md-none">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>

                             <div class="row no-gutters card-features">
                                 <div class="col-12 col-md-3 feature">
                                     <h6 class="lbl-bold">REWARDS RATE</h6>
                                     <p class="d-none d-md-block">
                                         1x - 3x <br /> Points Per Dollar
                                     </p>
                                     <p class="d-md-none">
                                         1x - 3x Points Per Dollar
                                     </p>
                                 </div>
                                 <div class="col-12 col-md-3 feature">
                                     <h6 class="lbl-bold">WELCOME BONUS</h6>
                                     <p class="d-none d-md-block">
                                         50,000 <br /> Points
                                     </p>
                                     <p class="d-md-none">
                                         Earn 50,000 points after spending $4,000 within the first 3 months.
                                     </p>
                                 </div>
                                 <div class="col-12 col-md-3 feature">
                                     <h6 class="lbl-bold">EDITORS' BONUS ESTIMATE</h6>
                                     <p>
                                         $785 <br />
                                     </p>
                                 </div>
                                 <div class="col-12 col-md-3 feature">
                                     <h6 class="lbl-bold">ANNUAL FEE</h6>
                                     <p>
                                         $69 <br />
                                     </p>
                                 </div>
                             </div>

                             <div class="card-details">
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn up to 80,000 points. Earn 50,000 points after you spend $2,000 on purchases
                                     in the first 3 months. Earn an additional 30,000 points after you spend $10,000
                                     on purchases in the first 9 months.
                                 </p>
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn 5 points per $1 spent on Southwest purchases. Earn between 12/1/2020 and
                                     3/31/2021 on up to $2,000 spent per month.
                                 </p>
                                 <div class="show-more-details">
                                     <a href="javascript:void(0)" class="show-more-lnk">
                                         Show More
                                         <i class="fa fa-angle-down"></i>
                                     </a>
                                     <div class="more-details d-none">
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
                 <br>
                 <h3 class="lbl-bold">Más tarjetas de crédito OCA</h3>
                 <br />
                 &lt;!&ndash;recommended card1&ndash;&gt;
                 <div class="recommended-card custom-card">
                     <div class="row">
                         <div class="col-12 col-md-4 col-lg-3">
                             <div class="custom-card-image">
                                 <img src="./images/cardsImg/card1.jfif" alt="card1" />
                             </div>
                             <div class="custom-card-buttons d-none d-md-block">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>
                         </div>
                         <div class="col-12 col-md-8 col-lg-9 custom-card-info">
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

                             <div class="custom-card-buttons d-md-none">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>

                             <div class="row no-gutters card-features">
                                 <div class="col-12 col-md-4 feature">
                                     <h6 class="lbl-bold">REWARDS RATE</h6>
                                     <p class="d-none d-md-block">
                                         1x - 3x <br /> Points Per Dollar
                                     </p>
                                     <p class="d-md-none">
                                         1x - 3x Points Per Dollar
                                     </p>
                                 </div>
                                 <div class="col-12 col-md-4 feature">
                                     <h6 class="lbl-bold">WELCOME BONUS</h6>
                                     <p class="d-none d-md-block">
                                         50,000 <br /> Points
                                     </p>
                                     <p class="d-md-none">
                                         Earn 50,000 points after spending $4,000 within the first 3 months.
                                     </p>
                                 </div>
                                 <div class="col-12 col-md-4 feature">
                                     <h6 class="lbl-bold">EDITORS' BONUS ESTIMATE</h6>
                                     <p>
                                         $785 <br />
                                     </p>
                                 </div>
                             </div>

                             <div class="card-details">
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn up to 80,000 points. Earn 50,000 points after you spend $2,000 on purchases
                                     in the first 3 months. Earn an additional 30,000 points after you spend $10,000
                                     on purchases in the first 9 months.
                                 </p>
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn 5 points per $1 spent on Southwest purchases. Earn between 12/1/2020 and
                                     3/31/2021 on up to $2,000 spent per month.
                                 </p>
                                 <div class="show-more-details">
                                     <a href="javascript:void(0)" class="show-more-lnk">
                                         Show More
                                         <i class="fa fa-angle-down"></i>
                                     </a>
                                     <div class="more-details d-none">
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
                 &lt;!&ndash;recommended card2&ndash;&gt;
                 <div class="recommended-card custom-card">
                     <div class="row">
                         <div class="col-12 col-md-4 col-lg-3">
                             <div class="custom-card-image">
                                 <img src="./images/cardsImg/card2.jfif" alt="card2" />
                             </div>
                             <div class="custom-card-buttons d-none d-md-block">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>
                         </div>
                         <div class="col-12 col-md-8 col-lg-9 custom-card-info">
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

                             <div class="custom-card-buttons d-md-none">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>

                             <div class="row no-gutters card-features">
                                 <div class="col-12 col-md-6 feature">
                                     <h6 class="lbl-bold">REWARDS RATE</h6>
                                     <p class="d-none d-md-block">
                                         1x - 3x <br /> Points Per Dollar
                                     </p>
                                     <p class="d-md-none">
                                         1x - 3x Points Per Dollar
                                     </p>
                                 </div>
                                 <div class="col-12 col-md-6 feature">
                                     <h6 class="lbl-bold">WELCOME BONUS</h6>
                                     <p class="d-none d-md-block">
                                         50,000 <br /> Points
                                     </p>
                                     <p class="d-md-none">
                                         Earn 50,000 points after spending $4,000 within the first 3 months.
                                     </p>
                                 </div>
                             </div>

                             <div class="card-details">
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn up to 80,000 points. Earn 50,000 points after you spend $2,000 on purchases
                                     in the first 3 months. Earn an additional 30,000 points after you spend $10,000
                                     on purchases in the first 9 months.
                                 </p>
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn 5 points per $1 spent on Southwest purchases. Earn between 12/1/2020 and
                                     3/31/2021 on up to $2,000 spent per month.
                                 </p>
                                 <div class="show-more-details">
                                     <a href="javascript:void(0)" class="show-more-lnk">
                                         Show More
                                         <i class="fa fa-angle-down"></i>
                                     </a>
                                     <div class="more-details d-none">
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
                 &lt;!&ndash;recommended card3&ndash;&gt;
                 <div class="recommended-card custom-card">
                     <div class="row">
                         <div class="col-12 col-md-4 col-lg-3">
                             <div class="custom-card-image">
                                 <img src="./images/cardsImg/card3.jfif" alt="card3" />
                             </div>
                             <div class="custom-card-buttons d-none d-md-block">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>
                         </div>
                         <div class="col-12 col-md-8 col-lg-9 custom-card-info">
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

                             <div class="custom-card-buttons d-md-none">
                                 <a href="#" class="btn btn-primary">Pedir ahora</a>
                                 <a href="#" class="btn btn-outline-primary">Mas detalles </a>
                             </div>

                             <div class="row no-gutters card-features">
                                 <div class="col-12 feature">
                                     <h6 class="lbl-bold">REWARDS RATE</h6>
                                     <p class="d-none d-md-block">
                                         1x - 3x <br /> Points Per Dollar
                                     </p>
                                     <p class="d-md-none">
                                         1x - 3x Points Per Dollar
                                     </p>
                                 </div>
                             </div>

                             <div class="card-details">
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn up to 80,000 points. Earn 50,000 points after you spend $2,000 on purchases
                                     in the first 3 months. Earn an additional 30,000 points after you spend $10,000
                                     on purchases in the first 9 months.
                                 </p>
                                 <p>
                                     <i class="fa fa-check"></i>
                                     Earn 5 points per $1 spent on Southwest purchases. Earn between 12/1/2020 and
                                     3/31/2021 on up to $2,000 spent per month.
                                 </p>
                                 <div class="show-more-details">
                                     <a href="javascript:void(0)" class="show-more-lnk">
                                         Show More
                                         <i class="fa fa-angle-down"></i>
                                     </a>
                                     <div class="more-details d-none">
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
             </div>
         </div>-->

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