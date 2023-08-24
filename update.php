<?php session_start(); ob_start();
include 'connection.php';

$classId = $studentId = null;
$action = isset($_GET['action']) ? $_GET['action'] : null;
if (isset($_GET['id']) && $action == 'class') {
    $classId = $_GET['id'];
} elseif (isset($_GET['id']) && $action == 'student') {
    $studentId = $_GET['id'];
}

if (isset($_POST['submit_class'])) {
    $className = $_POST['class_name'];
    $classId = $_POST['class_id'];

    $query = "UPDATE class set `class_name` = '$className' WHERE `class_id` = $classId";
    $insert = $db->prepare($query);
    $insert->execute();

    header("location:index.php");
}

if (isset($_POST['submit_student'])) {
    $studentId = $_POST['student_id'];
    $name = $_POST['stud_name'];
    $family = $_POST['stud_family'];
    $ave = $_POST['stud_avg'];

    $query = "UPDATE student set `name` = '$name', `family` = '$family', `ave` = '$ave' WHERE `student_id` = $studentId";
    $insert = $db->prepare($query);
    $insert->execute();

    header("location:index.php");
}
?>

<div id="wrapper">
    <?php if ($action == 'class') : ?>
    <form action="" method="post">
        <fieldset>
            <legend>update class <?= $classId ?></legend>
            <input type="hidden" value="<?= $classId ?>" name="class_id">

            <label>class name</label>
            <input type="text" name="class_name">
            <input type="submit" value="update class" name="submit_class">
        </fieldset>
    </form>
    <?php endif; ?>
    <?php if ($action == 'student') : ?>
        <form action="" method="post">
            <fieldset>
                <legend>update student <?= $studentId ?></legend>

                <input type="hidden" value="<?= $studentId ?>" name="student_id">

                <label>name</label><br/>
                <input type="text" name="stud_name"><br/>

                <label>family</label><br/>
                <input type="text" name="stud_family"><br/>

                <label>average</label><br/>
                <input type="text" name="stud_avg"><br/>

                <input type="submit" name="submit_student" value="update student">
            </fieldset>
        </form>
    <?php endif; ?>
</div>
