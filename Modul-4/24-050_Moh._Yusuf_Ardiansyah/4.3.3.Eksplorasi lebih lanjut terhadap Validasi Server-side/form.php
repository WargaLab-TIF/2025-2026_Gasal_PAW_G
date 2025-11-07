<?php
require_once 'validate.inc';
$errors=[];$values=['surname'=>'','email'=>'','age'=>'','birthdate'=>''];
if($_SERVER['REQUEST_METHOD']==='POST'&&isset($_POST['submit'])){
  $values['surname']=$_POST['surname']??'';$values['email']=$_POST['email']??'';$values['age']=$_POST['age']??'';$values['birthdate']=$_POST['birthdate']??'';
  $allEmpty=true;foreach($values as $v){if(trim($v)!==''){$allEmpty=false;break;}}
  if($allEmpty){$values=['surname'=>'','email'=>'','age'=>'','birthdate'=>''];$errors=[];}
  else{$ok=validateAll($values,$errors);if($ok){echo "<!doctype html><html><head><meta charset='utf-8'><title>Success</title></head><body>";echo "<h3>Form submitted successfully with no errors</h3>";echo "<p><strong>Surname:</strong> ".htmlspecialchars($values['surname'],ENT_QUOTES,'UTF-8')."</p>";echo "<p><strong>Email:</strong> ".htmlspecialchars($values['email'],ENT_QUOTES,'UTF-8')."</p>";echo "<p><strong>Age:</strong> ".htmlspecialchars($values['age'],ENT_QUOTES,'UTF-8')."</p>";echo "<p><strong>Birthdate:</strong> ".htmlspecialchars($values['birthdate'],ENT_QUOTES,'UTF-8')."</p>";echo '<p><a href="'.htmlspecialchars($_SERVER['PHP_SELF']).'">Back to empty form</a></p>';echo "</body></html>";exit;}}
}
?>
<!doctype html><html><head><meta charset="utf-8"><title>Form - Self Submission</title></head><body><h2>Self-submission Form</h2><?php include 'form.inc'; ?></body></html>
