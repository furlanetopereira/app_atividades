<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
class MY_model extends CI_Model {
  public $table=NULL;
  function __construct() {
    parent::__construct();
  }

  function Insert($data) {
    if(!isset($data))
      return false;
    return $this->db->insert($this->table, $data);
  }

  function GetById($id) {
    if(is_null($id))
      return false;
    $this->db->where('id', $id);
    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->row_array();
    } else {
      return null;
    }
  }

  function GetAll($sort = 'id', $order = 'asc') {
    $this->db->order_by($sort, $order);
    $query = $this->db->get($this->table);
    if ($query->num_rows() > 0) {
      return $query->result_array();
    } else {
      return null;
    }
  }
  
  function Update($id, $data) {
    if(is_null($id) || !isset($data))
      return false;
    $this->db->where('id', $id);
    return $this->db->update($this->table, $data);
  }
}