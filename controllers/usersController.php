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
        $this->_view->assign('subject','Lista de Usuarios');
        $this->_view->assign('users', User::all());
        $this->_view->render('index');
    }

    public function view($id = null)
    {
        $this->validateSession();
        Validate::validateModel(User::class,$id,'users');
        $this->getMessages();

        $this->_view->assign('title', 'Usuarios');
        $this->_view->assign('subject','Detalle Usuario');
        $this->_view->assign('user', User::find(Filter::filterInt($id)));
        $this->_view->render('view');
    }

    public function edit($id = null)
    {
        $this->validateSession();

        Validate::validateModel(User::class, $id, 'users');
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('subject','Editar Usuario');
        $this->_view->assign('button','Editar');
        $this->_view->assign('back', "users/edit/{$id}");
        $this->_view->assign('process', "users/update/{$id}");
        $this->_view->assign('user', User::find(Filter::filterInt($id)));
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('edit');
    }

    public function update($id = null)
    {
        $this->validateSession();
        Validate::validateModel(User::class, $id, 'users');

        $this->validatePUT();

        $this->validateForm("users/edit/{$id}",[
            'nombre' => Filter::getText('name'),
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'status' => Filter::getText('status'),
        ]);

        $user = User::find(Filter::filterInt($id));
        $user->name = Filter::getSql('name');
        $user->email = Filter::getPostParam('email');
        $user->status = Filter::getInt('status');
        $res = $user->save();

        Session::destroy('data');
        Session::set('msg_success','El usuario se ha modificado correctamente');
        $this->redirect('users/view/' . $id);
    }

    public function add()
    {
        $this->getMessages();

        $this->_view->assign('title','Usuarios');
        $this->_view->assign('subject','Nuevo Usuario');
        $this->_view->assign('button','Guardar');
        $this->_view->assign('back', 'users/<aa');
        $this->_view->assign('process','users/new');
        $this->_view->assign('user', Session::get('data'));
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

        $user = User::select('id')
            ->where('email', Filter::getPostParam('email'))
            ->first();

        if ($user) {
            Session::set('msg_error', 'El usuario ingresado ya existe... intente con otro');
            $this->redirect('users/add');
        }

        $user = new User;
        $user->name = Filter::getSql('name');
        $user->email = Filter::getPostParam('email');
        $user->status = 1;
        $user->password = Helper::encryptPassword(Filter::getSql('password'));
        $res = $user->save();

        Session::destroy('data');
        Session::set('msg_success','El usuario se ha registrado correctamente');
        $this->redirect('login/login');
    }
}