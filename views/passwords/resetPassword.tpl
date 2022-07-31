<div class="col-md-6 offset-md-3">
    {include file="../partials/_messages.tpl"}
    <form class="login-form" action="{$_layoutParams.root}{$process}" method="post">
        <h3 class="login-head"><i class="fa fa-lg fa-fw fa-user"></i>{{$asunto}} </h3>
        <div class="form-group mb-2">
            <label class="control-label">Email</label>
            <input class="form-control" type="email" name="email" placeholder="Ingresa tu email">
        </div>
        <div class="form-group btn-container">
            <input type="hidden" name="send" value="{$send}">
            <button type="submit" class="btn btn-primary btn-block"><i
                    class="fa fa-sign-in fa-lg fa-fw"></i>Enviar</button>
        </div>
    </form>
</div>