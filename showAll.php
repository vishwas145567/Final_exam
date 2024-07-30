<?php include 'header.php'; ?>

<?php
$conn = new mysqli("localhost", "root", "", "final");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT string_id, message FROM string_info";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo "ID: " . htmlspecialchars($row["string_id"]). " - Message: " . htmlspecialchars($row["message"]). "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();
?>

<form action="showAll.php" method="POST">
    <input type="number" name="delete_id" required>
    <input type="submit" name="delete" value="Delete">
</form>

<?php
if (isset($_POST['delete'])) {
    $conn = new mysqli("localhost", "root", "", "final");
    
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $delete_id = intval($_POST['delete_id']);
    $sql = "DELETE FROM string_info WHERE string_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $delete_id);
    $stmt->execute();
    
    $stmt->close();
    $conn->close();
    
    header("Location: showAll.php");
    exit();
}
?>