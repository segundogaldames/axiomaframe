{include file="header.tpl"}
{include file="menu.tpl"}
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="icon fa fa-user-plus" aria-hidden="true"></i> {$titulo}</h1>
            <p>{$tema}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{$_layoutParams.root}usuarios/perfil">Perfil</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3>
                    {$title}
                </h3>

                {include file="../partials/_mensajes.tpl"}
                <p class="text-danger">Campos obligatorios</p>
                <form action="" method="post">

                    <div class="form-group">
                        <label for="claveactual" class="control-label">Password actual<span class="text-danger">*</span></label>
                        <input type="password" name="claveactual" class="form-control" id="" aria-describedby=""
                            placeholder="Password del usuario" onpaste="return false">
                    </div>

                    <div class="form-group">
                        <label for="clave" class="control-label">Password<span class="text-danger">*</span></label>
                        <input type="password" name="clave" class="form-control" id="" aria-describedby=""
                            placeholder="Password del usuario" onpaste="return false">
                    </div>
                    <div class="form-group">
                        <label for="reclave" class="control-label">Confirmar Password<span
                                class="text-danger">*</span></label>
                        <input type="password" name="reclave" class="form-control" id="" aria-describedby=""
                            placeholder="Confirmar password del usuario" onpaste="return false">
                    </div>

                    <input type="hidden" name="enviar" value="{$enviar}">
                    <button type="submit" class="btn btn-outline-success">Modificar</button>
                    <a href="{$_layoutParams.root}usuarios/perfil" class="btn btn-outline-primary">Cancelar</a>
                </form>

            </div>
        </div>
    </div>
</main>