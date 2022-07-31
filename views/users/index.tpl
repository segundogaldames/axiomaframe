<div class="col-lg-12 col-md-12 mx-auto">
    <h3>
        {$subject}
    </h3>

    {include file="../partials/_messages.tpl"}

    {if isset($users) && count($users)}
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
                {foreach from=$users item=user}
                    <tr>
                        <td>{$user.id}</td>
                        <td>{$user.name}</td>
                        <td>
                            {if $user.status == 1}
                                <span class="badge text-bg-success">Activo</span>
                            {else}
                                <span class="badge text-bg-danger">Inactivo</span>
                            {/if}
                        </td>
                        <td>
                            <a href="{$_layoutParams.root}users/view/{$user.id}" class="btn btn-success btn-sm">Ver</a>
                            <a href="{$_layoutParams.root}users/edit/{$user.id}" class="btn btn-warning btn-sm">Editar</a>
                        </td>
                    </tr>
                {/foreach}
            </tbody>
        </table>
    {else}
        <p class="text-info">No hay usuarios registrados</p>
    {/if}
</div>