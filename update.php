<?php
include('connection.php');
$todo_id = $_GET['todo_id'];

$sql = 'SELECT * FROM todos WHERE todo_id = ?';
$stmnt = $pdo->prepare($sql);
$stmnt->execute([$todo_id]);
$todos = $stmnt->fetchAll();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UPDATED TODO</title>
</head>
<body>
<h1>UPDATE MY TODO LIST</h1>
    <form action="" method='POST'>
        <?php foreach($todos as $todo) : ?>
            <input type="text" name="todo_name" id="" value="<?php echo $todo->todo_name; ?>">
            <input type="text" name="todo_hrs" id="" value="<?php echo $todo->todo_hrs; ?>">
        <?php endforeach; ?>
        <input type="submit" value="UPDATE" name='update'>
    </form>
    <a href="index.php">Back</a>
        <br><br>
<?php
if(isset($_POST['update'])){
    $todo_name = $_POST['todo_name'];
    $todo_hrs = $_POST['todo_hrs'];

    $sql = 'UPDATE todos SET todo_name = ?, todo_hrs = ? WHERE todo_id = ?';
    $stmnt = $pdo->prepare($sql);
    $stmnt->execute([$todo_name, $todo_hrs, $todo_id]);

    echo 'TODO UPDATED, You will be redirected in about 3 seconds';
    header( "refresh:3;url=index.php" );
}
?>
</body>
</html>


