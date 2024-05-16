<?php
$answer1 = $_POST['question-1-answers'];
$answer2 = $_POST['question-2-answers'];
$answer3 = $_POST['question-3-answers'];
$answer4 = $_POST['question-4-answers'];
$answer5 = $_POST['question-5-answers'];

$totalA = 0;
$totalB = 0;
$totalC = 0;
$totalD = 0;

if ($answer1 == "A") { $totalA = $totalA + 1.17; $totalD = $totalD + .06; }
if ($answer1 == "B") { $totalB = $totalB + 1.15; $totalC = $totalC + .05; }
if ($answer1 == "C") { $totalC = $totalC + 1.13; $totalA = $totalA + .05; }
if ($answer1 == "D") { $totalD = $totalD + 1.16; $totalA = $totalA + .07; }

if ($answer2 == "A") { $totalA = $totalA + 1.23; }
if ($answer2 == "B") { $totalB = $totalB + 1.15; }
if ($answer2 == "C") { $totalC = $totalC + 1.13; }

if ($answer3 == "A") { $totalA = $totalA + 1.17; $totalC = $totalC + .05; }
if ($answer3 == "B") { $totalB = $totalB + 1.15; $totalC = $totalC + .03; }
if ($answer3 == "C") { $totalC = $totalC + 1.13; $totalB = $totalB + .07; }
if ($answer3 == "D") { $totalD = $totalD + 1.16; }

if ($answer4 == "A") { $totalA = $totalA + 1.17; }
if ($answer4 == "B") { $totalB = $totalB + 1.15; }
if ($answer4 == "C") { $totalC = $totalC + 1.13; $totalA = $totalA + .05; $totalB = $totalB + .06; $totalD = $totalD + .07; }
if ($answer4 == "D") { $totalD = $totalD + 1.16; $totalB = $totalB + .04; $totalA = $totalA + .045; $totalC = $totalC + .034; }

if ($answer5 == "A") { $totalA = $totalA + 1.17; $totalD = $totalD + .08; }
if ($answer5 == "B") { $totalB = $totalB + 1.15; }
if ($answer5 == "C") { $totalC = $totalC + 1.14; $totalA = $totalA + .06; $totalD = $totalD + .08; }
if ($answer5 == "D") { $totalD = $totalD + 1.16; $totalC = $totalC + .04; }

?>

<div class="results-overlay">
    <?php
    if ($totalA > $totalB && $totalA > $totalC && $totalA > $totalD) {
        echo '<div class="quiz-overlay result priest"></div><div class="results-text"><p class="you-chose">Ți se potrivește:</p><img src="img/card-27.jpg" class="card-img-top" alt="image for this category" width="300px" height="270px"><div class="results test-results2"><p class="score">Fingerprint</p><p class="score-details"></div>';
        echo '<a href="viewPizzaList.php?catid=27" class="btn btn-primary">Vezi oportunitățile</a>';
    }
    elseif ($totalB > $totalA && $totalB > $totalC && $totalB > $totalD) {
        echo '<div class="quiz-overlay result megadeth"></div><div class="results-text"><p class="you-chose">Ți se potrivește:</p><img src="img/card-28.jpg" class="card-img-top" alt="image for this category" width="300px" height="270px"><div class="results test-results2"><p class="score">Happy Bus</p><p class="score-details"></div>';
        echo '<a href="viewPizzaList.php?catid=28" class="btn btn-primary">Vezi oportunitățile</a>';
    }
    elseif ($totalC > $totalA && $totalC > $totalB && $totalC > $totalD) {
        echo '<div class="quiz-overlay result maiden"></div><div class="results-text"><p class="you-chose">Ți se potrivește:</p><img src="img/card-29.jpg" class="card-img-top" alt="image for this category" width="300px" height="270px"><div class="results test-results2"><p class="score">Heartbeat</p><p class="score-details"></div>';
        echo '<a href="viewPizzaList.php?catid=29" class="btn btn-primary">Vezi oportunitățile</a>';
    }
    elseif ($totalD > $totalA && $totalD > $totalB && $totalD > $totalC) {
        echo '<div class="quiz-overlay result dio"></div><div class="results-text"><p class="you-chose">Ți se potrivește:</p><img src="img/card-30.jpg" class="card-img-top" alt="image for this category" width="300px" height="270px"><div class="results test-results2"><p class="score">Global Classroom</p><p class="score-details"></div>';
        echo '<a href="viewPizzaList.php?catid=30" class="btn btn-primary">Vezi oportunitățile</a>';
    }
    ?>     
</div>
