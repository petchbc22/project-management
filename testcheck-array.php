<?PHP
include 'appsystem/inc_config.php';

$sql = "SELECT * FROM project_assign_user";
$result = $conn->query($sql);
$count = $result->num_rows;
    while ($query = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $pjt_id = $query["pjt_id"];
        $acc_id = $query["acc_id"];
        echo $pjt_id.'  '.$acc_id.'<br>';

        if (in_array("13", $query))
        {
            echo "Match found";
        }
        else
        {
            echo "Match not found";
        } 
    }
?>