<?php include('regis_header.php'); ?>


<div class="container" style="margin-top:50px;">
    <h1>Register</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>
    <?php echo form_open('index.php/Admin/registeruser'); ?>
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
                <label for="Pwd">Password :</label>
                <?php echo form_input(['class'=>'form-control','type'=>'password','placeholder'=>'Enter Passsword','name'=>'pass','value'=>set_value('pass')]); ?>
            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('pass'); ?>
        </div>
    </div>


    <hr>

    <p>By creating an account you agree to our <a href="#">Terms & Privacy</a>.</p>

    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-secondary','value'=>'REGISTER']) ?>
                <?php echo form_reset(['type'=>'reset','class'=>'btn btn-primary','value'=>'Reset']) ?>
                <?php echo anchor('index.php/admin/login','Signup?','class="link-class"') ?>

            </div>

        </div>
    </div>
</div>