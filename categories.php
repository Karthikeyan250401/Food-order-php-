<?php include('partials-front/menu.php'); ?>


    <!-- CAtegories Section Starts Here -->
    <section class="categories">
        <div class="container">
            <h2 class="text-center">Explore Foods</h2>
            <?php
            
            $sql="SELECT* FROM tbl_category WHERE active='yes'";

            //execute the query
            $res = mysqli_query($conn,$sql);

            //count rows

            $count=mysqli_num_rows($res);

            //check whether categories available or not
            if($count>0)
            {
                //available
                while($row=mysqli_fetch_assoc($res))
                {
                    //get value
                    $id=$row['id'];
                    $title=$row['title'];
                    $image_name=$row['image_name'];
                    ?>
                        <a href="category-foods.html">
                            <div class="box-3 float-container">
                                <?php
                                    if($image_name=='')
                                    {
                                        //not available
                                        echo "<div class='error'>image not found.</div>";
                                    }
                                    else
                                    {
                                        //available
                                        ?>
                                            <img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name;?> " alt="Pizza" class="img-responsive img-curve">
                                        <?php
                                    }
                                ?>
                                

                                <h3 class="float-text text-white"><?php echo $title;?></h3>
                            </div>
                             </a>

                    <?php

                }
            }
            else
            {
                //not avaiable
                echo "<div class='error'>category not found.</div>";
            }
        ?>
            

            <a href="#">
            <div class="box-3 float-container">
                <img src="images/burger.jpg" alt="Burger" class="img-responsive img-curve">

                <h3 class="float-text text-white">Burger</h3>
            </div>
            </a>

            

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Categories Section Ends Here -->


    <?php include('partials-front/footer.php');?>