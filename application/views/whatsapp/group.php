<!-- Begin Page Content -->
<div class="container-fluid dashboard-atas">

  <!-- Page Heading -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <h6 class="m-0 font-weight-bold text-primary "><?= $title ?></h6>
    </div>
    <div class="card-body">
      <?= $this->session->flashdata('message'); ?>
      <!-- <div class="card-body"> -->
      <div class="responsive">
        <table class="table table-striped table-bordered table-hover" id="example" style="width:100%;">
          <thead class="text-primary">
            <tr>
              <th scope="col">No.</th>
              <th scope="col">Kode Group</th>
              <th scope="col">Nama Group</th>
            </tr>
          </thead>

          <tbody>
            <?php
            // $phone_no = '6283199766610';
            // $key='iay747isynk0bxhkq4uilwpscyha9yh'; //this is demo key please change with your own key
            // $url='https://api.easywa.id/v1/groups';
            // $data = array(
            //   "number" => $phone_no
            // );
            // $data_string = json_encode($data);

            // $ch = curl_init($url);
            // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
            // // curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
            // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            // curl_setopt($ch, CURLOPT_VERBOSE, 0);
            // curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
            // curl_setopt($ch, CURLOPT_TIMEOUT, 360);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            // curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            // curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            //     'email: it.smkkarnas.40@gmail.com',
            //     'secret-key: iay747isynk0bxhkq4uilwpscyha9yh',
            //     'Content-Type: application/json'
            //   )
            // );
            // $res=curl_exec($ch);
            // curl_close($ch);
            $settings = $this->db->get('settings')->row_array();

            $curl = curl_init();

            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://api-whatsapp.smkkarnas.id/group/list?number=' . $settings['phone'],
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => true,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            // echo "<pre>";
            // echo $response;
            // echo "</pre>";
            $res = json_encode($response);
            $data_array = json_decode($response, true);

            // echo "<pre>";
            // print_r($data_array['message']['120363023476569548@g.us']['subject']);
            // echo "<pre>";
            // $array_hasil = array_keys($data_array['message']);
            if (is_array($data_array['message'])) {
            $array_hasil = array_keys($data_array['message']);
            } else {
            // Handle the case where $data_array['message'] is not an array (e.g., provide a default value or an error message).
            }
            $res = json_encode($array_hasil);
            $array_hasil = json_decode($res, true);
            // print_r($array_hasil);
            // print_r($data_array['message'][0]);
            $no = 1;
            foreach ($array_hasil as $key => $array_hasil) {
            ?>
              <tr>
                <td><?= $no++ ?></td>
                <td><?= $array_hasil ?></td>
                <td><?= $data_array['message'][$array_hasil]['subject'] ?></td>
              </tr>
            <?php
            }
            ?>
          </tbody>

        </table>
      </div>
      <!-- </div> -->
    </div>
  </div>

</div>
<!-- /.container-fluid -->

<script>
  $(document).ready(function() {
    $('#example').DataTable({
      "scrollX": true,
    })
  });
</script>

<!-- End of Main Content -->