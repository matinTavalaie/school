<?php session_start(); ob_start();
include 'connection.php';

if (isset($_POST['class_name'])) {
    $className = $_POST['class_name'];

    $query = "INSERT INTO class (class_name) VALUES ('$className')";
    $insert = $db->prepare($query);
    $insert->execute();
}

if (isset($_POST['submit_student'])) {
    $name = $_POST['stud_name'];
    $family = $_POST['stud_family'];
    $class = $_POST['class_id'];
    $avg = $_POST['stud_avg'];

    $query = "INSERT INTO student (`class_id`, `name`, `family`, `ave`) VALUES ('$class', '$name', '$family', '$avg')";
    $insert = $db->prepare($query);
    $insert->execute();
}


header("location:index.php");
