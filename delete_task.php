<?php

    include("db.php");
    
    if(isset($_GET['id'])){
        $id = $_GET['id'];

        $query = "DELETE FROM task WHERE id = $id";
        $result = mysqli_query($conn, $query);
        // echo $id;
        if(!$result){
            die("Query failed");
        }
        $_SESSION['message'] = 'Task removed successfully';
        $_SESSION['message_type'] = 'warning';

        header('Location: index.php');

    }

?>