<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title id="title">Pizza</title>
    <link rel="icon" href="img/logo.jpg" type="image/x-icon">
    <style>
        #cont {
            min-height: 578px;
        }
        .pizza-description p, .attribute-description {
            font-size: 16px;
            line-height: 1.6;
            color: #333;
            border-left: 4px solid #000; /* Changed from red to black */
            padding-left: 10px;
            background-color: #f9f9f9;
            margin-top: 20px;
            border-radius: 5px;
        }
        .attribute-title {
            font-weight: bold;
            display: block; /* makes the title go on a new line */
        }
        .link-section a {
            display: block;
            color: #007bff;
            text-decoration: none;
            padding: 5px;
            margin-top: 10px;
        }
        .link-section a:hover {
            background-color: #f0f0f0;
        }
    </style>
</head>
<body>
    <?php include 'partials/_dbconnect.php';?>
    <?php require 'partials/_nav.php' ?>

    <div class="container my-4" id="cont">
        <div class="row jumbotron">
        <?php
            $pizzaId = $_GET['pizzaid'];
            $sql = "SELECT * FROM `pizza` WHERE pizzaId = $pizzaId";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $pizzaName = $row['pizzaName'];
            $pizzaPrice = $row['pizzaPrice'];
            $pizzaDesc = $row['pizzaDesc'];
            $pizzaCategorieId = $row['pizzaCategorieId'];
            // New attributes
            $skills = $row['skills'];
            $language = $row['language'];
            $minimum_study_level = $row['minimum_study_level'];
            $accommodation = $row['accommodation'];
            $food = $row['food'];
        ?>
        <script> document.getElementById("title").innerHTML = "<?php echo $pizzaName; ?>"; </script> 
        <div class="col-md-4">
            <img src="img/pizza-<?php echo $pizzaId; ?>.jpg" width="249px" height="262px">
        </div>
        <div class="col-md-8 my-4">
            <h3><?php echo $pizzaName; ?></h3>
            <h5 style="color: #ff0000"><?php echo $pizzaPrice; ?> EUR</h5>
            <div class="pizza-description my-3">
                <p><?php echo nl2br($pizzaDesc); ?></p>
                <p class="attribute-description"><span class="attribute-title">Skills:</span><?php echo nl2br($skills); ?></p>
                <p class="attribute-description"><span class="attribute-title">Language:</span><?php echo nl2br($language); ?></p>
                <p class="attribute-description"><span class="attribute-title">Minimum Study Level:</span><?php echo nl2br($minimum_study_level); ?></p>
                <p class="attribute-description"><span class="attribute-title">Accommodation:</span><?php echo nl2br($accommodation); ?></p>
                <p class="attribute-description"><span class="attribute-title">Food:</span><?php echo nl2br($food); ?></p>
            </div>
            <?php
if($loggedin) {
    $quaSql = "SELECT `itemQuantity` FROM `viewcart` WHERE pizzaId = '$pizzaId' AND `userId`='$userId'";
    $quaresult = mysqli_query($conn, $quaSql);
    $quaExistRows = mysqli_num_rows($quaresult);
    if($quaExistRows == 0) {
        echo '<form id="addToCartForm" action="partials/_manageCart.php" method="POST">
              <input type="hidden" name="itemId" value="'.$pizzaId.'">
              <input type="hidden" name="redirect" value="apply.html">
              <button type="submit" name="addToCart" class="btn btn-primary my-2">Apply</button>
              </form>
              <script>
                  document.getElementById("addToCartForm").addEventListener("submit", function(event) {
                      event.preventDefault();
                      var form = this;
                      var request = new XMLHttpRequest();
                      request.open("POST", form.action, true);
                      request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
                      request.onreadystatechange = function() {
                          if(request.readyState === 4 && request.status === 200) {
                              window.location.href = "apply.html";
                          }
                      };
                      request.send(new URLSearchParams(new FormData(form)).toString());
                  });
              </script>';
    } else {
        echo '<a href="apply.html"><button class="btn btn-primary my-2">Apply</button></a>';
    }
} else {
    echo '<button class="btn btn-primary my-2" data-toggle="modal" data-target="#loginModal">Apply</button>';
}

            echo '</form>
            <h6 class="my-1"> View </h6>
            <div class="mx-4">
                <a href="viewPizzaList.php?catid=' . $pizzaCategorieId . '" class="active text-dark">
                <i class="fas fa-qrcode"></i>
                    <span>All Opportunities</span>
                </a>
            </div>
            <div class="mx-4">
                <a href="index.php" class="active text-dark">
                <i class="fas fa-qrcode"></i>
                    <span>All Categories</span>
                </a>
            </div>
        </div>'
    ?>
    </div>
</div>
    <?php require 'partials/_footer.php' ?>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
</body>
</html>
