<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// require APPPATH . '/libraries/Response.php';

class User extends CI_Model{

    const user = 'user';
    const forgotpassword = 'forgotpassword';

    function __construct()
    {
        parent::__construct();
        $this->res = new Response();
    }

    public $res;

    /*
    Add user data
    */
    public function add_user($user)
    {
        if(empty($user->email))
        {
            $this->res->SetObject(RCD::EC_EMPTY, RCD::ED_EMPTY, FALSE, NULL);
        }
        if($this->db->insert(self::user, $user))
        {
            $this->res->SetObject(RCD::SC, RCD::SD,FALSE, NULL);
        }
        else
        {
            $this->res->SetObject(RCD::EC_INSERT, RCD::ED_INSERT,TRUE, NULL);
        }
    }

    /*
    Get all user data
    */
    public function all_user()
    {
        $this->res->SetObject(RCD::SC, RCD::SC, FALSE, $this->db->get('user')->result());
    }

    /*
    Get one user data
    */
    public function get_user($request)
    {
        if(empty($request->email))
        {
            $this->res->SetObject(RCD::EC_EMPTY, RCD::ED_EMPTY, FALSE, NULL);
        }
        $this->db->where(array('email' => $request->email));
        $result = $this->db->get(self::user)->row();
        if(empty($result))
        {
            $this->res->SetObject(RCD::EC_EMPTY, RCD::ED_EMPTY, FALSE, NULL);
        }
        else
        {
            $this->res->SetObject(RCD::SC, RCD::SD, FALSE, $result);
        }
    }

    /*
    Update user data
    */
    public function update_user($user){
        if(empty($user->email))
        {
            $this->res->SetObject(RCD::EC_EMPTY, RCD::ED_EMPTY, FALSE, NULL);
        }
        $this->db->where(array('id' => $user->id));
        if($this->db->update(self::user, $user))
        {
            $this->res->SetObject(RCD::SC, RCD::SD, FALSE, NULL);
        }
        else
        {
            $this->res->SetObject(RCD::EC_UPDATE, RCD::ED_UPDATE, TRUE, NULL);
        }
    }

    /*
    Delete user data
    */
    public function delete_user($user){
        if(empty($user->email))
        {
            $this->res->SetObject(RCD::EC_EMPTY, RCD::ED_EMPTY, FALSE, NULL);
        }
        $where = array('id'=>$id);
        $this->db->where(array('id' => $user['id']));
        if($this->db->delete(self::user))
        {
            $this->res->SetObject(RCD::SC, RCD::SD, FALSE, NULL);
        }
        else
        {
            $this->res->SetObject(RCD::EC_DELETE, RCD::ED_DELETE, TRUE, NULL);
        }
    }

    /*
    Get user from forgot_password
    */
    public function add_forgotpassword($request){
        
        if($this->get_user($request)->status == RCD::EC_EMPTY)
        {
            $this->res->SetObject(RCD::EC_EMPTY, RCD::ED_EMPTY, FALSE, NULL);
        }
        $this->db->where(array('email' => $request->email));
        if(empty($this->db->get(self::forgotpassword)->row()))
        {
            $user = array(
                'token' => AUTHORIZATION::generateToken($request),
                'email' => $request['email']
            );    
            if($this->db->insert(self::forgotpassword, $user))
            {
                $this->res->SetObject(RCD::SC, RCD::SD, FALSE, NULL);
            }
            else
            {
                $this->res->SetObject(RCD::EC_INSERT, RCD::ED_INSERT,TRUE, NULL);
            }
        }

        $this->res->SetObject(RCD::SC, RCD::SD, FALSE, NULL);

    }
}