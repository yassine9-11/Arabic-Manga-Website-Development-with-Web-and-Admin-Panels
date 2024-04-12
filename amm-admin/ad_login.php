<?php 
session_start();
$nonavbar=' no';
$page_title="Amura Cpanel | login ";
$error='';


if (isset($_SESSION['adminID'])){
    header('location:  ad_home.php');  // redirect to dashbord
    exit();
}
include "init.php";

if ( $_SERVER['REQUEST_METHOD']=='POST'){

    $email=$_POST['email'];
    $password=$_POST['password'];
    $hashpass=sha1($password);

    // check if user exist:
    $sql="SELECT * FROM admin WHERE Email=? AND PasswordHash=?";
    $search=$con->prepare($sql);
    $search->execute(array($email,$hashpass));
    $row=$search->fetch();

    
    if($search->rowCount()>0){
        $error='';
        $_SESSION['adminID']=$row["AdminID"];
        $_SESSION['adminName']=$row['Username'];
        $_SESSION['adminEmail']=$rpw['Email'];
        header('location:ad_home.php');
        exit();
    }
    else{
        $error= "
        <div class='alert alert-danger '> you are not admin ! ! </div>
        ";
    }

}?>

<!-- html -->
<div class="row  login m-auto">
    <!-- header -->
    <div class="row login ad_home m-auto">
        <div class="logo_desc col-12">
            <div>
                <a class="Logo" href="home.html">AmuraManga</a>
            </div>
        </div>
    </div>
    <hr class="profil__hr" />
    <!-- form -->
    
    <form action="ad_login.php" class="container" method="POST" style="width:400px;border: 1px solid #13405b;
background: #ebedef33;">
        <label for=""> 
                تسجيل الدخول
               
        </label>
        <div class="err" style="    width: 343px;">
            <?php echo $error ;?>
        </div>
        <table>

            <tr>
                <td class="key">
                    عنوان البريد الاليكتروني: <span class="required">*</span>
                </td>
                <td class="val">
                    <input type="text" name="email" required="required">
                </td>
            </tr>
            <tr>
                <td class="key">
                    كلمة المرور: <span class="required">*</span>
                </td>
                <td class="val">
                    <input type="password" name="password" required="required">
                </td>
            </tr>
            <tr>
                <td class="forget" colspan="2">
                    <a href="increated.html">
                               نسيت كلمة المرور ؟
                            </a>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <input type="submit" name="" id="" class="prof btn btn-register" value="تسجيل الدخول  ">
                </td>
            </tr>
            
        </table>
    </form>

</div>
<hr class="profil__hr" />


<?php  
include $tpl."footer.php" ?>