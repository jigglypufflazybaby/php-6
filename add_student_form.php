

<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
    <label for="rollNumber">Roll Number:</label>
    <input type="text" name="rollNumber" required>
    <label for="name">Name:</label>
    <input type="text" name="name" required>
    <label for="city">City:</label>
    <input type="text" name="city" required>
    <label for="pinCode">Pin Code:</label>
    <input type="text" name="pinCode" required>
    <button type="submit" name="submit">Add Student</button>
</form>
