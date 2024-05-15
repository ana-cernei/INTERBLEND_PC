<?php
    include '_dbconnect.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['createItem'])) {
            // Retrieve data from form
            $name = $_POST["name"];
            $description = $_POST["description"];
            $categoryId = $_POST["categoryId"];
            $price = $_POST["price"];
            $skills = $_POST["skills"];
            $language = $_POST["language"];
            $minimum_study_level = $_POST["minimum_study_level"];
            $accommodation = $_POST["accommodation"];
            $food = $_POST["food"];

            // Prepare SQL statement to insert new record
            $sql = "INSERT INTO `pizza` (`pizzaName`, `pizzaPrice`, `pizzaDesc`, `pizzaCategorieId`, `pizzaPubDate`, `skills`, `language`, `minimum_study_level`, `accommodation`, `food`) VALUES (?, ?, ?, ?, CURRENT_TIMESTAMP(), ?, ?, ?, ?, ?)";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sdsssssss", $name, $price, $description, $categoryId, $skills, $language, $minimum_study_level, $accommodation, $food);
            $result = mysqli_stmt_execute($stmt);
            $pizzaId = $conn->insert_id;

            if ($result) {
                $check = getimagesize($_FILES["image"]["tmp_name"]);
                if ($check !== false) {
                    $newName = 'pizza-' . $pizzaId;
                    $newfilename = $newName . ".jpg";
                    $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/INTERBLEND_PC/img/';
                    $uploadfile = $uploaddir . $newfilename;

                    if (move_uploaded_file($_FILES['image']['tmp_name'], $uploadfile)) {
                        echo "<script>alert('Success');
                                window.location=document.referrer;
                              </script>";
                    } else {
                        echo "<script>alert('Image upload failed');
                                window.location=document.referrer;
                              </script>";
                    }
                } else {
                    echo "<script>alert('Please select a valid image file to upload.');
                            window.location=document.referrer;
                          </script>";
                }
            } else {
                echo "<script>alert('Failed to insert new item');
                        window.location=document.referrer;
                      </script>";
            }
        }

        if (isset($_POST['removeItem'])) {
            $pizzaId = $_POST["pizzaId"];
            $sql = "DELETE FROM `pizza` WHERE `pizzaId`='$pizzaId'";   
            $result = mysqli_query($conn, $sql);
            $filename = $_SERVER['DOCUMENT_ROOT'] . "/INTERBLEND_PC/img/pizza-" . $pizzaId . ".jpg";
            if ($result) {
                if (file_exists($filename)) {
                    unlink($filename);
                }
                echo "<script>alert('Item removed successfully');
                        window.location=document.referrer;
                      </script>";
            } else {
                echo "<script>alert('Failed to remove item');
                        window.location=document.referrer;
                      </script>";
            }
        }

        if (isset($_POST['updateItem'])) {
            $pizzaId = $_POST["pizzaId"];
            $pizzaName = $_POST["name"];
            $pizzaDesc = $_POST["desc"];
            $pizzaPrice = $_POST["price"];
            $pizzaCategorieId = $_POST["catId"];
            $skills = $_POST["skills"];
            $language = $_POST["language"];
            $minimum_study_level = $_POST["minimum_study_level"];
            $accommodation = $_POST["accommodation"];
            $food = $_POST["food"];

            $sql = "UPDATE `pizza` SET `pizzaName`=?, `pizzaPrice`=?, `pizzaDesc`=?, `pizzaCategorieId`=?, `skills`=?, `language`=?, `minimum_study_level`=?, `accommodation`=?, `food`=? WHERE `pizzaId`=?";
            $stmt = mysqli_prepare($conn, $sql);
            mysqli_stmt_bind_param($stmt, "sdsssssssi", $pizzaName, $pizzaPrice, $pizzaDesc, $pizzaCategorieId, $skills, $language, $minimum_study_level, $accommodation, $food, $pizzaId);
            $result = mysqli_stmt_execute($stmt);
            if ($result) {
                echo "<script>alert('Item updated successfully');
                        window.location=document.referrer;
                      </script>";
            } else {
                echo "<script>alert('Failed to update item');
                        window.location=document.referrer;
                      </script>";
            }
        }

        if (isset($_POST['updateItemPhoto'])) {
            $pizzaId = $_POST["pizzaId"];
            $check = getimagesize($_FILES["itemimage"]["tmp_name"]);
            if ($check !== false) {
                $newName = 'pizza-' . $pizzaId;
                $newfilename = $newName . ".jpg";
                $uploaddir = $_SERVER['DOCUMENT_ROOT'] . '/INTERBLEND_PC/img/';
                $uploadfile = $uploaddir . $newfilename;

                if (move_uploaded_file($_FILES['itemimage']['tmp_name'], $uploadfile)) {
                    echo "<script>alert('Image updated successfully');
                            window.location=document.referrer;
                          </script>";
                } else {
                    echo "<script>alert('Failed to update image');
                            window.location=document.referrer;
                          </script>";
                }
            } else {
                echo "<script>alert('Please select a valid image file to upload.');
                        window.location=document.referrer;
                      </script>";
            }
        }
    }
?>
