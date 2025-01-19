<?php
    session_start();
    require_once('../model/messagesModel.php');
    if(!isset($_REQUEST['submit']))
    {
        header("location: ../view/contractUs.php");
    }

    $name= $_REQUEST['username'];
    $email= $_REQUEST['email'];
    $message= $_REQUEST['message'];
    $status=false;
    $condition= insert_message($name,$email,$message,$status);
    if($condition == true)
    {
        ?>
        <html>
            <head></head>
            <body>
                <form onsubmit="return print()"></form>
                <script>
                    function print()
                    {
                        alert("Successfully Submited");
                    }
                    
                </script>
            </body>
        </html>
      <?php
        header("location:../view/contractUs.php");
    }
     else
    {
        ?>
        <html>
            <head></head>
            <body>
                <script>
                    alert("Wrong submition !!! Try Again");
                </script>
            </body>
        </html>
      <?php
        header("location:../view/contractUs.php");
    }

?>
