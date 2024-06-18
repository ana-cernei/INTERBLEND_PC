<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>My Applications</title>
    <link rel = "icon" href ="img/logo.jpg" type = "image/x-icon">
    <style>
    #cont{
        min-height : 626px;
    }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>
    <?php 
    if($loggedin){
        $userId = $_SESSION['userId'];
    ?>
    
    <div class="container" id="cont">
        <div class="row">
            <div class="alert alert-info mb-0" style="width: -webkit-fill-available;">
              <strong>Info!</strong> You can only delete applications in progress. If accepted, please <a href= "contact.php">contact us</a> to cancel it.
            </div>
            <div class="col-lg-12 text-center border rounded bg-light my-3">
                <h1>My Applications</h1>
            </div>
            <div class="col-lg-12">
            <?php
                if (isset($_GET['delete'])) {
                    if ($_GET['delete'] == 'success') {
                        echo '<div class="alert alert-success">Application deleted successfully.</div>';
                    } elseif ($_GET['delete'] == 'fail') {
                        echo '<div class="alert alert-danger">Failed to delete the application.</div>';
                    }
                }
                ?>
                <div class="card wish-list mb-3">
                    <table class="table text-center">
                        <thead class="thead-light">
                            <tr>
                                <th scope="col">No.</th>
                                <th scope="col">Application ID</th>
                                <th scope="col">Date</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Skills</th>
                                <th scope="col">Languages</th>
                                <th scope="col">Education</th>
                                <th scope="col">Experience</th>
                                <th scope="col">Status</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                $sql = "SELECT * FROM `orders` WHERE `userId`= $userId";
                                $result = mysqli_query($conn, $sql);
                                $counter = 0;
                                while($row = mysqli_fetch_assoc($result)){
                                    $counter++;
                                    $statusClass = '';
                                    $actionButton = '';

                                    if ($row['status'] == 'rejected') {
                                        $statusClass = 'text-danger';
                                    } elseif ($row['status'] == 'accepted') {
                                        $statusClass = 'text-success';
                                    } elseif ($row['status'] == 'In progress') {
                                        $statusClass = 'text-warning';
                                        $actionButton = '<form action="partials/_manageCart.php" method="POST" style="display:inline;">
                                                            <button name="deleteApplication" class="btn btn-sm btn-outline-danger">Delete</button>
                                                            <input type="hidden" name="orderId" value="'.$row['orderId'].'">
                                                        </form>';
                                    }
                                    echo '<tr>
                                            <td>' . $counter . '</td>
                                            <td>' . $row['orderId'] . '</td>
                                            <td>' . $row['orderDate'] . '</td>
                                            <td>' . $row['phoneNo'] . '</td>
                                            <td>' . $row['skills'] . '</td>
                                            <td>' . $row['languages'] . '</td>
                                            <td>' . $row['education'] . '</td>
                                            <td>' . $row['experience'] . '</td>
                                            <td class="' . $statusClass . '">' . $row['status'] . '</td>
                                            <td>' . $actionButton . '</td>
                                        </tr>';
                                }
                                if($counter==0) {
                                    echo '<tr><td colspan="9" class="text-center">No applications found</td></tr>';
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
             
    <?php 
    }
    else {
        echo '<div class="container" style="min-height : 610px;">
        <div class="alert alert-info my-3">
            <font style="font-size:22px"><center>Before you can view your applications, you need to <strong><a class="alert-link" data-toggle="modal" data-target="#loginModal">Login</a></strong></center></font>
        </div></div>';
    }
    ?>
    <?php require 'partials/_checkoutModal.php'; ?>
    <?php require 'partials/_footer.php' ?>
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>
