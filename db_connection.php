<?php
function connectDatabase() {
    $db = new SQLite3('expenses.db');
    $query1 = "CREATE TABLE IF NOT EXISTS expenses (
        id INTEGER PRIMARY KEY AUTOINCREMENT,
        name TEXT NOT NULL,
        date TEXT NOT NULL,
        amount REAL NOT NULL,
        payment_method TEXT NOT NULL
    )";
    $db->exec($query1);
    $query2 = <<<SQL
CREATE TABLE IF NOT EXISTS user (
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    username TEXT NOT NULL UNIQUE,
    password TEXT NOT NULL
);
SQL;
    $db->exec($query2);
    return $db;
}
?>
