<?php 
    session_id("login-session");
    session_start();
    include "dbh.php";
    
    $microcip = $_SESSION['microcip'];

    /*----------------------------
        incepe schimbarea de aici
    ------------------------------ */

    // VARIABLES:
        $c_microcip           = mysqli_real_escape_string($conn, $_POST['c_microcip']);
        $c_identificare       = mysqli_real_escape_string($conn, $_POST['c_identificare']);
        $c_capturare          = mysqli_real_escape_string($conn, $_POST['c_capturare']);
        $c_cazareadapost      = mysqli_real_escape_string($conn, $_POST['c_cazareadapost']);
        $c_caracteristici     = mysqli_real_escape_string($conn, $_POST['c_caracteristici']);
        $c_fsprinsi           = mysqli_real_escape_string($conn, $_POST['c_fsprinsi']);
        $c_fsrevendicati      = mysqli_real_escape_string($conn, $_POST['c_fsrevendicati']);
        $c_fsadoptati         = mysqli_real_escape_string($conn, $_POST['c_fsadoptati']);
        $c_cmentinuti         = mysqli_real_escape_string($conn, $_POST['c_cmentinuti']);
        $c_cadoptati          = mysqli_real_escape_string($conn, $_POST['c_cadoptati']);
        $c_eutanasiati        = mysqli_real_escape_string($conn, $_POST['c_eutanasiati']);
        $c_motiveutan         = mysqli_real_escape_string($conn, $_POST['c_motiveutan']);
        $c_substeutan         = mysqli_real_escape_string($conn, $_POST['c_substeutan']);
        $c_numperseutan       = mysqli_real_escape_string($conn, $_POST['c_numperseutan']);
        $c_nrfisaadoptie      = mysqli_real_escape_string($conn, $_POST['c_nrfisaadoptie']);
        $c_depsivacc          = mysqli_real_escape_string($conn, $_POST['c_depsivacc']);
        $c_steril             = mysqli_real_escape_string($conn, $_POST['c_steril']);
        $c_persmanopera       = mysqli_real_escape_string($conn, $_POST['c_persmanopera']);
        $c_decedati           = mysqli_real_escape_string($conn, $_POST['c_decedati']);

    if(isset($_POST['salvare-tabAdapost'])){

        if(!empty($c_microcip)){
            $sql = "UPDATE catei_tabel SET c_microcip='$c_microcip' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_identificare)){
            $sql = "UPDATE catei_tabel SET c_identificare='$c_identificare' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_cazareadapost)){
            $sql = "UPDATE catei_tabel SET c_cazareadapost='$c_cazareadapost' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_caracteristici)){
            $sql = "UPDATE catei_tabel SET c_caracteristici='$c_caracteristici' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_fsprinsi)){
            $sql = "UPDATE catei_tabel SET c_fsprinsi='$c_fsprinsi' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_fsrevendicati)){
            $sql = "UPDATE catei_tabel SET c_fsrevendicati='$c_fsrevendicati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_fsadoptati)){
            $sql = "UPDATE catei_tabel SET c_fsadoptati='$c_fsadoptati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(isset($c_cmentinuti)){
            $sql = "UPDATE catei_tabel SET c_cmentinuti='$c_cmentinuti' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_eutanasiati)){
            $sql = "UPDATE catei_tabel SET c_eutanasiati='$c_eutanasiati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_motiveutan)){
            $sql = "UPDATE catei_tabel SET c_motiveutan='$c_motiveutan' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_substeutan)){
            $sql = "UPDATE catei_tabel SET c_substeutan='$c_substeutan' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {} 
        if(!empty($c_fsadoptati)){
            $sql = "UPDATE catei_tabel SET c_fsadoptati='$c_fsadoptati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(isset($c_numperseutan)){
            $sql = "UPDATE catei_tabel SET c_numperseutan='$c_numperseutan' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_nrfisaadoptie)){
            $sql = "UPDATE catei_tabel SET c_nrfisaadoptie='$c_nrfisaadoptie' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
            $sql2 = "UPDATE tabel_adapost SET tab_nrfisa='$c_nrfisaadoptie' WHERE tab_nrident='$microcip'";
            mysqli_query($conn, $sql2);
        } else {}
        if(!empty($c_depsivacc)){
            $sql = "UPDATE catei_tabel SET c_depsivacc='$c_depsivacc' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_steril)){
            $sql = "UPDATE catei_tabel SET c_steril='$c_steril' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(!empty($c_persmanopera)){
            $sql = "UPDATE catei_tabel SET c_persmanopera='$c_persmanopera' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}
        if(isset($c_decedati)){
            $sql = "UPDATE catei_tabel SET c_decedati='$c_decedati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
        } else {}

        

            
        

        header("Location: ../details.php?microcip=".$microcip."");  
    } elseif(isset($_POST['anulare-tabAdapost'])){
        header("Location: ../details.php?microcip=".$microcip."");
    }


?>