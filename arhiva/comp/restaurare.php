<?php 
    session_id("login-session");
    session_start();
    include "../../comp/dbh.php";
    
    $microcip = $_SESSION['microcip'];
    $currentUser = $_SESSION['utilizator'];

    if(isset($_POST['restaurare_btn'])){
       
        $sqlInsertHome = "INSERT INTO catei_tabel (c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar) SELECT c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar FROM catei_tabel_arhiva WHERE c_microcip='$microcip'";
        mysqli_query($conn, $sqlInsertHome);
        $sqlDelete = "DELETE FROM catei_tabel_arhiva WHERE c_microcip='$microcip'";
        mysqli_query($conn, $sqlDelete);


        // reset `data predarii` from `tabel adapost`:
        $sqlDeletePredData = "UPDATE tabel_adapost SET tab_datapredarii='0000-00-00' WHERE tab_serie='$microcip'";
        mysqli_query($conn, $sqlDeletePredData);
    

        // user history
        $currentAction = "A restaurat cainele ".$microcip." din arhiva.";
        $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_arhive) VALUES ('$currentUser', '$currentAction', 1)";
        mysqli_query($conn, $userHistorySql);

        
        header("Location: ../home.php");
    }

?>