<html>

<head>
    <title></title>
    <style>
    .sidebar {
        margin: 0;
        padding: 0;
        width: 200px;
        background-color: #f1f1f1;
        /* position: fixed; */
        position: absolute;
        height: 100%;
        overflow: auto;
        /* z-index: 99; */
    }

    .sidebar a {
        display: block;
        color: black;
        padding: 16px;
        text-decoration: none;
    }

    .sidebar a.active {
        background-color: #04AA6D;
        color: white;
    }

    .sidebar a:hover:not(.active) {
        background-color: #555;
        color: white;
    }

    div.content {
        margin-left: 200px;
        padding: 1px 16px;
        height: 1000px;
    }

    @media screen and (max-width: 700px) {
        .sidebar {
            width: 100%;
            height: auto;
            position: relative;
        }

        .sidebar a {
            float: left;
        }

        div.content {
            margin-left: 0;
        }
    }

    @media screen and (max-width: 400px) {
        .sidebar a {
            text-align: center;
            float: none;
        }
    }
    </style>
</head>

<body>

    <div class="sidebar">

        <?=  anchor("index.php/Admin/home",'HOME');  ?>
        <?=  anchor("index.php/Admin/customer",'CUSTOMERS');  ?>
        <?=  anchor("index.php/Admin/welcome",'ARTICLE');  ?>

    </div>

</body>

</html>