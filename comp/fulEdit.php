<?php 
    session_id("login-session");
    session_start();
    include "dbh.php";
    
    $microcip = $_SESSION['microcip'];
    $currentUser = $_SESSION['utilizator'];

    // INITIAL VARIABLES: 
        $c_microcip_initial = '';
        $c_identificare_initial = '';
        $c_datacapt_initial = '';
        $c_loccapt_initial = ''; 
        $c_datcazare_initial = '';  
        $c_caracteristici_initial = '';
        $c_fsprinsi_initial = '';  
        $c_fsrevendicati_initial= '';   
        $c_fsadoptati_initial = '';
        $c_cmentinuti_initial = '';
        $c_cadoptati_initial = ''; 
        $c_eutanasiati_initial = '';
        $c_motiveutan_initial = '';   
        $c_substeutan_initial = '';   
        $c_numperseutan_initial = '';
        $c_nrfisaadoptie_initial = '';
        $c_datdeparazit_initial = '';
        $c_datvacc_initial = '';   
        $c_steril_initial = '';        
        $c_persmanopera_initial = '';  
        $c_decedati_initial = '';
    // INITIAL VALUES INCREMENT
    $sqlInitialValue = "SELECT * FROM catei_tabel WHERE c_microcip='$microcip'";
    $resultInitialValue = mysqli_query($conn, $sqlInitialValue);
    while($initialValue = mysqli_fetch_assoc($resultInitialValue)){
        $c_microcip_initial = $initialValue['c_microcip'];
        $c_identificare_initial = $initialValue['c_identificare'];     
        $c_datacapt_initial = $initialValue['c_datacapt'];        
        $c_loccapt_initial = $initialValue['c_loccapt'];         
        $c_datcazare_initial = $initialValue['c_datcazare'];         
        $c_caracteristici_initial = $initialValue['c_caracteristici'];  
        $c_fsprinsi_initial = $initialValue['c_fsprinsi'];       
        $c_fsrevendicati_initial = $initialValue['c_fsrevendicati'];    
        $c_fsadoptati_initial = $initialValue['c_fsadoptati'];  
        $c_cmentinuti_initial = $initialValue['c_cmentinuti'];  
        $c_cadoptati_initial = $initialValue['c_cadoptati'];    
        $c_eutanasiati_initial = $initialValue['c_eutanasiati'];   
        $c_motiveutan_initial = $initialValue['c_motiveutan'];     
        $c_substeutan_initial = $initialValue['c_substeutan'];      
        $c_numperseutan_initial = $initialValue['c_numperseutan']; 
        $c_nrfisaadoptie_initial = $initialValue['c_nrfisaadoptie'];  
        $c_datdeparazit_initial = $initialValue['c_datdeparazit'];   
        $c_datvacc_initial = $initialValue['c_datvacc'];      
        $c_steril_initial = $initialValue['c_steril'];          
        $c_persmanopera_initial = $initialValue['c_persmanopera'];   
        $c_decedati_initial = $initialValue['c_decedati'];  
    }


    // VARIABLES:
        $c_microcip           = mysqli_real_escape_string($conn, $_POST['c_microcip']);
        $c_identificare       = mysqli_real_escape_string($conn, $_POST['c_identificare']);
        $c_datacapt           = mysqli_real_escape_string($conn, $_POST['c_datacapt']);
        $c_loccapt            = mysqli_real_escape_string($conn, $_POST['c_loccapt']);
        $c_datcazare          = mysqli_real_escape_string($conn, $_POST['c_datcazare']);
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
        $c_datdeparazit       = mysqli_real_escape_string($conn, $_POST['c_datdeparazit']);
        $c_datvacc            = mysqli_real_escape_string($conn, $_POST['c_datvacc']);
        $c_steril             = mysqli_real_escape_string($conn, $_POST['c_steril']);
        $c_persmanopera       = mysqli_real_escape_string($conn, $_POST['c_persmanopera']);
        $c_decedati           = mysqli_real_escape_string($conn, $_POST['c_decedati']);

        // variables for history
        $c_microcip_user_hostory       = false;
        $c_identificare_user_hostory   = false;
        $c_datacapt_user_hostory       = false;
        $c_loccapt_user_hostory        = false;
        $c_datcazare_user_hostory      = false;
        $c_caracteristici_user_hostory = false;
        $c_fsprinsi_user_hostory       = false;
        $c_fsrevendicati_user_hostory  = false;
        $c_fsadoptati_user_hostory     = false;
        $c_cmentinuti_user_hostory     = false;
        $c_cadoptati_user_hostory      = false;
        $c_eutanasiati_user_hostory    = false;
        $c_motiveutan_user_hostory     = false;
        $c_substeutan_user_hostory     = false;
        $c_numperseutan_user_hostory   = false;
        $c_nrfisaadoptie_user_hostory  = false;
        $c_datdeparazit_user_hostory   = false;
        $c_datvacc_user_hostory        = false;
        $c_steril_user_hostory         = false;  
        $c_persmanopera_user_hostory   = false;
        $c_decedati_user_hostory       = false; 

    if(isset($_POST['full_save'])){

        if(!empty($c_microcip)){
            $sql = "UPDATE catei_tabel SET c_microcip='$c_microcip' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_microcip_user_hostory = true; $c_identificare_user_hostory = true;
        } else {}
        if(!empty($c_datacapt)){
            $sql = "UPDATE catei_tabel SET c_datacapt='$c_datacapt' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_datacapt_user_hostory = true;
        } else {}
        if(!empty($c_loccapt)){
            $sql = "UPDATE catei_tabel SET c_loccapt='$c_loccapt' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_loccapt_user_hostory = true;
        } else {}
        if(!empty($c_datcazare)){
            $sql = "UPDATE catei_tabel SET c_datcazare='$c_datcazare' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $sql1 = "UPDATE tabel_adapost SET tab_datacazarii='$c_datcazare' WHERE tab_serie='$microcip'";
            mysqli_query($conn, $sql1);

            $c_datcazare_user_hostory = true;
        } else {}
        if(!empty($c_caracteristici)){
            $sql = "UPDATE catei_tabel SET c_caracteristici='$c_caracteristici' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $sql1 = "UPDATE tabel_adapost SET tab_caracteristici='$c_caracteristici' WHERE tab_serie='$microcip'";
            mysqli_query($conn, $sql1);

            $c_caracteristici_user_hostory = true;
        } else {}
        if(!empty($c_fsprinsi)){
            $sql = "UPDATE catei_tabel SET c_fsprinsi='$c_fsprinsi' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_fsprinsi_user_hostory = true;
        } else {}
        if(!empty($c_fsrevendicati)){
            $sql = "UPDATE catei_tabel SET c_fsrevendicati='$c_fsrevendicati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_fsrevendicati_user_hostory = true;
        } else {}
        if(!empty($c_fsadoptati)){
            $sql = "UPDATE catei_tabel SET c_fsadoptati='$c_fsadoptati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_fsadoptati_user_hostory=true;
        } else {}
        if(isset($c_cmentinuti)){
            $sql = "UPDATE catei_tabel SET c_cmentinuti='$c_cmentinuti' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_cmentinuti_user_hostory=true;
        } else {}
        if(!empty($c_eutanasiati)){
            $sql = "UPDATE catei_tabel SET c_eutanasiati='$c_eutanasiati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_eutanasiati_user_hostory=true;
        } else {}
        if(!empty($c_motiveutan)){
            $sql = "UPDATE catei_tabel SET c_motiveutan='$c_motiveutan' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_motiveutan_user_hostory=true;
        } else {}
        if(!empty($c_substeutan)){
            $sql = "UPDATE catei_tabel SET c_substeutan='$c_substeutan' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_substeutan_user_hostory=true;
        } else {} 
        if(isset($c_numperseutan)){
            $sql = "UPDATE catei_tabel SET c_numperseutan='$c_numperseutan' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_numperseutan_user_hostory=true;
        } else {}
        if(!empty($c_nrfisaadoptie)){
            $sql = "UPDATE catei_tabel SET c_nrfisaadoptie='$c_nrfisaadoptie' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
            $sql2 = "UPDATE tabel_adapost SET tab_nrfisa='$c_nrfisaadoptie' WHERE tab_nrident='$microcip'";
            mysqli_query($conn, $sql2);

            $c_nrfisaadoptie_user_hostory=true;
        } else {}
        if(!empty($c_datdeparazit)){
            $sql = "UPDATE catei_tabel SET c_datdeparazit='$c_datdeparazit' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
            $sql1 = "UPDATE tabel_adapost SET tab_datadeparat='$c_datdeparazit' WHERE tab_serie='$microcip'";
            mysqli_query($conn, $sql1);

            $c_datdeparazit_user_hostory =true;
        } else {}
        if(!empty($c_datvacc)){
            $sql = "UPDATE catei_tabel SET c_datvacc='$c_datvacc' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
            $sql1 = "UPDATE tabel_adapost SET tab_datavacc='$c_datvacc' WHERE tab_serie='$microcip'";
            mysqli_query($conn, $sql1);

            $c_datvacc_user_hostory=true;
        } else {}
        if(!empty($c_steril)){
            $sql = "UPDATE catei_tabel SET c_steril='$c_steril' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $sql1 = "UPDATE tabel_adapost SET tab_datasteriliz='$c_steril' WHERE tab_serie='$microcip'";
            mysqli_query($conn, $sql1);

            $c_steril_user_hostory=true;
        } else {}
        if(!empty($c_persmanopera)){
            $sql = "UPDATE catei_tabel SET c_persmanopera='$c_persmanopera' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);

            $c_persmanopera_user_hostory=true;
        } else {}
        if(!empty($c_decedati)){
            $sql = "UPDATE catei_tabel SET c_decedati='$c_decedati' WHERE c_microcip='$microcip'";
            mysqli_query($conn, $sql);
            
            $c_decedati_user_hostory=true; 
        } else {}

        
    
        // for user history
        $modificari = array();
        if($c_microcip_user_hostory==true) $modificari[] = "microcip (initial: ".$c_microcip_initial.", modificat: ".$c_microcip.")";
        if($c_datacapt_user_hostory==true) $modificari[] = "data capturarii (initial: ".$c_datacapt_initial.", modificat: ".$c_datacapt.")";
        if($c_loccapt_user_hostory==true) $modificari[] = "locul capturarii (initial: ".$c_loccapt_initial.", modificat: ".$c_loccapt.")";
        if($c_datcazare_user_hostory==true) $modificari[] = "data cazarii (initial: ".$c_datcazare_initial.", modificat: ".$c_datcazare.")";
        if($c_caracteristici_user_hostory==true) $modificari[] = "caracteristici (initial: ".$c_caracteristici_initial.", modificat: ".$c_caracteristici.")";
        if($c_fsprinsi_user_hostory==true) $modificari[] = "caini fara stapan prinsi (initial: ".$c_fsprinsi_initial.", modificat: ".$c_fsprinsi.")";

        if($c_fsrevendicati_user_hostory==true) $modificari[] = "caini fara stapan revendicati (initial: ".$c_fsrevendicati_initial.", modificat: ".$c_fsrevendicati.")";
        if($c_fsadoptati_user_hostory==true) $modificari[] = "caini fara stapan adoptati (initial: ".$c_fsadoptati_initial.", modificat: ".$c_fsadoptati.")";
        if($c_cmentinuti_user_hostory==true) $modificari[] = "nr. de caini mentinuti in adapost (initial: ".$c_cmentinuti_initial.", modificat: ".$c_cmentinuti.")";
        if($c_cadoptati_user_hostory==true) $modificari[] = "nr. de caini adoptati la distanta (initial: ".$c_cadoptati_initial.", modificat: ".$c_cadoptati.")";
        if($c_eutanasiati_user_hostory==true) $modificari[] = "nr. de caini eutanasiati	 (initial: ".$c_eutanasiati_initial.", modificat: ".$c_eutanasiati.")";
        if($c_motiveutan_user_hostory==true) $modificari[] = "motivul eutanasierii (initial: ".$c_motiveutan_initial.", modificat: ".$c_motiveutan.")";
        if($c_substeutan_user_hostory==true) $modificari[] = "substanta utilizata pentru eutanasiere (initial: ".$c_substeutan_initial.", modificat: ".$c_substeutan.")";
        if($c_numperseutan_user_hostory==true) $modificari[] = "numele persoanei care realizeaza eutanasierea (initial: ".$c_numperseutan_initial.", modificat: ".$c_numperseutan.")";
        if($c_nrfisaadoptie_user_hostory==true) $modificari[] = "numarul fisei de adoptie (initial: ".$c_nrfisaadoptie_initial.", modificat: ".$c_nrfisaadoptie.")";
        if($c_datdeparazit_user_hostory==true) $modificari[] = "data deparazitarii (initial: ".$c_datdeparazit_initial.", modificat: ".$c_datdeparazit.")";
        if($c_datvacc_user_hostory==true) $modificari[] = "data vaccinarii antirabice (initial: ".$c_datvacc_initial.", modificat: ".$c_datvacc.")";
        if($c_steril_user_hostory==true) $modificari[] = "data sterilizarii (initial: ".$c_steril_initial.", modificat: ".$c_steril.")";
        if($c_persmanopera_user_hostory==true) $modificari[] = "persoanele care au instrumentat manoperele respective (initial: ".$c_persmanopera_initial.", modificat: ".$c_persmanopera.")";
        if($c_decedati_user_hostory==true) $modificari[] = "decedati (initial: ".$c_decedati_initial.", modificat: ".$c_decedati.")";



        $modificariEditat = join(", ", $modificari);
        
        $currentAction = "A modificat rubrica cainelui ".$microcip.": ".$modificariEditat.".";

        $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions) VALUES ('$currentUser', '$currentAction')";
        mysqli_query($conn, $userHistorySql);


            
        

        header("Location: ../details.php?microcip=".$microcip."");  
    } elseif(isset($_POST['full_cancel'])){
        header("Location: ../details.php?microcip=".$microcip."");
    }


?>