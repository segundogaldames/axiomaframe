<div class="col-lg-6 col-md-6 mx-auto">
    <h3>{{$asunto}} </h3>
    {include file="../partials/_messages.tpl"}

    <table class="table table-hover">
        <tr>
            <th>Nombre:</th>
            <td>{{$usuario.name}}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{$usuario.email}}</td>
        </tr>
        <tr>
            <th>Status:</th>
            <td>
                {{if $usuario.status == 1}}
                    Activo
                {{else}}
                    Inactivo
                {{/if}}
            </td>
        </tr>
        <tr>
            <th>Creado:</th>
            <td>{{$usuario.created_at|date_format:"%d-%m-%Y %H:%M:%S"}}</td>
        </tr>
        <tr>
            <th>Modificado:</th>
            <td>{{$usuario.updated_at|date_format:"%d-%m-%Y %H:%M:%S"}}</td>
        </tr>
    </table>
    <p>
        <a href="{{$_layoutParams.root}}users" class="btn btn-outline-primary btn-sm">Volver</a>
        <a href="{{$_layoutParams.root}}passwords/edit" class="btn btn-outline-success btn-sm">Cambiar Password</a>
    </p>
</div>