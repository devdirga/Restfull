<?php

class Response
{
    public $data = null;
    
    public $status = 200;
    
    public $description = "Success";
    
    public $token;

    public $error;

    public function __construct()
    {
        $this->data = new \stdClass();
    }

    public function SetObject($status = 200, $description = 'success' , $data = null, $token)
    {
        $this->status = $status;
        $this->description = $description;
        $this->data = $data;
        $this->token = $token;
        return $this;
    }

    public function SetDataAsObject()
    {
        $this->data = new \stdClass();
    }

    public function SetDataAsArray()
    {
        $this->data = array();
    }


    /*

    public function SetStatus($status, $description)
    {
        $this->status = $status;
        $this->description = $description;
    }

    public function setDataAsObject()
    {
        $this->data = new \stdClass();
    }
    
    public function setDataAsArray()
    {
        $this->data = array();
    }

    public function setToken($token)
    {
        $this->token = $token;
    }

    public function SetResponse($Status, $Description, $Data)
    {
        $this->status = $Status;
        $this->description = $Description;
        $this->data = $Data;
    }

    public function SetData($Data)
    {
        $this->data = $Data;
    }

    public function SetObject($status, $description, $error, $data)
    {
        $this->status = $status;
        $this->description = $description;
        $this->error = $error;
        $this->data = $data;
        return $this;
    }

    */

}