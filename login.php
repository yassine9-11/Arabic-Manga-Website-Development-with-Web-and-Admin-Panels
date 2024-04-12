<?php 
session_start();
$nonavbar=' no';
$page_title="Amura Manga | login ";
$error='';


if (isset($_SESSION['userID'])){
    header('location:  index.php');  // redirect to dashbord
    exit();
}
include "init.php";

if( $_SERVER['REQUEST_METHOD']=='POST'){

    $email=$_POST['email'];
    $password=$_POST['password'];
    $hashpass=sha1($password);

    // check if user exist:
    $sql="SELECT * FROM `user` WHERE Email = ? AND PasswordHash = ?";
    $search=$con->prepare($sql);
    $search->execute(array($email,$hashpass));
    $row=$search->fetch();

    
    if($search->rowCount()>0){
        $error='';
        $_SESSION['userID']=$row["UserID"];
        $_SESSION['Username']=$row['Username'];
        $_SESSION['Email']=$row['Email'];
        header('location:index.php');
        exit();
    }
    else{
        $error= "
        <div class='alert alert-danger '> 
        المعلومات غير صحيحة 
        </div>
        ";
    }

}

?>

<!-- html -->
<div class="row container login m-auto">
        <div class="logo_desc">
            <a class="Logo" href="home.html">AmuraManga</a>
            <div class="dec">مرحبا بكم في موقعنا

            </div>

        </div>

        

        <form action="login.php" method="POST"
        style="min-height: 60vh;padding: 10px;box-shadow: 0 0 3px #aaa;
                               border-radius: 16px;max-width: 460px;margin: auto;" >

        <h3 style="text-align:center;">LOGIN  PAGE </h3>
            
            <table>
                <tr>
                    <td colspan="2">
                    <?php echo $error; ?>
                    </td>
                </tr>
                <tr>
                    <td class="key">
                         البريد الاليكتروني: <span class="required">*</span>
                    </td>
                    <td class="val">
                        <input type="text" name="email">
                    </td>
                </tr>
                <tr>
                    <td class="key">
                        كلمة المرور: <span class="required">*</span>
                    </td>
                    <td class="val">
                        <input type="password" name="password">
                    </td>
                </tr>
                <tr>
                    <td class="forget" colspan="2" style="text-align:center;">
                        <a href="increated.html">
                              هل  نسيت كلمة المرور ؟
                            </a>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <input type="submit"class="prof btn btn-register" value="تسجيل الدخول  ">
                    </td>
                </tr>
                <tr>
                    <td class="forget" colspan="2">
                        <a href="signup.html" class="prof btn btn-login">
                              إنشاء حساب جديد 
                            </a>
                    </td>
                </tr>
            </table>
        </form>

    </div>
    <hr class="profil__hr" />



    <div class="container login">

        <!--foote_bottom_ul_amrc ends here-->
        <p class="text-center">Copyright @2017 | Designed With by <a href="home.html" class="companyname">AMURA MANGA</a></p>


        <!--social_footer_ul ends here-->
    </div>

    <script src="js/bootstrap.bundle.min.js"></script>
<?php  
 ?>