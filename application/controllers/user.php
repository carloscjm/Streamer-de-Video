<?php
class user extends CI_Controller {
    
        public function __construct(){
            parent::__construct();
            $this->load->model('user_model', 'userModel');
        }
        public function index()
        {
            $listaUsers = $this->userModel->listaUsers();
            $html = "<div class='container'><div class='row' style='max-width: 460px;'>";
            foreach ($listaUsers as $value)
            {
                $html .= "<div class='col-sm usersHome'><div onclick='sessionUser(".$value->id.",`".$value->nome."`)'>".$value->nome."</div></div>";
            }
            $html .= "</div></div>";
            $data['html'] = $html;
            $this->load->view('header');
            $this->load->view('index', $data);
            $this->load->view('footer');
        }

        public function salvaSession()
        {
            $usuario = $this->input->post('id');
            $nomeUser = $this->input->post('nome');
            if (session_status() !== PHP_SESSION_ACTIVE) {//Verificar se a sessão não já está aberta.
                session_start();
              }
              $_SESSION['usuario'] = $usuario;
              $_SESSION['nome'] = $nomeUser;
              echo json_encode('ok');
        }

}