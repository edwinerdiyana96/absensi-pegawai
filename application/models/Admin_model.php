<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_model extends CI_Model
{

    public function addNewRole($data)
    {
        $this->db->insert('user_role', $data);
    }

    public function deleteDatarole($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('user_role');
    }

    public function getRoleById($id)
    {
        return $this->db->get_where('user_role', ['id' => $id])->row_array();
    }

    public function getUserById($id)
    {
        return $this->db->get_where('user', ['id' => $id])->row_array();
    }
   

    public function updateDataRole()
    {
        $id = $this->input->post('id');
        $data = [
            'role' => $this->input->post('role', true)
        ];
        $this->db->where('id', $id);
        $this->db->update('user_role', $data);
    }

    public function updateDataUser(){

        $id = $this->input->post('id');
        $name = $this->input->post('name');
        $gender = $this->input->post('gender');
        $department = $this->input->post('department');
        $phone = $this->input->post('phone');
   
        $data = [
            'name'          => $name,
            'gender'        => $gender,
            'department'    => $department,
            'phone'         => $phone
 
        ];

        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }


    public function updateAccessUser()
    {
        $id = $this->input->post('id');

        $data = [
            'role_id' => $this->input->post('role_id')
        ];
        $this->db->where('id', $id);
        $this->db->update('user', $data);
    }




    public function getUserRole()
    {
        $query = "select user.id, user.name, user.role_id,user.is_active, user_role.role from user join user_role on user.role_id=user_role.id where user.role_id!=1";
        return  $this->db->query($query)->result_array();
    }

    //*Progress Edwin
    public function getAll()
    {
        $this->db->where_not_in('id',1);
        return $this->db->get('user')->result_array();
    }

    public function insertBatchUsers($data) {
        if (!empty($data)) {
            $this->db->insert_batch('user', $data);
        }
    }

    public function delete_all_users_except_admin() {
        // Hapus semua data pengguna kecuali akun dengan role_id = 1 (admin)
        $this->db->where('role_id !=', 1); // Exclude role_id = 1 (admin)
        $this->db->delete('user'); // Menghapus data
    }



    //Get Pegawai Except Admin & Kepala Sekolah
    public function getPegawai()
    {
        $this->db->where_not_in('role_id',1) && $this->db->where_not_in('role_id',19);
        return $this->db->get('user');
    }

    public function getPegawaibyId($id)
    {
        $this->db->where('id',$id);
        return $this->db->get('user');
    }

    //Get Total Guru
    public function getTotalGuru()
    {
        $this->db->where('department',"Guru");
        return $this->db->get('user');
    }
    //Get Total Staf
    public function getTotalStaf()
    {
        $this->db->where('department',"Staf");
        return $this->db->get('user');
    }
	//Get Pegawai Lainnya Except Admin & Kepala Sekolah & Guru
    public function getTotalLainnya()
    {
        $this->db->where_not_in('role_id',1) && $this->db->where_not_in('role_id',19) && $this->db->where_not_in('role_id',22);
        return $this->db->get('user');
    }

    public function addNewUser($data)
    {
        $this->db->insert('user',$data);
    }

    public function deleteDatauser($id)
    {

        $this->db->where('id', $id);
        $this->db->delete('user');
    }

    public function getGeolocation(){
        return $this->db->get('data_geolocation');
    }

    public function getGeolocationByPlaceId($params=""){
        $this->db->where('place_id', $params);
        return $this->db->get('data_geolocation');
    }
    
}
