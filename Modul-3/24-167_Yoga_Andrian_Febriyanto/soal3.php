<?php
    $height = array("andy"=>"176", "barry"=>"165","charlie"=>"170");
    echo "andy is". $height['andy'] . " cm tall";
    echo "<br>";
    $height_baru=[
        "ardi"=>"166",
        "sulhan"=>"163",
        "agus"=>"158",
        "rafi"=>"161",
        "cello"=>"172"
    ];
    $height = array_merge($height,$height_baru);
    $indeks=array_values($height);
    $nilai = count($indeks);
    echo "nilai dengan indeks tertinggi : " . $indeks[$nilai-1] . "<br>";
    $new_height = $height;
    unset($new_height['cello']);
    $new_indeks = array_values($new_height);
    $new_nilai = count($new_indeks);
    echo "nilai indeks tertinggi ". $new_indeks[$new_nilai-1] . "<br>";
    echo "indeks tertinggi: " . ($new_nilai-1) . "<br>";

    $weight = array("ardi"=>"176", "agus"=>"165","sulhan"=>"170");
    $idx=0;
    foreach($weight as $key => $value){
        if ($idx==1){
            echo $key . " => " . $value . "<br>";
            break;
        } $idx++;
        
    }
    
    
?>