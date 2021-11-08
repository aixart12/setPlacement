<?php
session_start();
require_once'../connect.php';
$cv_no=$_POST['cv_no'];
?>


  <?php
  $cv_no++;
  //set pdf here
  $pdf=$_FILES['resume']['name'];
  $pdf_type=$_FILES['resume']['type'];
  $pdf_size=$_FILES['resume']['size'];
  $pdf_temp_loc=$_FILES['resume']['tmp_name'];
  $pdf_store="cv_data/".$_SESSION['user_id']."_".$cv_no.".pdf";
  move_uploaded_file($pdf_temp_loc, $pdf_store);

  try{
if(isset($_POST['Submit']) && isset($_FILES)){
  $sql="INSERT INTO setplacement.cv(rollNo,cv_no,cv_data) VALUES(:rollNo,:cv_no,:cv_data)";
  $stmt=$conn->prepare($sql);
  echo "string";
  $stmt->execute(array(
      ':rollNo'=> $_SESSION['user_id'],
      ':cv_no' => $cv_no,
      ':cv_data'=> $pdf_store
  ));
  unset($_FILES);
  echo '<script>location.replace("std_dashboard.php")</script>';
}
  }catch(Exception $err){
    echo $err->getMessage();
  }
?>
