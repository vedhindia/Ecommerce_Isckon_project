<?php
    require 'dbconnection.php';
    $id = $_GET['id'];
    // sql to delete a record
    $sql = "DELETE FROM gallery WHERE id =$id";

    if ($conn->query($sql) === TRUE) {
       echo "<SCRIPT type='text/javascript'> //not showing me this
                       alert('Image Deleted Successfully!! ');
                      window.location.replace('gallery.php');
                     </SCRIPT>";
    } else {
      echo "Error deleting record: " . $conn->error;
    }
?>

   
