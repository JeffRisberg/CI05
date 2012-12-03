<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Jeff Risberg
 * @since 2012
 */
class Similar extends CI_Controller {

	const c_EntityType = 'POST';
	
	function __construct() {
		parent::__construct();
		
		$this->load->model('post_m');
		$this->load->model('comment_m');
		$this->load->model('qualifier_m');
		$this->load->model('qualifier_value_m');
		$this->load->model('entity_qualifier_value_m');	

		$this->load->library(array('session'));		
	}
		
	/**
	 * Show a list of posts similar to the given one
	 */
	public function index($basis_id = 0) {
		
		$this->data->basis = $this->post_m->get($basis_id);
		$this->data->basis->entity_qualifier_values = $this->entity_qualifier_value_m->get_any(self::c_EntityType, $basis_id);
		$basis_qualifiers_mask = $this->entity_qualifier_value_m->get_mask(self::c_EntityType, $basis_id);
		//var_dump($basis_qualifiers_mask);
		$matches = array();
		
		$ids = $this->post_m->get_all_ids();
		foreach ($ids as $id) {
			$id = (int) ($id->id);
			if ($id != $basis_id) {
				$qualifiers_mask = $this->entity_qualifier_value_m->get_mask(self::c_EntityType, $id);
				//var_dump($qualifiers_mask);
				
				// Match between $basis_qualifiers_mask and $qualifiers_mask	
				$match = 0;
				for ($i = 0; $i < sizeof($qualifiers_mask); $i++) {
					if ($qualifiers_mask[$i] && $basis_qualifiers_mask[$i]) {
						$match++;
					}
				}	
				//var_dump($match);
				if ($match > 0) {
					$matches[$id] = $match;
				}
			}
		}
		arsort($matches);
		//var_dump($matches);
		
		$this->data->posts = $this->post_m->get_from_matches($matches);
		
		foreach ($this->data->posts as &$post) {
			$post->entity_qualifier_values = $this->entity_qualifier_value_m->get_any(self::c_EntityType, $post->id);		
		}
		
		$this->data->title = "Similar posts";
		
		$this->load->view('similar/index', $this->data);
	}
}

/* End of file similr.php */
/* Location: ./application/controllers/similar.php */