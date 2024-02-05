<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information System</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 20px;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        .output {
            margin-top: 20px;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: auto;
        }
    </style>
</head>
<body>

    <?php
    function inputStudentInfo() {
        $student = [];

        $student['first_name'] = htmlspecialchars($_POST['first_name'] ?? '');
        $student['middle_name'] = htmlspecialchars($_POST['middle_name'] ?? '');
        $student['last_name'] = htmlspecialchars($_POST['last_name'] ?? '');
        $student['age'] = intval($_POST['age'] ?? 0);
        $student['course_year'] = htmlspecialchars($_POST['course_year'] ?? '');
        $student['enrolled'] = htmlspecialchars($_POST['enrolled'] ?? '');

        if (strtolower($student['enrolled']) == 'yes') {
            $student['subject'] = htmlspecialchars($_POST['subject'] ?? '');
            $student['grade'] = floatval($_POST['grade'] ?? 0.0);
        }

        return $student;
    }

    function displayStudentInfo($student) {
        echo "<div class='output'>";
        echo "<h2>Student Information</h2>";
        echo "<p><strong>Name:</strong> {$student['first_name']} {$student['middle_name']} {$student['last_name']}</p>";
        echo "<p><strong>Age:</strong> {$student['age']}</p>";
        echo "<p><strong>Course and Year:</strong> {$student['course_year']}</p>";
        echo "<p><strong>Enrolled:</strong> {$student['enrolled']}</p>";

        if (strtolower($student['enrolled']) == 'yes') {
            echo "<p><strong>Subject:</strong> {$student['subject']}</p>";
            echo "<p><strong>Grade:</strong> {$student['grade']}</p>";
        }

        echo "</div>";
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $student = inputStudentInfo();
        displayStudentInfo($student);
    }

    ?>

    <form method="post">
        <h2>Enter Student Information</h2>
        <label for="first_name">First Name:</label>
        <input type="text" id="first_name" name="first_name" required>

        <label for="middle_name">Middle Name:</label>
        <input type="text" id="middle_name" name="middle_name" required>

        <label for="last_name">Last Name:</label>
        <input type="text" id="last_name" name="last_name" required>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required>

        <label for="course_year">Course and Year:</label>
        <input type="text" id="course_year" name="course_year" required>

        <label for="enrolled">Enrolled? (Yes/No):</label>
        <select id="enrolled" name="enrolled" required>
            <option value="Yes">Yes</option>
            <option value="No">No</option>
        </select>

        <div id="enrolled-details" style="display: none;">
            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject">

            <label for="grade">Grade (e.g., 92.1):</label>
            <input type="text" id="grade" name="grade">
        </div>

        <button type="submit">Submit</button>
    </form>

    <script>
        document.getElementById('enrolled').addEventListener('change', function () {
            var enrolledDetails = document.getElementById('enrolled-details');
            enrolledDetails.style.display = this.value.toLowerCase() === 'yes' ? 'block' : 'none';
        });
    </script>

</body>
</html>