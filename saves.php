 <?php
$titletaskArr = json_decode($_POST["titletask"]);
$DescriptiontaskArr = json_decode($_POST["Descriptiontask"]);
$con=mysqli_connect("localhost","root","","vlog_management");
/* Check connection */
if (mysqli_connect_errno())
{
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
for ($i = 0; $i < count($titletaskArr); $i++) {

 /* not allowing empty values and the row which has been removed. */
    $sql="INSERT INTO task (task_title, task_description)
VALUES
('$titletaskArr[$i]','$DescriptiontaskArr[$i]')";
    if (!mysqli_query($con,$sql))
    {
        die('Error: ' . mysqli_error($con));
    }
  
}
Print  "Data added Successfully !";
mysqli_close($con);
?>