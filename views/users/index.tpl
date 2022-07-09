{include file="header.tpl"}
{include file="menu.tpl"}
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="icon fa fa-user-plus" aria-hidden="true"></i> {$titulo}
                <a href="{$_layoutParams.root}usuarios/add" class="btn btn-outline-dark"><i class="fa fa-user"
                        aria-hidden="true"></i>Crear Usuario</a>
            </h1>
            <p>{$tema}</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="{$_layoutParams.root}usuarios">Usuarios</a></li>
        </ul>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="tile">
                <h3>
                    {$title}
                </h3>

                {include file="../partials/_mensajes.tpl"}

                {if isset($usuarios) && count($usuarios)}
                    <table id="table" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>RUT</th>
                                <th>Nombres</th>
                                <th>Apellidos</th>
                                <th>Rol</th>
                                <th>Status</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            {foreach from=$usuarios item=usuario}
                                <tr>
                                    <td>{$usuario.id}</td>
                                    <td>{$usuario.rut}</td>
                                    <td>{$usuario.name}</td>
                                    <td>{$usuario.lastname}</td>
                                    <td>{$usuario.rol.nombre}</td>
                                    <td>
                                        {if $usuario.status == 1}
                                            <span class="badge badge-success">Activo</span>
                                        {else}
                                            <span class="badge badge-danger">Inactivo</span>
                                        {/if}
                                    </td>
                                    <td>
                                        <a href="{$_layoutParams.root}usuarios/view/{$usuario.id}" class="btn"><i
                                                class="fa fa-eye" aria-hidden="true"></i></a>
                                        <a href="{$_layoutParams.root}usuarios/edit/{$usuario.id}" class="btn"><i
                                                class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                    </td>
                                </tr>
                            {/foreach}
                        </tbody>
                    </table>
                {else}
                    <p class="text-info">No hay usuarios registrados</p>
                {/if}
            </div>
        </div>
    </div>
</main>