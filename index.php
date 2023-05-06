<?php

$name = isset($_POST['name']) ? $_POST['name'] : null;
$family = isset($_POST['family']) ? $_POST['family'] : null;
$id = isset($_POST['id']) ? $_POST['id'] : null;

$dns = 'mysql:host=localhost;dbname=school';
$username = 'root';
$pass = 'root';
$db = new PDO($dns, $username, $pass);

if ($id && $family && $name) {

    $query = "INSERT INTO student(id,name,family) values ($id,'$name','$family')";
    $result = $db->prepare($query);
    $result->execute();
}

?>
<form method="post" action="">
    <label for="name">name</label>
    <input name="name">

    <label for="family">family</label>
    <input name="family">

    <label for="id">id</label>
    <input name="id">

    <button type="submit">send</button>
</form>

<hr>
<br>
<hr>

    <table style="border: 1px solid #000">
        <tr>
            <th>id</th>
            <th>name</th>
            <th>family</th>
        </tr>
        <?php
        $query = "SELECT * FROM student";
        $result = $db->prepare($query);
        $result->execute();
        while($a=$result->fetch(PDO::FETCH_ASSOC)){
            echo " 
        <tr>
        <td>" . $a['id'] . "</td>
        <td>" . $a['name'] . "</td>
        <td>" . $a['family'] . "</td>
        ";
        }
        ?>
    </table>