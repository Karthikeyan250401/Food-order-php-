<?php include('partials/menu.php'); ?> 

<div class="maincontent">
    <div class="wrapper">
        <h1>Update admin</h1>

        <br><br>

        <?php
            // get id of selected admin
            $id=$_GET['id'];

            //create sql query to get details
            $sql="SELECT * FROM tbl_admin WHERE id=$id";

            //execute the query
            $res =mysqli_query($conn,$sql);

            //check execute or not
            if($res==true)
            {
                $count=mysqli_num_rows($res);

                if($count==1)
                {
                    //echo "admin available";
                    $rows=mysqli_fetch_assoc($res);
                    $full_name=$rows['full_name'];
                    $username=$rows['username'];
                }
                else
                {
                    header("location:".SITEURL.'admin/manage-admin.php');
                }
            }
        ?>
        <form action="" method="POST">
                   <table class="tbl-30">
                       <tr>
                           <td>Full Name:</td>
                           <td> 
                               <input type="text" name="full_name" value="<?php echo $full_name;?>">
                            </td>
                       </tr>
                       <tr>
                           <td>Username: </td>
                           <td>
                           <input type="text" name="username" value="<?php echo $username;?>">
                           </td>
                       </tr>
                       <tr>
                           <td colspan="2">
                           <input type="hidden" name="id" value="<?php echo $id;?>">
                           <input type="submit" name="submit" value="update Admin" class="btn-secondary">
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
         $full_name=$_POST['full_name'];
         $username=$_POST['username'];

         //sql to update
         $sql="UPDATE tbl_admin SET full_name='$full_name',username='$username' WHERE id='$id'";

         //execute the query
         $res =mysqli_query($conn,$sql);

         //check success or not
         if($res==true)
         {
            //create the admin update
            $_SESSION['update']="<div class='success'>Admin update successfully.</div>";
            // redirect to manage admin
            header("location:".SITEURL."admin/manage-admin.php");
         }
         else
         {
            //fail the admin update
            $_SESSION['update']="<div class='error'>fail to delete Admin.</div>";
            // redirect to manage admin
            header("location:".SITEURL."admin/manage-admin.php");
         }

    }
?>

<?php include ('partials/footer.php'); ?>