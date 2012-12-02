<?php if (!defined('BASEPATH')) exit('No direct script access allowed');


class Qualifier_value_m extends CI_Model {

	public function __construct()	{		
		parent::__construct();
		
		$this->_table = 'qualifier_values';
	}
	
	public function create($input) {
		$to_insert = array(
			'qualifier_id' => $input['qualifier_id'],
			'value' => $input['value']
		);

		return $this->db->insert($this->_table, $to_insert);
	}
	
	public function get_all() {
		$this->db->select('q.name as name, qv.value as value, qv.id as id, qv.qualifier_id as qualifier_id');
		$this->db->from('qualifier_values as qv');
		$this->db->join('qualifiers as q', 'qv.qualifier_id = q.id');
		return $this->db->get()->result();
	}
}
