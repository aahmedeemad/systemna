<?php
include('../DB/Database.php'); /* Including the DB */
$DB = new Database(); /* Making a DB object */

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(isset($_POST['type']) && $_POST['type'] == "reset")
    {
        try {
            $mail = filter_var($_POST['mail'], FILTER_SANITIZE_EMAIL);
            $password = $_POST['NewPass'];
            $sql = " SELECT * FROM employee WHERE email = '$mail' ";
            $DB->query($sql);
            $DB->execute();
            if($DB->numRows() > 0)
            {
                $sql = " UPDATE employee SET password = '" . sha1($password) . "' WHERE email = '$mail' ";
                $DB->query($sql);
                $DB->execute();
                echo "True";
            }
            else
            {
                echo "<script>alert('This email is invaild !');</script>";
            }
        }
        catch(Exception $e)
        {
            echo "<div class='alert alert-danger'>Error please try again later</div>";
            error_log("error while resettin user password");
        }
    }
}
else
{
    header("location: ../index.php"); /* Redirecting to mainpage if the user tried to get into this page without 'POST' method */
}
?>