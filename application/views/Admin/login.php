<?php include('regis_header.php'); ?>

<div class="container" style="margin-top:50px;">


    <h1>LOGIN FORM</h1>
    <hr>


    <?php if($msg=$this->session->flashdata('msg')) {
        $msg_class=$this->session->flashdata('msg_class')
         ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="alert <?= $msg_class ?>">
                <?= $msg; ?>
            </div>
        </div>
    </div>

    <?php } ?>


    <?php echo form_open('index.php/Admin/login'); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="Username">Username:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Username','name'=>'uname','value'=>set_value('uname')]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('uname'); ?>
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
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-secondary','value'=>'LOGIN']) ?>
                <?php echo form_reset(['type'=>'reset','class'=>'btn btn-primary','value'=>'Reset']) ?>
                <?php echo anchor('index.php/Admin/register','Signup?','class="link-class"') ?>
            </div>
        </div>



    </div>