<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * @author Chirag Bhatt
 * @since January 2013
 * @based of similar.php
 */
class Cosinesim extends CI_Controller {

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
		$basis_qualifiers_mask = $this->entity_qualifier_value_m->get_score_mask(self::c_EntityType, $basis_id);
		//var_dump($basis_qualifiers_mask);
		
		//Normalize the scores for basis document
		$sum_squares = 0;
		for ($i = 0; $i < sizeof($basis_qualifiers_mask); $i++) {
			$sum_squares += $basis_qualifiers_mask[$i] * $basis_qualifiers_mask[$i];
		}
		$norm = sqrt($sum_squares);
		for ($i = 0; $i < sizeof($basis_qualifiers_mask); $i++) {
			$basis_qualifiers_mask[$i] = $basis_qualifiers_mask[$i]/$norm;
		}
		$dotprods = array();
		
		$ids = $this->post_m->get_all_ids();
		foreach ($ids as $id) {
			$id = (int) ($id->id);
			if ($id != $basis_id) {
				$qualifiers_mask = $this->entity_qualifier_value_m->get_score_mask(self::c_EntityType, $id);
				//var_dump($qualifiers_mask);

				//Normalize the scores for this document
				$sum_squares = 0;
				for ($i = 0; $i < sizeof($basis_qualifiers_mask); $i++) {
					$sum_squares += $basis_qualifiers_mask[$i] * $basis_qualifiers_mask[$i];
				}
				$norm = sqrt($sum_squares);
				for ($i = 0; $i < sizeof($basis_qualifiers_mask); $i++) {
					$basis_qualifiers_mask[$i] = $basis_qualifiers_mask[$i]/$norm;
				}
				
				// Dot product between $basis_qualifiers_score_mask and $qualifiers_score_mask	
				$dotprod = 0;
				for ($i = 0; $i < sizeof($qualifiers_mask); $i++) {
					$dotprod += $qualifiers_mask[$i] * $basis_qualifiers_mask[$i];
				}
				if ($dotprod > 0) {
					$dotprods[$id] = $dotprod;
				}
			}
		}
		//var_dump($dotprods);
		arsort($dotprods);
		echo "sorted dot products";
		var_dump($dotprods);
		
		$this->data->posts = $this->post_m->get_from_matches($dotprods);
		
		foreach ($this->data->posts as &$post) {
			$post->entity_qualifier_values = $this->entity_qualifier_value_m->get_any(self::c_EntityType, $post->id);		
		}
		
		$this->data->title = "Similar posts (Cosine Similarity)";
		
		$this->load->view('cosinesim/index', $this->data);
	}
}

/* End of file cosinesim.php */
/* Location: ./application/controllers/cosinesim.php */