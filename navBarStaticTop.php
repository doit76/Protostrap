<div class="navbar navbar-static-top">
    <div class="navbar-inner">
        <div class="container">
            <!-- .btn-navbar is used as the toggle for collapsed navbar content -->
            <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </a>

            <!-- Be sure to leave the brand out there if you want it shown -->
            <a class="brand" href="index.php">Protostrap</a>


            <!-- Everything you want hidden at 940px or less, place within here -->
            <div class="nav-collapse">
                <!-- .nav, .navbar-search, .navbar-form, etc -->
                <ul class="nav">
                    <li class="<?php echo $navbarClasses[0];?>"><a href="index.php">Home</a></li>
                    <li class="<?php echo $navbarClasses[1];?>"><a href="two.php">Two</a></li>
                    <li class="<?php echo $navbarClasses[2];?>"><a href="three.php">Three</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>