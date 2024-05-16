<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css" integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">
    <title>Home</title>
    <link rel = "icon" href ="img/logo1.jpg" type = "image/x-icon">
  </head>
<body>
  <?php include 'partials/_dbconnect.php';?>
  <?php require 'partials/_nav.php' ?>
  
  <?php
if (isset($_GET['status'])) {
    $status = $_GET['status'];
    if ($status == 'success') {
        echo '<div class="alert alert-success" role="alert">Application submitted successfully!</div>';
    } elseif ($status == 'error') {
        $errorMsg = urldecode($_GET['errorMsg']);
        echo '<div class="alert alert-danger" role="alert">Error submitting application: ' . htmlspecialchars($errorMsg) . '</div>';
    } elseif ($status == 'invalidrequest') {
        echo '<div class="alert alert-warning" role="alert">Invalid request method.</div>';
    }
}
?>

  <!-- Category container starts here -->
  <div class="container my-3 mb-5">
    <div class="col-lg-2 text-center bg-light my-3" style="margin:auto;border-top: 2px groove black;border-bottom: 2px groove black;">     
      <h2 class="text-center">Menu </h2>
    </div>
    <div class="row">
      <!-- Fetch all the categories and use a loop to iterate through categories -->
      <?php 
        $sql = "SELECT * FROM `categories`"; 
        $result = mysqli_query($conn, $sql);
        while($row = mysqli_fetch_assoc($result)){
          $id = $row['categorieId'];
          $cat = $row['categorieName'];
          $desc = $row['categorieDesc'];
          echo '<div class="col-xs-3 col-sm-3 col-md-3">
                  <div class="card" style="width: 18rem;">
                    <img src="img/card-'.$id. '.jpg" class="card-img-top" alt="image for this category" width="249px" height="270px">
                    <div class="card-body">
                      <h5 class="card-title"><a href="viewPizzaList.php?catid=' . $id . '">' . $cat . '</a></h5>
                      <p class="card-text">' . substr($desc, 0, 30). '... </p>
                      <a href="viewPizzaList.php?catid=' . $id . '" class="btn btn-primary">View All</a>
                    </div>
                  </div>
                </div>';
        }
      ?>
    </div>
  </div>
  <div id="page-wrap">
        <h1 class="transparent index-headline">Discover which volunteering category suits you:
        <button id="startQuiz"  class="btn btn-lg btn-primary">Start Quiz</button></h1>

        <!-- Modal pentru Quiz -->
        <div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="quizModalLabel">Quiz</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="quizModalBody">
                        <!-- Quiz-ul va fi încărcat aici -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal pentru Rezultate -->
        <div class="modal fade" id="resultModal" tabindex="-1" role="dialog" aria-labelledby="resultModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="resultModalLabel">Results</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body" id="resultModalBody">
                        <!-- Rezultatele vor fi încărcate aici -->
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript necesar pentru Bootstrap și jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    <!-- Script pentru încărcarea dinamică -->
    <script>
        $(document).ready(function() {
            $('#startQuiz').on('click', function() {
                $.ajax({
                    url: 'partials/_test.php',
                    method: 'GET',
                    success: function(response) {
                        $('#quizModalBody').html(response);
                        $('#quizModal').modal('show');
                    }
                });
            });

            $(document).on('submit', '#quizForm', function(e) {
                e.preventDefault();
                $.ajax({
                    url: 'partials/_grade.php',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        $('#quizModal').modal('hide');
                        $('#resultModalBody').html(response);
                        $('#resultModal').modal('show');
                    }
                });
            });
        });
    </script>


    <?php require 'partials/_footer.php' ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>         
    <script src="https://unpkg.com/bootstrap-show-password@1.2.1/dist/bootstrap-show-password.min.js"></script>
</body>
</html>