<?php
    session_id("login-session");
    session_start();
    include "dbh.php";
    
    $microcip = $_SESSION['microcip'];
    $currentUser = $_SESSION['utilizator'];
// VARIABLES FOR TABLES: tabel `specific_details`
 

 $spec_data          = mysqli_real_escape_string($conn, $_POST['spec_data']);
 $spec_semneclinice  = mysqli_real_escape_string($conn, $_POST['spec_semneclinice']);
 $spec_diagnostic    = mysqli_real_escape_string($conn, $_POST['spec_diagnostic']);
 $spec_tratament     = mysqli_real_escape_string($conn, $_POST['spec_tratament']);
 $spec_vaccin        = mysqli_real_escape_string($conn, $_POST['spec_vaccin']);
 $spec_observatii    = mysqli_real_escape_string($conn, $_POST['spec_observatii']);

if(!empty($spec_data) || !empty($spec_semneclinice) || !empty($spec_diagnostic) || !empty($spec_tratament) || !empty($spec_vaccin) || !empty($spec_observatii)){
    $sqlSpecs = "INSERT INTO specific_details (spec_serie, spec_data, spec_semneclinice, spec_diagnostic, spec_tratament, spec_vaccin, spec_observatii) VALUES ('$microcip', '$spec_data', '$spec_semneclinice', '$spec_diagnostic', '$spec_tratament', '$spec_vaccin', '$spec_observatii')";
    mysqli_query($conn, $sqlSpecs);

    // for user history
    $modificari = array();
    if($spec_data != '') $modificari[] = "data: ".$spec_data.""; 
    if($spec_semneclinice != '') $modificari[] = "semne clinice: ".$spec_semneclinice."";
    if($spec_diagnostic != '') $modificari[] = "diagnostic: ".$spec_diagnostic."";
    if($spec_tratament != '') $modificari[] = "tratament: ".$spec_tratament."";
    if($spec_vaccin != '') $modificari[] = "vaccin: ".$spec_vaccin."";
    if($spec_observatii != '') $modificari[] = "observatii: ".$spec_observatii."";
    $modificariEditat = join(", ", $modificari);
    
    $currentAction = "A adaugat in fisa cainelui ".$microcip.": ".$modificariEditat.".";
    $userHistorySql = "INSERT INTO utilizatori_istoric (user_name, user_actions, user_trat) VALUES ('$currentUser', '$currentAction', 1)";
    mysqli_query($conn, $userHistorySql);



    header("Location: ../details.php?microcip=".$microcip."");
} else{
    header("Location: ../details.php?microcip=".$microcip."");
}

?>

<html>
<body>
    <h1><?php echo $_SESSION['microcip']; ?></h1>
</body>
</html>