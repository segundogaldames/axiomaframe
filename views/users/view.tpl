<h3>
    {$title}
</h3>

{include file="../partials/_messages.tpl"}

<table class="table table-hover">
    <tr>
        <th>Nombre:</th>
        <td>{$usuario.name}</td>
    </tr>
    <tr>
        <th>Email:</th>
        <td>{$usuario.email}</td>
    </tr>
    <tr>
        <th>Status:</th>
        <td>
            {if $usuario.status == 1}
                Activo
            {else}
                Inactivo
            {/if}
        </td>
    </tr>
    <tr>
        <th>Creado:</th>
        <td>{$usuario.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
    </tr>
    <tr>
        <th>Modificado:</th>
        <td>{$usuario.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
    </tr>
</table>
<p>
    <a href="{$_layoutParams.root}usuarios/" class="btn btn-outline-primary btn-sm">Volver</a>
</p>