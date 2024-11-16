<?php
require 'db.php';

// Check if the ID is passed
if (isset($_GET['id'])) {
    $task_id = $_GET['id'];

    // Delete the task from the database
    $stmt = $db->prepare("DELETE FROM tasks WHERE id = :id");
    $stmt->execute(['id' => $task_id]);

    // Redirect to the index page after deleting
    header("Location: index.php");
    exit;
} else {
    // If ID is not passed, redirect to index
    header("Location: index.php");
    exit;
}
?>

*update/replace your index.php code with this*
<?php
require 'db.php';

$tasks = $db->query("SELECT * FROM tasks ORDER BY created_at DESC")->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>To-Do List</title>
<link rel="stylesheet" href="style.css">
</head>
<body>
<h1>To-Do List</h1>
<form action="add_task.php" method="POST">
    <input type="text" name="task" placeholder="Enter new task" required>
    <button type="submit">Add Task</button>
</form>
<ul>
    <?php foreach ($tasks as $task): ?>
        <li>
            <?= htmlspecialchars($task['task']) ?>
            <a href="edit_task.php?id=<?= $task['id'] ?>">Edit</a>
            <a href="delete_task.php?id=<?= $task['id'] ?>">Delete</a>
        </li>
    <?php endforeach; ?>
</ul>
</body>
</html>