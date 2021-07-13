<?php 
    $id_lead = $_POST['id_lead'];
    // var_dump(shell_exec('sudo bash -c "kubectl apply -k /opt/lampp/htdocs/dangkydungthu/api-php/deployments/'.$id_lead.'" 2>&1'));
    // echo shell_exec('sudo bash -c "kubectl apply -f /opt/lampp/htdocs/dangkydungthu/api-php/deployments/'.$id_lead.'/'.$id_lead.'-dotbrose.yml" 2>&1');    
    echo shell_exec('sudo bash -c "kubectl apply -f /opt/lampp/htdocs/dangkydungthu/api-php/deployments/'.$id_lead.'" 2>&1');
?>