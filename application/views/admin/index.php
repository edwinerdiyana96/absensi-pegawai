<!-- <div class="row"> -->
<?php 
$settings = $this->db->get('settings')->row_array();
?>
<iframe src="<?= $settings['url']?>" height="80%" width="100%"></iframe>
<!-- </div> -->