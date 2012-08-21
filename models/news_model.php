<?php
class News_model extends CI_Model {
	
	public function __construct()
	{
		$this->load->database();
	}
	public function get_news($slug = FALSE)
	{
		if($slug ===FALSE)
		{
			$query = $this->db->get('news');
			return $query->result_array();
		}
		$query = $this->db->get_where('news', array('slug'=> $slug));
		return $query->row_array();
	}
	public function view ($slug)
	{
		$data['news_item']= $this->news_model->get_news($slug);

		if (empty($data['news_item']))
		{
			show_404();
		}

		$data['title'] = $data['news_item']['title'];

		$this->load->view('templates/header', $data);
		$this->load->view('news/view', $data);
		$this->load->views('templates/footer', $data);
	}
}