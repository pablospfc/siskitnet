<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * Created by PhpStorm.
 * User: claud
 * Date: 13/05/2017
 * Time: 20:13
 */
class Templates extends CI_Controller
{
    public function view($view)
    {
        $this->load->view('templates/'.$view);
    }

}