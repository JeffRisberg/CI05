<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Jeff Risberg
 * @since late summer 2012
 */
class Entity_qualifier_value_m extends CI_Model {

	public function __construct()	{
		parent::__construct();

		$this->_table = 'entity_qualifier_value';
	}

	/**
	 * $input is a post array	
	 */
	public function create_by_post($input) {
		$data = array(
				'entity_type'        => $this->input->post('entity_type'),
				'entity_id'          => $this->input->post('entity_id'),
				'qualifier_value_id' => $this->input->post('qualifier_value_id'),
		);
		$this->db->insert($this->_table, $data);
	}
	
	/**
	 * specific ids known
	 */
	public function create_by_ids($entity_type, $entity_id, $qualifier_value_id) {
		$data = array(
				'entity_type'        => $entity_type,
				'entity_id'          => $entity_id,
				'qualifier_value_id' => $qualifier_value_id,
		);		
		$this->db->insert($this->_table, $data);
	}
	
	/**
	 * very commonly used	
	 */
	public function create_any($entity_type, $entity_id, $input) {
		$qualifier_values = $this->input->post('qualifiervalue');
		
		if ($qualifier_values != null && sizeof($qualifier_values) > 0) {
			for ($i = 0; $i < sizeof($qualifier_values); $i++) {
				$data = array(
						'entity_type'        => $entity_type,
						'entity_id'          => $entity_id,
						'qualifier_value_id' => $qualifier_values[$i],
				);
				$this->db->insert($this->_table, $data);
			}
		}
	}
	
	/**
	 * specific ids known
	 */	
	public function get_any($entity_type, $entity_id) {
		$this->db->select('eqv.*, qv.value value');
		$this->db->from('entity_qualifier_value eqv');	
		$this->db->join('qualifier_values qv','eqv.qualifier_value_id = qv.id', 'left');		
		$this->db->where('entity_type', $entity_type);
		$this->db->where('entity_id', $entity_id);
	
		return $this->db->get()->result();
	}
	
	/**
	 * Returns the count of entities associated with each qualifier value
	 *
	 * Used on totalizer screens.
	 */
	public function count_by_qualifier_value($entity_type) {
		$table_name = "posts";
	
		$this->db->select('eqv.qualifier_value_id, count(eqv.entity_id) AS count_value');
		$this->db->from('entity_qualifier_value eqv');	
		$this->db->join($table_name . ' record', 'eqv.entity_id = record.id', 'left');
		$this->db->where('eqv.entity_type', $entity_type);
		$this->db->where('record.status', 'live');
		$this->db->group_by('eqv.qualifier_value_id');
		
		return $this->db->get()->result();
	}
	
	/**
	 * Returns the count of entities associated with each qualifier value
	 *
	 * Used on totalizer screens.
	 */
	public function count_by_user_and_qualifier_value($entity_type) {
		$table_name = "posts";
	
		$this->db->select('eqv.qualifier_value_id, count(eqv.entity_id) AS count_value');
		$this->db->from('entity_qualifier_value eqv');
		$this->db->join($table_name . ' record', 'eqv.entity_id = record.id', 'left');
		$this->db->where('eqv.entity_type', $entity_type);
		$this->db->where('record.created_by', $this->current_user ? $this->current_user->id : 0);
		$this->db->where('record.status', 'live');
		$this->db->group_by('eqv.qualifier_value_id');
	
		return $this->db->get()->result();
	}
	
	/**
	 * delete when you know the record id
	 */
	public function delete_by_id($id) {
		$this->db->delete($id);
	}
	
	/**
	 * delete when you know the specific id tuple
	 */
	public function delete_by_ids($entity_type, $entity_id, $qualifier_value_id) {
		$this->db->where('entity_type', $entity_type);
		$this->db->where('entity_id', $entity_id);
		$this->db->where('$qualifier_value_id', $qualifier_value_id);
		
		$this->db->delete($this->_table);
	}
	
	/**
	 * delete all values for this (entity_type, entity_id)
	 */
	public function delete_any($entity_type, $entity_id) {
		$this->db->where('entity_type', $entity_type);
		$this->db->where('entity_id', $entity_id);
		
		$this->db->delete($this->_table);
	}
}
