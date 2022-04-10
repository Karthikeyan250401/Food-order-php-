<?php include('partials/menu.php'); ?> 

<div class="main-content">
    <div class="wrapper">
    <h1>Manage food</h1>
    <br/>

    <?php
            if(isset($_SESSION["add"]))
            {
                 echo $_SESSION['add'];//display session message
                 unset($_SESSION['add']);//removing session message
            }
               
        ?>
              <!-- Button to add action -->
              <a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food </a>
              <br/><br/>
               <table class="tbl-full">
                   <tr>
                       <th>S.no</th>
                       <th>title</th>
                       <th>price</th>
                       <th>image</th>
                       <th>feature</th>
                       <th>active</th>
                       <th>action</th>
                   </tr>

                 <?php
                    //query to get all sdmin
                    $sql="SELECT* FROM tbl_food";

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
                                $price=$rows['price'];
                                $image_name=$rows['image_name'];
                                $feature=$rows['feature'];
                                $active=$rows['active'];

                                ?>
                                <tr>
                                    <td><?php echo $sn++;?></td>
                                    <td><?php echo $title;?></td>
                                    <td><?php echo $price;?></td>
                                    <td>
                                        <?php echo $image_name;?>
                                    </td>
                                    <td><?php echo $feature;?> </td>
                                    <td><?php echo $active;?></td>
                                    <td>
                                        <a href="a" class="btn-secondary">Update Admin</a>
                                        <a href="a" class="btn-danger">Delete Admin</a>
                                    </td>
                                </tr>

                                <?php

                                //display the value in our table
                            }
                    }
                    else
                    {
                        echo "<tr> <td colspace='7' class='error'> food not added yet.</td></tr>";
                    }
                    ?>

                   
                   
               </table>
    </div>
</div>


<?php include('partials/footer.php'); ?>