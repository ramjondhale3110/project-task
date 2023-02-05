<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home_model extends CI_Model
{
    public function registerUser($formdata)
    {
        $this->db->insert('usertbl', $formdata);
        return $this->db->insert_id();
    }

    public function findUserWhere($where)
    {
        $this->db->where($where);
        return $this->db->get('usertbl')->result();
    }

    public function insertCategory($formdata)
    {
        $this->db->insert('categorytbl', $formdata);
        return $this->db->insert_id();
    }

    public function insertProduct($formdata)
    {
        $this->db->insert('producttbl', $formdata);
        return $this->db->insert_id();
    }

    public function updateCategory($formdata, $where)
    {
        $this->db->where($where);
        $this->db->update('categorytbl', $formdata);
    }

    public function getCategory($where = '')
    {
        if ($where != '')
            $this->db->where($where);
        return $this->db->get('categorytbl')->result();
    }

    public function getAllSubCategoryCond($where = '')
    {
        if ($where != '')
            $this->db->where($where);
        return $this->db->get('subcategorytbl')->result();
    }

    public function insertSubCategory($formdata)
    {
        $this->db->insert('subcategorytbl', $formdata);
        return $this->db->insert_id();
    }


    public function getSubCategory($select, $where, $joinType)
    {
        $this->db->select($select);
        $this->db->from('subcategorytbl');
        $this->db->where($where);
        $result = $this->db->join('categorytbl', 'subcategorytbl.category_IdFk = categorytbl.id', $joinType)->get();
        return $result->result();
    }

    public function updateSubCategory($formdata, $where)
    {
        $this->db->where($where);
        $this->db->update('subcategorytbl', $formdata);
    }

    public function deleteSubCategory($where)
    {
        $this->db->where($where);
        $this->db->delete('subcategorytbl');
    }

    public function deleteCategory($where)
    {
        $this->db->where($where);
        $this->db->delete('categorytbl');
    }

    public function getProductDetail($select, $where)
    {
        $this->db->select($select);
        $this->db->from('producttbl');
        $this->db->join('categorytbl', 'producttbl.cat_IdFk = categorytbl.id', 'left');
        $this->db->join('subcategorytbl', 'producttbl.subcat_IdFk = subcategorytbl.id', 'left');
        $this->db->where($where);
        $result = $this->db->get();
        return $result->result();
    }
}
