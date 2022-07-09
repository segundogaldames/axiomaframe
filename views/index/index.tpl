<!DOCTYPE html>
<html lang="en">

<head>
    <title>Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--===============================================================================================-->
    {include file="link_css.tpl"}
    <!--===============================================================================================-->
</head>

<body class="animsition">

    <!-- Header -->
    {include file="header_shop.tpl"}


    <!-- Slider -->
    {include file="slider_shop.tpl"}


    <!-- Banner -->
    {include file="banner_shop.tpl"}


    <!-- Product -->
    <section class="bg0 p-t-23 p-b-140">
        <div class="container">
            <div class="p-b-10">
                <h3 class="ltext-103 cl5">
                    Productos Nuevos
                </h3>
                <hr>
            </div>

            <div class="row isotope-grid">
                {foreach from=$imagenes item=imagen}

                    <div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item women">
                        <!-- Block2 -->
                        <div class="block2">
                            <div class="block2-pic hov-img0">
                                <img src="{$_layoutParams.root}public/img/productos/{$imagen.img}" alt="IMG-PRODUCT">

                                <a href="{$_layoutParams.root}tienda/producto/{$imagen.producto.ruta}"
                                    class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04">
                                    Ver Detalle
                                </a>
                            </div>

                            <div class="block2-txt flex-w flex-t p-t-14">
                                <div class="block2-txt-child1 flex-col-l ">
                                    <a href="{$_layoutParams.root}tienda/producto/{$imagen.producto.ruta}" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                        {{$imagen.producto.nombre}}
                                    </a>

                                    <span class="stext-105 cl3">
                                        $ {{$imagen.producto.precio|number_format:0:",":"."}}
                                    </span>
                                </div>

                                <div class="block2-txt-child2 flex-r p-t-3">
                                    <a href="#" class="btn-addwish-b2 dis-block pos-relative js-addwish-b2">
                                        <img class="icon-heart1 dis-block trans-04" src="{$_layoutParams.ruta_shop}images/icons/icon-heart-01.png"
                                            alt="ICON">
                                        <img class="icon-heart2 dis-block trans-04 ab-t-l"
                                            src="{$_layoutParams.root}images/icons/icon-heart-02.png" alt="ICON">
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                {/foreach}
            </div>

            <!-- Load more -->
            <div class="flex-c-m flex-w w-full p-t-45">
                <a href="#" class="flex-c-m stext-101 cl5 size-103 bg2 bor1 hov-btn1 p-lr-15 trans-04">
                    Load More
                </a>
            </div>
        </div>
    </section>


    {include file="footer_shop.tpl"}

    {include file="link_js.tpl"}

</body>

</html>