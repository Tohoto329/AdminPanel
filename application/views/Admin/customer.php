<?php include('header.php'); ?>
<?php include('sidebar.php'); ?>

<html>

<head>
    <title>Customer</title>
</head>
<style>
.container {
    margin-left: 300px;
}

/* .card {
    position: relative;
    background-color: #f1f1f1;
    
} */

.pagination {
    margin-left: 200px;
    padding: 10px;
    width: 150px;
    justify-content: space-between;
}

#add-modal {
    background: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    display: none;
}

#add-modal #add-modal-form {
    background: #fff;
    text-align: center;
    width: 30%;
    top: 20%;
    position: relative;
    left: calc(50% - 15%);
    padding: 15px;
    border-radius: 4px;

}

#status-modal {
    background: rgba(0, 0, 0, 0.7);
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: 1;
    display: none;
}

#status-modal #status-modal-form {
    background: #fff;
    text-align: center;
    width: 30%;
    top: 20%;
    position: relative;
    left: calc(50% - 15%);
    padding: 15px;
    border-radius: 4px;

}

#closeadd-btn {
    font-size: 30px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    position: absolute;
    top: 10px;
    right: 5px;
    cursor: pointer;
}

#closestatus-btn {
    font-size: 30px;
    width: 30px;
    height: 30px;
    line-height: 30px;
    position: absolute;
    top: 10px;
    right: 5px;
    cursor: pointer;
}

select {
    cursor: pointer;
}
</style>

<body>
    <!-- <div class="card"> -->
    <div class="container" style="margin-top:25px">

        <div class="row">
            <div class="col-lg-1">
                <?=  anchor("index.php/Admin/addcustomer",'ADD',['class'=>'btn btn-primary ']);  ?>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top:50px">

        <div class="row">
            <div class="col-lg-2">
                <?php echo form_open_multipart('index.php/Admin/searchidkeyword'); 
                 echo form_input(['class'=>'form-control','type'=>'text','placeholder'=>'Search ID','name'=>'keyword',]); 
                 echo form_close(); ?>
            </div>
            <div class="col-lg-2">
                <?php echo form_open_multipart('index.php/Admin/searchkeyword'); 
                echo form_input(['class'=>'form-control','type'=>'text','placeholder'=>'Search Username','name'=>'keyword',]); 
                echo form_close(); ?>
            </div>
            <div class="col-lg-2">
                <?php echo form_open_multipart('index.php/Admin/searchmailkeyword');
                echo form_input(['class'=>'form-control','type'=>'text','placeholder'=>'Search Email','name'=>'keyword',]);
                echo form_close(); ?>
            </div>
            <div class="col-lg-2">
                <?php echo form_open_multipart('index.php/Admin/searchcontactkeyword');
                echo form_input(['class'=>'form-control','type'=>'text','placeholder'=>'Search Contact','name'=>'keyword',]);
                echo form_close(); ?>
            </div>

            <div class="col-lg-3" style="display:flex">
                <?php echo form_open_multipart('index.php/Admin/statusOption') ?>
                <select class="form-control" name="filter">
                    <option value="">--Filter by</option>
                    <option value="1" name="1">Active </option>
                    <option value="0" name="0">Inactive</option>
                </select>
                <?php echo form_submit(['type'=>'submit','class'=>'btn btn-primary','value'=>'Filter']);
                echo form_close(); ?>

            </div>
        </div>
    </div>
    </div>
    <!-- </div><br> -->
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

        <h1>Customer Data</h1>
        <div class="table">
            <table>

                <thead>
                    <tr style="text-align:center;">
                        <th>ID </th>
                        <th>IMAGE</th>
                        <th> USERNAME
                            <?=  anchor("index.php/Admin/asc/",'<i class="fa-solid fa-arrow-down"></i>');  ?>
                            <?=  anchor("index.php/Admin/desc/",'<i class="fa-solid fa-arrow-up"></i>');  ?>
                        </th>
                        <th> EMAIL ID</th>
                        <th> CONTACT </th>
                        <th> STATUS </th>
                        <th> REMARKS </th>
                        <th> EDIT </th>
                        <th> DELETE </th>



                    </tr>
                </thead>
                <tbody>
                    <?php if(count($users)) {
                        foreach ($users as $user){ ?>

                    <tr style="text-align:center;" id="user-data">
                        <td><b><?= $user['id']; ?> .</b></td>
                        <?php if(!is_null($user['image_user'])) {  ?>
                        <td>
                            <img src="<?php echo $user['image_user'] ?>" width="100" height="100">
                        </td>
                        <?php } ?>
                        <td><?= $user['username']; ?> </td>
                        <td><?= $user['email']; ?> </td>
                        <td><?= $user['pno']; ?> </td>
                        <td>
                            <?php
                            $status = $user['status'];
                            if($status == 1)
                            { ?>
                            <button class="btn btn-primary" id="status" data-id="<?= $user['id'];  ?>"
                                type="submit">ACTIVE</button>
                            <!-- <?=  anchor("index.php/Admin/userstatus/{$user['id']}/{$user['status']}",'Update',['class'=>'btn btn-success']);  ?> -->
                            <?php }
                            else{ ?>
                            <button class="btn btn-danger" id="status" data-id="<?= $user['id']; ?>"
                                type="submit">INACTIVE</button>
                            <?php } ?>
                        </td>
                        <td><?= $user['remarks']; ?> </td>


                        <td><?=  anchor("index.php/Admin/edituser/{$user['id']}",'Edit',['class'=>'btn btn-primary',]);  ?>
                        </td>


                        <td>
                            <button class="btn btn-danger" id="delete-btn" type="submit">DELETE</button>
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

    <div id="add-modal">
        <div id="add-modal-form">
            <b>ARE YOU SURE YOU WANT TO DELETE THIS DATA!!</b>
            <hr>
            <?=  anchor("index.php/Admin/deluser/{$user['id']}",'YES',['class'=>'btn btn-danger ']);  ?>
            <?=  anchor("index.php/Admin/customer",'NO',['class'=>'btn btn-primary ']);  ?>
            <div id="closeadd-btn"><i class="fa-regular fa-circle-xmark"></i></div>
        </div>
    </div>
    <div id="status-modal">
        <div id="status-modal-form">
            <div id="closestatus-btn"><i class="fa-regular fa-circle-xmark"></i></div>
            <b>Are you sure you want to change the status?</b>
            <hr>
            <div class="#error-message"></div>
            <form id="form-status" method="POST">
                <select class="form-control" name="status" id="status-status" required>
                    <option value="">--Status</option>
                    <option value="1" name="1" id="1">Active </option>
                    <option value="0" name="0" id="0">Inactive</option>
                </select>
                <!-- <input type="text" name="status" value="<?= $user['status']; ?>" id="status"> -->
                <textarea id='remarks' class="form-control" name="remarks" rows="5" cols="45"
                    placeholder='Enter Remarks' required></textarea><br>

                <button type='submit' id='submit' class='btn btn-primary'>Update</button>
            </form>
        </div>

    </div>
    </div>

    <script type="text/javascript">
    //Open Delete jquery
    $(document).on("click", "#delete-btn", function(e) {
        e.preventDefault();
        $('#add-modal').show();
    });

    //close Delete jquery
    $("#closeadd-btn").on("click", function() {
        $("#add-modal").hide();
    });

    //Open Status Ajax
    $(document).on("click", "#status", function(e) {
        e.preventDefault();
        $('#status-modal').show();
        var id = $(this).data("id");
        // console.log(id);


        $("#form-status").on('submit', (function(e) {
            e.preventDefault();
            var status = $('#status-status').val();
            var remarks = $('#remarks').val();

            $.ajax({
                url: "<?= base_url("index.php/admin/userstatus"); ?>",
                type: "POST",
                data: {
                    id: id,
                    status: status,
                    remarks: remarks,
                },
                success: function(data) {
                    if (data = 1) {
                        $("#status-modal").hide();
                        window.location.reload();
                    } else {
                        $("#error-message").html("couldn't Update.");
                    }
                },
                error: function(e) {}
            });

        }));

    });
    //Close Status Ajax
    $("#closestatus-btn").on("click", function() {
        $("#status-modal").hide();

    });
    </script>


</body>

</html>