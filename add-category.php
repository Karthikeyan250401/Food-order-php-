<?php include ('partials/menu.php');?>

<div class="main-content">
    <div class="wrapper"> 
               <h1>Add category</h1> 

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
                <br><br>

               <!--add category-->

               <form action="" method="POST" enctype="multipart/form-data">
                   <table class="tbl-30">
                       <tr>
                           <td>title:</td>
                           <td> 
                               <input type="text" name="title" placeholder="category title">
                            </td>
                       </tr>

                       <tr>
                           <td>select image: </td>
                           <td>
                                <input type="file" name="image">
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
                           <input type="submit" name="submit" value="Add category" class="btn-secondary">
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
                            $ext=end(explode('.',$image_name));

                            //rename our image
                            $image_name='Food_category_'.rand(000,999).'.'.$ext ; //eg: Food_category_.

                            $source_path=$_FILES['image']['tmp_name'];

                            $destination_path="../images/category/".$image_name;

                            //upload the image
                            $upload=move_uploaded_file($source_path,$destination_path);

                            //check
                            if($upload==false)
                            {
                                //set image
                                $_SESSION['upload']="<div class='error'>fail to upload.</div>";

                                //redirect
                                header('location:'.SITEURL.'admin/add-category.php');

                                //stop
                                die();
                            }
                        }
                        else
                        {
                            $image_name='';
                        }

                        //sql to save data into database
                        $sql="INSERT INTO tbl_category SET
                           title='$title',
                           image_name='$image_name',
                           feature='$feature',
                           active='$active'
                        ";

                        //execute query and saving data into database
                        $res= mysqli_query($conn,$sql) ; //or die(mysqli_error());

                        //chech data inserted or not
                        if($res==true)
                        {
                        //data inserted
                        //echo " Data inserted";
                        //create the session to display message
                        $_SESSION['add']="<div class='success'>category add successfully.</div>";
                        // redirect to manage admin
                        header("location:".SITEURL."admin/manage-category.php");
                        }
                        else
                        {
                        //data not insert
                        //echo "Fail to insert data";
                        //create the session to display message
                        $_SESSION['add']="<div class='error'>Fail to add category.</div>";
                        // redirect to add admin
                        header("location:".SITEURL."admin/add-category.php");
                        }
                    }
                ?>
    </div>
</div>


<?php include ('partials/footer.php'); ?>