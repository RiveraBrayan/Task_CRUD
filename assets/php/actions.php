<?php
require_once '../../config/connection.php';

// INSERT NEW DATA
if (isset($_POST["frmeNewTask"]) && $_POST["frmeNewTask"] != '') {
    
    $task_name = $mysqli->real_escape_string($_POST["frmeNewTask"]);

    $stmt = $mysqli->prepare("INSERT INTO tasks (task_name) VALUES (?)");
    $stmt->bind_param("s", $task_name);

    if ($stmt->execute()) {
        header("Location: ../../index.php");
        die();
    } else {
        echo "Error inserting task: (" . $mysqli->errno . ") " . $mysqli->error;
    }

    $stmt->close();
    $mysqli->close();
}

// UPDATE NEW DATA
if (isset($_POST["frmeIdTask"])) {

    $id = $_POST["frmeIdTask"];
    $task_name = $_POST["frmeNewTaskEdit"];

    $stmt = $mysqli->prepare("UPDATE tasks SET task_name = ? WHERE id = ?");
    $stmt->bind_param("si", $task_name, $id);

    if ($stmt->execute()) {
        header("Location: ../../index.php");
        die();
    } else {
        echo "Error updating task: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}

// DELETE DATA
if (isset($_POST["frmeDelete"])) {
    $id = $_POST["frmeDelete"];

    $stmt = $mysqli->prepare("DELETE FROM tasks WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../../index.php");
        die();
    } else {
        echo "Error deleting task: (" . $stmt->errno . ") " . $stmt->error;
    }

    $stmt->close();
    $mysqli->close();
}

