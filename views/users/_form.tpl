<div class="col-md-6 offset-md-3">

    <form action="{$_layoutParams.root}{$action}" method="post">
        <div class="form-group mb-2">
            <label for="name" class="control-label">Nombre<span
                    class="text-danger">*</span></label>
            <input type="text" name="name" value="{$usuario.name|default:""}" class="form-control" id="" aria-describedby=""
                placeholder="Nombre del usuario">
        </div>
        <div class="form-group mb-2">
            <label for="email" class="control-label">Email<span class="text-danger">*</span></label>
            <input type="email" name="email" value="{$usuario.email|default:""}" class="form-control" id="" aria-describedby=""
                placeholder="Email del usuario">
        </div>
        {if $button == 'Guardar' || $button == 'Modificar'}
            <div class="form-group">
                <label for="password" class="control-label">Password<span
                        class="text-danger">*</span></label>
                <input type="password" name="password" class="form-control" id="" aria-describedby=""
                    placeholder="Password del usuario" onpaste="return false">
            </div>
            <div class="form-group mb-2">
                <label for="password_confirm" class="control-label">Confirmar Password<span class="text-danger">*</span></label>
                <input type="password" name="password_confirm" class="form-control" id="" aria-describedby="" placeholder="Confirmar password del usuario" onpaste="return false">
            </div>
        {/if}
        {if $button == 'Editar'}
            <div class="form-group mb-2">
                <label for="status" class="control-label">Status<span class="text-danger">*</span></label>
                <select name="status" class="form-control">
                    <option value="{$usuario.status}">
                        {if $usuario.status == 1}
                            Activo
                            <option value="2">Desactivar</option>
                        {else}
                            Inactivo
                            <option value="1">Activar</option>
                        {/if}
                    </option>
                </select>
            </div>
        {/if}

        <input type="hidden" name="_method" value="PUT">
        <input type="hidden" name="send" value="{$send}">
        <button type="submit" class="btn btn-outline-success">{$button}</button>
        <a href="{$_layoutParams.root}" class="btn btn-outline-primary">Cancelar</a>
    </form>
</div>