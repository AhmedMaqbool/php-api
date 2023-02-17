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

  function storeStudent($studentInput) {
    global $conn;
    $name = mysqli_real_escape_string($conn, $studentInput['name']);
    $school_id = mysqli_real_escape_string($conn, $studentInput['school_id']);
    $order_id = mysqli_real_escape_string($conn, $studentInput['order_id']);

    if(empty(trim($name))) {
        return error422("Enter name");
    } else if (empty(trim($school_id))) {
        return error422("Enter School Id");
    } else if (empty(trim($order_id))) {
        return error422("Enter Order id");
    } else {
        $query = "INSERT INTO students(name, school_id, order_id) VALUES('$name', '$school_id', '$order_id')";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $data = [
                'status' => 201,
                'message' => 'Student Created Successfully'
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

  function getStudentList() {

    global $conn;
    $query = "SELECT * from students";
    $query_run = mysqli_query($conn, $query);

    if ($query_run) {

        if (mysqli_num_rows($query_run) > 0) {
                $res = mysqli_fetch_all($query_run, MYSQLI_ASSOC);
                $data = [
                    'status' => 200,
                    'message' => 'Student List Succesfully',
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

  function getStudent($studentParams) {
        global $conn;

        if($studentParams['id'] == null) {
            return error422("Enter student id");
        }

        $studentId = mysqli_real_escape_string($conn, $studentParams['id']);
        $query = "SELECT * FROM students WHERE id='$studentId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if($result) {
                if (mysqli_num_rows($result) == 1) {
                        $res = mysqli_fetch_assoc($result);
                        $data = [
                            'status' => 200,
                            'message' => 'Student Fetched Successfully',
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

  function updateStudent($studentInput, $studentParams) {
    global $conn;

    if (!isset($studentParams['id'])) {
        return error422("Student id is not found");
    } else if ($studentParams['id'] == null) {
        return error422("Enter student id");
    }

    $studentId = mysqli_real_escape_string($conn, $studentParams['id']);
    $name = mysqli_real_escape_string($conn, $studentInput['name']);
    $school_id = mysqli_real_escape_string($conn, $studentInput['school_id']);
    $order_id = mysqli_real_escape_string($conn, $studentInput['order_id']);

    if(empty(trim($name))) {
        return error422("Enter student name");
    } else if (empty(trim($school_id))) {
        return error422("Enter school id");
    } else if (empty(trim($order_id))) {
        return error422("Enter order id");
    } else {
        $query = "UPDATE students SET name='$name', school_id='$school_id', order_id='$order_id' WHERE id='$studentId' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if ($result) {

            $data = [
                'status' => 200,
                'message' => 'Student Updated Successfully'
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

  function deleteStudent($studentParams) {
    global $conn;

    if (!isset($studentParams['id'])) {
        return error422("Student id is not found");
    } else if ($studentParams['id'] == null) {
        return error422("Enter student id");
    }

    $studentId = mysqli_real_escape_string($conn, $studentParams['id']);
    $query = "DELETE FROM students WHERE id='$studentId' LIMIT 1";
    $result = mysqli_query($conn, $query);

    if($result) {

        $data = [
            'status' => 200,
            'message' => 'Student Deleted Succesfully'
        ];
        header("HTTP/1.0 200 OK");
        return(json_encode($data));

    } else {
        $data = [
            'status' => 404,
            'message' => 'Student Not Found'
        ];
        header("HTTP/1.0 400 Not Found");
        return(json_encode($data));
    }

  }
?>