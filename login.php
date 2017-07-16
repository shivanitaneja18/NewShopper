 
<?php
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['mobilenumber']) && isset($_POST['password'])) {
 
    // receiving the post params
    $mobilenumber = $_POST['mobilenumber'];
    $password = $_POST['password'];
 
    // get the user by email and password
    $user = $db->getUserByEmailAndPassword($mobilenumber, $password);
 
    if ($user != false) {
        // use is found
        $response["error"] = FALSE;
        //$response["uid"] = $user["unique_id"];
        //$response["user"]["firstname"] = $user["firstname"];
        //$response["user"]["lastname"]=$user["lastname"];
        //$response["user"]["email"] = $user["email"];
        //$response["user"]["created_at"] = $user["created_at"];
        //$response["user"]["updated_at"] = $user["updated_at"];
        $response["user"]="Login Success!";
        echo json_encode($response);
    } else {
        // user is not found with the credentials
        $response["error"] = TRUE;
        $response["error_msg"] = "Login credentials are wrong. Please try again!";
        echo json_encode($response);
    }
} else {
    // required post params is missing
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters email or password is missing!";
    echo json_encode($response);
}
?>
