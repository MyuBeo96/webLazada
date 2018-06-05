<?php
    include_once("config.php");

    $manv = $_GET["manv"];

    $truyvan = "select * from nhanvien where MANV = ".$manv;
    $ketqua = mysqli_query($conn, $truyvan);
    $chuoi_json = array();
    echo "{";
    echo "\"NHANVIEN\":";
    if($ketqua){
        while($dong = mysqli_fetch_array($ketqua)){
            array_push($chuoi_json, array('TENNV' =>$dong["TENNV"], 'TENDANGNHAP' =>$dong["TENDANGNHAP"]));
        }
        echo json_encode($chuoi_json, JSON_UNESCAPED_UNICODE);
    }
    echo "}";
?>