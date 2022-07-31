<?php
use models\User;

class passwordsController extends Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function edit()
    {
        $this->validateSession();
        $this->getMessages();

        $this->_view->assign('title','Password');
        $this->_view->assign('subject','Cambiar Password');
        $this->_view->assign('process','passwords/update');
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        $this->_view->render('edit');
    }

    public function update()
    {
        //print_r($_POST);exit;
        $this->validateSession();
        $this->validatePUT();

        $this->validateForm('passwords/edit',[
            'password' => Filter::getSql('password')
        ]);

        if (strlen(Filter::getSql('password')) < 8) {
            Session::set('msg_error','El password debe contener al menos 8 caracteres');
            $this->redirect('passwords/edit');
        }

        if (Filter::getSql('password') != Filter::getSql('password_confirm')) {
            Session::set('msg_error','Los passwords no coinciden');
            $this->redirect('passwords/edit');
        }

        $user = User::find(Session::get('user_id'));
        $user->password = Helper::encryptPassword(Filter::getSql('password'));
        $res = $user->save();

        Session::destroy('data');
        Session::set('msg_success','El password se ha modificado');
        $this->redirect('users/view/' . Session::get('usuario_id'));
    }

    public function resetPassword()
    {
        $this->getMessages();

        $this->_view->assign('title','Resetear Password');
        $this->_view->assign('subject','Resetear Password');
        $this->_view->assign('process','passwords/confirmUser/');
        $this->_view->assign('send', $this->encrypt($this->getForm()));
        $this->_view->render('resetPassword');
    }

    public function confirmUser()
    {
        $this->validateForm('passwords/resetPassword',[
            'email' => $this->validateEmail(Filter::getPostParam('email'))
        ]);

        $user = User::select('id')->where('email', Filter::getPostParam('email'))->first();

        if (!$user) {
            Session::set('msg_error','El email ingresado no está registrado... intente con otro');
            $this->redirect('passwords/resetPassword');
        }

        Session::set('id_user', $user->id);
        $this->redirect('passwords/editPassword');
    }

    public function editPassword()
    {
        $this->getMessages();

        $this->_view->assign('title','Cambiar Password');
        $this->_view->assign('subject','Cambiar Password');
        $this->_view->assign('process','passwords/updatePassword');
        $this->_view->assign('send',$this->encrypt($this->getForm()));
        $this->_view->render('editPassword');
    }

    public function updatePassword()
    {
        $this->validatePUT();
        $this->validateForm('passwords/editPassword',[
            'password' => Filter::getSql('password')
        ]);

        if (strlen(Filter::getSql('password')) < 8) {
            Session::set('msg_error','El password debe contener al menos 8 caracteres');
            $this->redirect('passwords/editPassword');
        }

        if (Filter::getSql('password') != Filter::getSql('password_confirm')) {
            Session::set('msg_error','Los passwords no coinciden');
            $this->redirect('passwords/editPassword');
        }

        if (!Session::get('id_user')) {
            $this->redirect('error/denied');
        }

        $user = User::find(Session::get('id_user'));
        $user->password = Helper::encryptPassword(Filter::getSql('password'));
        $res = $user->save();

        Session::destroy('data');
        Session::set('msg_success','El password se ha restablecido... inicia sessión para continuar');
        $this->redirect('login/login');
    }
}