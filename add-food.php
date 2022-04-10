<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper"> 
            <h1>Add food</h1>
            <br><br>

            
             <?php
             if(isset($_SESSION["add"]))
             {
               echo $_SESSION['add'];//display session message
               unset($_SESSION['add']);//removing session message
             }
             if(isset($_SESSION["upload"]))
             {
               echo $_SESSION['upload'];//display session message
               unset($_SESSION['uplad']);//removing session message
              }
        
         ?>

            <form action="" method="POST" enctype="multipart/form-data">
                   <table class="tbl-30">
                       <tr>
                           <td>title:</td>
                           <td> 
                               <input type="text" name="title" placeholder="food title">
                            </td>
                       </tr>
                       <tr>
                           <td>description:</td>
                           <td>
                               <textarea name="description" cols="30" rows="5" placeholder="food description"></textarea>
                           </td>
                       </tr>
                       <tr>
                           <td>price:</td>
                           <td> 
                               <input type="number" name="price">
                            </td>
                       </tr>

                       <tr>
                           <td>select image: </td>
                           <td>
                                <input type="file" name="image">
                           </td>
                       </tr>
                       <tr>
                           <td>category:</td>
                           <td> 
                               <select name="category">
                                   <?php
                                        //create code to display category from database

                                        $sql="SELECT *FROM tbl_category WHERE active='yes'";

                                        //execute the query
                                        $res =mysqli_query($conn,$sql);

                                        //count rows to check data in database or not
                                        $count=mysqli_num_rows($res);//get all the rows in database

                                        //count is greater than 0 we have category
                                        if($count>0)
                                        {
                                            //we have category
                                            while($row=mysqli_fetch_assoc($res))
                                            {
                                               //get the details 
                                               $id=$row['id'];
                                               $title=$row['title'];

                                               ?>

                                               <option value="<?php echo $id;?>"><?php echo $title; ?> </option>
                                               
                                               <?php
                                            }
                                        }
                                        else
                                        {
                                            //we dont
                                            ?>
                                            <option value="0">no category found</option>
                                            <?php
                                        }
                                   ?>
                                   
                            </td>
                       </tr>
                       <tr>
                           <td>feature: </td>
                           <td>
                                <input type="radio" name="feature" value="yes"> yes
                                <input type="radio" name="feature" value="no"> no
                           </td>
                       </tr>
                       <tr>
                           <td>active: </td>
                           <td>
                           <input type="radio" name="active" value="yes"> yes
                           <input type="radio" name="active" value="no"> no
                           </td>
                       </tr>
                       <tr>
                           <td colspan="2">
                           <input type="submit" name="submit" value="Add food" class="btn-secondary">
                           </td>
                       </tr>
                   </table>
                </form> 
                <?php
                    //process the value from form and save it in database
                    // check the submit button

                    if(isset($_POST['submit']))
                    {
                        //button clicked
                        //echo "Button clicked";
                        //get data from form
                        $title=$_POST['title'];
                        $discription=$_POST['description'];
                        $price=$_POST['price'];
                        $category=$_POST['category'];



                        if(isset($_POST['feature']))
                        {
                            $feature=$_POST['feature'];
                        }
                        else
                        {
                            $feature='no';
                        }

                        if(isset($_POST['active']))
                        {
                            $active=$_POST['active'];
                        }
                        else
                        {
                            $active='no';
                        }

                        //check the image select otr not
                        //print_r($_FILES['image']);
                        
                        //die(); //break the code
                        if(isset($_FILES['image']['name']))
                        {
                            $image_name=$_FILES['image']['name'];

                            //auto rename image
                            //extention image only in format
                            //$ext=end(explode('.',$image_name));

                            //check image upload or not
                            if($image_name!="")
                            {
                                $ext=end(explode('.',$image_name));
                            }

                            //create name our image
                            $image_name='Food-Name-'.rand(000,999).'.'.$ext ; //eg: Food-Name-.

                            $src=$_FILES['image']['tmp_name'];

                            //destination path
                            $dst="../images/food/".$image_name;

                            //upload image
                            $upload=move_uploaded_file($src,$dst);

                            //check upload

                            //$source_path=$_FILES['image']['tmp_name'];

                            //$destination_path="../images/category/".$image_name;

                            //upload the image
                            //$upload=move_uploaded_file($source_path,$destination_path);

                            //check
                            if($upload==false)
                            {
                                //set image
                                $_SESSION['upload']="<div class='error'>fail to upload.</div>";

                                //redirect
                                header('location:'.SITEURL.'admin/add-food.php');

                                //stop
                                die();
                            }
                        }
                        else
                        {
                            $image_name='';
                        }

                        //sql to save data into database
                        //for numerical dont need to pass value quotes'' but string value its compulsory to add quotes''.
                        $sql2="INSERT INTO tbl_food SET
                           title='$title',
                           description='$destination',
                           price='$price',
                           image_name='$image_name',
                           category=$category,
                           feature='$feature',
                           active='$active'
                        ";

                        //execute query and saving data into database
                        $res2= mysqli_query($conn,$sql2) ; //or die(mysqli_error());

                        //chech data inserted or not
                        if($res2==true)
                        {
                        //data inserted
                        //echo " Data inserted";
                        //create the session to display message
                        $_SESSION['add']="<div class='success'>food add successfully.</div>";
                        // redirect to manage admin
                        header("location:".SITEURL."admin/manage-food.php");
                        }
                        else
                        {
                        //data not insert
                        //echo "Fail to insert data";
                        //create the session to display message
                        $_SESSION['add']="<div class='error'>Fail to add food.</div>";
                        // redirect to add admin
                        header("location:".SITEURL."admin/add-food.php");
                        }
                    }
                ?>  
    </div>
</div> 


<?php include ('partials/footer.php'); ?>