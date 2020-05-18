<?php
defined('BASEPATH') or exit('No direct script access allowed');

require APPPATH . '/controllers/Core.php';

class Auth extends Core
{
    public function __construct()
    {

        parent::__construct();
        $this->load->model('User');
    }

    public function login_post()
    {
        // $this->res->setToken(AUTHORIZATION::generateToken($this->req));
        $this->set_response(
            $this->res->SetObject(RCD::SC, RCD::SD, NULL, AUTHORIZATION::generateToken($this->req)),
            Rest::HTTP_OK
        );
    }

    public function register_post()
    {
        $this->req->password = password_hash($this->req->password, PASSWORD_DEFAULT);
        $this->set_response($this->User->add_user($this->req), Rest::HTTP_OK);
    }

    public function forgotpassword_post()
    {
        $res =  $this->User->add_forgotpassword($this->req);
        if ($res->status == RCD::EC_INSERT) {
            $this->res->SetStatus(RCD::EC_INSERT, RCD::ED_INSERT);
        }
        return $this->req;
    }

    public function token_post()
    {
        $this->set_response($this->res, Rest::HTTP_OK);
    }
}