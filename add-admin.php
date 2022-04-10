<?php include ('partials/menu.php');?>


<div class="main-content">
<div class="wrapper"> 
               <h1>Add admin</h1> 

               <br><br>

               <?php
                  if(isset($_SESSION["add"]))
                  {
                      echo $_SESSION['add'];//display session message
                      unset($_SESSION['add']);//removing session message
                  }
               
               ?>
               
               <form action="" method="POST">
                   <table class="tbl-30">
                       <tr>
                           <td>Full Name:</td>
                           <td> 
                               <input type="text" name="full_name" placeholder="Enter your name">
                            </td>
                       </tr>
                       <tr>
                           <td>Username: </td>
                           <td>
                           <input type="text" name="username" placeholder="your username">
                           </td>
                       </tr>
                       <tr>
                           <td>password: </td>
                           <td>
                           <input type="password" name="password" placeholder="your password">
                           </td>
                       </tr>
                       <tr>
                           <td colspan="2">
                           <input type="submit" name="submit" value="Add Admin" class="btn-secondary">
                           </td>
                       </tr>
                   </table>
</div>
</div>

<?php include ('partials/footer.php'); ?>


<?php
     //process the value from form and save it in database
     // check the submit button

    if(isset($_POST['submit']))
    {
        //button clicked
        //echo "Button clicked";
        //get data from form
        $full_name=$_POST['full_name'];
        $username=$_POST['username'];
        $password=md5($_POST['password']);//password encrypt with md5

        //sql to save data into database
        $sql="INSERT INTO tbl_admin SET
        full_name='$full_name',
        username='$username',
        password='$password'
        ";

        //execute query and saving data into database
        $res= mysqli_query($conn,$sql) or die(mysqli_error());

        //chech data inserted or not
        if($res==TRUE)
        {
            //data inserted
            //echo " Data inserted";
            //create the session to display message
            $_SESSION['add']="Admin add successfully";
            // redirect to manage admin
            header("location:".SITEURL."admin/manage-admin.php");
        }
        else
        {
            //data not insert
            //echo "Fail to insert data";
            //create the session to display message
            $_SESSION['add']="Fail to add admin";
            // redirect to add admin
            header("location:".SITEURL."admin/add-admin.php");
        }
    }
    
?>