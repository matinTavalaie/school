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
            <form action=""method="post">
                <fieldset>
                    <legend>class</legend>
                    <label>class name</label>
                    <input type="text" name="txt_class">
                    <input type="submit" value="insert-class">
                    </fieldset>
            </form><!--from1-->
            <table style="border: 1px">
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
                    <td>".$row[class_name]."</td>
                    ";
                }
                ?>
            </table>
        </div><!--row1_col1-->
        <div id="row1_col2">
            <form action="" method="post">
                <fieldset>
                    <legend>student</legend>
                    <label>name</label><br/>
                    <input type="text" name="stud_name"><br/>
                    <label>family</label><br/>
                    <input type="text" name="stud_family"><br/>
                    <label>average</label><br/>
                    <input type="text" name="stud_avg"><br/>
                    <input type="submit" name="submit1" value="inser-student">
                </fieldset>
            </form><!--form 1 -->
            <table border="1">
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
        </tr>
        ";
}
?>
            </table>
        </div><!--row_col2-->
    </div><!--row1-->
</div><!--wrapper-->

<?php session_start(); ob_start();
include "connection.php";
if (isset($_GET['id']) && isset($_GET['page']) ){
    $id=$_GET['id'];
    $page=$_GET['page'];
    switch ($page){
        case 1:
            $query="DELETE FROM student WHERE stud_id=".$id;
            $del=$db->prepare($query);
            $del->execute();
            header("location:index.php");
    }//switch

}//end if
?>
<?php session_start(); ob_start();
include "connection.php";
if (isset($_GET['$id'])&& isset($_GET['page'])){
    $id=$_GET['id'];
    $page=$_GET['page'];
    switch ($page){
        case 1:
            include "connection.php";
            $query="SELECT * FROM class WHERE class_id=".$id;
            $result=$db->prepare($query);
            $result->execute();
            $row=$result->fetch(PDO::FETCH_ASSOC);
            if (isset($_POST['submit'] )){
                $class_name=$_POST['txt_class'];
                $query="UPDATE class SET class_name='".$class_name."' WHERE class_id=".$id;
                $del=$db->prepare($query);
                $del->execute();
                header("location:index.php");
            }
            echo '<div id="row1_col1">
            <form action="" method="post">
            <fieldset>
                <legend>Class</legend>
                <label>class name:</label>
            </fieldset>
            </form>
            </div>';
        case 2 :
            include "connection.php";
            $query = "select *from student where stud_id = " . $id;
            $result = $db->prepare($query);
            $result->execute();
            $row = $result->fetch(PDO::FETCH_ASSOC);
            if (isset($_POST['submit2'])) {
                $name = $_POST['stud_name'];
                $family = $_POST['stud_family'];
                $ave = $_POST['stud_ave'];
                $query = "Update student Set name = `$name`, family= `$family`, ave=`$ave` where stud_id = `$id`";
                $edit = $db->prepare($query);
                $edit->execute();
                header("location:index.php");
            }
            echo '
                <div id="row1_col2">
                    <form action="" method="post">
                        <fieldset>
                            <legend>Student</legend>
                            <label>name</label><br>
                            <input type="text" name="stud_name" value="' . $row['name'] .'"><br>
                            
                            <label>family</label>
                            <input type="text" name="stud_family" value="' . $row['family'] .'"><br>
                            
                            <label>average</label>
                            <input type="text" name="stud_ave" value="' . $row['ave'] .'"><br>
                            
                            <input type="submit" name="submit2" value="edit-student">
                        </fieldset>
                    </form>
                </div>
            ';
    }//switch
} ?>

</body>
</html>
<body>
<?php
include "connection.php";
if (isset($_POST['submit1'])) {
    $classid=$_POST['txt_classid'];
    $classname = $_POST['txt_class'];
    $ins_sql="INSERT INTO class (`class_id`,`class_name`) values (`$classid`, `$classname`)";
    $ins_ql_pre = $db->prepare($ins_sql);
    $ins_ql_pre->execute();
}// end if

if (isset($_POST['submit2'])) {
    $classid=$_POST['classid'];
    $stud_name=$_POST['stud_name'];
    $stud_family= $_POST['stud_family'];
    $stud_ave=$_POST['stud_ave'];
    $ins_sql="INSERT INTO student(`stud_id`, `class_id`, `name`, `family`, `ave`) values (null, '$classid', '$stud_name', '$stud_family', '$stud_ave')";
    $ins_sql_pre = $db->prepare($ins_sql);
    $ins_sql_pre->execute();
} // end if
?>

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
            <td>name</td>
            <td>family</td>
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
                    <td>' . $row['name'] . '</td>
                    <td>' . $row['family'] . '</td>
                    <td>' . $row['ave'] . '</td>
                </tr>
                ';
            }
        }
        ?>
    </table>
</div>
</body>