<?php

  if(!empty($_POST["jenis"])){

    /* RE-ESTABLISH YOUR CONNECTION */
    $con = new mysqli("localhost", "root", "masrud.com", "ajc");

    /* CHECK CONNECTION */
    if (mysqli_connect_errno()) {
      printf("Connect failed: %s\n", mysqli_connect_error());
      exit();
    }

    /* PREPARE YOUR QUERY */
    $stmt = $con->prepare("SELECT  FROM biaya WHERE id_biaya = ?");
    $stmt->bind_param("i", $_POST["id_biaya"]); /* PARAMETIZE THIS VARIABLE TO YOUR QUERY */
    $stmt->execute(); /* EXECUTE QUERY */
    $stmt->bind_result($biaya); /* BIND THE RESULTS TO THESE VARIABLES */
    $stmt->fetch(); /* FETCH THE RESULTS */
    $stmt->close(); /* CLOSE THE PREPARED STATEMENT */

    /* RETURN THIS DATA TO THE MAIN FILE */
    echo json_encode(array("biaya" => $biaya));

  } /* END OF IF NOT EMPTY loadnumber */

?>
