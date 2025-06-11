<?php
session_start();
require_once 'questions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CalmNest</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>CalmNest - Mental Health Diagnosis Expert System</h1>
        <p>This expert system will help you diagnose a patient based on a series of questions to help identify potential mental health concerns and disorders.</p>
        <p>Answer for the most accurate results. A professional diagnosis on your part will be required.</p>
        
        <form action="diagnosis.php" method="post">
            <div class="form-group">
                <label for="name">Patient Name:</label>
                <input type="text" id="name" name="name">
            </div>

            <div class="form-group">
                <label for="MRN">MRN:</label>
                <input type="text" id="MRN" name="MRN">
            </div>
            
            <div class="form-group">
                <label for="age">Patient Age:</label>
                <input type="number" id="age" name="age" min="12" max="100" required>
            </div>

             <div class="form-group">
                <label for="medicine">Patient Prescribed Medicine History:</label>
                <input type="text" id="medicine" name="medicine">
            </div>

             <div class="form-group">
                <label for="notes">Patient History/Notes (for future references):</label>
                <input type="text" id="notes" name="notes">
            </div>
            
            <div class="form-group">
                <label>Gender:</label>
                <div class="radio-group">
                    <input type="radio" id="male" name="gender" value="male" required>
                    <label for="male">Male</label>
                    
                    <input type="radio" id="female" name="gender" value="female">
                    <label for="female">Female</label>
                    
                    <input type="radio" id="other" name="gender" value="other">
                    <label for="other">Other/Prefer not to say</label>
                </div>
            </div>
            
            <h2>Mental Disorder Questionnaire</h2>
            <p>For each question, select how often the patient have experienced it within the past 2 weeks:</p>
            
            <?php foreach ($questions as $id => $question): ?>
                <div class="question">
                    <p><?php echo $question['text']; ?></p>
                    <div class="options">
                        <input type="radio" id="<?php echo $id; ?>_0" name="<?php echo $id; ?>" value="0" required>
                        <label for="<?php echo $id; ?>_0">Never</label>
                        
                        <input type="radio" id="<?php echo $id; ?>_1" name="<?php echo $id; ?>" value="1">
                        <label for="<?php echo $id; ?>_1">Rarely</label>
                        
                        <input type="radio" id="<?php echo $id; ?>_2" name="<?php echo $id; ?>" value="2">
                        <label for="<?php echo $id; ?>_2">Sometimes</label>
                        
                        <input type="radio" id="<?php echo $id; ?>_3" name="<?php echo $id; ?>" value="3">
                        <label for="<?php echo $id; ?>_3">Often</label>
                        
                        <input type="radio" id="<?php echo $id; ?>_4" name="<?php echo $id; ?>" value="4">
                        <label for="<?php echo $id; ?>_4">Very Often</label>
                    </div>
                </div>
            <?php endforeach; ?>
            
            <button type="submit" class="submit-btn">Get Diagnosis</button>
        </form>
    </div>
</body>
</html>