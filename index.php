<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "12345678";
$dbname = "P36";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to add a new student
function addStudent($conn, $rollNumber, $name, $city, $pinCode) {
    $sql = "INSERT INTO student (roll_number, name, city, pin_code) VALUES ('$rollNumber', '$name', '$city', '$pinCode')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Student added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Check if the form is submitted for adding a student
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    $rollNumber = $_POST["rollNumber"];
    $name = $_POST["name"];
    $city = $_POST["city"];
    $pinCode = $_POST["pinCode"];
    
    addStudent($conn, $rollNumber, $name, $city, $pinCode);
}

// Function to display all records
function displayRecords($conn) {
    $sql = "SELECT * FROM student";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "Roll Number: " . $row["roll_number"] . "<br>";
            echo "Name: " . $row["name"] . "<br>";
            echo "City: " . $row["city"] . "<br>";
            echo "Pin Code: " . $row["pin_code"] . "<br><br>";
        }
    } else {
        echo "No records found";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Student Management System</title>
</head>
<body>
    <div class="container">
        <h2>Add Student</h2>
        <?php include("add_student_form.php"); ?>

        <h2>Student Records</h2>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
            <button type="submit" name="displayRecords">Display Records</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["displayRecords"])) {
            displayRecords($conn);
        }
        ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
