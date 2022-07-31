<?php
use models\User;

class loginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tema = 'Ingreso de usuario';
    }

    #metodo GET que carga el formulario de login
    public function login()
    {
        if (Session::get('autenticado')) {
            $this->redirect();
        }

        $this->getMessages();
        //print_r($_POST);exit;
        $this->_view->assign('title','Login de Usuario');
        $this->_view->assign('subject','Login de Usuario');
        $this->_view->assign('process', 'login/new');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('login');
    }

    #metodo POST que crea el login y la sesion
    public function new()
    {
        $this->validateForm('login/login',[
            'email' => $this->validateEmail(Filter::getPostParam('email')),
            'password' => Filter::getSql('password')
        ]);

        $user = User::
            where('email', Filter::getPostParam('email'))
            ->where('password', Helper::encryptPassword(Filter::getSql('password')))
            ->where('status', 1)
            ->first();

        if (!$user) {
            Session::set('msg_error', 'El email o el password no están registrados... intente nuevamente');
            $this->redirect('login/login');
        }

        Session::set('autenticate', true);
        Session::set('user_id', $user->id);
        Session::set('user_name', $user->name);
        Session::set('time', time());
        Session::set('msg_success','Bienvenid@ ' . $user->name);

        $this->redirect('home');
    }

    public function logout()
    {
        Session::destroy();


        $this->redirect();
    }
}