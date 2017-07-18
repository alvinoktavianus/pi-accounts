<?php 

if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'user') { ?>
	<div>
    <?php foreach ($galleries as $key => $gallery) { ?>
    	<div class="col-md-3">
    		<?php echo '<h4>' . $gallery->gallery_name . '</h4>'; ?>
    		<img src="<?php echo $gallery->file_url; ?>" class="imggal-satuan img-responsive img-thumbnail">
    		<?php echo '<h5>Modal Beli : Rp ' . $gallery->base_price . '</h5>'; ?>
    		<?php echo '<h5>Peluang Jual : Rp' . $gallery->sell_price . '</h5>'; ?>
    	</div>
    <?php } ?>
	</div>
<?php } else {
    redirect('home','refresh');
} ?>