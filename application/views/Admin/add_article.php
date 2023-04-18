<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<style>
form {
    margin-left: 350px;
}
</style>




<?php echo form_open_multipart('index.php/admin/uservalidation'); ?>
<div class="container" style="margin-top:50px;">
    <div style="float:right;"> <?php echo anchor('index.php/Admin/welcome','back','class="btn btn-primary"') ?></div>



    <h1>ADD ARTICLE</h1>


    <hr>
    <?php $id = $this->session->userdata('id'); 
    echo form_hidden('user_id',$id); ?>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="title">ADD ADRTICLE:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Article Title','name'=>'article_title','value'=>set_value('article_title')]); ?>

            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('article_title'); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="form-group">
                <label for="body">ADD ARTICLE BODY :</label>
                <?php echo form_textarea(['class'=>'form-control','type'=>'textarea','placeholder'=>'Enter Article Body','name'=>'article_body','value'=>set_value('article_body')]); ?>
            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('article_body'); ?>
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