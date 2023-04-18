<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>
<style>
form {
    margin-left: 350px;
}
</style>

<?php echo form_open_multipart("index.php/admin/edituser/{$users-> id}"); ?>
<div class="container" style="margin-top:50px;">
    <div style="float:right;"><?php echo anchor('index.php/Admin/customer','back','class="btn btn-primary"') ?></div>
    <h1>EDIT CUSTOMER DETAILS </h1>


    <hr>


    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php if(!is_null($users->image_user)) {  ?>
                <td>
                    <img src="<?php echo $users->image_user ?>" alt="" width="100" height="100">
                </td>
                <?php } ?>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="body">Select Image :</label>
                <?php echo form_upload(['name'=>'userfile']); ?>
            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php if(isset($upload_error)) {echo $upload_error; } ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Username">Username:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Username','name'=>'username','value'=>set_value('username',$users->username)]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('username'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="firstname">FirstName:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter First Name','name'=>'firstname','value'=>set_value('firstname',$users->firstname)]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('firstname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="lastname">LastName:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Last Name','name'=>'lastname','value'=>set_value('lastname',$users->lastname)]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('lastname'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="contact">Contact:</label>
                <?php echo form_input(['class'=>'form-control','type'=>'number','placeholder'=>'Enter Phone Number','name'=>'pno','value'=>set_value('pno',$users->pno)]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('pno'); ?>
        </div>
    </div>

    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-secondary','value'=>'Update']) ?>
                <?php echo form_reset(['type'=>'reset','class'=>'btn btn-primary','value'=>'Reset']) ?>

            </div>
        </div>
    </div>