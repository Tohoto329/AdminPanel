<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<style>
form {
    margin-left: 400px;
}
</style>



<?php echo form_open_multipart("index.php/admin/editarticles/{$articles-> id}"); ?>
<div class="container" style="margin-top:50px;">
    <div style="float:right;">
        <?php echo anchor('index.php/Admin/welcome','Back','class="btn btn-primary"') ?></div>

    <h1>EDIT ARTICLE</h1>

    <hr>

    <div class="row">
        <div class="col-lg-12">
            <div class="form-group">
                <?php if(!is_null($articles->image_article)) {  ?>
                <td>
                    <img src="<?php echo $articles->image_article ?>" alt="" width="100" height="100">
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
                <label for="title">ADD ADRTICLE:</label>

                <?php echo form_input(['class'=>'form-control','placeholder'=>'Enter Article Title','name'=>'article_title','value'=>set_value('article_title',$articles->article_title )]); ?>

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
                <?php echo form_textarea(['class'=>'form-control','type'=>'textarea','placeholder'=>'Enter Article Body','name'=>'article_body','value'=>set_value('article_body',$articles->article_body)]); ?>
            </div>
        </div>
        <div class="col-lg-6" style="margin-top:30px">
            <?php echo form_error('article_body'); ?>
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