<?php include ('partials/menu.php');?>

<head>
        <link rel="stylesheet" href="../css/admin.css">
    </head>
        <div class="main-content">
            <div class="wrapper"> 
               <h1>Manage Admin</h1> 
               <br/>

                <?php
                  if(isset($_SESSION["add"]))
                  {
                      echo $_SESSION['add'];//display session message
                      unset($_SESSION['add']);//removing session message
                  }
                  if(isset($_SESSION["delete"]))
                  {
                      echo $_SESSION['delete'];//display session message
                      unset($_SESSION['delete']);//removing session message
                  }
                  if(isset($_SESSION["update"]))
                  {
                      echo $_SESSION['update'];//display session message
                      unset($_SESSION['update']);//removing session message
                  }
                  if(isset($_SESSION["user-not-found"]))
                  {
                      echo $_SESSION['user-not-found'];
                      unset($_SESSION['user-not-found']);
                  }
                  if(isset($_SESSION["password-not-match"]))
                  {
                      echo $_SESSION['password-not-match'];
                      unset($_SESSION['password-not-match']);
                  }
                  if(isset($_SESSION["change-password"]))
                  {
                      echo $_SESSION['change-password'];
                      unset($_SESSION['change-password']);
                  }
               
                ?>
               <br><br><br>
              <!-- Button to add action -->
              <a href="add-admin.php" class="btn-primary">Add Admin </a>
              <br/><br/>
               <table class="tbl-full">
                   <tr>
                       <th>S.no</th>
                       <th>Full Name</th>
                       <th>User Name</th>
                       <th>Actions</th>
                   </tr>
                    
                   <?php
                    //query to get all sdmin
                     $sql="SELECT* FROM tbl_admin";

                     //execute the query
                     $res =mysqli_query($conn,$sql);

                     // check query is work or not
                     if($res==TRUE)
                     {
                        //count rows to check data in database or not
                        $count=mysqli_num_rows($res);//get all the rows in database
                        
                        $sn=1; //create  variable and assign value

                        // check num of roes
                        if($count>0)
                        {
                            //we have data in database
                            while($rows=mysqli_fetch_assoc($res))
                            {
                                //while loop get all data from database and run as long as data in database
                                
                                //get individual data
                                $id=$rows['id'];
                                $full_name=$rows['full_name'];
                                $username=$rows['username'];

                                //display the value in our table
                                ?>
                                  
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $full_name; ?></td>
                                    <td><?php echo $username; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>
                                        <a href="<?php echo SITEURL;?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
                                        <a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>


                                <?php
                            }
                        }
                        else
                        {
                            //not have data in database
                        }
                     }
                   ?>
                   
               </table>
            </div> 
        </div>
<?php include ('partials/footer.php'); ?>