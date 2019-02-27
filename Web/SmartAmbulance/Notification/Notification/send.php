     <?php
        // Enabling error reporting
        error_reporting(-1);
        ini_set('display_errors', 'On');
 
        require_once __DIR__ . '/Firebase.php';
        require_once __DIR__ . '/push.php';
 
        $firebase = new Firebase();
        $push = new Push();
 
        // optional payload
        $payload = array();
        $payload['team'] = 'India';
        $payload['score'] = '5.6';
 
        // notification title
        $title = 'Alert Incoming patient';
         
        // notification message
        $message = mysqli_real_escape_string($con,$_GET['message']);
         
        // push type - single user / topic
        $push_type = 'topic';
         
        // whether to include to image or not
        $include_image = isset($_GET['include_image']) ? TRUE : FALSE;
 
 
        $push->setTitle($title);
        $push->setMessage($message);
        if ($include_image) {
            $push->setImage('https://api.androidhive.info/images/minion.jpg');
        } else {
            $push->setImage('htpp;//');
        }
        $push->setIsBackground(FALSE);
        $push->setPayload($payload);
 
 
        $json = '';
        $response = '';
 
        if ($push_type == 'topic') {
            $json = $push->getPush();
            $response = $firebase->sendToTopic('global', $json);
        } else if ($push_type == 'individual') {
            $json = $push->getPush();
            $regId = isset($_GET['regId']) ? $_GET['regId'] : '';
            $response = $firebase->send($regId, $json);
        }
        ?>