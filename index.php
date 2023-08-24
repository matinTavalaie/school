<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>school database sample</title>
    <link href="css/style.css" rel="stylesheet"/>
</head>

<body>
<div id="wrapper">
    <div id="row1">
        <div id="row1_col1">
            <form action="insert.php" method="post">
                <fieldset>
                    <legend>class</legend>
                    <label>class name</label>
                    <input type="text" name="class_name">
                    <input type="submit" value="insert-class">
                    </fieldset>
            </form>

            <!--   -------------------------------     -->

            <table class="list" style="border: 1px">
                <tr>
                    <td>class id</td>
                    <td>class name</td>
                </tr>

                <?php
                include "connection.php";
                $query="SELECT * FROM class";
                $result=$db->prepare($query);
                $result->execute();
                while ($row=$result->fetch(PDO::FETCH_ASSOC)){
                    echo "
                    <tr>
                    <td>".$row['class_id']."</td>
                    <td>".$row['class_name']."</td>
                    <td><a href='delete.php?id=".$row['class_id']."&action=class'>delete</a></td>
                    <td><a href='update.php?id=".$row['class_id']."&action=class'>update</a></td>
                    ";
                }
                ?>
            </table>
        </div>

        <!--   -------------------------------     -->
        <div id="row1_col2">
            <form action="insert.php" method="post">
                <fieldset>
                    <legend>student</legend>

                    <label>name</label><br/>
                    <input type="text" name="stud_name"><br/>

                    <label>family</label><br/>
                    <input type="text" name="stud_family"><br/>

                    <label>class id</label><br/>
                    <input type="text" name="class_id"><br/>

                    <label>average</label><br/>
                    <input type="text" name="stud_avg"><br/>

                    <input type="submit" name="submit_student" value="insert-student">
                </fieldset>
            </form>

            <!--   -------------------------------     -->

            <table border="1" class="list">
                <tr>
                    <td>name</td>
                    <td>family</td>
                    <td>average</td>
                </tr>

                <?php
include "connection.php";
$query="SELECT * FROM student";
$result=$db->prepare($query);
$result->execute();
while ($row=$result->fetch(PDO::FETCH_ASSOC)){

    echo "
    <tr>
    <td>".$row['name']."</td>
    <td>".$row['family']."</td>
    <td>".$row['ave']."</td>
    <td><a href='delete.php?id=".$row['student_id']."&action=student'>delete</a></td>
    <td><a href='update.php?id=".$row['student_id']."&action=student'>update</a></td>
    </tr>
        ";
}
?>
            </table>
        </div>
    </div>
</div>

<!--   -------------------------------     -->

<div id="show_list">
    <form action="" method="post">
        <label for="">class name</label>
        <select name="select1" id="select1">
            <?php
            include "connection.php";
            $sql_options = "select * from class";
            $sql_options_pre = $db->prepare($sql_options);
            $sql_options_pre->execute();
            while($rows=$sql_options_pre->fetch(PDO::FETCH_ASSOC)) {
                echo "<option value='" . $rows['class_id'] ."'>" . $rows['class_name'] . "</option>";
            }
            ?>
            <input  type="submit" name="sub" value="select">
        </select>
    </form>

    <table>
        <tr>
            <td>student id</td>
            <td>name</td>
            <td>family</td>
            <td>class id</td>
            <td>ave</td>
        </tr>
        <?php
        include "connection.php";
        if (isset($_POST['sub'])) {
            echo "<script>alert('ok')</script>";
            $id = $_POST['select1'];
            $sql_show = "select * from student where class_id =" .$id;
            $sql_show_pre = $db->prepare($sql_show);
            $sql_show_pre->execute();
            while ($row = $sql_show_pre->fetch(PDO::FETCH_ASSOC)) {
                echo '
                <tr>
                    <td>' . $row['student_id'] . '</td>
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['family'] . '</td>
                    <td>' . $row['class_id'] . '</td>
                    <td>' . $row['ave'] . '</td>
                </tr>
                ';
            }
        }
        ?>
    </table>
</div>
</body>
</html>
