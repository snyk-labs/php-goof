<?php
    require __DIR__.'/vendor/autoload.php';

    include("db.php");

    use League\CommonMark\CommonMarkConverter;
    $converter = new CommonMarkConverter(['html_input' => 'escape', 'allow_unsafe_links' => false]);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>PHP Goof Todo</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php">PHP Goof Todo</a>
  </div>
</nav>

<div class="container p-4">
    <div class="row">

        <div class="col-4">
            <?php if(isset($_SESSION['message'])){ ?>
            <div class="alert alert-<?php echo $_SESSION['message_type'];?>" role="alert">
                <?php echo $_SESSION['message']; ?>
            </div>
            <?php session_unset();} ?>
            <div class="card card-body">
                <form action="tasks.php" method="POST">
                    <div class="form-group">
                        <input class="form-control" type="stext" name="title" placeholder="Title" required autofocus>
                    </div>
                    <input type="submit" class="btn btn-success mt-3" name="save_task" value="Save todo">
                </form>
            </div>
        </div>
        <div class="col-8">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Title</th>
                        <th scope="col">date/time</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


        $query = "SELECT * FROM task";
        $result_tasks = mysqli_query($conn, $query);

        while($row = mysqli_fetch_array($result_tasks)){ ?>
                    <tr>
                        <td><?php 
                        echo $converter->convertToHtml(urldecode($row['title']));?></td>
                        <td><?php echo $row['created_at'];?></td>
                        <td>
                            <a href="edit.php?id=<?php echo $row['id'];?>"><span class="material-icons">edit</span></a>
                            <a href="delete_task.php?id=<?php echo $row['id'];?>"><span class="material-icons text-danger">delete_forever</span></a>
                        </td>
                    </tr>
                    <?php
        }
      ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>