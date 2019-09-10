  <nav class="navbar navbar-expand navbar-light bg-light border-bottom">
        <a class="navbar-brand" href="process.php">
            <i class="fas fa-home"></i>
        </a>
        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="process.php">PROCESSES</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="Template.php">TEMPLATES</a>
            </li>
            <?php 
                if($ss_acc_permission == 0 ){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="list-user.php">USERS</a>
            </li>
            <?php } ?>
        </ul>
        <?php include 'modal-login.php';?>
        <div class="p-2">
            <img class="rounded-circle" src="assets/img/<?php echo $acc_img; ?>" width="30" height="30" alt="Avatar">
            <span id="dropdown-username" style="margin-left: 8px"><?php echo $acc_name.' '.$acc_lastname ?></span>
        </div>
        <div class="p-2">
            <span>Home</span>
        </div>         
        <div class="dropdown">
            <a class="p-2 dropdown-toggle" href="#" id="navbarDropdowns" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bell f-25 noti-icon"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdowns">
                <a class="dropdown-item" href="Profile.php">Profile Setting</a>
                <a class="dropdown-item" href="WebSetting.php">Web Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Sign Out</a>
            </div>
        </div>   
     
   
      
        <div class="nav-item dropdown">
            <a class="dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-sort-down mb-3"></i>
            </a>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                <a class="dropdown-item" href="Profile.php">Profile Setting</a>
                <a class="dropdown-item" href="WebSetting.php">Web Setting</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="logout.php">Sign Out</a>
            </div>
        </div>
    </nav>