<?php
include("checklogin.php");
include("layouts/header.php");
include("layouts/sidebar.php");

?>
<link rel="stylesheet" type="text/css" href="layouts/dist/css/dataTables.bootstrap.min.css"/>

<script type="text/javascript" src="layouts/dist/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="layouts/dist/js/dataTables.bootstrap.min.js"></script>
<div class="main">
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-default">
                <div class="panel-heading">
                    ข้อมูลกลุ่มสินค้า
                    <span><div class="btn btn-success"><i class="fa fa-plus"></i> สร้างข้อมูล</div></span>
                </div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered table-hover" id="group_data">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>-</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>

<script>
    $(document).ready(function () {
        // $('.js-example-basic-single').select2();
        var userdataTable = $('#group_data').DataTable({
            "processing": true,
            "serverSide": true,
            "order": [],
            "bFilter": true,
            "ajax": {
                url: "product_group_fetch.php",
                type: "POST"
            },
            "columnDefs": [
                {
                    "targets": [0,4], // array column to disable sort arrow
                    "orderable": false,
                }
            ],
            "pageLength": 10
        });
    });
</script>
<?php include("layouts/footer.php");?>
