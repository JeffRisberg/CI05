<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Jeff Risberg
 * @since 2012
 */
class Comment_m extends CI_Model {

	function get($id) {
		$this->db->where('id', $id);
		$query = $this->db->get('comments');
		return $query->row_array();
	}
	
	function get_all() {
		$this->db->order_by('date_created','desc');
		$query = $this->db->get('comments');
		return $query->result_array();
	}
	
	function insert($post_id, $title, $email, $body) {
		$date = date('Y-m-d H:i:s');
		$data = array(
				'post_id' => $post_id,
				'title' => $title,
				'email' => $email,
				'body' => $body,
				'date_created' => $date,
				'last_updated' => $date
		);
		$this->db->insert('comments', $data);
	}
	
	public function update() {
		$this->title = $_POST['title'];
		$this->body = $_POST['body'];
		$this->last_updated = date('Y-m-d H:i:s');
			
		$this->db->update('comments', $this, array('id' => $_POST['id']));
	}
	
	public function delete() {
		$this->db->delete('comments', array('id' => $_POST['id']));
	}
	
}

/* End of file comment_model.php */
/* Location: ./application/models/comment_model.php */