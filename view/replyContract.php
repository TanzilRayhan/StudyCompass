<?php
require_once('../model/messagesModel.php');
if(!isset($_COOKIE['admin']))
{
    header("location: ../view/login.php");
}
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if (!$id) {
    echo "Notification ID is missing!";
    exit();
}


$message=get_message($id);

if (!$message) {
    echo "Contract not found!";
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>StudyCompass - Home</title>
</head>

<body>
  
<a href="home.php" style="text-align : center;text-decoration: none;">StudyCompass</a>
   
    
            <h2>Contract Response</h2>
            <form method="post" action="../controller/sendContract.php" onsubmit="return check()">
                
                <input type="hidden" name="id" value="<?= $message['message_id'] ?>">
                        
                Username: <input type="text" name="username" value="<?= ($message['username']) ?>" required></br>
                Email:<input type="email" name="email" value="<?= ($message['email']) ?>" required></br>
                <fieldset>
                <legend>Message</legend>
                <textarea name="message" id="message" style="width: 100%; height:100px"><?= ($message['message']) ?></textarea>
                </fieldset>
                <fieldset>
                <legend>Response</legend>
                <textarea name="response" id="response" style="width: 100%; height:100px"></textarea>
                </fieldset>

                <input  name="submit" type="submit" value="Send"></br>
               
            </form>
             <a href="adminDashboard.php" style="text-align : center;text-decoration: none;">Dashboard</a>
            <script>
        function check()
        {
            let message=document.getElementById('response').value;
            if(message.trim()=="")
            {
                alert("Insert Your Response First")
                return false;
            }
            else return true;
            
        }
    </script>
</body>

</html>
