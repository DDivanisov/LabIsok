<?php
include 'db_connection.php';
include 'auth.php';
$db = connectDatabase();

// Fetch all expenses
$query = "SELECT * FROM expenses";
$result = $db->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Expense Management</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        .actions button {
            margin-right: 5px;
        }
    </style>
</head>
<body>
<?php if (!logedIn()){
    header('Location: login.php');
}
?>

<?php if (logedIn()):?>
    <a href="logout.php"><button>Log Out</button></a>
<?php endif;  ?>
<h1>Expense Management</h1>
<a href="add_expense.php"><button>Add New Expense</button></a>
<table>
    <thead>
    <tr>
        <th>Name</th>
        <th>Date</th>
        <th>Amount</th>
        <th>Payment Method</th>
        <th>Actions</th>
    </tr>
    </thead>
    <tbody>
    <?php while ($expense = $result->fetchArray(SQLITE3_ASSOC)): ?>
        <tr>
            <td><?php echo htmlspecialchars($expense['name']); ?></td>
            <td><?php echo htmlspecialchars($expense['date']); ?></td>
            <td><?php echo htmlspecialchars($expense['amount']); ?></td>
            <td><?php echo htmlspecialchars($expense['payment_method']); ?></td>
            <td class="actions">
                <form action="delete_expense.php" method="post" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <form action="update_expense.php" method="get" style="display:inline;">
                    <input type="hidden" name="id" value="<?php echo $expense['id']; ?>">
                    <button type="submit">Update</button>
                </form>
            </td>
        </tr>
    <?php endwhile; ?>
    </tbody>
</table>
</body>
</html>
