<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH . '/libraries/Rest.php';
require APPPATH . '/libraries/Response.php';

class Core extends Rest{
     /**
     * Request object. 
     * 
     * @var Request
     */
     public $req;
     /**
     * Response object. 
     * 
     * @var Response
     */
     public $res;
      /**
     * Skiped Url. 
     * 
     * @var Response
     */
     public $skipedUrl = array(
          'auth/register',
          'auth/login'
     );
     /**
     * __construct. 
     * 
     * @var __construct
     */
     function __construct() {     
            
          parent::__construct();

          $this->Initiate();
     }
     /**
     * Initiate. 
     * 
     * @var Initiate
     */
     function Initiate()
     {
          $this->res = new Response();

          $this->req =  json_decode($this->request->body[0]);

          if(!in_array(uri_string(), $this->skipedUrl))
          {
               $headers = $this->input->request_headers();

               if (array_key_exists('Authorization', $headers) && !empty($headers['Authorization']))
               {
                    $decodedToken = AUTHORIZATION::validateToken($headers['Authorization']);
                    if ($decodedToken != false) 
                    {
                         $this->res->SetData($decodedToken);
                    }
                    else
                    {
                         // $this->res->SetStatus(RCD::EC_UNAUTH, RCD::ED_UNAUTH);
                         $this->set_response(
                              $this->res->SetObject(RCD::EC_UNAUTH, RCD::ED_UNAUTH, FALSE, null), Rest::HTTP_UNAUTHORIZED);
                    }
               }
               else
               {
                    // $this->res->SetStatus(RCD::EC_UNAUTH, RCD::ED_UNAUTH);
                    $this->set_response(
                         $this->res->SetObject(RCD::EC_UNAUTH, RCD::ED_UNAUTH, FALSE), Rest::HTTP_UNAUTHORIZED);
               }

          }
     }
}