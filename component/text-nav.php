        <ul class="navbar-nav mr-auto">
            <li class="nav-item">
                <a class="nav-link" href="process.php">PROCESSES</a>
            </li>
            <?php if($ss_acc_permission == 0 || $ss_acc_permission == 1){?>
            <li class="nav-item">
                <a class="nav-link" href="create-project.php">CREATE PROJECT</a>
            </li>
            <?php }?>
            <?php
                if($ss_acc_permission == 0 ){
            ?>
            <li class="nav-item">
                <a class="nav-link" href="list-user.php">USERS</a>
            </li>
            <?php } ?>
            <li class="nav-item">
                <a class="nav-link" href="master/gantt.php">CALENDAR</a>
            </li>
        </ul>
