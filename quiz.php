<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $correctAnswers = [
        'q1' => 'a', // 9%
        'q2' => 'c', // Paper
        'q3' => 'b', // Reduce, Recycle, Reuse
        'q4' => 'b', // Electronic waste (corrected from 'Parties')
        'q5' => 'b', // Decomposing organic matter
        'q6' => 'c', // Blue
        'q7' => 'b', // Methane
        'q8' => 'c', // Reusing and recycling
        'q9' => 'c', // Plastic
        'q10' => 'b' // Efficient recycling
    ];

    $score = 0;
    for ($i = 1; $i <= 10; $i++) {
        $question = "q$i";
        if (isset($_POST[$question]) && $_POST[$question] === $correctAnswers[$question]) {
            $score++;
        }
    }

    echo "<script>alert('Your Score: $score/10\\nGreat effort! Want to learn more?'); window.location.href = 'quiz.html';</script>";
    exit();
}
