<?php
include 'db_connection.php';
include 'auth.php';
$db = connectDatabase();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = $_GET['id'];
    $query = "SELECT * FROM expenses WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':id', $id);
    $expense = $stmt->execute()->fetchArray(SQLITE3_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $date = $_POST['date'];
    $amount = $_POST['amount'];
    $payment_method = $_POST['payment_method'];

    $query = "UPDATE expenses SET name = :name, date = :date, amount = :amount, payment_method = :payment_method WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':date', $date);
    $stmt->bindValue(':amount', $amount);
    $stmt->bindValue(':payment_method', $payment_method);
    $stmt->bindValue(':id', $id);
    $stmt->execute();

    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Expense</title>
</head>
<body>
<?php if (!logedIn()){
    header('Location: login.php');
}
?>
<h1>Update Expense</h1>
<form action="update_expense.php" method="post">
    <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
    <label>Name: <input type="text" name="name" value="<?php echo $expense['name']; ?>" required></label><br>
    <label>Date: <input type="date" name="date" value="<?php echo $expense['date']; ?>" required></label><br>
    <label>Amount: <input type="number" name="amount" step="0.01" value="<?php echo $expense['amount']; ?>" required></label><br>
    <label>Payment Method:</label>
    <input type="radio" name="payment_method" value="Cash" <?php if ($expense['payment_method'] == 'Cash') echo 'checked'; ?>> Cash
    <input type="radio" name="payment_method" value="Card" <?php if ($expense['payment_method'] == 'Card') echo 'checked'; ?>> Card<br>
    <button type="submit">Update Expense</button>
</form>
</body>
</html>
