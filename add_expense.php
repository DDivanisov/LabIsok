<?php
include 'auth.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    include 'db_connection.php';
    $db = connectDatabase();

    $name = $_POST['name'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    $query = "INSERT INTO expenses (name, date, amount, payment_method) VALUES (:name, :date, :amount, :payment_method)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':amount', $amount);
    $stmt->bindValue(':payment_method', $payment_method);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Expense</title>
</head>
<body>
<?php if (!logedIn()){
    header('Location: login.php');
}
?>
<h1>Add New Expense</h1>
<form action="add_expense.php" method="post">
    <label>Name: <input type="text" name="name" required></label><br>
    <label>Date: <input type="date" name="date" required></label><br>
    <label>Amount: <input type="number" name="amount" step="0.01" required></label><br>
    <label>Payment Method:</label>
    <input type="radio" name="payment_method" value="Cash" required> Cash
    <input type="radio" name="payment_method" value="Card" required> Card<br>
    <button type="submit">Add Expense</button>
</form>
</body>
</html>
