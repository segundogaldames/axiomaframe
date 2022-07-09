<form action="{$_layoutParams.root}{$ruta}" method="post">
    <div class="form-group">
        <label for="rut" class="control-label">RUT<span class="text-danger">*</span></label>
        <input type="text" name="rut" value="{$usuario.rut|default:""}" class="form-control" id="" aria-describedby=""
            placeholder="RUT del usuario">
    </div>
    <div class="form-group">
        <label for="name" class="control-label">Nombre<span
                class="text-danger">*</span></label>
        <input type="text" name="name" value="{$usuario.name|default:""}" class="form-control" id="" aria-describedby=""
            placeholder="Nombre del usuario">
    </div>
    <div class="form-group">
        <label for="lastname" class="control-label">Apellido(s)<span class="text-danger">*</span></label>
        <input type="text" name="lastname" value="{$usuario.lastname|default:""}" class="form-control" id="" aria-describedby=""
            placeholder="Apellido(s) del usuario">
    </div>
    <div class="form-group">
        <label for="email" class="control-label">Email<span class="text-danger">*</span></label>
        <input type="email" name="email" value="{$usuario.email|default:""}" class="form-control" id="" aria-describedby=""
            placeholder="Email del usuario">
    </div>
    <div class="form-group">
        <label for="phone" class="control-label">Teléfono<span class="text-danger">*</span></label>
        <input type="text" name="phone" value="{$usuario.phone|default:""}" class="form-control" id="" aria-describedby=""
            placeholder="Teléfono del usuario">
    </div>
    <div class="form-group">
        <label for="rol" class="control-label">Rol<span class="text-danger">*</span></label>
        <select name="rol" class="form-control">
            {if $button == 'Editar'}
                <option value="{$usuario.rol_id}">{$usuario.rol.nombre}</option>
            {/if}
            <option value="">Seleccione...</option>
            {foreach from=$roles item=rol}
                <option value="{$rol.id}">{$rol.nombre}</option>
            {/foreach}
        </select>
    </div>
    {if $button == 'Guardar' || $button == 'Modificar'}
        <div class="form-group">
            <label for="clave" class="control-label">Password<span
                    class="text-danger">*</span></label>
            <input type="password" name="clave" class="form-control" id="" aria-describedby=""
                placeholder="Password del usuario" onpaste="return false">
        </div>
        <div class="form-group">
            <label for="reclave" class="control-label">Confirmar Password<span class="text-danger">*</span></label>
            <input type="password" name="reclave" class="form-control" id="" aria-describedby="" placeholder="Confirmar password del usuario" onpaste="return false">
        </div>
    {/if}
    {if $button == 'Editar'}
        <div class="form-group">
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
    <input type="hidden" name="enviar" value="{$enviar}">
    <button type="submit" class="btn btn-outline-success">{$button}</button>
    <a href="{$_layoutParams.root}usuarios" class="btn btn-outline-primary">Cancelar</a>
</form>