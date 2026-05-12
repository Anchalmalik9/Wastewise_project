<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $correctAnswers = [
        'q1' => 'a',
        'q2' => 'b',
        'q3' => 'b',
        'q4' => 'b',
        'q5' => 'b',
        'q6' => 'c',
        'q7' => 'b',
        'q8' => 'c',
        'q9' => 'c',
        'q10' => 'b'
    ];

    $score = 0;

    foreach ($correctAnswers as $question => $answer) {

        if (
            isset($_POST[$question]) &&
            $_POST[$question] == $answer
        ) {
            $score++;
        }
    }

    echo "<script>
            alert('Your Score: $score/10');
          </script>";
}

?>

<!DOCTYPE html>
<html>

<head>

    <title>WasteWise Quiz</title>

</head>

<body style="background:black;color:white;font-family:Arial;padding:40px;">

<header style="display:flex;justify-content:space-between;align-items:center;padding:20px 40px;background:#111;margin:-40px -40px 40px -40px;">

    <h2 style="color:lime;">
        WasteWise
    </h2>

    <nav>

        <a href="index.php#home" style="color:white;margin-right:20px;text-decoration:none;">
            Home
        </a>

        <a href="index.php#about" style="color:white;margin-right:20px;text-decoration:none;">
            About
        </a>

        <a href="index.php#blog" style="color:white;margin-right:20px;text-decoration:none;">
            Blog
        </a>

        <a href="quiz.php" style="color:lime;margin-right:20px;text-decoration:none;">
            Quiz
        </a>

        <a href="index.php#contact" style="color:white;text-decoration:none;">
            Contact
        </a>

    </nav>

</header>

<h1>WasteWise Quiz 🌱</h1>

<form method="POST" action="quiz.php">

    <p>1. What percentage of plastic waste is recycled globally?</p>

    <input type="radio" name="q1" value="a" required>
    9%
    <br><br>

    <input type="radio" name="q1" value="b">
    25%
    <br><br>

    <input type="radio" name="q1" value="c">
    50%
    <br><br>

    <input type="radio" name="q1" value="d">
    75%
    <br><br><br>


    <p>2. Which material is biodegradable?</p>

    <input type="radio" name="q2" value="a" required>
    Plastic
    <br><br>

    <input type="radio" name="q2" value="b">
    Paper
    <br><br>

    <input type="radio" name="q2" value="c">
    Glass
    <br><br>

    <input type="radio" name="q2" value="d">
    Aluminum
    <br><br><br>


    <p>3. What do the 3Rs stand for?</p>

    <input type="radio" name="q3" value="a" required>
    Rebuild Reuse Renew
    <br><br>

    <input type="radio" name="q3" value="b">
    Reduce Recycle Reuse
    <br><br>

    <input type="radio" name="q3" value="c">
    Remove Replace Return
    <br><br>

    <input type="radio" name="q3" value="d">
    Recycle Remove Reduce
    <br><br><br>


    <p>4. What is E-waste?</p>

    <input type="radio" name="q4" value="a" required>
    Environmental waste
    <br><br>

    <input type="radio" name="q4" value="b">
    Electronic waste
    <br><br>

    <input type="radio" name="q4" value="c">
    Energy waste
    <br><br>

    <input type="radio" name="q4" value="d">
    Emission waste
    <br><br><br>


    <p>5. Composting is the process of?</p>

    <input type="radio" name="q5" value="a" required>
    Burning waste
    <br><br>

    <input type="radio" name="q5" value="b">
    Decomposing organic matter
    <br><br>

    <input type="radio" name="q5" value="c">
    Recycling plastic
    <br><br>

    <input type="radio" name="q5" value="d">
    Crushing glass
    <br><br><br>


    <p>6. Which color bin is used for recyclable waste?</p>

    <input type="radio" name="q6" value="a" required>
    Red
    <br><br>

    <input type="radio" name="q6" value="b">
    Green
    <br><br>

    <input type="radio" name="q6" value="c">
    Blue
    <br><br>

    <input type="radio" name="q6" value="d">
    Yellow
    <br><br><br>


    <p>7. Which gas is produced from decomposing organic waste?</p>

    <input type="radio" name="q7" value="a" required>
    Oxygen
    <br><br>

    <input type="radio" name="q7" value="b">
    Methane
    <br><br>

    <input type="radio" name="q7" value="c">
    Nitrogen
    <br><br>

    <input type="radio" name="q7" value="d">
    Carbon dioxide
    <br><br><br>


    <p>8. Best method to manage plastic waste?</p>

    <input type="radio" name="q8" value="a" required>
    Burning
    <br><br>

    <input type="radio" name="q8" value="b">
    Dumping
    <br><br>

    <input type="radio" name="q8" value="c">
    Reusing and recycling
    <br><br>

    <input type="radio" name="q8" value="d">
    Landfilling
    <br><br><br>


    <p>9. Which waste takes longest to decompose?</p>

    <input type="radio" name="q9" value="a" required>
    Paper
    <br><br>

    <input type="radio" name="q9" value="b">
    Cotton
    <br><br>

    <input type="radio" name="q9" value="c">
    Plastic
    <br><br>

    <input type="radio" name="q9" value="d">
    Banana peel
    <br><br><br>


    <p>10. Main benefit of waste segregation?</p>

    <input type="radio" name="q10" value="a" required>
    Easier burning
    <br><br>

    <input type="radio" name="q10" value="b">
    Efficient recycling
    <br><br>

    <input type="radio" name="q10" value="c">
    Cost increase
    <br><br>

    <input type="radio" name="q10" value="d">
    Bad smell control
    <br><br><br>


    <button type="submit" style="padding:15px 25px;font-size:18px;background:lime;color:black;border:none;cursor:pointer;">
        Submit Quiz
    </button>

</form>

<br><br>

<a href="index.php" style="color:lime;font-size:20px;">
    Go Home
</a>

</body>

</html>