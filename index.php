<?php include 'header.php'; ?>

<form action="index.php" method="POST">
    <input type="text" name="message" maxlength="50" required>
    <input type="submit" name="submit" value="Submit">
</form>

<a href="showAll.php">Show all records</a>

<?php
if (isset($_POST['submit'])) {
    $conn = new mysqli("localhost", "root", "", "final");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $message = $_POST['message'];
    $sql = "INSERT INTO string_info (message) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $message);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
}
?>