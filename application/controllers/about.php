<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Jeff Risberg
 * @since 2012
 */
class About extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('post_m');
		$this->load->model('comment_m');
	}
	
	public function index() {
		$data['title'] = "About Elephant";
		$data['monthes'] = array( 1 => "Jan", 2 => "Feb", 3 => "March", 4=> "April", 5=> "May", 6 => "June");
		$this->load->view('about/index', $data);
	}
}

/* End of file about.php */
/* Location: ./application/controllers/about.php */