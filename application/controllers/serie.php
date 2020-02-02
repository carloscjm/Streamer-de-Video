<?php
class serie extends CI_Controller {
    
        public function __construct(){
            parent::__construct();
            $this->load->model('episodios_model', 'episodioModel');
        }
        public function index()
        {
            $path = "D:/xamp/htdocs/streamer/videos/".$_GET['serie'];
            $diretorio = dir($path);
            $files = [];
            $count = 0;
            $countRow = 1;
            $html = "<div class='container'>";
            
            while($arquivo = $diretorio -> read()){
                $verificaepi = $this->episodioModel->verificaEpisodio($arquivo, $_SESSION['usuario']);
                if($verificaepi != NULL)
                {
                    $bt_color = 'background-color: green;';
                }else $bt_color = '';
                $tipo = substr($arquivo, -4);
                if($tipo=='.jpg' || $tipo=='.png')
                {
                    $banner = $arquivo;
                }
                if($arquivo != '.' && $arquivo != '..' && $tipo == '.mp4' || $tipo == '.mkv')
                {
                    if($countRow == 1 || $countRow == 4)
                    {
                        $html.= "<div style='margin-top: 40px;' class='row'>";
                    }
                    $html.="<div style='display: grid;max-width: 32%;' class='col-sm'>";
                    $html.="<img style='width: 50%; margin-bottom: 10px;' src='/streamer/videos/".$_GET['serie']."/".$banner."'/>";
                    $html.="<span id='chap_name' style='color:white;'>".$arquivo."</span>";
                    $html.="<button style='width: 50%;".$bt_color."' id='cap".$count."' onclick='openPopUp(`/streamer/videos/".$_GET['serie']."/".$arquivo."`,".$count.");' type='button' class='btn btn-primary play_bt' data-toggle='modal' data-target='#modalPlayer'>
                    Play
                    </button></div>";
                    $count++;
                    $countRow++;
                    if($countRow == 4)
                    {
                        $html.= "</div>";
                        $countRow = 1;
                    }
                }
            }
            $html .= "</div>";
            $diretorio -> close();
            $data['html'] = $html;
            $this->load->view('header');
            $this->load->view('serie', $data);
            $this->load->view('footer');
        }

        public function updt_views()
        {
            $caputuloName = $this->input->post('capName');
            $userId = $_SESSION['usuario'];
            $verificaepi = $this->episodioModel->updtEpisodio($caputuloName,$userId);
            echo json_encode('verificaepi');
        }
}