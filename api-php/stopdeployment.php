<?php
    $id_lead = $_POST['id_lead'];
    //khong xoa deployment ma chi xoa service (giu nguyen deployment)
    shell_exec('sudo bash -c "kubectl delete svc nginx-service-loadbalancer-'.$id_lead.'" 2>&1');    
    //delete lead: set field delete = 1
    $servername = "localhost";
    $username = "root";
    $password = "";
    $db = "infosytemdb";
    // Create connect
    $conn = new mysqli($servername, $username, $password, $db);
    $conn->set_charset("utf8");
    //Check connect
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $sql = "UPDATE leads SET cdelete='1' WHERE id_lead='".$id_lead."'";
    if ($conn->query($sql) === true) {
        echo 'success';
    } else {
        echo 'fail';
    }
    $conn->close();
?>