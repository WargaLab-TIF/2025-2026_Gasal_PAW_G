<?php
    $height = array("andy"=>"176", "barry"=>"165","charlie"=>"170");
    $height_baru=[
        "ardi"=>"166",
        "sulhan"=>"163",
        "agus"=>"158",
        "rafi"=>"161",
        "cello"=>"172"
    ];
    $height = array_merge($height,$height_baru);
    foreach($height as $x => $x_value){
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }

    $weight = array("ardi"=>"176", "agus"=>"165","sulhan"=>"170");
    foreach($height as $x => $x_value){
        echo "Key=" . $x . ", Value=" . $x_value;
        echo "<br>";
    }
?>