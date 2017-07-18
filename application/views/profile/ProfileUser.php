<?php if ($this->session->flashdata('errors')): ?>
    <div class="alert alert-danger" role="alert">
        <strong><?php echo $this->session->flashdata('errors'); ?></strong>
    </div>
<?php endif; ?>

<?php if ($this->session->flashdata('success')): ?>
    <div class="alert alert-success" role="alert">
        <strong><?php echo $this->session->flashdata('success'); ?></strong>
    </div>
<?php endif; ?>

<?php if (empty($users)): ?>
    <h4>No Data Profile</h4>
<?php else: ?>
    <h1>Your Profile</h1>
    <div>
        <table class="table table-bordered table-sm" style="max-width: 500px;">
            <tbody>
                <?php foreach ($users as $index => $user): ?>
                    <tr><td>Email</td><td><?php echo $user->email; ?></td></tr>
                    <tr><td>Full Name</td><td><?php echo $user->first_name . ' ' . $user->last_name; ?></td></tr>
                    <tr><td>Alamat</td><td>
                    <?php if (empty($user->alamat)) {echo "-";} else { echo $user->alamat;} ?></td></tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<?php endif; ?>

<div style="max-width: 500px;margin-top: 45px;">
    <h3>Ubah Alamat</h3>
    <?php echo form_open_multipart(base_url('profile/add_alamat'), array('name' => 'alamatForm', 'novalidate' => 'true')); ?>
        <?php echo form_textarea(array('class' => 'form-control', 'style' => 'height: 100px;', 'id' => 'alamat', 'name' => 'alamat', 'ng-required' => true, 'ng-model' => 'user.alamat', 'placeholder' => 'Jl. xx No. xx, Jakarta, Indonesia')); ?>
        <button type="submit" class="button buttonBlue buttonSubmit" ng-disabled="alamatForm.$invalid" ng-cloak>SAVE
            <div class="ripples buttonRipples"><span class="ripplesCircle"></span></div>
        </button>
    <?php echo form_close(); ?>
</div>