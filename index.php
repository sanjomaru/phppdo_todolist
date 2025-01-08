<?php
include('connection.php');
$is_search = false;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP PDO - TODO LIST</title>
</head>
<body>

<form action="" method="post">
    <input type="text" name="todo_name" id="" placeholder='Type todos'>
    <input type="text" name="todo_hrs" id="" placeholder='Number Of Hrs'>
    <input type="submit" value="SUBMIT" name='submit'>
</form>

<?php
$todo_name = !empty($_POST['todo_name']) ? $_POST['todo_name'] : '';
$todo_hrs = !empty($_POST['todo_hrs']) ? $_POST['todo_hrs'] : '';

if(isset($_POST['submit'])){
    $sql = 'INSERT INTO todos(todo_name, todo_hrs) VALUES (?, ?)';
    $stmnt = $pdo->prepare($sql);
    $stmnt->execute([$todo_name, $todo_hrs]);
    
    echo 'POST INSERTED';   
}

$sql = 'SELECT * FROM todos';
$stmnt = $pdo->prepare($sql);
$stmnt->execute();
$todos = $stmnt->fetchAll();

?>
<h1>MY TODO LIST</h1>

<form action="" method="POST">
    <input type="text" name="todo_name_search" id="" placeholder="Todo Name Search">
    <input type="submit" value="SEARCH" name='search_submit'>
</form>
<a href="index.php">RESET</a>
<br><br>
<?php

if(isset($_POST['search_submit'])) : 
    $todo_name_search = '%'.$_POST['todo_name_search'].'%';
    
    $sqlsearch = 'SELECT * FROM todos WHERE todo_name LIKE ?';
    $stmntsearch = $pdo->prepare($sqlsearch);
    $stmntsearch->execute([$todo_name_search]);
    $rowCount = $stmntsearch->rowCount();
    $searchs = $stmntsearch->fetchAll();
    $is_search = true;

    if($rowCount >= 1) : 
    ?>
        <table style="border-collapse: collapse; width: 100%; border: 1px solid #000;">
            <thead>
                <tr>
                    <th style="border: 1px solid #000; padding: 8px;">TODO NAME</th>
                    <th style="border: 1px solid #000; padding: 8px;">TODO NUMBER OF HOURS</th>
                    <th style="border: 1px solid #000; padding: 8px;">ACTIONS</th>
                </tr>
            </thead>
            <tbody>
        <?php foreach ($searchs as $todo) : ?>
                <tr>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $todo->todo_name; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;"><?php echo $todo->todo_hrs; ?></td>
                    <td style="border: 1px solid #000; padding: 8px;">
                        <a href="update.php?todo_id=<?php echo $todo->todo_id; ?>">UPDATE</a>
                        <a href="delete.php?todo_id=<?php echo $todo->todo_id; ?>">DELETE</a>
                    </td>
                </tr>   
        <?php endforeach; ?>
<?php  else : ?>
    <h2>NO TODO FOUND</h2>
<?php endif; endif; ?>

<?php if(!$is_search) : ?>
    <table style="border-collapse: collapse; width: 100%; border: 1px solid #000;">
        <thead>
            <tr>
                <th style="border: 1px solid #000; padding: 8px;">TODO NAME</th>
                <th style="border: 1px solid #000; padding: 8px;">TODO NUMBER OF HOURS</th>
                <th style="border: 1px solid #000; padding: 8px;">ACTIONS</th>
            </tr>
        </thead>
        <tbody>
    <?php foreach ($todos as $todo) : ?>
            <tr>
                <td style="border: 1px solid #000; padding: 8px;"><?php echo $todo->todo_name; ?></td>
                <td style="border: 1px solid #000; padding: 8px;"><?php echo $todo->todo_hrs; ?></td>
                <td style="border: 1px solid #000; padding: 8px;">
                    <a href="update.php?todo_id=<?php echo $todo->todo_id; ?>">UPDATE</a>
                    <a href="delete.php?todo_id=<?php echo $todo->todo_id; ?>">DELETE</a>
                </td>
            </tr>   
    <?php endforeach; ?>
<?php endif; ?>
</tbody>
</table>
    
</body>
</html>