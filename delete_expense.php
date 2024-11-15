<?php
include 'auth.php';
if (!logedIn()){
    header('Location: login.php');
}
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php';
    $db = connectDatabase();

    $id = $_POST['id'];

    // Check the amount
    $query = "SELECT amount FROM expenses WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $result = $stmt->execute()->fetchArray(SQLITE3_ASSOC);

    if ($result && $result['amount'] > 100) {
        echo "Cannot delete expenses greater than 100.";
    } else {
        $query = "DELETE FROM expenses WHERE id = :id";
        $stmt = $db->prepare($query);
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        header('Location: index.php');
        exit();
    }
}

?>

