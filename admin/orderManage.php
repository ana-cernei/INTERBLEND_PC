<?php
include 'partials/_dbconnect.php'; // Include your database connection file

// Handle status update request
if(isset($_POST['updateStatus'])) {
    $orderId = $_POST['orderId'];
    $newStatus = $_POST['status'];
    $updateSql = "UPDATE `orders` SET `status`='$newStatus' WHERE `orderId`=$orderId";
    $updateResult = mysqli_query($conn, $updateSql);
}
?>

<div class="container" style="margin-top:98px;background: aliceblue;">
    <div class="table-wrapper">
        <div class="table-title" style="border-radius: 14px;">
            <div class="row">
                <div class="col-sm-4">
                    <h2>Applications <b>Details</b></h2>
                </div>
                <div class="col-sm-8">						
                    <a href="" class="btn btn-primary"><i class="material-icons">&#xE863;</i> <span>Refresh List</span></a>
                    <a href="#" onclick="window.print()" class="btn btn-info"><i class="material-icons">&#xE24D;</i> <span>Print</span></a>
                </div>
            </div>
        </div>
        
        <table class="table table-striped table-hover text-center" id="NoOrder">
            <thead style="background-color: rgb(111 202 203);">
                <tr>
                    <th>Order Id</th>
                    <th>User Id</th>
                    <th>Phone No</th>
                    <th>Order Date</th>
                    <th>Skills</th>
                    <th>Languages</th>
                    <th>Education</th>
                    <th>Experience</th>
                    <th>Status</th>
                    <th>Change Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT * FROM `orders`";
                $result = mysqli_query($conn, $sql);
                $counter = 0;
                while($row = mysqli_fetch_assoc($result)){
                    $orderId = $row['orderId'];
                    $userId = $row['userId'];
                    $phoneNo = $row['phoneNo'];
                    $orderDate = $row['orderDate'];
                    $skills = $row['skills'];
                    $languages = $row['languages'];
                    $education = $row['education'];
                    $experience = $row['experience'];
                    $status = $row['status'];
                    $counter++;

                    $statusClass = '';
                    if ($status == 'accepted') {
                        $statusClass = 'status-accepted';
                    } elseif ($status == 'rejected') {
                        $statusClass = 'status-rejected';
                    }

                    echo '<tr class="' . $statusClass . '">
                            <td>' . $orderId . '</td>
                            <td>' . $userId . '</td>
                            <td>' . $phoneNo . '</td>
                            <td>' . $orderDate . '</td>
                            <td>' . $skills . '</td>
                            <td>' . $languages . '</td>
                            <td>' . $education . '</td>
                            <td>' . $experience . '</td>
                            <td>' . $status . '</td>
                            <td>
                                <form method="post" action="">
                                    <input type="hidden" name="orderId" value="' . $orderId . '">
                                    <select name="status" onchange="this.form.submit()">
                                        <option value="in progress"' . ($status == 'in progress' ? ' selected' : '') . '>In Progress</option>
                                        <option value="accepted"' . ($status == 'accepted' ? ' selected' : '') . '>Accepted</option>
                                        <option value="rejected"' . ($status == 'rejected' ? ' selected' : '') . '>Rejected</option>
                                    </select>
                                    <input type="hidden" name="updateStatus" value="1">
                                </form>
                            </td>
                        </tr>';
                }
                if($counter == 0) {
                    echo '<tr><td colspan="10"><div class="alert alert-info alert-dismissible fade show" role="alert" style="width:100%">You have not received any order!</div></td></tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<style>
    .tooltip.show {
        top: -62px !important;
    }
    
    .table-wrapper .btn {
        float: right;
        color: #333;
        background-color: #fff;
        border-radius: 3px;
        border: none;
        outline: none !important;
        margin-left: 10px;
    }
    .table-wrapper .btn:hover {
        color: #333;
        background: #f2f2f2;
    }
    .table-wrapper .btn.btn-primary {
        color: #fff;
        background: #03A9F4;
    }
    .table-wrapper .btn.btn-primary:hover {
        background: #03a3e7;
    }
    .table-title .btn {		
        font-size: 13px;
        border: none;
    }
    .table-title .btn i {
        float: left;
        font-size: 21px;
        margin-right: 5px;
    }
    .table-title .btn span {
        float: left;
        margin-top: 2px;
    }
    .table-title {
        color: #fff;
        background: #4b5366;		
        padding: 16px 25px;
        margin: -20px -25px 10px;
        border-radius: 3px 3px 0 0;
    }
    .table-title h2 {
        margin: 5px 0 0;
        font-size: 24px;
    }
    table.table tr th, table.table tr td {
        border-color: #e9e9e9;
        padding: 12px 15px;
        vertical-align: middle;
    }
    table.table tr th:first-child {
        width: 60px;
    }
    table.table tr th:last-child {
        width: 80px;
    }
    table.table-striped tbody tr:nth-of-type(odd) {
        /* background-color: #fcfcfc; */
    }
    table.table-striped.table-hover tbody tr:hover {
        /* background: #f5f5f5; */
    }
    table.table th i {
        font-size: 13px;
        margin: 0 5px;
        cursor: pointer;
    }	
    table.table td a {
        font-weight: bold;
        color: #566787;
        display: inline-block;
        text-decoration: none;
    }
    table.table td a:hover {
        color: #2196F3;
    }
    table.table td a.view {        
        width: 30px;
        height: 30px;
        color: #2196F3;
        border: 2px solid;
        border-radius: 30px;
        text-align: center;
    }
    table.table td a.view i {
        font-size: 22px;
        margin: 2px 0 0 1px;
    }   
    table.table .avatar {
        border-radius: 50%;
        vertical-align: middle;
        margin-right: 10px;
    }
    table {
        counter-reset: section;
    }

    .count:before {
        counter-increment: section;
        content: counter(section);
    }
    
    /* CSS pentru statusuri */
    .status-accepted {
        background-color: #d4edda !important; /* Verde deschis */
    }

    .status-rejected {
        background-color: #f8d7da !important; /* Roșu deschis */
    }
</style>

<script>
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
});
</script>
