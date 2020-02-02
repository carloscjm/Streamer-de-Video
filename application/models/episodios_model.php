<?php
class episodios_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	
	public function verificaEpisodio($episodio, $idUser)
	{
		$idUser = intval($idUser);
		$this->db->select('*');
		$this->db->where('episodio', $episodio);
		$this->db->where('idUser', $idUser);
		$this->db->from('completed');
		return $this->db->get()->result();
		
	}
	
	public function updtEpisodio($episodio, $idUser)
	{
        $this->db->set('episodio', $episodio);
        $this->db->set('idUser', $idUser);
		$this->db->insert('completed');
	}
	
}