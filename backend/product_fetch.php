<?php

//user_fetch.php

include("../common/dbcon.php");
include("models/brand_model.php");
include("models/group_model.php");
//include("helpers/QuotationStatus.php");

$query = '';

$output = array();

$query .= "SELECT * FROM product WHERE status=1 AND";

/*if(isset($_POST["is_category"]))
{
 	//echo $query .= "is_reimbursed = '".$_POST["is_category"]."' AND ";
} */

if(isset($_POST["search"]["value"]))
{
    $query .= '( name LIKE "%'.$_POST["search"]["value"].'%" ';
    $query .= 'OR description LIKE "%'.$_POST["search"]["value"].'%" ) ';
//    $query .= 'OR expense_bb_no LIKE "%'.$_POST["search"]["value"].'%" ';
//    $query .= 'OR expense_payee LIKE "%'.$_POST["search"]["value"].'%" ';
//    $query .= 'OR expense_company_name LIKE "%'.$_POST["search"]["value"].'%" ';
//    $query .= 'OR expense_remark LIKE "%'.$_POST["search"]["value"].'%" ';
//    $query .= 'OR expense_withdraw_amount LIKE "%'.$_POST["search"]["value"].'%" ';
//    $query .= 'OR expense_vat_amount LIKE "%'.$_POST["search"]["value"].'%" )';
}

if(isset($_POST["order"]))
{
    $query .= ' ORDER BY '.$_POST['order']['0']['column'].' '.$_POST['order']['0']['dir'].' ';
}
else
{
    $query .= ' ORDER BY id DESC';
}

if($_POST["length"] != -1)
{
    $query .= ' LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $connect->prepare($query);

$statement->execute();

$result = $statement->fetchAll();

$data = array();

$filtered_rows = $statement->rowCount();
$running_no = 1;

foreach($result as $row)
{
//    $statusDoc = '';
//    if($row["is_submit_to_accounting"] == 'Completed')
//    {
//        //$statusDoc = '<span class="label label-success">Completed</span>';
//        //$statusDoc = '<button type="button" name="update_docsubmit" id="'.$row["expense_id"].'" class="btn btn-success btn-xs update_docsubmit" data-status="Completed">Completed</button>';
//        $statusDoc = '<img src="images/document-green.png" height="20" width="20"  name="update_docsubmit_date" id="'.$row["expense_id"].'" class="update_docsubmit_date" data-status="Completed">';
//        //$statusDoc = '<button type="button" name="update_docsubmit_date" id="'.$row["expense_id"].'" class="btn btn-success btn-xs update_docsubmit_date" data-status="Completed">Completed</button>';
//    }
//    else
//    {
//        //$statusDoc = '<span class="label label-danger">Pending</span>';
//        //$statusDoc = '<button type="button" name="update_docsubmit" id="'.$row["expense_id"].'" class="btn btn-danger btn-xs update_docsubmit" data-status="Pending">Pending</button>';
//        $statusDoc = '<img src="images/document-red.png" height="20" width="20" name="update_docsubmit_date" id="'.$row["expense_id"].'" class="update_docsubmit_date" data-status="Pending">';
//        //$statusDoc = '<button type="button" name="update_docsubmit_date" id="'.$row["expense_id"].'" class="btn btn-warning btn-xs update_docsubmit_date" data-status="Pending">Pending</button>';
//    }
//
    $status = '';
    if($row["status"] == 1)
    {
        $status = '<span class="label label-success">Active</span>';
    }
    else
    {
        $status ='<span class="label label-danger">Inactive</span>';
//        $status = '<button type="button" name="update_vatclaim" id="'.$row["expense_id"].'" class="btn btn-danger btn-xs update_vatclaim_date" data-status="Pending">Pending</button>';
//        //$status = '<img src="images/pending_reimbursed.png" height="25" width="20" name="update_vatclaim" id="'.$row["expense_id"].'" class="update_vatclaim" data-status="Pending">';


    }
//
//    if($row['expense_company_name'] != "" && $row['expense_payee'] != "") {
//        $combinePayee = $row["expense_company_name"]."/".$row["expense_payee"];
//    } else {
//        if ($row['expense_company_name'] != "") {
//            $combinePayee = $row["expense_company_name"];
//        } else {
//            $combinePayee = $row["expense_payee"];
//        }
//
//    }
//
//    if ($row['expense_vat_rate'] == 0.01) {
//        $expense_vat_amount = number_format($row['expense_vat_amount'],2);
//    } else if ($row['expense_vat_rate'] == 0.03) {
//        $expense_vat_amount = number_format($row['expense_vat_amount'],2);
//    } else if ($row['expense_vat_rate'] == 0.05) {
//        $expense_vat_amount = number_format($row['expense_vat_amount'],2);
//    } else if ($row['expense_vat_rate'] == 0.07) {
//        $expense_vat_amount = number_format($row['expense_vat_amount'],2);
//    } else {
//        $expense_vat_amount = "-";
//    }

    $sub_array = array();
    $sub_array[] = $running_no++;
    $sub_array[] = $row['code'];
    $sub_array[] = $row['name'];
    $sub_array[] = $row['description'];
    $sub_array[] =  getGroupName($row['product_group_id'], $connect);
    $sub_array[] =  getBrandName($row['brand_id'], $connect);
    $sub_array[] = $status;
    //  $sub_array[] = '<div class="label label-default">'.$row['status'].'</div>';
//    $sub_array[] = number_format($row['expense_withdraw_amount'],2);
//    $sub_array[] = $expense_vat_amount;
//    $sub_array[] = '<button type="button" name="view" id="'.$row["expense_id"].'" class="btn btn-info btn-xs  view"><span class="glyphicon glyphicon-search"></span> View</button>';
//    $sub_array[] = $statusDoc;
//    //'<button type="button" name="update_docsubmit_date" id="'.$row["expense_id"].'" class="btn btn-default btn-xs update_docsubmit_date" data-status="'.$row["is_submit_to_accounting"].'">'.$row["is_submit_to_accounting"].'</button>';
//    $sub_array[] = $status;
    //$sub_array[] = '<button type="button" name="update_vatclaim" id="'.$row["expense_id"].'" class="btn btn-warning btn-xs update_vatclaim" data-status="'.$row["is_reimbursed"].'">'.$status.'</button>';
    $sub_array[] = '<button type="button" onclick="getupdate($(this));" name="update" id="'.$row["id"].'" class="btn btn-warning btn-xs update"><span class="glyphicon glyphicon-pencil"></span> Update</button><button type="button" onclick="getdelete($(this));" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$row["status"].'"><span class="fa fa-trash"></span> Delete</button>';
//    $sub_array[] = '<button type="button" name="delete" id="'.$row["id"].'" class="btn btn-danger btn-xs delete" data-status="'.$row["status"].'"><span class="fa fa-trash"></span> Delete</button>';
    $data[] = $sub_array;
}

$output = array(
    "draw"				=>	intval($_POST["draw"]),
    "recordsTotal"  	=>  $filtered_rows,
    "recordsFiltered" 	=>  get_total_all_records($connect),
    "data"    			=> 	$data
);
echo json_encode($output);

function get_total_all_records($connect)
{
    $statement = $connect->prepare("SELECT * FROM product");
    $statement->execute();
    return $statement->rowCount();
}

?>
