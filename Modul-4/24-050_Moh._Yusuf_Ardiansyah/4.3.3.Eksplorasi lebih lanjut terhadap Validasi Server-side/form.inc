<?php
if(!isset($values)||!is_array($values))$values=[];
if(!isset($errors)||!is_array($errors))$errors=[];
function v($a,$k){return isset($a[$k])?htmlspecialchars($a[$k],ENT_QUOTES,'UTF-8'):'';}
function e($a,$k){return !empty($a[$k])?htmlspecialchars($a[$k],ENT_QUOTES,'UTF-8'):'';}
?>
<form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
  <div><label for="surname">Surname</label><br><input type="text" id="surname" name="surname" value="<?php echo v($values,'surname');?>"><?php if($err=e($errors,'surname')):?><div style="color:red;"><?php echo $err;?></div><?php endif;?></div>
  <div style="margin-top:8px;"><label for="email">Email</label><br><input type="text" id="email" name="email" value="<?php echo v($values,'email');?>"><?php if($err=e($errors,'email')):?><div style="color:red;"><?php echo $err;?></div><?php endif;?></div>
  <div style="margin-top:8px;"><label for="age">Age</label><br><input type="text" id="age" name="age" value="<?php echo v($values,'age');?>"><?php if($err=e($errors,'age')):?><div style="color:red;"><?php echo $err;?></div><?php endif;?></div>
  <div style="margin-top:8px;"><label for="birthdate">Birthdate (YYYY-MM-DD)</label><br><input type="text" id="birthdate" name="birthdate" value="<?php echo v($values,'birthdate');?>"><?php if($err=e($errors,'birthdate')):?><div style="color:red;"><?php echo $err;?></div><?php endif;?></div>
  <div style="margin-top:12px;"><input type="submit" name="submit" value="Submit"></div>
</form>
