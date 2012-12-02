<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Qualifier_m extends CI_Model {

	public function __construct()	{		
		parent::__construct();
		
		$this->_table = 'qualifiers';
	}
	
	public function create($input) {
		$to_insert = array(
			'name' => $input['name'],
			'seq_num' => $input['seq_num'],
			'description' => $input['description']
		);

		return $this->db->insert($this->_table, $to_insert);
	}
	 
	public function get_all() {
		$this->db->select('q.id as id, q.name as name');
		$this->db->from('qualifiers as q');	
		return $this->db->get()->result();
	}
}
