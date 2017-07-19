<?php 

if ($this->session->userdata('user_session') && $this->session->userdata('user_session')['role'] == 'user') { ?>

<div>
	<div class="col-md-2">
	    <form action="<?php echo base_url('galleries') ?>" method="get" name="galleryForm">
	        <div class="form-group">
	            <label class="control-label">Search by category</label>
	            <?php echo form_dropdown('category', $categories, $selectedCategory, array('class' => 'form-control', 'ng-required' => "true", "name" => "category")); ?>
	        </div>
	        <div class="form-group">
	            <input type="submit" value="Search" class="btn btn-primary">
	        </div>
	    </form>
	</div>
	<div class="col-md-10">
	<?php foreach ($galleries as $key => $gallery) { ?>
		<div class="col-md-3 col-xs-6">
			<?php echo '<h4><strong>' . $gallery->gallery_name . '</strong></h4>'; ?>
			<img src="<?php echo $gallery->file_url; ?>" class="imggal-satuan img-responsive img-thumbnail">
			<?php echo '<h5><strong>Modal Beli : Rp ' . $gallery->base_price . '</strong></h5>'; ?>
			<?php echo '<h5><strong>Peluang Jual : Rp ' . $gallery->sell_price . '</strong></h5>'; ?>
		</div>
	<?php } ?>
	</div>
	<?php } else {
	    redirect('home','refresh');
	} ?>
</div>