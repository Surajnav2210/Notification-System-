<?php
include('connect.php');

if (isset($_POST['view'])) {
    if ($_POST["view"] != '') {
        $update_query = "UPDATE users SET userStatus = 1 WHERE userStatus=0";
        mysqli_query($con, $update_query);
    }

    $query = "SELECT * FROM users ORDER BY id DESC LIMIT 5";
    $result = mysqli_query($con, $query);
   
     // Add a div with max-height and scroll properties
    $output = '<div style="margin:4px, 4px;
    padding:4px;
    background-color: light blue;
    width: 500px;
    height: 110px;
    overflow-x: hidden;
    overflow-y: auto;
    text-align:justify;"
                
            ><ul>';
    

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output .= '
            <li>
            <a href="#">
        
            <strong>' . $row["name"] . '</strong><br />
            <small><em>' . $row["email"] . '</em></small>
            <small><em>' . $row["subject"] . '</em></small>
            <small><em>' . $row["comments"] . '</em></small>
            <small><em>' . $row["gender"] . '</em></small>
            </a>
            </li>
        ';
        
        }
    } else {
        $output .= '<li><a href="#" class="text-bold text-italic">No Notification Found</a></li>';
    }

    $output .= '</ul></div>'; // Close the div
    $status_query = "SELECT * FROM users WHERE userStatus=0";
    $result_query = mysqli_query($con, $status_query);
    $count = mysqli_num_rows($result_query);

    // Get the success message from the session, if it exists
    $successMessage = $_SESSION['successMessage'] ?? '';

    // Unset the success message from the session after including it in the AJAX response
    

    $data = array(
        'notification' => $output,
        'unseen_notification' => $count,
    );

    echo json_encode($data);
}
?>
