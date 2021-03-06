<?php

session_start();
$mysqli = new mysqli('localhost', 'root', '', 'crud_1') or die(mysqli_error($mysqli));

$update = false;
$name = '';
$location = '';
$id = 0;
// Saving data
if (isset($_POST['save'])) {
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT INTO data (name,location) VALUES ('$name', '$location')") or die($mysqli->error);

    $_SESSION['message'] = "Record has been saved!";
    $_SESSION['msg_type'] = "success";

    header("location:index.php");
}

// Delete Data
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id=$id") or die($mysqli->error);

    $_SESSION['message'] = "Record has been deleted!";
    $_SESSION['msg_type'] = "danger";

    header("location:index.php");
}

// Edit Data

if (isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error);
    if (count(is_countable($result) ? $result : [1])) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location = $row['location'];
    }
}

// Update Data
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE data SET name = '$name', location = '$location' WHERE id= $id ") or die($mysqli->error);

    $_SESSION['message'] = "Resord has been updated!";
    $_SESSION['msg_type'] = "warning";

    header('location : index.php');
}
