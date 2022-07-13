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
        $this->_view->assign('usuario', User::find(Param::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validateSession();
        $this->validateUsuario($id);

        $this->validatePUT();

        $this->validateForm('users/edit/'.$id,[
            'name' => Param::getText('name'),
            'email' => $this->validateEmail(Param::getPostParam('email')),
            'status' => Param::getText('status'),
        ]);

        $usuario = User::find(Param::filterInt($id));
        $usuario->name = Param::getSql('name');
        $usuario->email = Param::getPostParam('email');
        $usuario->status = Param::getInt('status');
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
            'nombre' => Param::getText('name'),
            'email' => $this->validateEmail(Param::getPostParam('email')),
            'password' => Param::getSql('password')
        ]);

        if (strlen(Param::getSql('password')) < 8) {
            Session::set('msg_error', 'El password debe contener al menos 8 caracteres');
            $this->redirect('users/add');
        }

        if (Param::getSql('password') != Param::getSql('password_confirm')) {
            Session::set('msg_error', 'Los passwords no coinciden');
            $this->redirect('users/add');
        }

        $usuario = User::select('id')
            ->where('email', Param::getPostParam('email'))
            ->first();

        if ($usuario) {
            Session::set('msg_error', 'El usuario ingresado ya existe... intente con otro');
            $this->redirect('users/add');
        }

        $usuario = new User;
        $usuario->name = Param::getSql('name');
        $usuario->email = Param::getPostParam('email');
        $usuario->status = 1;
        $usuario->password = Helper::encryptPassword(Param::getSql('password'));
        $res = $usuario->save();

        if (!$res) {
            Session::set('msg_error','El usuario no se ha registrado... intente nuevamente');
        }

        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect();
    }

    #############################################

    private function validateUsuario($id)
    {
        if ($this->filterInt($id)) {
            $user = User::select('id')->find(Param::filterInt($id));

            if ($user) {
                return true;
            }

        }

        $this->redirect('users');
    }
}