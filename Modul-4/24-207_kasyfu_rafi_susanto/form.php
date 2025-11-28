<!DOCTYPE html> 
<html lang="en"> 
<head> 
    <title>Document</title> 
</head> 
<body> 
     
    <?php 
  
    if(isset($_POST["submit"])){ 
        $error = []; 
        $nama = $_POST["nama"]; 
        $nomor = $_POST["nomor"]; 
        $pattern_nama = "/^[a-zA-Z'-]+$/"; 
        $pattern_nomor = '/^(\+|0)[\d]{7,14}$/'; 
         
        if(empty($nama)){ 
            $error["nama"] = "jangan kosongkan nama"; 
            // echo $error["nama"]; 
        }elseif (!preg_match($pattern_nama,$nama)){ 
            $error["nama"]= "format harus alfabet"; 
            // echo $error["name"]; 
        } 

        if(empty($nomor)){ 
            $error["nomor"] = "jangan kosongkan nomor"; 
            // echo $error["nomor"]; 
        }elseif (!preg_match($pattern_nomor,$nomor)){ 
            $error["nomor"]= "format harus nomor (+62 / 0)."; 
            // echo $error["nomor"]; 
        } 

        if (count($error) == 0){ 
            echo "form sukses di submit tanpa ada error"; 
        } 
    } 
    require "form.inc";
 
    ?> 
</body> 
</html> 
 
 
