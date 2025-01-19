<?php
    function getconn()
    {
        $conn = mysqli_connect('127.0.0.1', 'root', '', 'study_compass');
        return $conn;
    }

    function insert_message ($name,$email,$message,$status)
    {
        $conn=getconn();
        $sql= "INSERT INTO messages (username, email, message, status) 
        VALUES ('$name', '$email', '$message', '$status')";
        $result=mysqli_query($conn,$sql);

        if($result==1) return true;
        else return false;

    }
    function delete_message($message_id)
    {
        $conn=getconn();
        $sql= "DELETE FROM messages WHERE message_id = $message_id";
        $result=mysqli_query($conn,$sql);

        if($result==1) return true;
        else return false;
    }

    function reply_messege($message_id)
    {
        $conn=getconn();
        $sql= "UPDATE messages SET status = 1 WHERE message_id = $message_id";
        $result=mysqli_query($conn,$sql);

        if($result==1) return true;
        else return false;
    }

    function get_messages()
    {
    $conn = getconn();
    $sql = "SELECT * FROM messages WHERE status=0 ";
    $result = mysqli_query($conn, $sql);
    $messages = [];

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $messages[] = $row;
        }
        return $messages;
    }
    }

    function get_message($message_id)
    {
    $conn = getconn();
    $sql = "SELECT * FROM messages WHERE message_id=$message_id ";
    $result = mysqli_query($conn, $sql);
    $message = mysqli_fetch_assoc($result);

        return $message;
    }

?>