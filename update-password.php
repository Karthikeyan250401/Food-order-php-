<?php include ('partials/menu.php');?>

<div class="main-content">
            <div class="wrapper"> 
               <h1>change password</h1> 
               <br/>

                <?php
                  if(isset($_GET["id"]))
                  {
                      $id=$_GET['id'];
                  }
                ?>

               <form action="" method="POST">
                   <table class="tbl-30">
                       <tr>
                           <td>current password:</td>
                           <td> 
                               <input type="password" name="current_password" placeholder='current password'>
                            </td>
                       </tr>

                       <tr>
                           <td>new password: </td>
                           <td>
                           <input type="password" name="new_password" placeholder='new password'>
                           </td>
                       </tr>
                       <tr>
                           <td>confirm password: </td>
                           <td>
                           <input type="password" name="confirm_password" placeholder='confirm password'>
                           </td>
                       </tr>
                       <tr>
                           <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $id;?>">
                           <input type="submit" name="submit" value="change password" class='btn-secondary'>
                           </td>
                       </tr>
                   </table>
            </div>
</div>
<?php
    //check submit button
    if(isset($_POST['submit']))
    {
        //echo 'button clicked';
        //get all value from form
         $id=$_POST['id'];
         $current_password=md5($_POST['current_password']);
         $new_password=md5($_POST['new_password']);
         $confirm_password=md5($_POST['confirm_password']);

        // check password is exists or not
        $sql="SELECT * FROM tbl_admin WHERE id=$id AND password='$current_password'";
        //execute query
        $res= mysqli_query($conn,$sql);

        if($res==true)
        {
            //data available or not
            $count=mysqli_num_rows($res);

            if($count==1)
            {
                //echo"user found";
                if($new_password==$confirm_password)
                {
                    //update password
                    //echo "password match";
                    $sql2="UPDATE tbl_admin SET password='$new_password' WHERE id=$id";

                    // execute query
                    $res2=mysqli_query($conn,$sql2);

                    //execute or not
                    if($res2==true)
                    {
                       //success message
                        // redirect to manage page
                    $_SESSION['change-password']="<div class='success'>change password success.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                    else
                    {
                       // error message
                       $_SESSION['change-password']="<div class='error'>fail to change password.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                    }
                }
                else
                {
                    // redirect to manage page
                    $_SESSION['password-not-match']="<div class='error'>password not match.</div>";
                    header('location:'.SITEURL.'admin/manage-admin.php');
                }
            }
            else
            {
                $_SESSION['user not found']="<div class='error'>user not found.</div>";
                header('location:'.SITEURL.'admin/manage-admin.php');
            }
        }
    }
?>

<?php include ('partials/footer.php'); ?>