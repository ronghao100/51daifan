<?php

class Signin extends CI_Controller {

      public function signin() {
          $d['abc'] = 'abc';
          $this->load->view('home', $d);
          
      }
}
