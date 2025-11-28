<?php
    //array_push
    $mhs=[
        ["sulhan"=>"2458"],
        ["ardi"=>"2450"]
    ];
    array_push($mhs,["agus"=>"2466"]);
    var_dump($mhs);
    echo "<br>";

    //array_marge
    $mhs1=[
        ["qomar"=>"24128"],
        ["cello"=>"2477"]
    ];
    $mhs2=array_merge($mhs,$mhs1);
    var_dump($mhs2);
    echo "<br>";

    //array_values
    $mhs3=array_values($mhs2);
    var_dump($mhs3);
    echo "<br>";

    //array_search
    $search=array_search(["cello"=>"2477"],$mhs3);
    echo $search;
    echo "<br>";

    //array_filter
    $filter=array_filter($mhs3,function($var){
        return ($var !== ["cello"=>"2477"]);
    });
    var_dump($filter);
    echo "<br>";

    //sort
    $angka=[5,3,8,1,4,9,2,7,6];
    sort($angka);
    var_dump($angka);
    echo "<br>";

    //resort
    rsort($angka);
    var_dump($angka);
    echo "<br>";

    //asort
    asort($mhs3);
    var_dump($mhs3);
    echo "<br>";

    //ksort
    ksort($mhs3);
    var_dump($mhs3);
    echo "<br>";
?>