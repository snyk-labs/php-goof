<?php
    require('func.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <title>PHP Goof Todo</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container">
    <a class="navbar-brand" href="index.php">PHP Goof Todo</a> 
    <a href="https://github.com/snyk-labs/php-goof" title="get the code" target="blank"><span style="color:white" class="material-icons info">info</span></a> 
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
                        <input class="form-control" type="stext" name="title" placeholder="Title" required autofocus value="<?php if(isset($title)) echo $title; ?>">
                        <?php if(isset($title)){
                            ?><input type="hidden" name="edid" value="<?php echo $_GET['edid']?>"><?php } ?>

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
                        <th class="col-2" scope="col">date/time</th>
                        <th class="col-2" scope="col">Actions</th>
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
                            <a href="index.php?edid=<?php echo $row['id'];?>"><span class="material-icons">edit</span></a>
                            <a href="tasks.php?delid=<?php echo $row['id'];?>"><span class="material-icons text-danger">delete_forever</span></a>
                            <a href="#" data-bs-toggle="modal" data-bs-target="#myModal" title="send email reminder"><span class="material-icons email">email</span></a>
                             <a href="pdf.php?title=<?php echo $row['title'];?>" target="_blank"><span class="material-icons picture_as_pdf">picture_as_pdf</span></a>

                            <!-- Modal -->
                            <div class="modal" id="myModal">
                              <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="mail.php" method="POST">
                                 
                                        <!-- Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Send todo as an email</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
+                                        </div>                                

                                        <div class="modal-body">

                                            <div class="form-group">
                                                <input class="form-control" type="stext" name="email" placeholder="Recipient Email" required autofocus>
                                            </div>
                                        </div>

                                        <!-- Modal footer -->
                                        <div class="modal-footer">
                                            <input type="submit" class="btn btn-success" name="send" value="send">
                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                        </div>

                                    </form>
                                </div>

                              </div>
                            </div>

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