<?php
session_start();
require_once 'questions.php';

// Collect user responses
$responses = $_POST;
$name = htmlspecialchars($responses['name'] ?? '');
$MRN = htmlspecialchars($responses['MRN'] ?? '');
$age = intval($responses['age']);
$gender = htmlspecialchars($responses['gender']);

// Initialize scores for each disorder category
$scores = [
    'depression' => 0,
    'anxiety' => 0,
    'OCD' => 0,
    'bipolar' => 0,
    'eating disorder' => 0
];

// Calculate scores for each category
foreach ($questions as $id => $question) {
    if (isset($responses[$id])) {
        $score = intval($responses[$id]);
        $category = $question['category'];
        $scores[$category] += $score;
    }
}

// Calculate maximum possible scores for each category
$maxScores = [
    'anxiety' => 5 * 4, // 5 questions, max 4 points each
    'OCD' => 5 * 4,
    'ADHD' => 4 * 4,
    'bipolar' => 4 * 4,
    'eating disorder' => 5*4,
    'depression' => 5*4
];

// Calculate percentages
$percentages = [];
foreach ($scores as $category => $score) {
    $percentages[$category] = ($score / $maxScores[$category]) * 100;
}

// Determine potential diagnoses
$potentialDiagnoses = [];
$threshold = 50; // Percentage threshold for potential diagnosis

foreach ($percentages as $category => $percentage) {
    if ($percentage >= $threshold) {
        $potentialDiagnoses[$category] = $percentage;
    }
}

// Sort by highest percentage
arsort($potentialDiagnoses);

// Store results in session
$_SESSION['results'] = [
    'name' => $name,
    'MRN' => $MRN,
    'age' => $age,
    'gender' => $gender,
    'scores' => $scores,
    'percentages' => $percentages,
    'diagnoses' => $potentialDiagnoses
];

// Redirect to results page
header('Location: results.php');
exit();
?>