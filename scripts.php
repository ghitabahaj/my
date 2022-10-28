<?php
    //INCLUDE DATABASE FILE
    require 'database.php';
    //SESSSION IS A WAY TO STORE DATA TO BE USED ACROSS MULTIPLE PAGES
    session_start();

    //ROUTING
    if(isset($_POST['save']))       saveTask();
    if(isset($_POST['update']))      updateTask();
    if(isset($_POST['delete']))      deleteTask();
    getTasks();
     function getTasks()
    {
     global $con;
     $sql = "SELECT ta.id, ta.title, namePriority , nameStatuses , nameType , ta.task_datetime, ta.description FROM tasks as ta JOIN priority ON (priority_id=priority.id) JOIN type ON (type_id=type.id) JOIN statues ON (status_id=statues.id)" ;
     $result = mysqli_query($con,$sql);
     $arr = array();
     if($result->num_rows > 0){

         while ($row=$result->fetch_assoc()){
             $arr[] = array(
                 "id" => $row['id'],
                 "title" =>$row['title'],
                 "type" => $row['nameType'],
                 "priority" => $row['namePriority'],
                 "status" => $row['nameStatuses'],
                 "date" => $row['task_datetime'],
                 "description" => $row['description']
             );
         }

     }

     return $arr;
      
    }


    function saveTask()
    {
        //CODE HERE
        //SQL INSERT
        $title = $_POST['title'];
        $type  = $_POST['typeid'] ;
        $priority = $_POST['priorityid'];
        $status = $_POST['statusid'];
        $date = $_POST['date'];
        $description = $_POST['description'];
        // die() ;
        global $con;
        $query = "INSERT INTO tasks(title,type_id ,priority_id ,status_id ,task_datetime,description) VALUES ('$title' ,'$type','$priority','$status','$date','$description')";

        if (mysqli_query($con, $query)) {
            $_SESSION['message'] = "Task has been added successfully !";
            header('location: index.php');
          } else {
            echo "Error: here eroor " . $query . "<br>" . mysqli_error($con);
          }
        // $_SESSION['message'] = "Task has been added successfully !";
		// header('location: index.php');
    }

    function updateTask()
    {

      
        //CODE HERE
        //SQL UPDATE
        $_SESSION['message'] = "Task has been updated successfully !";
		header('location: index.php');
    }

    function deleteTask()
    {
        //CODE HERE
        //SQL DELETE
        $_SESSION['message'] = "Task has been deleted successfully !";
		header('location: index.php');
    }





?>