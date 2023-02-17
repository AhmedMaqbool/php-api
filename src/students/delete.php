<?php
     error_reporting(0);

     header('Access-Control-Allow-Origin:*');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Method: DELETE');
     header('Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Request-With');
    
     include('function.php');

     $requestMethod = $_SERVER["REQUEST_METHOD"];
     $token = null;
     $headers = apache_request_headers();

    if ($headers['Authorization'] !== "ADMIN") {
    $data = [
        'status' => 401,
        'message' => 'Unauthorized'
    ];
    header("HTTP/1.0 401 Unauthorized");
    echo(json_encode($data));
    }

    else if ($requestMethod == "DELETE") {
         $deleteStudent = deleteStudent($_GET);
         echo $deleteStudent;

     } else {

        $data = [
            'status' => 405,
            'message' => $requestMethod. 'Method not allowed'
        ];
        header("HTTP/1.0 405 Method Not Allowed");
        echo(json_encode($data));
     }
?>