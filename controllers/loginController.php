<?php
use models\User;

class loginController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->tema = 'Ingreso de usuario';
    }

    public function index()
    {

    }

    public function view($id = null)
    {

    }

    public function edit($id = null)
    {

    }

    public function update($id = null)
    {

    }

    public function add()
    {

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
        $this->_view->assign('asunto','Login de Usuario');
        $this->_view->assign('send', $this->encrypt($this->getForm()));

        $this->_view->render('login');
    }

    #metodo POST que crea el login y la sesion
    public function new()
    {
        $this->validateForm('login/login',[
            'email' => $this->validateEmail($this->getPostParam('email')),
            'password' => $this->getSql('password')
            ]
        );

        $usuario = User::
            where('email', $this->getPostParam('email'))
            ->where('password', Helper::encryptPassword($this->getSql('password')))
            ->where('status', 1)
            ->first();

        //print_r(Helper::encryptPassword($this->getSql('password')));exit;

        if (!$usuario) {
            Session::set('msg_error', 'El email o el password no están registrados... intente nuevamente');
            $this->redirect('login/login');
        }

        Session::set('autenticate', true);
        Session::set('usuario_id', $usuario->id);
        Session::set('usuario_name', $usuario->name);
        Session::set('tiempo', time());
        Session::set('msg_success','Bienvenid@ ' . $usuario->name);

        $this->redirect();
    }

    public function logout()
    {
        Session::destroy();


        $this->redirect();
    }
}