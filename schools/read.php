<?php
     header('Access-Control-Allow-Origin:*');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Method: GET');
     header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
    
     include('function.php');

     $requestMethod = $_SERVER["REQUEST_METHOD"];

     if ($requestMethod == "GET") {

        if (isset($_GET['id'])) {
         $school = getSchool($_GET);
         echo $school;
        } else {
         $schoolList = getSchoolList();
         echo $schoolList;
        }

     } else {

        $data = [
            'status' => 405,
            'message' => $requestMethod. 'Method not allowed'
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo(json_encode($data));
     }
?>