 
<?php
 
require_once 'DB_Functions.php';
$db = new DB_Functions();
 
// json response array
$response = array("error" => FALSE);
 
if (isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['mobilenumber']) && isset($_POST['city']) && isset($_POST['gcmid'])) {
 
    // receiving the post params
    $firstname = $_POST['firstname'];
    $lastname=$_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $mobilenumber=$_POST['mobilenumber'];
    $city=$_POST['city'];
    $gcmid=$_POST['gcmid'];
 
    // check if user is already existed with the same email
    if ($db->isUserExisted($mobilenumber)) {
        // user already existed
        $response["error"] = TRUE;
        $response["error_msg"] = "User already existed with " . $mobilenumber;
        echo json_encode($response);
    } else {
        // create a new user
        $user = $db->storeUser($firstname,$lastname,$email,$password,$mobilenumber,$city,$gcmid);
        if ($user) {
            // user stored successfully
            $response["error"] = FALSE;
            //$response["uid"] = $user["unique_id"];
            //$response["user"]["firstname"] = $user["firstname"];
            //$response["user"]["lastname"]=$user["lastname"];
            //$response["user"]["email"] = $user["email"];
            //$response["user"]["mobilenumber"]=$user["mobilenumber"];
            //$response["user"]["city"]=$user["city"];
            //$response["user"]["created_at"] = $user["created_at"];
            //$response["user"]["updated_at"] = $user["updated_at"];
            $response["user"]="Successfully Registered!";
            echo json_encode($response);
        } else {
            // user failed to store
            $response["error"] = TRUE;
            $response["error_msg"] = "Unknown error occurred in registration!";
            echo json_encode($response);
        }
    }
} else {
    $response["error"] = TRUE;
    $response["error_msg"] = "Required parameters (name, email or password) is missing!";
    echo json_encode($response);
}
?>
