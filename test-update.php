<?php 
      $config_set = "local";
      if ($config_set == "local"){
          $config_server = "localhost";
          $config_database = "mydatabase";
          $config_username = "root";
          $config_password = "";
          $config_port = "" ;
      }
    
      $conn = new mysqli( $config_server, $config_username, $config_password, $config_database);
      mysqli_set_charset( $conn, 'utf8');
      mysqli_query($conn , "SET NAMES 'utf8';");
      mysqli_query($conn , "SET CHARACTER SET 'utf8';");
      mysqli_query($conn , "SET COLLATION_CONNECTION = 'utf8_general_ci';");

      $SQL_Profile = "SELECT * FROM test_update WHERE status = 1 AND pj_id = 2";
      $sql_task_show_result = $conn->query($SQL_Profile);
      $sql_task_show_count = $sql_task_show_result->num_rows;
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css -->
    <link rel="stylesheet" href="node_modules/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/air-datepicker/dist/css/datepicker.min.css">
    <link rel="stylesheet" href="node_modules/chosen-js/chosen.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <title>In Process</title>
</head>
<body>
    
</body>
  
        <?php 
            while($task_show_result_query = mysqli_fetch_array($sql_task_show_result,MYSQLI_ASSOC)){
                $id     = $task_show_result_query["id"];
                $name   = $task_show_result_query["name"];
                $lname  = $task_show_result_query["lname"];
        ?>
        <input type="hidden" value="<?php echo $id; ?>" name="id[]" id="id" >
        <div class="d-flex p-1">
        <div class="p-1">
                <input type="text" value="<?php echo $name;?>" id="name" name="name[]">
        </div> 
        <div class="p-1">
                <input type="text" value="<?php echo $lname;?>" id="lname" name="lname[]"> 
        </div>
        </div>
        <?php }?>
        <input type="text" id="addname" name="addname[]" >     <input type="text" id="addlname" name="addlname[]" > <br>
        <input type="text" id="addname" name="addname[]">     <input type="text" id="addlname" name="addlname[]" > 
        <button id="save">update</button>

  

    <script src="node_modules/jquery/dist/jquery.min.js"></script>
    <script src="node_modules/popper.js/dist/umd/popper.min.js"></script>
    <script src="node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="node_modules/chosen-js/chosen.jquery.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/datepicker.min.js"></script>
    <script src="node_modules/air-datepicker/dist/js/i18n/datepicker.en.js"></script>
    <script src="assets/js/main.js"></script>
    <script src="assets/js/Dropdown.js"></script>
    <script src="assets/js/modal.js"></script>
    <script src="assets/js/select.js"></script>
    <script src="assets/js/displaycontent.js"></script>
    <script src="assets/js/additem.js"></script>    
    <script type="text/javascript">
        $('.datepicker-set').datepicker({
            language: 'en',
            minDate: new Date() 
        })
    </script>  
    <script>
        $(document).ready(function(){
            $("#save").click(function(){
                var addname = [];
                var addlname = [];
                var id  = [];
                var name  = [];
                var lname = [];
                $(":input[name='addname[]']").each(function() {
                    addname.push($( this ).val());
                });
                $(":input[name='addlname[]']").each(function() {
                    addlname.push($( this ).val());
                });
                $(":input[name='id[]']").each(function() {
                    id.push($( this ).val());
                }); 
                $(":input[name='name[]']").each(function() {
                    name.push($( this ).val());
                }); 
                $(":input[name='lname[]']").each(function() {
                    lname.push($( this ).val());
                }); 
                console.log(addname);
                $.ajax({
                    url:"aaa.php",
                    method:"POST",
                    data:{
                        id:id,
                        addname:addname,
                        addlname:addlname,
                        name:name,
                        lname:lname
                    },
                    success:function(data){
                        alert (data) ;
                    }
                });
            });
        });
    </script>
</html>


