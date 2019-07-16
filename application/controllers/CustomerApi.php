<?php

require APPPATH . 'libraries/REST_Controller.php';

class CustomerApi extends REST_Controller{

  // construct
  public function __construct(){
    parent::__construct();
    $this->load->model('CustomerModel');
  }

  // method index untuk menampilkan semua data customer menggunakan method get
  public function index_get(){
    $response = $this->CustomerModel->all_customer();
    $this->response($response);
  }

  // untuk menambah customer menaggunakan method post
  public function add_post(){
    $response = $this->CustomerModel->add_customer(
        $this->post('name'),
		$this->post('email'),
		$this->post('password'),
		$this->post('gender'),
		$this->post('is_married'),
        $this->post('address')
        
      );
    $this->response($response);
  }

  // update data customer menggunakan method put
  public function update_put(){
    $response = $this->CustomerModel->update_customer(
        $this->put('id'),
        $this->put('name'),
		$this->put('email'),
		$this->put('password'),
		$this->put('gender'),
		$this->put('is_married'),
        $this->put('address')
      );
    $this->response($response);
  }

  // hapus data customer menggunakan method delete
 /*  public function delete_delete(){
    $response = $this->CustomerModel->delete_customer(
        $this->delete('id')
      );
    $this->response($response);
  } */
  
  public function delete_delete($id = null){

	$response = $this->CustomerModel->delete_customer($id);

	$this->response($response);

	}

}

?>
