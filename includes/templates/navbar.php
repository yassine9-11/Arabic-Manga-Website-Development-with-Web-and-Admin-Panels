<!-- nav -->
<nav class="navbar navbar-expand-lg navbar-dark bg-body-tertiary ">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">AmuraManga</a>

            <button class="navbar-toggler searchbar_icon" type="button" data-bs-toggle="collapse" data-bs-target="#search" aria-controls="search" aria-expanded="false" aria-label="Toggle navigation">
                <i class="fa fa-search"></i></button>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar" aria-controls="navbar" aria-expanded="false" aria-label="Toggle navigation">

        <span class="navbar-toggler-icon"></span>
      </button>
            <div class="collapse " style="margin-top: 10px;" id="search">
                <form class=" searchtogle" role="search">
                    <input class="form-control me-2" type="search" placeholder="... ابحث عن المانجا" aria-label="Search">
                    <button class="btn btn-search" type="submit">بحث</button>
                </form>
            </div>
            <div class="collapse navbar-collapse" id="navbar">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">القائمة</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="manga.php">المانجا</a>
                    </li>
                    <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                      الصفحات
                    </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="increated.html">صفحة 1 </a></li>
                            <li><a class="dropdown-item" href="increated.html">صفحة é</a></li>
                            <li>
                                <hr class="dropdown-divider">
                            </li>
                            <li><a class="dropdown-item" href="increated.html">صفحة 3</a></li>
                        </ul>
                    </li>
                </ul>
                <?php  if(!isset($nosearch)){  ?>
                <form class="searchbar " action="manga.php" method="GET" role="search">
                    <input class="form-control me-2" 
                           type="search" 
                           placeholder="... ابحث عن المانجا" 
                           aria-label="Search"
                           name="q"
                           >
                    <button class="btn btn-search" type="submit">بحث</button>
                </form>
                <?php } ?>
                <!--
                <ul class="navbar-nav profil-opt">
                    <?php if (isset($_SESSION['userID'])){
                        // get user info :
                        $sql="SELECT * FROM `user` WHERE userID = ? ";
                        $search=$con->prepare($sql);
                        $search->execute(array($_SESSION['userID']));
                        $row=$search->fetch();
                    ?>
                    <li class="nav-item">
                    <li class="nav-item">
                        <a style="margin-left:6px;"class="prof btn btn-outline-danger" href="logout.php">
                        تسجيل الخروج
                        </a>
                        <a href="profile.php?id=<?php echo $row['UserID'] ?>">
                        <img class="userIMG" src="<?php echo $img.$row['image']?>" alt="">
                        </a>
                    </li>
                    
                    <?php }else{?>
                    <li class="nav-item">
                        <a class="prof btn btn-register" href="signup.php">
                        انشاء حساب
                    </a>
                        <a class="prof btn btn-login" href="login.php">
                        تسجيل الدخول
                    </a>
                    </li>
                    <?php } ?>
                </ul>-->
            </div>
        </div>
    </nav>
