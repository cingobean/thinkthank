<?php

// extends class Model
class CustomerModel extends CI_Model{
	
	
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
	}

  // response jika field ada yang kosong
  public function empty_response(){
    $response['status']=502;
    $response['error']=true;
    $response['message']='Field tidak boleh kosong';
    return $response;
  }

  // function untuk insert data ke tabel tb_customer
  public function add_customer($name,$email,$password,$gender,$is_married,$address){

    if(empty($name) || empty($email) || empty($password) || empty($gender) || empty($is_married) || empty($address) ){
      return $this->empty_response();
    }else{
      $data = array(
        "name"=>$name,
		"email"=>$email,
		"password"=>$password,
		"gender"=>$gender,
		"is_married"=>$is_married,
        "address"=>$address
        
      );

      $insert = $this->db->insert("tb_customer", $data);

      if($insert){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data customer ditambahkan.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data customer gagal ditambahkan.';
        return $response;
      }
    }

  }

  // mengambil semua data customer
  public function all_customer(){

    $all = $this->db->get("tb_customer")->result();
    $response['status']=200;
    $response['error']=false;
    $response['customer']=$all;
    return $response;

  }

  // hapus data customer
  public function delete_customer($id){

    if($id == ''){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $this->db->where($where);
      $delete = $this->db->delete("tb_customer");
      if($delete){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data customer dihapus.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data customer gagal dihapus.';
        return $response;
      }
    }

  }

  // update customer
  public function update_customer($id,$name,$email,$password,$gender,$is_married,$address){

    if($id == '' || empty($name) || empty($email) || empty($password) || empty($gender) || empty($is_married) || empty($address)){
      return $this->empty_response();
    }else{
      $where = array(
        "id"=>$id
      );

      $set = array(
		"name"=>$name,
		"email"=>$email,
		"password"=>$password,
		"gender"=>$gender,
		"is_married"=>$is_married,
        "address"=>$address
      );

      $this->db->where($where);
      $update = $this->db->update("tb_customer",$set);
      if($update){
        $response['status']=200;
        $response['error']=false;
        $response['message']='Data customer diubah.';
        return $response;
      }else{
        $response['status']=502;
        $response['error']=true;
        $response['message']='Data customer gagal diubah.';
        return $response;
      }
    }

  }

}

?>
