<?php include 'connect-mysql.php';


    $username = $_POST["txtUsername"];
    $password = $_POST["txtPassword"];

    if(isset($username)&&isset($password)) {

        $sql = "SELECT * FROM `member` WHERE Username = '".$username. "' and Password = '".$password. "' ";
        $objQuery = mysqli_query($objCon, $sql);
        $objResult = mysqli_fetch_array($objQuery, MYSQLI_ASSOC);

        echo $sql;

        if($objResult["Username"]==$username&&$objResult["Password"]==($password)){

            session_start();

            $_SESSION["UserID"] = $objResult["UserID"];
            $_SESSION["Status"] = $objResult["Status"];

            session_write_close();

            if($objResult["Status"] == "ADMIN")
            {

                header("location:map.php");
            }
            else
            {
                header("location:data.php");
            }
        }
        else{
            echo "Username and Password Incorrect!";
            header('Location: login.php');
        }
    }
    else{
        echo "Username and Password Incorrect!";
        header('Location: login.php');
    }
?>