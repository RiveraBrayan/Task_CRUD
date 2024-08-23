<?php include_once 'config/connection.php' ?>

<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>To do List</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">

  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .card {
      min-width: 80vh;
    }

    .card-header {
      text-align: center;
      font-weight: bold;
    }

    .taskInput {
      text-align: center;
    }
  </style>
</head>

<body>

  <div class="card">
    <div class="card-header">
      <h5 class="card-title">To Do List</h5>
    </div>
    <div class="card-body">
      <div class="row">
        <form action="assets/php/actions.php" method="post" novalidate autocomplete="off">
          <div class="input-group mb-3">
            <input type="text" class="form-control taskInput" placeholder="New task" aria-label="New task"
              name="frmeNewTask">
            <button class="btn btn-primary btn-save-task" type="submit"><i class="bi bi-plus-circle"></i></button>
          </div>
        </form>
        <table class="table">
          <thead>
            <tr>
              <th scope="col" style="width: 10%;">#</th>
              <th scope="col" style="width: 60%;">Task</th>
              <th scope="col">Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            $result = $mysqli->query("SELECT * FROM tasks");
            $order = 0;
            if ($result->num_rows > 0) {
              while ($row = $result->fetch_assoc()) {
                $order++;
                echo '<tr>
                            <th scope="row">' . $order . '</th>
                            <td>' . $row['task_name'] . '</td>
                            <td>
                              <div class="btn-group" role="group" aria-label="Basic mixed styles example">
                                <button type="button" class="btn btn-success btn-edit-task" data-id="' . $row['id'] . '" data-task="' . $row['task_name'] . '" data-bs-toggle="modal" data-bs-target="#editModal"><i class="bi bi-pencil-square"></i></button> 
                                <form action="assets/php/actions.php" method="post" novalidate autocomplete="off">
                                  <button type="submit" class="btn btn-danger" value="' . $row['id'] . '" name="frmeDelete"><i class="bi bi-trash"></i></button>
                                </form>
                              </div> 
                            </td>
                        </tr>';
              }
            } else {
              echo '<tr><td colspan="3" style="text-align: center;">No data</td></tr>';
            }
            ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <form action="assets/php/actions.php" method="post" novalidate autocomplete="off">
        <div class="modal-content">
          <div class="modal-header">
            <h1 class="modal-title fs-5" id="editModalLabel">EDIT TASK</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="input-group mb-3">
              <input type="hidden" name="frmeIdTask" id="frmeIdTask">
              <input type="text" class="form-control taskInput" placeholder="New task" aria-label="New task"
                id="frmeNewTaskEdit" name="frmeNewTaskEdit">
            </div>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </div>
      </form>
    </div>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>

  <script>
    $("body").on("click", ".btn-edit-task", function () {
      // ID task
      let id = $(this).data("id");
      $('#frmeIdTask').val(id);

      // Text task
      let task = $(this).data("task");
      $('#frmeNewTaskEdit').val(task);
    });
  </script>
</body>

</html>