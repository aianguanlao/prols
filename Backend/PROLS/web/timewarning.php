<?php
    //LOCAL
        $port = "";
        $host = "127.0.0.1";
        $db = 'prols';
        $user = "root";
        $pwd = "";

        $pdo = new PDO(
            'mysql:host='.$host.';port='.$port.';dbname='.$db,
            $user,
            $pwd,
            array(
                PDO::ATTR_PERSISTENT => false
            )
        );

        if (!$pdo) {
            die ("Could not connect to database!\n");
            exit;
        }

        // $query = "SELECT password FROM emp_acc WHERE password='admin'";
        date_default_timezone_set('Asia/Manila');
        $current_date = date('Y-m-d');
        $current_time = date('H:i:s');

        $query = "SELECT cast(time_in as time) FROM emp_time WHERE DATE(date) = '$current_date'";
        $sql = $pdo->prepare($query);
        $sql->execute();
        $dataTimeIn = $sql->fetchAll(PDO::FETCH_ASSOC);

        $query = "SELECT cast(time_out as time) FROM emp_time WHERE DATE(date) = '$current_date'";
        $sql = $pdo->prepare($query);
        $sql->execute();
        $dataTimeOut = $sql->fetchAll(PDO::FETCH_ASSOC);


        for ($ct = 0; $ct < sizeof($dataTimeIn); $ct++) {
            if($dataTimeOut[$ct]['cast(time_out as time)'] == NULL){
                $timeIn = $dataTimeIn[$ct]['cast(time_in as time)'];
                echo '<br>';
                $interval = $current_time->sub($timeIn);
                echo '<br>';
                echo '<br>';
            }
        }

        echo $dataTimeIn[0]['cast(time_in as time)'];
        echo '<br>';
        echo $dataTimeIn[1]['cast(time_in as time)'];
        echo '<br>';
        echo $dataTimeIn[2]['cast(time_in as time)'];
        echo '<br>';
        echo $dataTimeIn[3]['cast(time_in as time)'];
        echo '<br>';
        echo '<br>';

        echo $dataTimeOut[0]['cast(time_out as time)'];
        echo '<br>';
        echo $dataTimeOut[1]['cast(time_out as time)'];
        echo '<br>';
        echo $dataTimeOut[2]['cast(time_out as time)'];
        echo '<br>';
        echo $dataTimeOut[3]['cast(time_out as time)'];
        echo '<br>';
        echo '<br>';


        if($dataTimeOut[3]['time_out'] == NULL){
            printf("yes ");
        }
        // echo $dataTimeIn;

        // if ($data) {
        //     // include('swiftmailer.php');
        // }
        // var_dump($data);

        // $query2 = "UPDATE emp_acc SET password='superadmin' WHERE password='admin'";
        // $sql = $pdo->prepare($query2);
        // $sql->execute();
?>