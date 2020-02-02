<?php
class sobre extends CI_Controller {
    
        public function index()
        {
               self::chama_home();
        }
        function chama_home(){
            $this->load->view('header');
            $this->load->view('sobre');
            $this->load->view('footer');
        }
            
}