<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<style>
form {
    margin-left: 350px;
}
</style>



<?php echo form_open_multipart('index.php/Admin/registercustomer'); ?>

<div class="container" style="margin-top:50px;">


    <div style="float:right;">
        <?php echo anchor('index.php/Admin/customer','back','class="btn btn-primary"') ?></div>
    <h1>ADD CUSTOMER</h1>
    <p>Please fill in this form to add a customer.</p>
    <hr>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Username">Username:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Username','name'=>'username','value'=>set_value('username')]); ?>

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

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter First Name','name'=>'firstname','value'=>set_value('firstname')]); ?>

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

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Last Name','name'=>'lastname','value'=>set_value('lastname')]); ?>

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
                <?php echo form_input(['class'=>'form-control','type'=>'number','placeholder'=>'Enter Phone Number','name'=>'pno','value'=>set_value('pno')]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('pno'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="email">Email:</label>
                <?php echo form_input(['class'=>'form-control','type'=>'email','placeholder'=>'Enter Email','name'=>'email','value'=>set_value('email')]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('email'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="body">Status :</label>
                <select class="form-control" name="status">
                    <option value="">--Filter by</option>
                    <option value="1" name="1">Active </option>
                    <option value="0" name="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('status'); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Pwd">Password :</label>
                <?php echo form_input(['class'=>'form-control','type'=>'password','placeholder'=>'Enter Passsword','name'=>'pass','value'=>set_value('pass')]); ?>
            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('pass'); ?>
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

    <hr>


    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-secondary','value'=>'Submit']) ?>
                <?php echo form_reset(['type'=>'reset','class'=>'btn btn-primary','value'=>'Reset']) ?>


            </div>

        </div>
    </div>
</div>