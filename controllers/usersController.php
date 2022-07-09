<?php

use models\Rol;
use models\Usuario;

class usuariosController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tema = 'Usuarios del sistema';
        $this->permiso = $this->getPermisos('Usuarios');
    }

    public function index()
    {
        $this->verificarSession();

        if ($this->permiso->leer != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->verificarMensajes();

        $this->_view->assign('titulo', 'Usuarios');
        $this->_view->assign('title','Lista de Usuarios');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('usuarios', Usuario::with('rol')->get());
        $this->_view->renderizar('index');
    }

    public function view($id = null)
    {
        $this->verificarSession();

        if ($this->permiso->leer != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->verificarUsuario($id);
        $this->verificarMensajes();

        $this->_view->assign('titulo', 'Usuario');
        $this->_view->assign('title','Detalle Usuario');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('usuario', Usuario::with('rol')->find($this->filtrarInt($id)));
        $this->_view->renderizar('view');
    }

    public function perfil()
    {
        $this->verificarSession();

        if ($this->permiso->leer != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->verificarMensajes();

        $this->_view->assign('titulo', 'Mi Perfil');
        $this->_view->assign('title','Detalle Usuario');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('usuario', Usuario::with('rol')->find($this->filtrarInt(Session::get('usuario_id'))));
        $this->_view->renderizar('perfil');
    }

    public function edit($id = null)
    {
        $this->verificarSession();

        if ($this->permiso->actualizar != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->verificarUsuario($id);
        $this->verificarMensajes();

        $this->_view->assign('titulo','Editar Usuario');
        $this->_view->assign('title','Editar Usuario');
        $this->_view->assign('button','Editar');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('ruta', 'usuarios/update/' . $id);
        $this->_view->assign('roles', Rol::select('id','nombre')->orderBy('id','asc')->get());
        $this->_view->assign('usuario', Usuario::with('rol')->find($this->filtrarInt($id)));
        $this->_view->assign('enviar', $this->encrypt($this->getForm()));

        $this->_view->renderizar('edit');
    }

    public function update($id = null)
    {
        $this->verificarSession();

        if ($this->permiso->actualizar != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->validaPUT();

        $this->validaForm('usuarios/edit/'.$id,[
            'rut' => $this->getSql('rut'),
            'name' => $this->getTexto('name'),
            'lastname' => $this->getTexto('lastname'),
            'email' => $this->validarEmail($this->getPostParam('email')),
            'phone' => $this->getTexto('phone'),
            'status' => $this->getTexto('status'),
            'rol' => $this->getTexto('rol')
        ]);

        $usuario = Usuario::find($this->filtrarInt($id));
        $usuario->rut = $this->getSql('rut');
        $usuario->name = $this->getSql('name');
        $usuario->lastname = $this->getSql('lastname');
        $usuario->email = $this->getPostParam('email');
        $usuario->phone = $this->getSql('phone');
        $usuario->status = $this->getInt('status');
        $usuario->rol_id = $this->getInt('rol');
        $res = $usuario->save();

        if ($res) {
            Session::set('msg_success','El usuario se ha modificado correctamente');
        }else {
            Session::set('msg_error','El usuario no se ha modificado... intente nuevamente');
        }

        $this->redireccionar('usuarios/view/' . $this->filtrarInt($id));
    }

    public function resetPassword()
    {
        if (Session::get('autenticado')) {
            $this->redireccionar();
        }
        //print_r($_POST);exit;
        $this->_view->assign('titulo', 'Reset Password');
        $this->_view->assign('title','Recuperar Password');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('enviar', $this->encrypt('reset'.CTRL));

        if ($this->decrypt($this->getAlphaNum('enviar')) == ('reset'.CTRL)) {

            $this->validaForm('resetPassword',[
                'email' => $this->validarEmail($this->getPostParam('email'))
            ]);

            $usuario = Usuario::select('id')->where('email', $this->getPostParam('email'))->first();

            if (!$usuario) {
                $this->_view->assign('_error','El correo electrónico no está registrado');
                $this->_view->renderizar('resetPassword');
                exit;
            }

            Session::set('id_user', $usuario->id);
            $this->redireccionar('usuarios/confirmUser');
        }

        $this->_view->renderizar('resetPassword');
    }

    public function confirmUser()
    {
        if (Session::get('autenticado')) {
            $this->redireccionar();
        }
        //print_r($_POST);exit;
        $this->_view->assign('titulo', 'Nuevo Password');
        $this->_view->assign('title','Nuevo Password');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('enviar', $this->encrypt('confirm'.CTRL));

        if ($this->decrypt($this->getAlphaNum('enviar')) == ('confirm'.CTRL)) {

            if (!$this->getSql('clave') && strlen($this->getSql('clave')) < 8) {
                $error = 'Ingrese un password de al menos 8 caracteres';

            }elseif ($this->getSql('clave') != $this->getSql('reclave')) {
                $error = 'Los passwords ingresados no coinciden';

            }

            if (isset($error)) {
                $this->_view->assign('_error','$error');
                $this->_view->renderizar('confirmUser');
                exit;
            }

            $usuario = Usuario::select('id')->find($this->getInt('user'));

            if (!$usuario) {
                $this->_view->assign('_error','El usuario no existe... debe registrarse para continuar');
                $this->_view->renderizar('confirmUser');
                exit;
            }

            $usuario = Usuario::find($this->getInt('user'));
            $usuario->clave = Helper::encriptar($this->getSql('clave'));
            $res = $usuario->save();

            if ($res) {
                Session::set('msg_success','El password se ha modificado correctamente');
            }else{
                Session::set('msg_error','El password no se ha modificado... intente nuevamente');
            }

            $this->redireccionar('usuarios/login');
        }

        $this->_view->renderizar('confirmUser');
    }

    public function editPassword($id = null)
    {
        $this->verificarSession();

        if ($this->permiso->actualizar != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->_view->assign('titulo','Cambiar Password');
        $this->_view->assign('title','Cambiar Password');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('enviar', $this->encrypt(Session::get('usuario_id')));

        if ($this->decrypt($this->getAlphaNum('enviar')) == Session::get('usuario_id')) {

            $this->validaForm('editPassword',[
                'claveactual' => $this->getSql('claveactual')
            ]);

            if (!$this->getSql('clave') && strlen($this->getSql('clave')) < 8) {
                $error='Ingrese un password de al menos 8 caracteres';

            }elseif ($this->getSql('clave') != $this->getSql('reclave')) {
                $error = 'Los passwords ingresados no coinciden';

            }

            if (isset($error)) {
                $this->_view->assign('_error','$error');
                $this->_view->renderizar('confirmUser');
                exit;
            }

            $usuario = Usuario::select('id')
                        ->where('clave', Helper::encriptar($this->getSql('claveactual')))
                        ->find(Session::get('usuario_id'));

            if (!$usuario) {
                $this->_view->assign('_error','El password o el usuario no existe... intente nuevamente');
                $this->_view->renderizar('editPassword');
                exit;
            }

            $usuario = Usuario::find(Session::get('usuario_id'));
            $usuario->clave = Helper::encriptar($this->getSql('clave'));
            $res = $usuario->save();

            if ($res) {
                Session::set('msg_success','El password se ha modificado correctamente');
            }else {
                Session::set('msg_error','El password no se ha modificado... intente nuevamente');
            }

            $this->redireccionar('usuarios/perfil');
        }

        $this->_view->renderizar('editPassword');
    }

    public function add()
    {
        $this->verificarSession();

        if ($this->permiso->escribir != 1) {
            $this->redireccionar('error/noPermit');
        }

        $this->verificarMensajes();

        $this->_view->assign('titulo','Nuevo Usuario');
        $this->_view->assign('title','Nuevo Usuario');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('ruta','usuarios/new');
        $this->_view->assign('usuario', Session::get('dato'));
        $this->_view->assign('roles', Rol::select('id','nombre')->orderBy('id','asc')->get());
        $this->_view->assign('enviar', $this->encrypt($this->getForm()));

        $this->_view->renderizar('add');
    }

    public function new()
    {
        $this->validaForm('usuarios/add',[
            'rut' => $this->getSql('rut'),
            'name' => $this->getTexto('name'),
            'lastname' => $this->getTexto('lastname'),
            'email' => $this->validarEmail($this->getPostParam('email')),
            'phone' => $this->getTexto('phone'),
            'rol' => $this->getTexto('rol')
        ]);

        if (!$this->getSql('clave') && strlen($this->getSql('clave')) < 8) {
            $error='El password debe contener al menos 8 caracteres' ;
        }elseif ($this->getSql('clave') !=
            $this->getSql('reclave')) {
            $error = 'Los passwords no coinciden';
        }


        if (isset($error)) {
            Session::set('msg_error', $error);
            $this->redireccionar('usuarios/add');
        }

        $usuario = Usuario::select('id')->where('rut', $this->getSql('rut'))->first();

        if ($usuario) {
            Session::set('msg_error', 'El usuario ingresado ya existe... intente con otro');
            $this->redireccionar('usuarios/add');
        }

        $usuario = new Usuario;
        $usuario->rut = $this->getSql('rut');
        $usuario->name = $this->getSql('name');
        $usuario->lastname = $this->getSql('lastname');
        $usuario->email = $this->getPostParam('email');
        $usuario->phone = $this->getSql('phone');
        $usuario->status = $this->getInt('status');
        $usuario->rol_id = $this->getInt('rol');
        $usuario->status = 1;
        $usuario->clave = Helper::encriptar($this->getSql('clave'));
        $res = $usuario->save();

        if ($res) {
            Session::set('msg_success','El usuario se ha registrado correctamente');
        }else {
            Session::set('msg_error','El usuario no se ha registrado... intente nuevamente');
        }

        $this->redireccionar('usuarios');
    }

    #############################################

    private function verificarUsuario($id)
    {
        if ($this->filtrarInt($id)) {
            $usuario = Usuario::select('id')->find($this->filtrarInt($id));

            if ($usuario) {
                return true;
            }

        }

        $this->redireccionar('usuarios');
    }
}