<?php include('connection.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DELETE TODO</title>
</head>
<body>

<?php
$todo_id = $_GET['todo_id'];
$sql = 'DELETE FROM todos WHERE todo_id = ?';
$stmnt = $pdo->prepare($sql);
$stmnt->execute([$todo_id]);

echo 'TODO DELETED';

?>
<br>
<a href="index.php">Back</a>
</body>
</html>