<div class="col-md-6 offset-md-3">
    {include file="../partials/_messages.tpl"}
    <form class="login-form" action="{$_layoutParams.root}{$process}" method="post">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>Login</h3>
        <div class="form-group mb-2">
            <label class="control-label">Email</label>
            <input name="email" class="form-control" type="email" placeholder="Ingresa tu email" autofocus>
        </div>
        <div class="form-group mb-2">
            <label class="control-label">Password</label>
            <input class="form-control" type="password" name="password" placeholder="Ingresa tu password">
        </div>
        <div class="form-group mb-2">
            <div class="utility">

                <p class="semibold-text mb-2"><a href="{$_layoutParams.root}passwords/resetPassword">¿Olvidaste tu
                        password?</a></p>
            </div>
        </div>
        <div class="form-group btn-container">
            <input type="hidden" name="send" value="{$send}">
            <button type="submit" class="btn btn-primary btn-block"><i class="fa fa-sign-in fa-lg fa-fw"></i>Login</button>
        </div>
    </form>
</div>