<?php session_start(); ob_start();
include 'connection.php';

if (isset($_GET['id']) && isset($_GET['action'])) {
    $id = $_GET['id'];
    $action = $_GET['action'];

    switch ($action) {
        case 'student' :
            $query = 'delete from student where student_id =' . $id;
            $del = $db->prepare($query);
            $del->execute();
            break;
        case 'class' :
            $query = 'delete from class where class_id =' . $id;
            $del = $db->prepare($query);
            $del->execute();
            break;
    }

    header("location:index.php");
}
