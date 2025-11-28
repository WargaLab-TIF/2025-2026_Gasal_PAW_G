<?php 
$matkul=array("PTI","ALPRO","DPW","strukdat","JARKOM","PAW","Psbf","RPL");
$praktikum =array ("JARKOM","PAW");
$panjang_arr1=count($praktikum);
$panjang_arr2=count($matkul);
for ($i=0;$i<$panjang_arr2;$i++){
    $ada =FALSE;
    for ($j=0;$j<$panjang_arr1;$j++){
        if($matkul[$i]===$praktikum[$j]){
            $ada=True;
            break;}}
        if($i==6 or $i==7  ){
            echo "saya belum mengambil matkul ". $matkul[$i] ."<br>";
        }elseif($ada){
           echo "saya sedang mengambil matkul " . $matkul[$i] ." termasuk praktikumnya". "<br>";
        }else{
            echo "Saya sudah mengambil matkul " . $matkul[$i] . "<br>";
        } 
        
   
}