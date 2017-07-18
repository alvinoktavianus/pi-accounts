<?php 

if (!$this->session->userdata('user_session')) { ?>
	<div>
    <?php foreach ($galleries as $key => $gallery) { ?>
    	<div class="col-md-3 col-xs-6">
    		<?php echo '<h4><strong>' . $gallery->gallery_name . '</strong></h4>'; ?>
    		<img src="<?php echo $gallery->file_url; ?>" class="imggal-satuan img-responsive img-thumbnail">
    		<?php echo '<h5><strong>Modal Beli : Rp ' . $gallery->base_price . '</strong></h5>'; ?>
    		<?php echo '<h5><strong>Peluang Jual : Rp' . $gallery->sell_price . '</strong></h5>'; ?>
    	</div>
    <?php } ?>
	</div>
<?php } else {
    redirect('home','refresh');
} ?>