<?php include('partials/menu.php'); ?> 

<div class="main-content">
    <div class="wrapper">
        <h1>Manage category</h1>
        <br/>

        <?php
            if(isset($_SESSION["add"]))
            {
                 echo $_SESSION['add'];//display session message
                 unset($_SESSION['add']);//removing session message
            }
               
        ?>
        <br><br>
              <!-- Button to add action -->
              <a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add category </a>
              <br/><br/><br>
               <table class="tbl-full">
                   <tr>
                       <th>S.no</th>
                       <th>title</th>
                       <th>image</th>
                       <th>feature</th>
                       <th>active</th>
                       <th>action</th>
                   </tr>


                   <?php
                    //query to get all sdmin
                    $sql="SELECT* FROM tbl_category";

                     //execute the query
                    $res =mysqli_query($conn,$sql);

                    //count the query
                    $count =mysqli_num_rows($res);

                    //serial number
                    $sn=1;

                    //check we have data or not
                    if($count>0)
                    {
                        //we have data
                        //get data and dispaly
                        while($rows=mysqli_fetch_assoc($res))
                            {
                                //while loop get all data from database and run as long as data in database
                                
                                //get individual data
                                $id=$rows['id'];
                                $title=$rows['title'];
                                $image_name=$rows['image_name'];
                                $feature=$rows['feature'];
                                $active=$rows['active'];

                                //display the value in our table
                                ?>
                                  
                                <tr>
                                    <td><?php echo $sn++; ?></td>
                                    <td><?php echo $title; ?></td>


                                    <td>
                                        <?php 
                                           //check image name is available or not
                                           if($image_name!='')
                                           {
                                               //dispaly image
                                               ?>

                                               <img src="<?php echo SITEURL;?>images/category/<?php echo $image_name; ?>" width='100px'>
                                               
                                               <?php
                                           }
                                           else
                                           {
                                               //display message
                                               echo"<div class='error'>image not added.</div>";

                                           }
                                        ?>
                                    </td>


                                    <td><?php echo $feature; ?></td>
                                    <td><?php echo $active; ?></td>
                                    <td>
                                        <a href="<?php echo SITEURL;?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">change password</a>
                                        
                                    </td>
                                </tr>


                                <?php
                            }
                    }
                    else
                    {
                        //we dont
                        //display message inside table
                        ?>
                        <tr>
                            <td colspan='6'><div class='error'>no category added.</div></td>
                        </tr>
                        <?php
                    }
                    ?>
                   
                   
               </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>