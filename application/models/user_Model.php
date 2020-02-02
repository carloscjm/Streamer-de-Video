<?php
class user_model extends CI_Model {
	public function __construct(){
		parent::__construct();
	}
	
	public function listaUsers()
	{
		$this->db->select('*');
		$this->db->from('users');
		return $this->db->get()->result();
		
	}
	
	public function updtEpisodio($episodio, $idUser)
	{
        $this->db->set('episodio', $episodio);
        $this->db->set('idUser', $idUser);
		$this->db->insert('completed');
		
	}
	
}