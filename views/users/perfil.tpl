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
            <li class="breadcrumb-item"><a href="{$_layoutParams.root}usuarios/perfil">Mi Perfil</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3>
                    {$title}
                </h3>

                {include file="../partials/_mensajes.tpl"}

                <table class="table table-hover">
                    <tr>
                        <th>RUT:</th>
                        <td>{$usuario.rut}</td>
                    </tr>
                    <tr>
                        <th>Nombres:</th>
                        <td>{$usuario.name}</td>
                    </tr>
                    <tr>
                        <th>Apellidos:</th>
                        <td>{$usuario.lastname}</td>
                    </tr>
                    <tr>
                        <th>Email:</th>
                        <td>{$usuario.email}</td>
                    </tr>
                    <tr>
                        <th>Teléfono:</th>
                        <td>{$usuario.phone}</td>
                    </tr>
                    <tr>
                        <th>Rol:</th>
                        <td>{$usuario.rol.nombre}</td>
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
                    <a href="{$_layoutParams.root}usuarios/editPassword" class="btn btn-outline-primary btn-sm">Cambiar Password</a>
                </p>
            </div>
        </div>
    </div>
</main>