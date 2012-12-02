<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Jeff Risberg
 * @since 2012
 */
class Post_m extends CI_Model {

	function get($id) {
		return $this->db->where('id', $id)->get('posts')->row();
	}
	
	function get_all() {		
		$this->db->order_by('date_created', 'desc');
		$query = $this->db->get('posts');
		return $query->result();
	}
	
	function insert($image) {
		$date = date('Y-m-d H:i:s');
		$data = array(
			'title' => $_POST['title'],
			'body' => $_POST['body'],
			'date_created' => $date,
		  'last_updated' => $date,
			'image' => $image
		);
		$this->db->insert('posts', $data);
		
		return $this->db->insert_id();
	}
	
  public function update($id, $image) {
		$this->title = $_POST['title'];
		$this->body = $_POST['body'];
		$this->last_updated = date('Y-m-d H:i:s');
		$this->image = $image;

		$this->db->update('posts', $this, array('id' => $id));
	}

	public function delete($id) {
		$this->db->delete('posts', array('id' => $id));
	}
	
	function get_comments($post_id)	{
		$this->db->where('post_id', $post_id);
		$query = $this->db->get('comments');
		return $query->result();
	}
	
	function total_comments($id) {
		$this->db->like('post_id', $id);
		$this->db->from('comments');
		return $this->db->count_all_results();
	}
}

/* End of file post_model.php */
/* Location: ./application/models/post_model.php */