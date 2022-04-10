<!--<?php include('../config/constants.php');?>

<html>
    <head>
        <title>
            Login - Food Order system
        </title>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
    <body>
        <div class='login'>
            <h1 class='text-center'>Login</h1>
            <br>-->

            <!--<?php
                /*if(isset($_SESSION['login']))
                {
                    echo $_SESSION['login'];
                    unset($_SESSION['login']);
                }
            
            ?>
            <br><br>

            <!--login form -->
            <form action="" method="POST" class='text-center'>
            username: <br>
            <input type="text" name="username" placeholder="enter username"> <br><br>
            
            password: <br>
            <input type="password" name="password" placeholder="enter password"><br><br>
             
            <input type="submit" name="submit" value="login" class="btn-primary">
            <br><br>
            </form>
            <p class='text-center'>Created by - <a href="WWW.JosephKarthick.com">JosephKarthick</a></p>
        </div>
    </body>
</html>
<?php
    //check submit button work
    if(isset($_POST['submit']))
    {
        //process login
        $username= $_POST['username'];
        $password= md5($_POST['password']);

        //sqp query to check
        $sql="SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

        //execute the query
        $res=mysqli_query($conn,$sql);

        if($count==1)
        {
            //success
            $_SESSION['login']="<div class='success'>login successful.</div>";
            // redirect to home page
            header("location:".SITEURL."admin/");
        }
        else
        {
            //fail
            $_SESSION['login']="<div class='error text-center'>username or password did not match.</div>";
            // redirect to home/dashboard
            header("location:".SITEURL."admin/login.php");
        }
    }


?>*/