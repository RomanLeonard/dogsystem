<?php
    session_id("login-session");
    session_start();
    include "dbh.php";


if(isset($_POST['adauga'])){

    /* tabel principal */
    $c_microcip = mysqli_real_escape_string($conn, $_POST['c_microcip']);
    $c_identificare = mysqli_real_escape_string($conn, $_POST['c_identificare']);
    $c_datacapt = mysqli_real_escape_string($conn, $_POST['c_datacapt']);
    $c_loccapt = mysqli_real_escape_string($conn, $_POST['c_loccapt']);
    $c_datcazare = mysqli_real_escape_string($conn, $_POST['c_datcazare']);
    $c_caracteristici = mysqli_real_escape_string($conn, $_POST['c_caracteristici']);
    $c_fsprinsi = mysqli_real_escape_string($conn, $_POST['c_fsprinsi']);
    $c_fsrevendicati = mysqli_real_escape_string($conn, $_POST['c_fsrevendicati']);
    $c_fsadoptati = mysqli_real_escape_string($conn, $_POST['c_fsadoptati']);
    $c_cmentinuti = mysqli_real_escape_string($conn, $_POST['c_cmentinuti']);
    $c_cadoptati = mysqli_real_escape_string($conn, $_POST['c_cadoptati']);
    $c_eutanasiati = mysqli_real_escape_string($conn, $_POST['c_eutanasiati']);
    $c_motiveutan = mysqli_real_escape_string($conn, $_POST['c_motiveutan']);
    $c_substeutan = mysqli_real_escape_string($conn, $_POST['c_substeutan']);
    $c_numperseutan = mysqli_real_escape_string($conn, $_POST['c_numperseutan']);
    $c_nrfisaadoptie = mysqli_real_escape_string($conn, $_POST['c_nrfisaadoptie']);
    $c_datdeparazit = mysqli_real_escape_string($conn, $_POST['c_datdeparazit']);
    $c_datvacc = mysqli_real_escape_string($conn, $_POST['c_datvacc']);
    $c_steril = mysqli_real_escape_string($conn, $_POST['c_steril']);
    $c_persmanopera = mysqli_real_escape_string($conn, $_POST['c_persmanopera']);
    $c_decedati = mysqli_real_escape_string($conn, $_POST['c_decedati']);
    $c_proprietar = mysqli_real_escape_string($conn, $_POST['c_proprietar']);

    /* tabel detaliat */
    $det_nume = mysqli_real_escape_string($conn, $_POST['det_nume']);
    $det_nrmatricol = mysqli_real_escape_string($conn, $_POST['det_nrmatricol']);
    $det_tronson = mysqli_real_escape_string($conn, $_POST['det_tronson']);
    $det_cusca = mysqli_real_escape_string($conn, $_POST['det_cusca']);
    $det_varsta = mysqli_real_escape_string($conn, $_POST['det_varsta']);
    $det_sex = mysqli_real_escape_string($conn, $_POST['det_sex']);
    $det_culoare = mysqli_real_escape_string($conn, $_POST['det_culoare']);
    $det_semnpartic = mysqli_real_escape_string($conn, $_POST['det_semnpartic']);
    $det_sterilizat = mysqli_real_escape_string($conn, $_POST['det_sterilizat']);
    $det_observatii = mysqli_real_escape_string($conn, $_POST['det_observatii']);
    /* imagini */
        $hasImg = 0;
        $file = $_FILES['img'];
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];
        $fileExt = explode('.', $fileName);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = array('jpg', 'jpeg', 'png');

        if(!empty($file)){
            if(in_array($fileActualExt, $allowed)){
                if($fileError === 0){
                    if($fileSize < 100000000){
                        $fileNameNew = "dog".$c_microcip.".".$fileActualExt;
                        $fileDestination = '../uploads/'.$fileNameNew;
                        move_uploaded_file($fileTmpName, $fileDestination);
                        $hasImg = 1;
                    } else {
                        echo "Fisierul este prea mare ca sa poata fi incarcat pe server.";
                        
                    }
                } else {
                echo "A aparut o eroare. Code: img-01";
                } 
            }
        } else {
            $hasImg = 0;
            echo "Acest tip de fisier nu este acceptat.";   
        }
    
    /* tabel adapost */
    $tab_medic = mysqli_real_escape_string($conn, $_POST['tab_medic']);
    $tab_datapredarii = mysqli_real_escape_string($conn, $_POST['tab_datapredarii']);
    

    if($_POST['c_microcip'] > 0 || $_POST['c_identificare'] > 0){
        $sql = "INSERT INTO catei_tabel (c_microcip, c_identificare, c_datacapt, c_loccapt, c_datcazare, c_caracteristici, c_fsprinsi, c_fsrevendicati, c_fsadoptati, c_cmentinuti, c_cadoptati, c_eutanasiati, c_motiveutan, c_substeutan, c_numperseutan, c_nrfisaadoptie, c_datdeparazit, c_datvacc, c_steril, c_persmanopera, c_decedati, c_proprietar) VALUES ('$c_microcip', '$c_identificare', '$c_datacapt', '$c_loccapt', '$c_datcazare', '$c_caracteristici', '$c_fsprinsi', '$c_fsrevendicati', '$c_fsadoptati', '$c_cmentinuti', '$c_cadoptati', '$c_eutanasiati', '$c_motiveutan', '$c_substeutan', '$c_numperseutan', '$c_nrfisaadoptie', '$c_datdeparazit', '$c_datvacc', '$c_steril', '$c_persmanopera', '$c_decedati', '$c_proprietar');";
        mysqli_query($conn, $sql);
                                            
        $sql1 = "INSERT INTO details (det_serie, det_nume, det_img, det_nrmatricol, det_tronson, det_cusca, det_varsta, det_sex, det_culoare, det_semnpartic, det_observatii) VALUES ('$c_microcip', '$det_nume', '$hasImg', '$det_nrmatricol', '$det_tronson', '$det_cusca', '$det_varsta', '$det_sex', '$det_culoare', '$det_semnpartic', '$det_observatii');";
        mysqli_query($conn, $sql1);

        $sql2 = "INSERT INTO tabel_adapost (tab_serie, tab_data, tab_datacazarii, tab_caracteristici, tab_nrcprinsi, tab_nrcrevendic, tab_nrcadopt, tab_nrcmentin, tab_nrcdecedati, tab_motiv, tab_nrident, tab_nrfisa, tab_datavacc, tab_datadeparat, tab_datasteriliz, tab_medic, tab_datapredarii) VALUES ('$c_microcip', '$c_datacapt', '$c_datcazare', '$c_caracteristici', '$c_fsprinsi', '$c_fsrevendicati', '$c_fsadoptati', '$c_cmentinuti', '$c_decedati', '$c_motiveutan', '$c_microcip', '$c_nrfisaadoptie', '$c_datvacc', '$c_datdeparazit', '$c_steril', '$tab_medic', '$tab_datapredarii');";
        mysqli_query($conn, $sql2);
        
        
        // user history
        $currentUser = $_SESSION['utilizator'];
        $currentAction = "A adaugat cainele ".$c_microcip.".";
        $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_add) VALUES ('$currentUser', '$currentAction', 1)";
        mysqli_query($conn, $userHistorySql);

        header("Location: ../adauga.php?success");
    }  else {
        header("Location: ../adauga.php?error");
    }

} elseif(isset($_POST['anuleaza'])){
    header("Location: ../adauga.php");
}

?>