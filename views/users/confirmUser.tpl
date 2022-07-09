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
            <h3 class="login-head"><i class="fa fa-key" aria-hidden="true"></i> Cambiar Password</h3>
            <div class="form-group">
                <label class="control-label">Password</label>
                <input class="form-control" type="password" name="clave" placeholder="Ingresa tu password">
            </div>
            <div class="form-group">
                <label class="control-label">Confirmar password</label>
                <input class="form-control" type="password" name="reclave" placeholder="Ingresa tu password">
            </div>
            <div class="form-group btn-container">
                <input type="hidden" name="user" value="{Session::get('id_user')}">
                <input type="hidden" name="enviar" value="{$enviar}">
                <button type="submit" class="btn btn-primary btn-block"><i
                        class="fa fa-sign-in fa-lg fa-fw"></i>Cambiar</button>
            </div>
        </form>
    </div>
</section>