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
        $this->getMessages();

        $this->_view->assign('title', 'Usuarios');
        $this->_view->assign('asunto','Detalle Usuario');
        $this->_view->assign('usuario', User::find(Filter::filterInt($id)));
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
        $this->_view->assign('usuario', User::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validateSession();
        $this->validateUsuario($id);

        $this->validatePUT();

        $this->validateForm('users/edit/'.$id,[
            'name' => Filter::getText('name'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'status' => Filter::getText('status'),
        ]);

        $usuario = User::find(Filter::filterInt($id));
        $usuario->name = Filter::getSql('name');
        $usuario->email = Filter::getPostParam('email');
        $usuario->status = Filter::getInt('status');
        $res = $usuario->save();

        if (!$res) {
            Session::set('msg_error','El usuario no se ha modificado... intente nuevamente');
        }

        Session::set('msg_success','El usuario se ha modificado correctamente');
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
            'nombre' => Filter::getText('name'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'password' => Filter::getSql('password')
        ]);

        if (strlen(Filter::getSql('password')) < 8) {
            Session::set('msg_error', 'El password debe contener al menos 8 caracteres');
            $this->redirect('users/add');
        }

        if (Filter::getSql('password') != Filter::getSql('password_confirm')) {
            Session::set('msg_error', 'Los passwords no coinciden');
            $this->redirect('users/add');
        }

        $usuario = User::select('id')
            ->where('email', Filter::getPostParam('email'))
            ->first();

        if ($usuario) {
            Session::set('msg_error', 'El usuario ingresado ya existe... intente con otro');
            $this->redirect('users/add');
        }

        $usuario = new User;
        $usuario->name = Filter::getSql('name');
        $usuario->email = Filter::getPostParam('email');
        $usuario->status = 1;
        $usuario->password = Helper::encryptPassword(Filter::getSql('password'));
        $res = $usuario->save();

        if (!$res) {
            Session::set('msg_error','El usuario no se ha registrado... intente nuevamente');
        }

        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect('login/login');
    }

    #############################################

    private function validateUsuario($id)
    {
        if ($id) {
            $user = User::select('id')->find(Filter::filterInt($id));

            if ($user) {
                return true;
            }

        }

        $this->redirect('users');
    }
}