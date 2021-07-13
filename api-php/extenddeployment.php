<?php
    $id_lead = $_POST['id_lead'];
    //tao moi service tu deployment co san (truoc do)
    shell_exec('sudo bash -c "kubectl apply -f /opt/lampp/htdocs/dangkydungthu/api-php/deployments/'.$id_lead.'/'.$id_lead.'-service-dotbrose.yml" 2>&1');
    //update status lead: delete = 0
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
    $sql = "UPDATE leads SET cdelete='0' WHERE id_lead='".$id_lead."'";
    if ($conn->query($sql) === true) {
        echo 'success';
    } else {
        echo 'fail';
    }
    $conn->close();
?>