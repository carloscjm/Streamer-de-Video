<?php
class home extends CI_Controller {
    
        public function index()
        {
            $path = "D:/xamp/htdocs/streamer/videos";
            $diretorio = dir($path);
            $files = [];
            $count = 0;
            $html = '';
            $countRow = 1;
            while($arquivo = $diretorio -> read()){
                if($arquivo != '.' && $arquivo != '..')
                {
                    $pathInside = "D:/xamp/htdocs/streamer/videos/".$arquivo;
                    $diretorioInside = dir($pathInside);
                    while($arquivoInside = $diretorioInside -> read()){
                        if($arquivoInside == 'name.txt')
                        {
                            $arquivotxt = fopen ($pathInside."/".$arquivoInside, 'r');
                            while(!feof($arquivotxt))
                            {
                                //Mostra uma linha do arquivo
                                $linha = fgets($arquivotxt, 1024);
                            }
                            // Fecha arquivo aberto
                            fclose($arquivotxt);
                        }
                        $tipo = substr($arquivoInside, -4);
                        if($tipo == '.jpg' || $tipo == '.png'){
                            $imgHome = $arquivoInside;
                        }
                    }
                    if($countRow == 1 || $countRow == 4)
                    {
                        $html.= "<div style='margin-top: 40px;' class='row'>";
                    }
                    $html.="<div style='margin-bottom: 30px;display: grid;max-width: 460px;' class='col-sm'>";
                    $html.="<a style='margin-left: 60px;align-items: center;display: flex;flex-direction: row;flex-wrap: wrap;justify-content: center;width: 70%; padding: 20px;background: #007bff; color: white;' href='serie?serie=".$arquivo."'>
                             <img style='width: 100%; margin-bottom: 10px;' src='/streamer/videos/".$arquivo."/".$imgHome."'/>
                            ".$linha."
                            </a>
                        </div>";
                    $countRow++;
                    if($countRow == 4)
                    {
                        $html.= "</div>";
                        $countRow = 1;
                    }
                }
            }
            $diretorio -> close();
            $data['html'] = $html;

            $this->load->view('header');
            $this->load->view('home', $data);
            $this->load->view('footer');
        }
            
}