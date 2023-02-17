<?php
  require "../inc/dbcon.php";

  function error422($message) {
    $data = [
        'status' => 422,
        'message' => $message
    ];
    header("HTTP/1.0 422 Unprocessable Entity");
    echo(json_encode($data));
    exit();
  }

  function storeName($nameInput) {
    global $conn;
    $name = mysqli_real_escape_string($conn, $nameInput['name']);

    if(empty(trim($name))) {
        return error422("Enter your name");
    } else {
        $query = "INSERT INTO schools(name) VALUES('$name')";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $data = [
                'status' => 201,
                'message' => 'School Created Successfully'
            ];
            header("HTTP/1.0 201 Created");
            return(json_encode($data));

        }else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error'
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return(json_encode($data));
        }
    }
  }

  function getSchoolList() {

    global $conn;
    $query = "SELECT * from schools";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
                $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                $data = [
                    'status' => 200,
                    'message' => 'School List Succesfully',
                    'data' => $res
                ];
                header("HTTP/1.0 200 OK");
                return(json_encode($data));
        } else {
            $data = [
                'status' => 404,
                'message' => 'No School Found'
            ];
            header("HTTP/1.0 404 No School Found");
            return(json_encode($data));    
        }

    } else {
        $data = [
            'status' => 500,
            'message' => 'Internal Server Error'
        ];
        header("HTTP/1.0 500 Internal Server Error");
        return(json_encode($data));
    }

  }

  function getSchool($schoolParams) {
        global $conn;

        if($schoolParams['id'] == null) {
            return error422("Enter school id");
        }

        $schoolId = mysqli_real_escape_string($conn, $schoolParams['id']);
        $query = "SELECT * FROM schools WHERE id='$schoolId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result) {
                if (mysqli_num_rows($result) == 1) {
                        $res = mysqli_fetch_assoc($result);
                        $data = [
                            'status' => 200,
                            'message' => 'School Fetched Successfully',
                            'data' => $res
                        ];
                        header("HTTP/1.0 200 OK");
                        return(json_encode($data));
                } else {
                    $data = [
                        'status' => 404,
                        'message' => 'No school found'
                    ];
                    header("HTTP/1.0 404 Not Found");
                    return(json_encode($data));
                }
        } else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error'
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return(json_encode($data));
        }
  }

  function updateName($nameInput, $nameParams) {
    global $conn;

    if (!isset($nameParams['id'])) {
        return error422("School id is not found");
    } else if ($nameParams['id'] == null) {
        return error422("Enter school id");
    }

    $schoolId = mysqli_real_escape_string($conn, $nameParams['id']);
    $name = mysqli_real_escape_string($conn, $nameInput['name']);

    if(empty(trim($name))) {
        return error422("Enter school name");
    } else {
        $query = "UPDATE schools SET name='$name' WHERE id='$schoolId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $data = [
                'status' => 200,
                'message' => 'School Updated Successfully'
            ];
            header("HTTP/1.0 200 Success");
            return(json_encode($data));

        }else {
            $data = [
                'status' => 500,
                'message' => 'Internal Server Error'
            ];
            header("HTTP/1.0 500 Internal Server Error");
            return(json_encode($data));
        }
    }
  }

  function deleteSchool($nameParams) {
    global $conn;

    if (!isset($nameParams['id'])) {
        return error422("School id is not found");
    } else if ($nameParams['id'] == null) {
        return error422("Enter school id");
    }

    $schoolId = mysqli_real_escape_string($conn, $nameParams['id']);
    $query = "DELETE FROM schools WHERE id='$schoolId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result) {

        $data = [
            'status' => 200,
            'message' => 'School Deleted Succesfully'
        ];
        header("HTTP/1.0 200 OK");
        return(json_encode($data));

    } else {
        $data = [
            'status' => 404,
            'message' => 'School Not Found'
        ];
        header("HTTP/1.0 400 Not Found");
        return(json_encode($data));
    }

  }
?>