<?php
session_start();

if (!isset($_SESSION['results'])) {
    header('Location: index.php');
    exit();
}

$results = $_SESSION['results'];
$name = $results['name'];
$MRN = $results['MRN'] ?? '';
$age = $results['age'];
$gender = $results['gender'];
$scores = $results['scores'];
$percentages = $results['percentages'];
$diagnoses = $results['diagnoses'];

// Disorder information
$disorderInfo = [
    'depression' => [
        'name' => 'Depression',
        'description' => 'A mood disorder that causes persistent feelings of sadness and loss of interest.',
        'recommendation' => 'Consider consulting a mental health professional. Treatment may include therapy, medication, or lifestyle changes.'
    ],
    'anxiety' => [
        'name' => 'Anxiety Disorder',
        'description' => 'Characterized by excessive fear or anxiety that interferes with daily activities.',
        'recommendation' => 'Cognitive behavioral therapy and relaxation techniques can help. Severe cases may benefit from medication.'
    ],
    'psychosis' => [
        'name' => 'Psychotic Disorder',
        'description' => 'Involves distorted thinking and awareness, including hallucinations or delusions.',
        'recommendation' => 'Urgent professional evaluation is recommended. Early intervention improves outcomes.'
    ],
    'bipolar' => [
        'name' => 'Bipolar Disorder',
        'description' => 'Characterized by extreme mood swings from emotional highs (mania) to lows (depression).',
        'recommendation' => 'Consult a psychiatrist for proper diagnosis. Treatment typically involves mood stabilizers and therapy.'
    ],
    'eating disorder' => [
        'name' => 'Eating Disorder',
        'description' => 'Eating disorders are behavioral conditions characterized by severe and persistent disturbance in eating behaviors and associated distressing thoughts and emotions..',
        'recommendation' => 'A dietitian can help you learn healthy eating habits and behaviours. This will help you return to a healthy weight.'
    ],
    'depression' => [
        'name' => 'Depression',
        'description' => 'A mood disorder that causes persistent feelings of sadness and loss of interest.',
        'recommendation' => 'Consider consulting a mental health professional. Treatment may include therapy, medication, or lifestyle changes.'
    ]
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diagnosis Results</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Diagnosis Results</h1>
        
        <?php if (!empty($name)): ?>
            <p>Name: <?php echo htmlspecialchars($name); ?></p>
        <?php endif; ?>
        <p>MRN: <?php echo htmlspecialchars($MRN); ?></p>
        <p>Age: <?php echo htmlspecialchars($age); ?></p>
        <p>Gender: <?php echo htmlspecialchars(ucfirst($gender)); ?></p>
        
        <div class="results-section">
            <h2>Symptom Scores</h2>
            <div class="score-bars">
                <?php foreach ($percentages as $category => $percentage): ?>
                    <div class="score-item">
                        <label><?php echo ucfirst($category); ?>: <?php echo round($percentage); ?>%</label>
                        <div class="bar-container">
                            <div class="bar" style="width: <?php echo $percentage; ?>%; 
                                background-color: <?php echo $percentage >= 50 ? '#e74c3c' : '#3498db'; ?>"></div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php if (!empty($diagnoses)): ?>
            <div class="diagnosis-section">
                <h2>Potential Concerns</h2>
                <p>Based on your responses, you may be experiencing symptoms of:</p>
                
                <?php foreach ($diagnoses as $category => $percentage): ?>
                    <div class="diagnosis-card">
                        <h3><?php echo $disorderInfo[$category]['name']; ?></h3>
                        <p><strong>Match:</strong> <?php echo round($percentage); ?>%</p>
                        <p><strong>Description:</strong> <?php echo $disorderInfo[$category]['description']; ?></p>
                        <p><strong>Recommendation:</strong> <?php echo $disorderInfo[$category]['recommendation']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="no-diagnosis">
                <h2>No Significant Concerns Detected</h2>
                <p>Patient's responses doesn't indicate significant symptoms of the mental health conditions we screen for.</p>
                <p>However, if the patient is experiencing distress or have concerns about their mental health, consider further consultation.</p>
            </div>
        <?php endif; ?>
        
        <div class="disclaimer">
            <h3>Important Disclaimer</h3>
            <p>The results are based on the ICD-10 guideline and professional evaluation is still required.</p>
            <p>Any updates regarding symptoms the symptoms will be implemented accordingly.</p>
        </div>
        
        <a href="index.php" class="restart-btn">Back to Questionaire</a>
    </div>
</body>
</html>