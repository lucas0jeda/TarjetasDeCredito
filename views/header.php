<?php $categoriesHeader = $parametros['categories'];
$emisoresHeader = $parametros['emisores'];
$sellosHeader = $parametros['sellos'];
$tarjetasHeader = $parametros['tarjetas'];


$cantidadTarjetas =  count($tarjetasHeader);
$cantidadEmisores = count($emisoresHeader);
$cantidadSellos =  count($sellosHeader);
$cantidad =  count($categoriesHeader);

?>
<!--header-->
    <header>
        <div class="container">
            <nav class="row no-gutters">
                <div class="col-9 col-md-9 col-lg-3 logo-section">
                    <a href="#">Tarjetas de Credito.com.uy</a>
                </div>
                <div class="col-lg-7 d-none d-lg-block main-menu-section">
                    <ul class="mainMenu">
                        <li class="menu-item">
                            <a href="#">
                                Tipo de tarjeta
                                <span class="material-icons">
                                        keyboard_arrow_down
                                    </span>
                            </a>
                            <ul class="sub-menu-columns">
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=0; $i < $cantidad; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $tarjetasHeader[$i]['url']; ?>">
                                                    <?php echo $tarjetasHeader[$i]['nombre']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 4): break; endif; } ?>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=4; $i < $cantidad; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $tarjetasHeader[$i]['url']; ?>">
                                                    <?php echo $tarjetasHeader[$i]['nombre']; ?>
                                                </a>
                                            </li>
                                        <?php if($i === 8): break; endif; } ?>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=8; $i < $cantidad; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $tarjetasHeader[$i]['url']; ?>">
                                                    <?php echo $tarjetasHeader[$i]['nombre']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 12): break; endif; } ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Categorias
                                <span class="material-icons">
                                        keyboard_arrow_down
                                    </span>
                            </a>
                            <ul class="sub-menu-columns">
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=0; $i < $cantidad; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $categoriesHeader[$i]['url']; ?>">
                                                    <?php echo $categoriesHeader[$i]['titulo_categoria']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 4): break; endif; } ?>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=4; $i < $cantidad; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $categoriesHeader[$i]['url']; ?>">
                                                    <?php echo $categoriesHeader[$i]['titulo_categoria']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 8): break; endif; } ?>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=8; $i < $cantidad; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $categoriesHeader[$i]['url']; ?>">
                                                    <?php echo $categoriesHeader[$i]['titulo_categoria']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 12): break; endif; } ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                        <li class="menu-item">
                            <a href="#">
                                Bancos y emisores
                                <span class="material-icons">
                                        keyboard_arrow_down
                                    </span>
                            </a>
                            <ul class="sub-menu-columns">
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=0; $i < $cantidadEmisores; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $emisoresHeader[$i]['url']; ?>">
                                                    <?php echo $emisoresHeader[$i]['nombre']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 4): break; endif; } ?>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=4; $i < $cantidadEmisores; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $emisoresHeader[$i]['url']; ?>">
                                                    <?php echo $emisoresHeader[$i]['nombre']; ?>
                                                </a>
                                            </li>
                                        <?php if($i === 8): break; endif; } ?>
                                    </ul>
                                </li>
                                <li>
                                    <ul class="sub-menu-column">
                                        <?php
                                        for($i=8; $i < $cantidadEmisores; $i++){ ?>
                                            <li>
                                                <a href="<?php echo $emisoresHeader[$i]['url']; ?>">
                                                    <?php echo $emisoresHeader[$i]['nombre']; ?>
                                                </a>
                                            </li>
                                        <?php  if($i === 12): break; endif; } ?>
                                    </ul>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="col-3 col-md-3 col-lg-2 right-section">
                    <a href="#" class="d-none d-lg-inline-block">
                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                        Recibir ofertas
                    </a>
                    <a class="d-inline-block d-lg-none mobile-nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                    </a>
                </div>
            </nav>
        </div>
    </header>
    <!--header-->

    <!--mobile side nav-->
    <nav id="mobileSideNav" class="mobile-side-nav d-lg-none">
        <ul class="mobile-menu">
            <li>
                <a class="drop-down-link">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    Tipo de tarjeta
                </a>
                <ul class="drop-down-menu">
                    <li>
                        <ul class="sub-menu-column">
                            <?php
                            for($i=0; $i < $cantidad; $i++){ ?>
                                <li>
                                    <a href="<?php echo $categoriesHeader[$i]['url']; ?>">
                                        <?php echo $categoriesHeader[$i]['nombre']; ?>
                                    </a>
                                </li>
                            <?php  if($i === 4): break; endif; } ?>
                        </ul>
                    </li>
                    <li>
                        <ul class="sub-menu-column">
                            <?php
                            for($i=4; $i < $cantidad; $i++){ ?>
                                <li>
                                    <a href="<?php echo $categoriesHeader[$i]['url']; ?>">
                                        <?php echo $categoriesHeader[$i]['nombre']; ?>
                                    </a>
                                </li>
                            <?php  if($i === 8): break; endif; } ?>
                        </ul>
                    </li>
                    <li>
                        <ul class="sub-menu-column">
                            <?php
                            for($i=8; $i < $cantidad; $i++){ ?>
                                <li>
                                    <a href="<?php echo $categoriesHeader[$i]['url']; ?>">
                                        <?php echo $categoriesHeader[$i]['nombre']; ?>
                                    </a>
                                </li>
                            <?php if($i === 12): break; endif; } ?>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a class="drop-down-link">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    Categorias
                </a>
                <ul class="sub-menu-columns">
                    <?php   if($cantidad > 0){ ?>
                        <li>
                            <ul class="sub-menu-column">
                                <?php
                                for($i=0; $i < $cantidad; $i++){ ?>
                                    <li>
                                        <a href="#">
                                            <?php echo $categoriesHeader[$i]['titulo_categoria']; ?>
                                        </a>
                                    </li>
                                <?php  if($i === 4): break; endif; } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if($cantidad > 4){ ?>
                        <li>
                            <ul class="sub-menu-column">
                                <?php
                                for($i=4; $i < $cantidad; $i++){ ?>
                                    <li>
                                        <a href="#">
                                            <?php echo $categoriesHeader[$i]['titulo_categoria']; ?>
                                        </a>
                                    </li>
                                <?php   if($i === 8): break; endif; } ?>
                            </ul>
                        </li>
                    <?php } ?>
                    <?php if($cantidad > 8){ ?>
                        <li>
                            <ul class="sub-menu-column">
                                <?php
                                for($i=8; $i < $cantidad; $i++){ ?>
                                    <li>
                                        <a href="#">
                                            <?php echo $categoriesHeader[$i]['titulo_categoria']; ?>
                                        </a>
                                    </li>
                                <?php  if($i === 12): break; endif; } ?>
                            </ul>
                        </li>
                    <?php } ?>
                </ul>
            </li>
            <li>
                <a class="drop-down-link">
                    <i class="fa fa-chevron-down" aria-hidden="true"></i>
                    Bancos y emisores
                </a>
                <ul class="sub-menu-columns">
                    <li>
                        <ul class="sub-menu-column">
                            <?php
                            for($i=0; $i < $cantidadEmisores; $i++){ ?>
                                <li>
                                    <a href="<?php echo $emisoresHeader[$i]['url']; ?>">
                                        <?php echo $emisoresHeader[$i]['nombre']; ?>
                                    </a>
                                </li>
                            <?php  if($i === 4): break; endif; } ?>
                        </ul>
                    </li>
                    <li>
                        <ul class="sub-menu-column">
                            <?php
                            for($i=4; $i < $cantidadEmisores; $i++){ ?>
                                <li>
                                    <a href="<?php echo $emisoresHeader[$i]['url']; ?>">
                                        <?php echo $emisoresHeader[$i]['nombre']; ?>
                                    </a>
                                </li>
                            <?php  if($i === 8): break; endif; } ?>
                        </ul>
                    </li>
                    <li>
                        <ul class="sub-menu-column">
                            <?php
                            for($i=8; $i < $cantidadEmisores; $i++){ ?>
                                <li>
                                    <a href="<?php echo $emisoresHeader[$i]['url']; ?>">
                                        <?php echo $emisoresHeader[$i]['nombre']; ?>
                                    </a>
                                </li>
                            <?php if($i === 12): break; endif; } ?>
                        </ul>
                    </li>
                </ul>
            </li>
            <li>
                <a>
                    <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    Recibir ofertas
                </a>
            </li>
        </ul>
    </nav>

    <!--End Mobile Nav-->