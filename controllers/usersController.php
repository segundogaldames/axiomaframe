<?php

use models\User;

class usersController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->validateSession();

        $this->getMessages();

        $this->_view->assign('title', 'Usuarios');
        $this->_view->assign('asunto','Lista de Usuarios');
        $this->_view->assign('usuarios', User::all());
        $this->_view->render('index');
    }

    public function view($id = null)
    {
        $this->validateSession();
        $this->validateUsuario($id);

        $this->_view->assign('title', 'Usuarios');
        $this->_view->assign('asunto','Detalle Usuario');
        $this->_view->assign('usuario', User::find($this->filterInt($id)));
        $this->_view->render('view');
    }

    public function edit($id = null)
    {
        $this->validateSession();

        $this->validateUsuario($id);
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Editar Usuario');
        $this->_view->assign('button','Editar');
        $this->_view->assign('action', 'users/update/' . $id);
        $this->_view->assign('usuario', User::find($this->filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validateSession();
        $this->validateUsuario($id);

        $this->validatePUT();

        $this->validateForm('users/edit/'.$id,[
            'name' => $this->getText('name'),
            'email' => $this->validateEmail($this->getPostParam('email')),
            'status' => $this->getText('status'),
        ]);

        $usuario = User::find($this->filterInt($id));
        $usuario->name = $this->getSql('name');
        $usuario->email = $this->getPostParam('email');
        $usuario->status = $this->getInt('status');
        $res = $usuario->save();

        if ($res) {
            Session::set('msg_success','El usuario se ha modificado correctamente');
        }else {
            Session::set('msg_error','El usuario no se ha modificado... intente nuevamente');
        }

        $this->redirect('users/view/' . $id);
    }

    public function add()
    {
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('asunto','Nuevo Usuario');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('action','users/new');
        $this->_view->assign('usuario', Session::get('data'));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('add');
    }

    public function new()
    {
        $this->validateForm('users/add',[
            'name' => $this->getText('name'),
            'email' => $this->validateEmail($this->getPostParam('email')),
            'password' => $this->getSql('password')
        ]);

        if (strlen($this->getSql('password')) < 8) {
            $error='El password debe contener al menos 8 caracteres' ;
        }elseif ($this->getSql('password') != $this->getSql('password_confirm')) {
            $error = 'Los passwords no coinciden';
        }


        if (isset($error)) {
            Session::set('msg_error', $error);
            $this->redirect('users/add');
        }

        $usuario = User::select('id')
            ->where('email', $this->getPostParam('email'))
            ->first();

        if ($usuario) {
            Session::set('msg_error', 'El usuario ingresado ya existe... intente con otro');
            $this->redirect('users/add');
        }

        $usuario = new User;
        $usuario->name = $this->getSql('name');
        $usuario->email = $this->getPostParam('email');
        $usuario->status = 1;
        $usuario->password = Helper::encryptPassword($this->getSql('clave'));
        $res = $usuario->save();

        if ($res) {
            Session::set('msg_success','El usuario se ha registrado correctamente');
        }else {
            Session::set('msg_error','El usuario no se ha registrado... intente nuevamente');
        }

        $this->redirect('users');
    }

    #############################################

    private function validateUsuario($id)
    {
        if ($this->filterInt($id)) {
            $user = User::select('id')->find($this->filterInt($id));

            if ($user) {
                return true;
            }

        }

        $this->redirect('usuarios');
    }
}