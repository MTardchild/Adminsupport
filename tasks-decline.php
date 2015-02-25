<?php
    header("Location: index.php");
//    $id = $_GET['id'];
//
//    $trainee = $_POST['trainee'];
//    $task = $_POST['task'];
//    $date = $_POST['date'] . ' ';
//    $time = $_POST['time'];

//    include 'MySQLCredentials.php';
//
//    if($row = $connection->query("SELECT * FROM $log WHERE log_id='$id'")) {
//        $row = $query->fetch_array(MYSQLI_ASSOC);
//
//        $trainee = $row['log_id'];
//        $task = $row['task_id'];
//        $date = $row['user_id'] . ' ';
//        $time = $row['date'];
//
//        if($query = $connection->query("SELECT log_id, b.user_id, c.score, b.score AS scoreUser FROM $log a INNER JOIN $users b ON a.user_id = b.user_id INNER JOIN $tasks c ON a.task_id = c.task_id WHERE log_id='$id'")){
//            $row = $query->fetch_array(MYSQLI_ASSOC);
//            $score = $row['score'] + $row['scoreUser'];
//            $user = $row['user_id'];
//
//            if($connection->query("UPDATE $users SET score='$score' WHERE user_id='$user'")) {
//                echo "<b>Successfully added score</b><br>";
//            }
//        } else {
//            echo $connection->errno . ": " . $connection->error . "\n";
//            $connection->close();
//            exit;
//        }
//    } else {
//        echo $connection->errno . ": " . $connection->error . "\n";
//        $connection->close();
//        exit;
//    }
//    $connection->close(); // Closing Connection
?>