<?php
use models\Usuario;
use models\Carrito;

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
            $this->redireccionar();
        }

        $this->verificarMensajes();
        //print_r($_POST);exit;
        $this->_view->assign('titulo', 'Usuario Login');
        $this->_view->assign('title','Login de Usuario');
        $this->_view->assign('tema', $this->tema);
        $this->_view->assign('enviar', $this->encrypt($this->getForm()));

        $this->_view->renderizar('login');
    }

    #metodo POST que crea el login y la sesion
    public function new()
    {
        $this->validaForm('login/login',[
            'email' => $this->validarEmail($this->getPostParam('email')),
            'clave' => $this->getSql('clave')
            ]
        );

        $usuario = Usuario::with('rol')
            ->where('email', $this->getPostParam('email'))
            ->where('clave', Helper::encriptar($this->getSql('clave')))
            ->where('status', 1)
            ->first();

        if (!$usuario) {
            Session::set('msg_error', 'El email o el password no están registrados... intente nuevamente');
            $this->redireccionar('login/login');
        }

        Session::set('autenticado', true);
        Session::set('usuario_id', $usuario->id);
        Session::set('usuario_name', $usuario->name . ' ' . $usuario->lastname);
        Session::set('usuario_rol', $usuario->rol->nombre);
        Session::set('tiempo', time());

        $this->vaciarCarrito();

        $this->redireccionar();
    }

    public function logout()
    {
        // $acceso = Usuario::find(Session::get('ingreso'));
        // $acceso->save();


        $this->vaciarCarrito();
        Session::destroy();


        $this->redireccionar();
    }

    #############################################################
    public function vaciarCarrito()
    {
        $carrito = Carrito::where('usuario_id', Session::get('usuario_id'))->where('status',1)->get();

        if ($carrito) {
            foreach ($carrito as $carr) {
                $carr->delete();
            }
        }
    }
}