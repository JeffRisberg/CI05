<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Jeff Risberg
 * @since 2012
 */
class Comment extends CI_Controller {

	function __construct() {
		parent::__construct();
		
		$this->load->model('post_m');
		$this->load->model('comment_m');
	}
}

/* End of file comment.php */
/* Location: ./application/controllers/comment.php */