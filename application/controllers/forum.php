<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Chirag Bhatt
 * @since 2012
 */
class Forum extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('qualifier_m');
		$this->load->model('qualifier_value_m');
	}
	
	public function index() {
		$data['title'] = "Forum Topics";
		$data['qualifiers'] = $this->qualifier_m->get_all();
		$data['qualifier_values'] = $this->qualifier_value_m->get_all();
		$this->load->view('forum/index', $data);
	}
}

/* End of file forum.php */
/* Location: ./application/controllers/forum.php */