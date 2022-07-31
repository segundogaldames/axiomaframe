<form class="login-form" action="{$_layoutParams.root}{$process}" method="post">
    <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{$subject}</h3>
    <div class="form-group mb-2">
        <label class="control-label">Password</label>
        <input class="form-control" type="password" name="password" placeholder="Ingresa tu password">
    </div>
    <div class="form-group mb-2">
        <label class="control-label">ConfirmarPassword</label>
        <input class="form-control" type="password" name="password_confirm" placeholder="Confirma tu password">
    </div>
    <div class="form-group btn-container">
        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Enviar</button>
    </div>
</form>