<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<html>

<head>
    <title>Dashboard</title>
</head>
<style>
.container {
    margin-left: 400px;
}

.card {
    position: relative;
    /* z-index: 99; */
}

.pagination {
    margin-left: 200px;
    padding: 10px;
    width: 150px;
    justify-content: space-between;

}
</style>


<body>

    <div class="container" style="margin-top:25px">
        <div class="row">
            <div class="col-lg-6">
                <?=  anchor("index.php/Admin/addarticle",'ADD',['class'=>'btn btn-primary ']);  ?>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top:50px">
        <div class="row">
            <div class="col-lg-3" style="display:flex;">
                <?php echo form_open_multipart('index.php/Admin/artsearchkeyword'); ?>

                <?php echo form_input(['class'=>'form-control','type'=>'text','placeholder'=>'Search','name'=>'keyword',]); ?>
                <!-- <?php echo form_submit(['type'=>'submit','class'=>'btn btn-secondary','value'=>'Search']) ?> -->
            </div>
        </div>
    </div>

    <div class="container" style="margin-top:50px,margin-left:400px">
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


        <div class="table">
            <h1>Data</h1>

            <table>
                <thead>
                    <tr style="text-align:center;">
                        <th>ID </th>
                        <th>IMAGE</th>
                        <th> ARTICLE TITLE
                            <?=  anchor("index.php/Admin/arasc/",'<i class="fa-solid fa-arrow-down"></i>');  ?>
                            <?=  anchor("index.php/Admin/ardesc/",'<i class="fa-solid fa-arrow-up"></i>');  ?>
                        </th>
                        <th> ARTICLE BODY </th>
                        <th> EDIT </th>
                        <th> DELETE </th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(count($articles)) {
                        foreach ($articles as $art){ ?>

                    <tr style="text-align:center;">
                        <td><b><?= $art-> id; ?>.</b>
                        </td>
                        <?php if(!is_null($art->image_article)) {  ?>
                        <td>
                            <img src="<?php echo $art->image_article ?>" alt="" width="100" height="100">
                        </td>
                        <?php } ?>
                        <td><?= $art-> article_title; ?></td>
                        <td><?= $art-> article_body; ?></td>

                        <td><?=  anchor("index.php/Admin/editarticles/{$art->id}",'Edit',['class'=>'btn btn-primary ']);  ?>
                        </td>


                        <td>
                            <?=  anchor("index.php/Admin/delarticles/{$art->id}",'Delete',['class'=>'btn btn-danger ']);  ?>
                        </td>
                    </tr>
                    <?php }}else { ?>
                    <tr>
                        <td colspan="5" style="text-align:center;"><b>No data found</b></td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>

        <?= $this->pagination->create_links(); ?>

    </div>
</body>

</html>