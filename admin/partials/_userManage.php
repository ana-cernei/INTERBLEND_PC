<?php
    include '_dbconnect.php';

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(isset($_POST['removeUser'])) {
        $Id = $_POST["Id"];
        $sql = "DELETE FROM users WHERE id='$Id'";   
        $result = mysqli_query($conn, $sql);
        echo "<script>alert('Removed');
            window.location=document.referrer;
            </script>";
    }
    
    if(isset($_POST['createUser'])) {
        $username = $_POST["username"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $userType = $_POST["userType"];
        $password = $_POST["password"];
        $cpassword = $_POST["cpassword"];
        
        // Check whether this username exists
        $existSql = "SELECT * FROM users WHERE username = '$username'";
        $result = mysqli_query($conn, $existSql);
        $numExistRows = mysqli_num_rows($result);
        if($numExistRows > 0){
            echo "<script>alert('Username Already Exists');
                    window.location=document.referrer;
                </script>";
        }
        else{
            if(($password == $cpassword)){
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $sql = "INSERT INTO users ( username, firstName, lastName, email, phone, userType, password, joinDate) VALUES ('$username', '$firstName', '$lastName', '$email', '$phone', '$userType', '$hash', current_timestamp())";   
                $result = mysqli_query($conn, $sql);
                if ($result){
                    echo "<script>alert('Success');
                            window.location=document.referrer;
                        </script>";
                }else {
                    echo "<script>alert('Failed');
                            window.location=document.referrer;
                        </script>";
                }
            }
            else{
                echo "<script>alert('Passwords do not match');
                    window.location=document.referrer;
                </script>";
            }
        }
    }
    if(isset($_POST['editUser'])) {
        $id = $_POST["userId"];
        $firstName = $_POST["firstName"];
        $lastName = $_POST["lastName"];
        $email = $_POST["email"];
        $phone = $_POST["phone"];
        $userType = $_POST["userType"];

        $sql = "UPDATE users SET firstName='$firstName', lastName='$lastName', email='$email', phone='$phone', userType='$userType' WHERE id='$id'";   
        $result = mysqli_query($conn, $sql);
        if ($result){
            echo "<script>alert('update successfully');
                window.location=document.referrer;
                </script>";
        }
        else {
            echo "<script>alert('failed');
                window.location=document.referrer;
                </script>";
        }
    }
    
    if(isset($_POST['updateProfilePhoto'])) {
        $id = $_POST["userId"];
        $check = getimagesize($_FILES["userimage"]["tmp_name"]);
        if($check !== false) {
            $newfilename = "person-".$id.".jpg";

            $uploaddir = $_SERVER['DOCUMENT_ROOT'].'/INTERBLEND_PC/img/';
            $uploadfile = $uploaddir . $newfilename;

            if (move_uploaded_file($_FILES['userimage']['tmp_name'], $uploadfile)) {
                echo "<script>alert('success');
                        window.location=document.referrer;
                    </script>";
            } else {
                echo "<script>alert('failed');
                        window.location=document.referrer;
                    </script>";
            }
        }
        else{
            echo '<script>alert("Please select an image file to upload.");
            window.location=document.referrer;
                </script>';
        }
    }
    
    if(isset($_POST['removeProfilePhoto'])) {
        $id = $_POST["userId"];
        $filename = $_SERVER['DOCUMENT_ROOT']."/INTERBLEND_PC/img/person-".$id.".jpg";
        if (file_exists($filename)) {
            unlink($filename);
            echo "<script>alert('Removed');
                window.location=document.referrer;
            </script>";
        }
        else {
            echo "<script>alert('no photo available.');
                window.location=document.referrer;
            </script>";
        }
    }
}
// Search functionality: Processing GET request for search
$search_id = isset($_GET['searchId']) ? mysqli_real_escape_string($conn, $_GET['searchId']) : '';
$search_name = isset($_GET['searchName']) ? mysqli_real_escape_string($conn, $_GET['searchName']) : '';

// Build SQL query based on search input
$sql = "SELECT * FROM users";
$conditions = [];
if (!empty($search_id)) {
    $conditions[] = "id LIKE '%$search_id%'";
}
if (!empty($search_name)) {
    $conditions[] = "(username LIKE '%$search_name%' OR firstName LIKE '%$search_name%' OR lastName LIKE '%$search_name%')";
}
if (count($conditions) > 0) {
    $sql .= " WHERE " . implode(' AND ', $conditions);
}
$result = mysqli_query($conn, $sql);
?>

<div class="container-fluid" style="margin-top:98px">
    <div class="row">
        <div class="col-lg-12">
            <button class="btn btn-primary float-right btn-sm" data-toggle="modal" data-target="#newUser"><i class="fa fa-plus"></i> New user</button>
            <!-- Search form -->
            <form class="form-inline" action="" method="GET">
                <input class="form-control mr-sm-2" type="text" placeholder="Search by ID" name="searchId" value="<?= $search_id ?>">
                <input class="form-control mr-sm-2" type="text" placeholder="Search by Name" name="searchName" value="<?= $search_name ?>">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="card col-lg-12">
            <div class="card-body">
                <table class="table-striped table-bordered col-md-12 text-center">
                    <thead style="background-color: rgb(111 202 203);">
                        <tr>
                            <th>UserId</th>
                            <th style="width:7%">Photo</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone No.</th>
                            <th>Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        while($row = mysqli_fetch_assoc($result)) {
                            $Id = $row['id'];
                            $username = $row['username'];
                            $firstName = $row['firstName'];
                            $lastName = $row['lastName'];
                            $email = $row['email'];
                            $phone = $row['phone'];
                            $userType = $row['userType'];
                            $userType = $userType == 0 ? "user" : "Admin";

                            echo "<tr>
                                <td>$Id</td>
                                <td><img src='/INTERBLEND_PC/img/profilePic$Id.jpg' alt='image for this user' onError='this.src =\"/INTERBLEND_PC/img/profilePic.jpg\"' width='100px' height='100px'></td>
                                <td>$username</td>
                                <td>
                                    <p>First Name: <b>$firstName</b></p>
                                    <p>Last Name: <b>$lastName</b></p>
                                </td>
                                <td>$email</td>
                                <td>$phone</td>
                                <td>$userType</td>
                                <td class='text-center'>
                                    <div class='row mx-auto' style='width:112px'>
                                        <button class='btn btn-sm btn-primary' data-toggle='modal' data-target='#editUser$Id' type='button'>Edit</button>";
                            if($Id == 1) {
                                echo "<button class='btn btn-sm btn-danger' disabled style='margin-left:9px;'>Delete</button>";
                            } else {
                                echo "<form action='partials/_userManage.php' method='POST'>
                                        <button name='removeUser' class='btn btn-sm btn-danger' style='margin-left:9px;'>Delete</button>
                                        <input type='hidden' name='Id' value='$Id'>
                                    </form>";
                            }
                            echo "</div>
                                </td>
                            </tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>