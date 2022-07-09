<section class="material-half-bg">
    <div class="cover"></div>
</section>
<section class="login-content">
    <div class="logo">
        <h1>Tienda Virtual</h1>
    </div>
    <div class="login-box">
        <form class="login-form" action="" method="post">
            {include file="../partials/_mensajes.tpl"}
            <h3 class="login-head"><i class="fa fa-key" aria-hidden="true"></i>Login</h3>
            <div class="form-group">
                <label class="control-label">Email</label>
                <input name="email" class="form-control" type="email" placeholder="Ingresa tu email" autofocus>
            </div>
            <div class="form-group">
                <div class="utility">

                    <p class="semibold-text mb-2"><a href="{$_layoutParams.root}usuarios/login">Volver a Login</a></p>
                </div>

            </div>
            <div class="form-group btn-container">
                <input type="hidden" name="enviar" value="{$enviar}">
                <button type="submit" class="btn btn-primary btn-block"><i
                    class="fa fa-sign-in fa-lg fa-fw"></i>Enviar</button>
            </div>
        </form>
    </div>
</section>