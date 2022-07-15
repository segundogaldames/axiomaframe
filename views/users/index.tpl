<div class="col-lg-12 col-md-12 mx-auto">
    <h3>
        {$asunto}
    </h3>

    {include file="../partials/_messages.tpl"}

    {if isset($usuarios) && count($usuarios)}
        <table id="table" class="table table-hover">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>Status</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                {foreach from=$usuarios item=usuario}
                    <tr>
                        <td>{$usuario.id}</td>
                        <td>{$usuario.name}</td>
                        <td>
                            {if $usuario.status == 1}
                                <span class="badge text-bg-success">Activo</span>
                            {else}
                                <span class="badge text-bg-danger">Inactivo</span>
                            {/if}
                        </td>
                        <td>
                            <a href="{$_layoutParams.root}users/view/{$usuario.id}" class="btn btn-success btn-sm">Ver</a>
                            <a href="{$_layoutParams.root}users/edit/{$usuario.id}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="text-info">No hay usuarios registrados</p>
    {/if}
</div>