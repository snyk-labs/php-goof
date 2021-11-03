<?php

include('db.php');

if(isset($_POST['save_task'])){
    
    $title = urlencode($_POST['title']);

    $query = "INSERT INTO task(title) VALUES ('$title')";
    $result = mysqli_query($conn, $query);

    if(!$result){
        die("Query failed");
    }
    
    $_SESSION['message'] = 'Task saved successfully';
    $_SESSION['message_type'] = 'success';

    header('Location: index.php');

}

?>