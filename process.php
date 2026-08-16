<?php
session_start();

if(!isset($_SESSION['students']))
{
    $_SESSION['students']=array();
}

if(isset($_POST['reset']))
{
    session_destroy();
    header("Location:index.html");
    exit();
}

if(isset($_POST['marks']))
{
    if(count($_SESSION['students'])<20)
    {
        $marks=$_POST['marks'];

        if($marks>=80)
            $status="Eligible";
        else
            $status="Not Eligible";

        $_SESSION['students'][]=array(
            "marks"=>$marks,
            "status"=>$status
        );
    }
}
?>

<!DOCTYPE html>
<html>
<head>

<title>Scholarship Result</title>

<link rel="stylesheet" href="style.css">

</head>

<body>

<div class="container">

<?php

$count=count($_SESSION['students']);

if($count<20)
{
    echo "<h2>Student $count of 20 Added</h2>";

    echo "<form action='process.php' method='POST'>";

    echo "<label>Enter Student Marks</label>";

    echo "<input type='number' name='marks' min='0' max='100' required>";

    echo "<button type='submit'>Submit Next</button>";

    echo "</form>";
}
else
{

echo "<h2>Scholarship Eligible Students</h2>";

echo "<table>";

echo "<tr><th>Serial</th><th>Marks</th></tr>";

$sr=1;

foreach($_SESSION['students'] as $student)
{
    if($student['status']=="Eligible")
    {
        echo "<tr>";
        echo "<td>".$sr++."</td>";
        echo "<td>".$student['marks']."</td>";
        echo "</tr>";
    }
}

echo "</table>";

echo "<h2>Not Eligible Students</h2>";

echo "<table>";

echo "<tr><th>Serial</th><th>Marks</th></tr>";

$sr=1;

foreach($_SESSION['students'] as $student)
{
    if($student['status']=="Not Eligible")
    {
        echo "<tr>";
        echo "<td>".$sr++."</td>";
        echo "<td>".$student['marks']."</td>";
        echo "</tr>";
    }
}

echo "</table>";

?>

<form method="POST">
    <button class="reset" name="reset">Reset All</button>
</form>

<?php

}

?>

</div>

</body>
</html>