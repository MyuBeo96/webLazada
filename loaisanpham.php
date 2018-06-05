<?php
    include_once("config.php");

    $ham = $_POST["ham"];
    // $ham = $_GET["ham"];

    switch ($ham) {

        case 'LayDSMenu':
            $ham(); 
            break;

        case 'LayDanhSachThuongHieuLon':
            $ham(); 
            break;

        case 'LayDanhSachTopMayTinh':
            $ham(); 
            break;

        case 'LayDanhSachTienIch':
            $ham(); 
            break;

        case 'TopTienIch':
            $ham();
            break;

        case 'LayLogoThuongHieu':
            $ham();
            break;

        case 'LayDanhSachSanPhamMoi':
            $ham();
            break;

        case 'LayDanhSachSanPhamTheoMaLoaiDanhMuc':
            $ham();
            break;

        case 'LayDanhSachSanPhamTheoMaThuongHieu':
            $ham();
            break;

        default:
            break;

    } 

    function LaySanPhamVaChiTietTheoMaSP(){
        global $conn;
        $chuoijson = array();

        if(isset($_POST["maloaisp"])){
            $maloai = $_POST["maloaisp"];
        }
    }

    function LayDanhSachSanPhamTheoMaLoaiDanhMuc(){
        global $conn;
        $chuoijson = array();

        if(isset($_POST["maloaisp"]) || isset($_POST["limit"])){
            $maloai = $_POST["maloaisp"];
            $limit = $_POST["limit"];
        }
           
        echo "{";
        echo "\"DANHSACHSANPHAM\":";

        $chuoijson = LayDanhSachSanPhamDanhMucTheoMaLoai($conn,$maloai,$chuoijson,$limit);
      
        // echo $chuoijson;
        echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

        echo "}";
    }


    function LayDanhSachSanPhamTheoMaThuongHieu(){
        global $conn;
        $chuoijson = array();
        if(isset($_POST["maloaisp"]) || isset($_POST["limit"])){
            $maloai = $_POST["maloaisp"];
            $limit = $_POST["limit"];
        }
        
        echo "{";
        echo "\"DANHSACHSANPHAM\":";

        $chuoijson = LayDanhSachSanPhamTheoMaLoaiThuongHieu($conn,$maloai,$chuoijson,$limit);

        echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
        echo "}";

    }

    function LayDanhSachSanPhamMoi(){
        global $conn;

        $truyvan = "SELECT *  FROM sanpham ORDER BY MASP DESC LIMIT 5";
        $ketqua = mysqli_query($conn,$truyvan);
        $chuoijson = array();

        echo "{";
        echo "\"DANHSACHSANPHAMMOIVE\":";
        if($ketqua){
            while ($dong=mysqli_fetch_array($ketqua)) {
                array_push($chuoijson, array("MASP"=>$dong["MASP"],'TENSP' => $dong["TENSP"],'GIA' => $dong["GIA"],'HINHLON'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dong["HINHLON"]));
            }
            echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
        }

        echo "}";
    }

    function LayLogoThuongHieu(){
        global $conn;

        $truyvan = "SELECT *  FROM thuonghieu";
        $ketqua = mysqli_query($conn,$truyvan);
        $chuoijson = array();

        echo "{";
        echo "\"DANHSACHLOGOTHUONGHIEU\":";
        if($ketqua){
            while ($dong=mysqli_fetch_array($ketqua)) {
                array_push($chuoijson, array("MATHUONGHIEU"=>$dong["MATHUONGHIEU"],'TENTHUONGHIEU' => $dong["TENTHUONGHIEU"],'HINHTHUONGHIEU'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dong["LOGOTHUONGHIEU"]));
            }
            echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
        }

        echo "}";
    }

    function TopTienIch(){
        global $conn;

        $ketqua = LayDanhSachLoaiSanPhamTheoMaLoai($conn, 2);

        $chuoijson = array();

        echo "{";
        echo "\"TOPTIENICH\":";
        if($ketqua){
            while ($dong=mysqli_fetch_array($ketqua)) {
                $ketquacon = LayDanhSachLoaiSanPhamTheoMaLoai($conn,$dong["MALOAISP"]);

                if($ketquacon){
                    while ($dongcon = mysqli_fetch_array($ketquacon)) {
                        $chuoijson = LayDanhSachSanPhamTheoMaLoai($conn, $dong["MALOAISP"], $chuoijson, 5);
                    }
                }
            }
        }

        echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

        echo "}";
    }

    function LayDanhSachTienIch(){
        global $conn;

        $ketqua = LayDanhSachLoaiSanPhamTheoMaLoai($conn, 2);

        $chuoijson = array();

        echo "{";
        echo "\"DANHSACHTIENICH\":";
        if($ketqua){
            while ($dong=mysqli_fetch_array($ketqua)) {
                $ketquacon = LayDanhSachLoaiSanPhamTheoMaLoai($conn,$dong["MALOAISP"]);

                if($ketquacon){
                    while ($dongcon = mysqli_fetch_array($ketquacon)) {
                        $chuoijson = LayDanhSachSanPhamTheoMaLoai($conn, $dong["MALOAISP"], $chuoijson, 1);
                    }
                }
            }
        }

        echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

        echo "}";
    }

    function LayDanhSachLoaiSanPhamTheoMaLoai($conn, $maloaisp){
        $truyvan = "SELECT *  FROM loaisanpham lsp WHERE lsp.MALOAISP = ".$maloaisp;
        $ketqua = mysqli_query($conn,$truyvan);
        
        return $ketqua;

    }

    function LayDanhSachSanPhamDanhMucTheoMaLoai($conn,$maloaisp,$chuoijson,$limit){
			
        $truyvantienich = "SELECT *  FROM loaisanpham lsp, sanpham sp WHERE lsp.MALOAISP = ".$maloaisp." AND lsp.MALOAISP = sp.MALOAISP ORDER BY sp.LUOTMUA DESC LIMIT ".$limit.",10";
        
        $ketquacon = mysqli_query($conn,$truyvantienich);	
                
        if($ketquacon){
            while ($dongtienich = mysqli_fetch_array($ketquacon)) {
                array_push($chuoijson, array("MASP"=>$dongtienich["MASP"],'TENSP' => $dongtienich["TENSP"],'GIA'=>$dongtienich["GIA"], 'HINHLON'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dongtienich["HINHLON"])); 
                
            }
        }

        return $chuoijson;

    }

    //lay danh sach san pham theo thuong hieu
    function LayDanhSachSanPhamTheoMaLoaiThuongHieu($conn,$maloaith,$chuoijson,$limit){
        
        $truyvantienich = "SELECT *  FROM thuonghieu th, sanpham sp WHERE th.MATHUONGHIEU = ".$maloaith." AND th.MATHUONGHIEU = sp.MATHUONGHIEU ORDER BY sp.LUOTMUA DESC LIMIT ".$limit.",10";
        
        $ketquacon = mysqli_query($conn,$truyvantienich);	
                
        if($ketquacon){
            while ($dongtienich = mysqli_fetch_array($ketquacon)) {
                array_push($chuoijson, array("MASP"=>$dongtienich["MASP"],'TENSP' => $dongtienich["TENSP"],'GIA'=>$dongtienich["GIA"], 'HINHLON'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dongtienich["HINHLON"])); 
                
            }
        }
        return $chuoijson;
    }

    function LayDanhSachSanPhamTheoMaLoai($conn, $maloaisp, $chuoijson, $limit){
        $truyvantienich = "SELECT *  FROM loaisanpham lsp, sanpham sp WHERE lsp.MALOAI_CHA = ".$maloaisp." AND lsp.MALOAISP = sp.MALOAISP ORDER BY sp.LUOTMUA DESC LIMIT ".$limit.",20";
        $ketquatienich = mysqli_query($conn,$truyvantienich);

        if($ketquatienich){
            while ($dongtienich=mysqli_fetch_array($ketquatienich)) {
                array_push($chuoijson, array("MASP"=>$dongtienich["MASP"],'TENSP' => $dongtienich["TENLOAISP"],'GIA' => $dongtienich["GIA"],'HINHLON'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dongtienich["HINHLON"],'HINHNHO'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dongtienich["HINHNHO"])); 
            }
        }
        return $chuoijson;
    }

    function LayDanhSachTopMayTinh(){
        global $conn;

        $truyvan = "SELECT *  FROM loaisanpham lsp, sanpham sp WHERE lsp.TENLOAISP LIKE '%laptop%' AND lsp.MALOAISP = sp.MALOAISP ORDER BY sp.LUOTMUA DESC LIMIT 5";
        $ketqua = mysqli_query($conn,$truyvan);
        $chuoijson = array();

        echo "{";
        echo "\"TOPMAYTINH\":";
        if($ketqua){
            while ($dong=mysqli_fetch_array($ketqua)) {
                array_push($chuoijson, array("MASP"=>$dong["MASP"],'TENSP' => $dong["TENSP"],'GIA' => $dong["GIA"],'HINHLON'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dong["HINHLON"]));  
            }
        }

        $truyvanmb = "SELECT *  FROM loaisanpham lsp, sanpham sp WHERE lsp.TENLOAISP LIKE '%macbook%' AND lsp.MALOAISP = sp.MALOAISP ORDER BY sp.LUOTMUA DESC LIMIT 1";
        $ketquamb = mysqli_query($conn,$truyvanmb);

        if($ketquamb){
            while ($dongmb=mysqli_fetch_array($ketquamb)) {
                array_push($chuoijson, array("MASP"=>$dongmb["MASP"],'TENSP' => $dongmb["TENSP"],'GIA' => $dongmb["GIA"],'HINHLON'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dongmb["HINHLON"])); 
            }
        }
        echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);

        echo "}";
    }

    function LayDanhSachThuongHieuLon(){
        global $conn;

        $truyvan = "SELECT *  FROM thuonghieu th,chitietthuonghieu cth WHERE th.MATHUONGHIEU = cth.MATHUONGHIEU";
        $ketqua = mysqli_query($conn,$truyvan);
        $chuoijson = array();

        echo "{";
        echo "\"DANHSACHTHUONGHIEU\":";
        if($ketqua){
            while ($dong=mysqli_fetch_array($ketqua)) {
                array_push($chuoijson, array("MATHUONGHIEU"=>$dong["MATHUONGHIEU"],'TENTHUONGHIEU' => $dong["TENTHUONGHIEU"],'HINHTHUONGHIEU'=>"http://".$_SERVER['SERVER_NAME']."/webLazada".$dong["HINHTHUONGHIEU"]));
            }
            echo json_encode($chuoijson,JSON_UNESCAPED_UNICODE);
        }

        echo "}";
    }

    function LayDSMenu(){
        global $conn;
        if(isset($_POST["maloaicha"]))
            $maloaicha = $_POST["maloaicha"];

        $truyvan = "select * from loaisanpham where MALOAI_CHA = ".$maloaicha;
        $ketqua = mysqli_query($conn, $truyvan);
        $chuoi_json = array();
        echo "{";
        echo "\"LOAISANPHAM\":";
        if($ketqua){
            while($dong = mysqli_fetch_array($ketqua)){
                array_push($chuoi_json, array('TENLOAISP' =>$dong["TENLOAISP"], 'MALOAISP' =>$dong["MALOAISP"], 'MALOAI_CHA' => $dong["MALOAI_CHA"]));
            }
            echo json_encode($chuoi_json, JSON_UNESCAPED_UNICODE);
        }
        echo "}";
        mysqli_close($conn);
    }
?>