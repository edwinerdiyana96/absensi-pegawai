<?php
/**
 * Models     : Datatables serverside based php
 * Modified   : Fauzan Falah
 * Website    : https://www.codekop.com/
 * 
 * 
 * 
 * 
 */
class M_Datatables extends CI_Model
{
    function __construct()
    {
        parent::__construct();
    }

    function get_tables($tables,$cari,$iswhere)
    {
            // Ambil data yang di ketik user pada textbox pencarian
        $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
        $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
        $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

        $query = $tables;

        if(!empty($iswhere)){
            $sql = $this->db->query("SELECT * FROM ".$query." WHERE ".$iswhere);
        }else{
            $sql = $this->db->query("SELECT * FROM ".$query);
        }

        $sql_count = $sql->num_rows();

        $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";


            // Untuk mengambil nama field yg menjadi acuan untuk sorting
        $order_field = $_POST['order'][0]['column']; 

            // Untuk menentukan order by "ASC" atau "DESC"
        $order_ascdesc = $_POST['order'][0]['dir']; 
        $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

        if(!empty($iswhere)){
            $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
        }else{
            $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
        }

        if(isset($search))
        {
            if(!empty($iswhere)){
                $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE $iswhere (".$cari.")");
            }else{
                $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE (".$cari.")");
            }
            $sql_filter_count = $sql_cari->num_rows();
        }else{
            if(!empty($iswhere)){
                $sql_filter = $this->db->query("SELECT * FROM ".$query."WHERE ".$iswhere);
            }else{
                $sql_filter = $this->db->query("SELECT * FROM ".$query);
            }
            $sql_filter_count = $sql_filter->num_rows();
        }
        $data = $sql_data->result_array();

        $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return json_encode($callback); // Convert array $callback ke json
        }

        function get_tables_where($tables,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            $setWhere = array();
            foreach ($where as $key => $value)
            {
                $setWhere[] = $key."='".$value."'";
            }

            $fwhere = implode(' AND ', $setWhere);

            if(!empty($iswhere)){
                $sql = $this->db->query("SELECT * FROM ".$tables." WHERE $iswhere AND ".$fwhere);
            }else{
                $sql = $this->db->query("SELECT * FROM ".$tables." WHERE ".$fwhere);
            }
            $sql_count = $sql->num_rows();

            $query = $tables;
            $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
            
            // Untuk mengambil nama field yg menjadi acuan untuk sorting
            $order_field = $_POST['order'][0]['column']; 

            // Untuk menentukan order by "ASC" atau "DESC"
            $order_ascdesc = $_POST['order'][0]['dir']; 
            $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

            if(!empty($iswhere)){
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }else{
                $sql_data = $this->db->query("SELECT * FROM ".$query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
            }

            if(isset($search))
            {
                if(!empty($iswhere)){
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                }else{
                    $sql_cari =  $this->db->query("SELECT * FROM ".$query." WHERE ".$fwhere." AND (".$cari.")");
                }
                $sql_filter_count = $sql_cari->num_rows();
            }else{
                if(!empty($iswhere)){
                    $sql_filter = $this->db->query("SELECT * FROM ".$tables." WHERE $iswhere AND ".$fwhere);
                }else{
                    $sql_filter = $this->db->query("SELECT * FROM ".$tables." WHERE ".$fwhere);
                }
                $sql_filter_count = $sql_filter->num_rows();
            }

            $data = $sql_data->result_array();
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return json_encode($callback); // Convert array $callback ke json
        }

        function get_tables_query($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            return json_encode($callback); // Convert array $callback ke json
        }


        function get_tables_query_csrf($query,$cari,$where,$isWhere,$csrf_name,$csrf_hash)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }

                $fwhere = implode(' AND ', $setWhere);
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ".$fwhere);
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);

                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }

                $data = $sql_data->result_array();

            }else{

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query."WHERE $isWhere");
                }else{
                    $sql = $this->db->query($query);
                }

                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $isWhere (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $isWhere (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{

                    if(!empty($iswhere))
                    {
                        $sql_filter =  $this->db->query($query." WHERE $isWhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }

                    $sql_filter_count = $sql_filter->num_rows();
                }

                $data = $sql_data->result_array();

            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$data
            );
            $callback[$csrf_name] = $csrf_hash; 

            return json_encode($callback); // Convert array $callback ke json
        }


















        // ============================= Model Query Kelas ==============================
        function get_query_kelas($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }


            $cek_data = $data;
            $nestedData = array();
            $hasil = array();


            foreach ($data as $key => $data) {
                 // Array Data

                $km = $this->db->query("SELECT * FROM user WHERE id = '".$data['class_leader']."'")->row_array();
                $kelas = $data['class'];
                $hitung = $this->db->query("SELECT count(id) as jumlah FROM user where class_name = '".$kelas."'")->row_array();

                $nestedData['class'] = $data['class'];
                $nestedData['name'] = $data['name'];
                $nestedData['class_leader'] = $km['name'];
                $nestedData['grade'] = $hitung['jumlah'];
                $nestedData['class_id'] = $data['class_id'];
                $hasil[] = $nestedData;
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$hasil
            );
            return json_encode($callback); // Convert array $callback ke json
        }



        // ============================= Model Query Mapel ==============================
        function get_query_mapel($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }


            $cek_data = $data;
            $nestedData = array();
            $hasil = array();


            foreach ($data as $key => $data) {
                 // Array Data

                $num = $this->db->query("SELECT * FROM teacher_lessons where lessons_id = '".$data['mapel_id']."'")->num_rows();

                $nestedData['mapel_id'] = $data['mapel_id'];
                $nestedData['lessons'] = $data['lessons'];
                $nestedData['grade'] = $data['grade'];
                $nestedData['guru'] = $num;
                $hasil[] = $nestedData;
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$hasil
            );
            return json_encode($callback); // Convert array $callback ke json
        }





        // ============================= Model Query Rekap Bulanan ==============================
        function get_tables_rekap_bulanan($query,$cari,$where,$iswhere, $awal="", $akhir="")
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }


            $cek_data = $data;
            $nestedData = array();
            $hasil = array();

            
            foreach ($data as $key => $data) {
                 // Array Data

                $semua = 0;
                $persentase = 0;
                $tidak_hadir = 0;
                $pesentase_tepat_waktu = 0;
                $persentase_telat = 0;
                $hadir = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '1' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $telat = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '2' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $sakit = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '3' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $izin = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '4' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $absen_khusus = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '6' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $alpha = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '0' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $tidak_hadir = $sakit + $izin + $alpha;
                $total_kehadiran = $hadir + $telat + $absen_khusus;
                $semua = $total_kehadiran + $tidak_hadir;
                

                if ($hadir != 0) {
                    $pesentase_tepat_waktu = number_format(($hadir/$total_kehadiran)*100,2);
                }
                if ($telat != 0) {
                    $persentase_telat = number_format(($telat/$total_kehadiran)*100,2);
                }

                if ($semua == 0) {
                    $persentase = 0;
                }else{
                    $persentase = number_format(($total_kehadiran/$semua)*100,2);
                }
                

                $update = [
                    'view_tepat_waktu' => $hadir,
                    'view_telat' => $telat,
                    'view_sakit' => $sakit,
                    'view_izin' => $izin,
                    'view_alpha' => $alpha,
                    'view_khusus' => $absen_khusus,
                    'view_hadir' => $total_kehadiran,
                    'view_tidak_hadir' => $tidak_hadir,
                    'view_persentase' => $persentase,
                    'view_persentase_telat' => $persentase_telat,
                    'view_persentase_tepat_waktu' => $pesentase_tepat_waktu
                ];
                $this->db->where('id', $data['id']);
                $this->db->update('user', $update);

                $nestedData['name'] = $data['name'];
                $nestedData['view_tepat_waktu'] = $hadir;
                $nestedData['view_telat'] = $telat;
                $nestedData['view_hadir'] = $total_kehadiran;
                $nestedData['view_sakit'] = $sakit;
                $nestedData['view_izin'] = $izin;
                $nestedData['view_alpha'] = $alpha;
                $nestedData['view_khusus'] = $absen_khusus;
                $nestedData['view_tidak_hadir'] = $tidak_hadir;
                $nestedData['view_persentase'] = $persentase."%";
                $nestedData['view_persentase_telat'] = $persentase_telat."%";
                $nestedData['view_persentase_tepat_waktu'] = $pesentase_tepat_waktu."%";
                $hasil[] = $nestedData;
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$hasil
            );
            return json_encode($callback); // Convert array $callback ke json
        }




        // ============================= Model Query Rekap Pegawai pertahun ==============================
        function get_tables_rekap_pegawai_pertahun($query,$cari,$where,$iswhere, $awal="", $akhir="")
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }


            $cek_data = $data;
            $nestedData = array();
            $hasil = array();

            
            foreach ($data as $key => $data) {
                 // Array Data

                $semua = 0;
                $persentase = 0;
                $tidak_hadir = 0;
                $hadir = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '1' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $sakit = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '3' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $izin = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '4' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $alpha = $this->db->query("SELECT * FROM data_attendance WHERE user_id = '".$data['id']."' AND status = '0' AND date >= '".$awal."' AND date <= '".$akhir."'")->num_rows();
                $tidak_hadir = $sakit + $izin + $alpha;
                $semua = $hadir + $tidak_hadir;
                if ($semua == 0) {
                    $persentase = 0;
                }else{
                    $persentase = number_format(($hadir/$semua)*100,2);
                }
                

                $update = [
                    'view_sakit' => $sakit,
                    'view_izin' => $izin,
                    'view_alpha' => $alpha,
                    'view_hadir' => $hadir,
                    'view_tidak_hadir' => $tidak_hadir,
                    'view_persentase' => $persentase
                ];
                $this->db->where('id', $data['id']);
                $this->db->update('user', $update);

                $nestedData['name'] = $data['name'];
                $nestedData['view_hadir'] = $hadir;
                $nestedData['view_sakit'] = $sakit;
                $nestedData['view_izin'] = $izin;
                $nestedData['view_alpha'] = $alpha;
                $nestedData['view_tidak_hadir'] = $tidak_hadir;
                $nestedData['view_persentase'] = $persentase."%";
                $hasil[] = $nestedData;
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$hasil
            );
            return json_encode($callback); // Convert array $callback ke json
        }


		// ============================= Model Query Belum Absen ==============================
        function get_query_belum_absen($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }


            $cek_data = $data;
            $nestedData = array();
            $hasil = array();


            foreach ($data as $key => $data) {
                 // Array Data

                // $num = $this->db->query("SELECT * FROM teacher_lessons where lessons_id = '".$data['mapel_id']."'")->num_rows();
                $nomor = "62".substr($data['phone'],1);
                $nestedData['id'] = $data['id'];
                $nestedData['name'] = $data['name'];
                $nestedData['phone'] = $nomor;
                $nestedData['attendance_id'] = $data['attendance_id'];
                // $nestedData['guru'] = $num;
                $hasil[] = $nestedData;
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$hasil
            );
            return json_encode($callback); // Convert array $callback ke json
        }



        // ============================= Model Query Auto==============================
        function get_query_auto($query,$cari,$where,$iswhere)
        {
            // Ambil data yang di ketik user pada textbox pencarian
            $search = htmlspecialchars($_POST['search']['value']);
            // Ambil data limit per page
            $limit = preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['length']}");
            // Ambil data start
            $start =preg_replace("/[^a-zA-Z0-9.]/", '', "{$_POST['start']}"); 

            if($where != null)
            {
                $setWhere = array();
                foreach ($where as $key => $value)
                {
                    $setWhere[] = $key."='".$value."'";
                }
                $fwhere = implode(' AND ', $setWhere);

                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere AND ".$fwhere);
                    
                }else{
                    $sql = $this->db->query($query." WHERE ".$fwhere);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {
                    $sql_data = $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }
                
                if(isset($search))
                {
                    if(!empty($iswhere))
                    {
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND ".$fwhere." AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE ".$fwhere." AND (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere AND ".$fwhere);
                    }else{
                        $sql_filter = $this->db->query($query." WHERE ".$fwhere);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();

            }else{
                if(!empty($iswhere))
                {
                    $sql = $this->db->query($query." WHERE  $iswhere ");
                }else{
                    $sql = $this->db->query($query);
                }
                $sql_count = $sql->num_rows();

                $cari = implode(" LIKE '%".$search."%' OR ", $cari)." LIKE '%".$search."%'";
                
                // Untuk mengambil nama field yg menjadi acuan untuk sorting
                $order_field = $_POST['order'][0]['column']; 

                // Untuk menentukan order by "ASC" atau "DESC"
                $order_ascdesc = $_POST['order'][0]['dir']; 
                $order = " ORDER BY ".$_POST['columns'][$order_field]['data']." ".$order_ascdesc;

                if(!empty($iswhere))
                {                
                    $sql_data = $this->db->query($query." WHERE $iswhere AND (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }else{
                    $sql_data = $this->db->query($query." WHERE (".$cari.")".$order." LIMIT ".$limit." OFFSET ".$start);
                }

                if(isset($search))
                {
                    if(!empty($iswhere))
                    {     
                        $sql_cari =  $this->db->query($query." WHERE $iswhere AND (".$cari.")");
                    }else{
                        $sql_cari =  $this->db->query($query." WHERE (".$cari.")");
                    }
                    $sql_filter_count = $sql_cari->num_rows();
                }else{
                    if(!empty($iswhere))
                    {
                        $sql_filter = $this->db->query($query." WHERE $iswhere");
                    }else{
                        $sql_filter = $this->db->query($query);
                    }
                    $sql_filter_count = $sql_filter->num_rows();
                }
                $data = $sql_data->result_array();
            }


            $cek_data = $data;
            $nestedData = array();
            $hasil = array();


            foreach ($data as $key => $data) {
                 // Array Data
                $data_attendance = $this->db->query("SELECT * FROM data_attendance WHERE date = '".date('Y-m-d')."' AND user_id = '".$data['id']."'")->num_rows();
                $konfirmasi = "confirm('Apakah anda Yakin?')";
                if($data_attendance == 0){
                    $isi_aksi = '<a type="button" class="btn btn-primary" onclick="return '.$konfirmasi.'" href="'.base_url('auto/manual/'.$data['id']).'">Auto Isert</a>';
                }else{
                    $isi_aksi = 'Data Sudah Ada';
                }

                $nestedData['id'] = $data['id'];
                $nestedData['name'] = $data['name'];
                $nestedData['aksi'] = $isi_aksi;
                // $nestedData['guru'] = $num;
                $hasil[] = $nestedData;
            }
            
            $callback = array(    
                'draw' => $_POST['draw'], // Ini dari datatablenya    
                'recordsTotal' => $sql_count,    
                'recordsFiltered'=>$sql_filter_count,    
                'data'=>$hasil
            );
            return json_encode($callback); // Convert array $callback ke json
        }



    }
