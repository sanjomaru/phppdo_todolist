<?php
$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'phppdo_todolist';

//DSN
$dsn = 'mysql:host='.$host.';dbname='.$dbname;

//PDO INSTANCE
$pdo = new PDO ($dsn, $user, $pass);

//SET DEFAULT FETCH TYPE
$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);

//This is something about emulation, so if you have a query with a LIMIT that uses a POSITIONAL parameter with the value of 1, it should work.
$pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);