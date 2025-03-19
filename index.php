<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Excel Editor</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        .form-group {
            margin-bottom: 15px;
        }
        textarea {
            width: 100%;
            height: 100px;
        }
        .button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        .button:hover {
            background-color: #45a049;
        }
        .error {
            color: red;
        }
    </style>
</head>
<body>
<h1>Добавление пользователя</h1>

<form action="process.php" method="post">
    <div class="form-group">
        <label for="users">Enter users (JSON format):</label><br>
        <textarea name="users" id="users" placeholder='[{"id": 1, "name": "John", "age": 25}, ...]'></textarea>
    </div>
    <button type="submit" class="button">Загрузить и обновить файл</button>
</form>

<?php
session_start();
if (isset($_SESSION['processed_data'])) {
    $data = $_SESSION['processed_data'];
    echo "<h2>Ввелите данные:</h2>";
    echo "<table>";
    echo "<tr><th>ID</th><th>Name</th><th>Age</th><th>Is Adult</th></tr>";
    foreach ($data as $user) {
        echo "<tr>";
        echo "<td>{$user['id']}</td>";
        echo "<td>{$user['name']}</td>";
        echo "<td>{$user['age']}</td>";
        echo "<td>" . ($user['is_adult'] ? 'Yes' : 'No') . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo '<p><a href="output/users.xlsx" class="button">Загрузка файла</a></p>';
    unset($_SESSION['processed_data']); // Очищаем сессию после отображения
}
if (isset($_SESSION['error'])) {
    echo "<p class='error'>Ошибка: {$_SESSION['error']}</p>";
    unset($_SESSION['error']);
}
?>
</body>
</html>