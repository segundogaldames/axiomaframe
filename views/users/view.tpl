<div class="col-lg-6 col-md-6 mx-auto">
    <h3>{$subject} </h3>
    {include file="../partials/_messages.tpl"}

    <table class="table table-hover">
        <tr>
            <th>Nombre:</th>
            <td>{$user.name}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{$user.email}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                {if $user.status == 1}
                    Activo
                {else}
                    Inactivo
                {/if}
            </td>
        </tr>
        <tr>
            <th>Creado:</th>
            <td>{$user.created_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
        </tr>
        <tr>
            <th>Modificado:</th>
            <td>{$user.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}</td>
        </tr>
    </table>
    <p>
        <a href="{$_layoutParams.root}users" class="btn btn-outline-primary btn-sm">Volver</a>
        <a href="{$_layoutParams.root}passwords/edit" class="btn btn-outline-success btn-sm">Cambiar Password</a>
    </p>
</div>