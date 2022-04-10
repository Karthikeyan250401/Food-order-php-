<?php

    // include constants page
    include('../config/constants.php');
    
    //id of admin delete
    $id=$_GET['id'];

    //sql query to delete admin
    $sql= "DELETE FROM tbl_admin WHERE id=$id";

    //execute the query
    $res=mysqli_query($conn,$sql);

    //check the query execute or not
    if($res==true)
    {
        //successful
        //echo "Admin deleted";
        //create session variable to display
        $_SESSION['deleted']="<div class='success'> Admin deleted sucessfully.</div>";
        //redirect to manage admin page
        header('location:'.SITEURL.'admin/manage-admin.php');
    }
    else
    {
        // failed
        //echo"failed to delete admin";
        $_SESSION['deleted']="<div class='error'>fail to delete admin. try again later.</div>";
        header('location:'.SITEURL.'admin/manage-admin.php');

    }

    //redirect to manage admin page with success or error


?>