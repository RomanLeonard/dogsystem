<?php 
    session_id("login-session");
    session_start();
    include "../../comp/dbh.php";
    
    $microcip = $_SESSION['microcip'];
    $currentUser = $_SESSION['utilizator'];
    $tosinsertMicrocip = $microcip;
    
    if(isset($_POST['stergere'])){
        $sql = "DELETE FROM details WHERE det_serie='$microcip'";
        mysqli_query($conn, $sql);
        $sql2 = "DELETE FROM catei_tabel_arhiva WHERE c_microcip='$microcip'";
        mysqli_query($conn, $sql2);
        $sql3 = "DELETE FROM specific_details WHERE spec_serie='$microcip'";
        mysqli_query($conn, $sql3);
        $sql4 = "DELETE FROM tabel_adapost WHERE tab_serie='$microcip'";
        mysqli_query($conn, $sql4);


        // user history 
        $currentAction = "A sters complet cainele ".$microcip.".";
        $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_arhive) VALUES ('$currentUser', '$currentAction', 1)";
        mysqli_query($conn, $userHistorySql);

        header("Location: ../home.php");
    }

    elseif(isset($_POST['btn_imp_restaurare'])){   

        $sqlInsert = "INSERT INTO catei_tabel (c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati) SELECT c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati FROM catei_tabel_a_adopted WHERE c_microcip='$microcip'";
        mysqli_query($conn, $sqlInsert);
        
        $sqlDel = "DELETE FROM catei_tabel_a_adopted WHERE c_microcip='$microcip'";
        mysqli_query($conn, $sqlDel);



        // user history 
        $currentAction = "A restaurat cainele ".$microcip." din arhiva.";
        $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_arhive) VALUES ('$currentUser', '$currentAction', 1)";
        mysqli_query($conn, $userHistorySql);


        header("Location: ../details.php?microcip=".$microcip."");
    }

?>