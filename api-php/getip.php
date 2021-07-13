<?php
    $id_lead = $_POST['id_lead_same'];
    $external_ip = shell_exec('sudo bash -c "kubectl get svc nginx-service-loadbalancer-'.$id_lead.' -o=jsonpath="{.status.loadBalancer.ingress[0].hostname}""');
    //update external ip vao database file domain
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
    $sql = "UPDATE leads SET domain='".$external_ip."' WHERE id_lead='".$id_lead."'";
    if ($conn->query($sql) === true) {
        echo 'success';
    } else {
        echo 'error';
    }
    $conn->close();
    // echo ('sudo bash -c "kubectl  get svc nginx-service-loadbalancer-'.$id_lead.' -o=jsonpath="{.status.loadBalancer.ingress[0].hostname}""');
?>