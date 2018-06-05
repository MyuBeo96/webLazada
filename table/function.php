<?php
    include("../config.php");

    $ham = $_POST["action"];

    switch ($ham) {
        
        case 'ThemLoaiNhanVien':
            $ham();
            break;

        case 'LayDanhSachLoaiNV':
            $ham();
            break;

        case 'TimKiemLoaiNV':
            $ham();
            break;

        case 'XoaLoaiNhanVien':
            $ham();
            break;

        case 'PhanTrangLoaiNV':
            $ham();
            break;

        case 'ThemNhanVien':
            $ham();
            break;

        case 'LayDanhSachNV':
            $ham();
            break;

        case 'CapNhatNhanVien':
            $ham();
            break;

        case 'XoaNhanVien':
            $ham();
            break;

        case 'ThemLoaiSanPham':
            $ham();
            break;

        case 'LayDanhSachLoaiSP':
            $ham();
            break;

        case 'XoaLoaiSanPham':
            $ham();
            break;

        case 'PhanTrangLoaiSP':
            $ham();
            break;

        case 'TimKiemLoaiSP':
            $ham();
            break;

        case 'ThemSanPham':
            $ham();
            break;

        case 'TimKiemNV':
            $ham();
            break;

        case 'XoaSanPham':
            $ham();
            break;

        case 'TimKiemSP':
            $ham();
            break;

        case 'LayChiTietSanPhamTheoMa':
            $ham();
            break;

        case 'CapNhatSanPhamTheoMaSP':
            $ham();
            break;

        case 'LayDanhSachSanPham':
            $ham();
            break;

        case 'KiemTraDangNhap':
            $ham();
            break;

        case 'ThemThuongHieu':
            $ham();
            break;

        case 'ThemHoaDon':
            $ham();
            break;

        case 'LayChiTietHoaDonTheoMa':
            $ham();
            break;

        case 'CapNhatHoaDon':
            $ham();
            break;

        case 'TimKiemHD':
            $ham();
            break;
        
        default:
            # code...
            break;
    }

/*Phần đăng nhập */
    //Kiểm tra đăng nhập
    function KiemTraDangNhap(){
        global $conn;
        session_start();
        $tendangnhap = $_POST["tendangnhap"];
        $matkhau = $_POST["matkhau"];
        $nhotaikhoan = $_POST["nhotaikhoan"];

        $truyvan = 'SELECT * FROM nhanvien WHERE TENDANGNHAP = "'.$tendangnhap.'" AND MATKHAU = "'.$matkhau.'"';
        $ketqua = mysqli_query($conn, $truyvan);

        if($nhotaikhoan){
			setcookie("tendangnhap",$tendangnhap,time() + (86400 * 30),"/");
			setcookie("matkhau",$matkhau,time() + (86400 * 30),"/");
		}

        if($ketqua){
            $kiemtra = mysqli_num_rows($ketqua);
            while($dong = mysqli_fetch_array($ketqua)){
                $_SESSION["tennv"] = $dong["TENNV"];
                $_SESSION["email"] = $dong["TENDANGNHAP"];
                $_SESSION["manv"] = $dong["MANV"];
                $_SESSION["maloainv"] = $dong["MALOAINV"];
                echo "Đăng nhập thành công";
            }
        }else{
            echo "Đăng nhập thất bại";
        }
    }
/*Kết thúc phần đăng nhập */

/*Phần hóa đơn */
    //Tìm kiếm hóa đơn
    function TimKiemHD(){
        global $conn;
        $tenchuhd = $_POST["timkiem"];
        $truyvan = "SELECT * FROM hoadon WHERE TENNGUOINHAN LIKE '%".$tenchuhd."%'";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                $chuyenkhoan = $dong["CHUYENKHOAN"] != null && $dong["CHUYENKHOAN"] != '0' ? 'Đã thanh toán' : 'Chưa thanh toán';
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td data-tennn = '".$dong["TENNGUOINHAN"]."'>".$dong["TENNGUOINHAN"]."</td>";
                    echo "<td data-sodt = '".$dong["SODT"]."'>".$dong["SODT"]."</td>";
                    echo "<td data-diachi = '".$dong["DIACHI"]."'>".$dong["DIACHI"]."</td>";
                    echo "<td data-trangthai = '".$dong["TRANGTHAI"]."'>".$dong["TRANGTHAI"]."</td>";
                    echo "<td data-ngaydat = '".$dong["NGAYDAT"]."'>".$dong["NGAYDAT"]."</td>";
                    echo "<td data-ngaygiao = '".$dong["NGAYGIAO"]."'>".$dong["NGAYGIAO"]."</td>";
                    echo "<td data-chuyenkhoan = '".$dong["CHUYENKHOAN"]."'>$chuyenkhoan</td>";
                    echo "<td data-machuyenkhoan = '".$dong["MACHUYENKHOAN"]."'>".$dong["MACHUYENKHOAN"]."</td>";
                    echo "<td data-id = '".$dong["MAHD"]."'>
                                <a class = 'btn btn-info btn_suahd'>Sửa</a>
                                <a class = 'btn btn-danger btn_xoahd'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
    }

    //Cập nhật hóa đơn
    function CapNhatHoaDon(){
        global $conn;
        $mahd = $_POST["mahd"];
        $tenchuhd = $_POST["tenchuhd"];
        $sdthoadon = $_POST["sdthoadon"];
        $diachihoadon = $_POST["diachihoadon"];
        $ngaydat = $_POST["ngaydat"];
        $ngaygiao = $_POST["ngaygiao"];
        $trangthai = $_POST["trangthai"];
        $chuyenkhoan = $_POST["chuyenkhoan"];
        $machuyenkhoan = $_POST["machuyenkhoan"];

        $mangmachitiethd = isset($_POST["mangmachitiethd"]) ? $_POST["mangmachitiethd"] : [];
        $mangtenchitiethd = isset($_POST["mangtenchitiethd"]) ? $_POST["mangtenchitiethd"] : [];
        $mangsoluongcthd = isset($_POST["mangsoluongcthd"]) ? $_POST["mangsoluongcthd"] : [];

        $dem = count($mangmachitiethd);
		$kiemtra = false;
		$chuoithongbao = "Các sản phẩm sau không đáp ứng được đơn hàng: ";

		for ($i=0; $i < $dem; $i++) { 
			$masp = $mangmachitiethd[$i];
			$soluong = $mangsoluongcthd[$i];
			$tensp = $mangtenchitiethd[$i];

			$soluongtonkho = LaySoLuongSanPhamTonKho($masp);
			if($soluongtonkho < $soluong){
				$chuoithongbao .= "Tên sản phẩm : ".$tensp." - Số lượng : ".($soluongtonkho - $soluong);
				$kiemtra = true;
			}
		}
		
		if(!$kiemtra){
			if($trangthai=="Đang chờ kiểm duyệt" || $trangthai=="Hoàn thành"){
                CapNhatHoaDonTheoMa($ngaydat,$ngaygiao,$trangthai,$tenchuhd,$sdthoadon,$diachihoadon,$chuyenkhoan,$machuyenkhoan,$mahd);
			    XoaChiTietHoaDon($mahd);

                for ($i=0; $i < $dem; $i++) { 
                    $masp = $mangmachitiethd[$i];
                    $soluong = $mangsoluongcthd[$i];
                    ThemChiTietHoaDon($mahd,$masp,$soluong);
                }
				
			}else if($trangthai == "Hủy đơn hàng"){
				for ($i=0; $i < $dem; $i++) { 
					$masp = $mangmachitiethd[$i];
					$soluong = $mangsoluongcthd[$i];

					CapNhatHoaDonTheoMa($ngaydat,$ngaygiao,$trangthai,$tenchuhd,$sdthoadon,$diachihoadon,$chuyenkhoan,$machuyenkhoan,$mahd);
					CapNhatSoLuongSanPham($masp,$soluong,true);
				}
				
			}else if($trangthai == "Đang giao hàng"){
				for ($i=0; $i < $dem; $i++) { 
					$masp = $mangmachitiethd[$i];
					$soluong = $mangsoluongcthd[$i];

					CapNhatHoaDonTheoMa($ngaydat,$ngaygiao,$trangthai,$tenchuhd,$sdthoadon,$diachihoadon,$chuyenkhoan,$machuyenkhoan,$mahd);
					CapNhatSoLuongSanPham($masp,$soluong,false);
				}
			}
		}else{
			echo $chuoithongbao;
		}
    }

    function CapNhatSoLuongSanPham($masp,$soluong,$kiemtra){
		global $conn;
		$soluongtonkho = LaySoLuongSanPhamTonKho($masp);

		if($kiemtra){
			$soluongtonkho += $soluong;
		}else{
			$soluongtonkho -= $soluong;
		}

		$truyvan = "UPDATE sanpham SET SOLUONG='".$soluongtonkho."' WHERE MASP='".$masp."'";
		mysqli_query($conn,$truyvan);
	}

    function LaySoLuongSanPhamTonKho($masp){
		global $conn;
		$truyvan = "SELECT * FROM sanpham WHERE MASP='".$masp."'";
		$ketqua = mysqli_query($conn,$truyvan);
		$soluongtonkho = 0;
		if($ketqua){
			while ($dong = mysqli_fetch_array($ketqua)) {
				$soluongtonkho = $dong["SOLUONG"];
			}
		}

		return $soluongtonkho;
	}

    function CapNhatHoaDonTheoMa($ngaydat,$ngaygiao,$trangthai,$tenchuhd,$sdthoadon,$diachihoadon,$chuyenkhoan,$machuyenkhoan,$mahd){
		global $conn;
		$truyvanhoadon = "UPDATE hoadon SET NGAYDAT = '".$ngaydat."', NGAYGIAO='".$ngaygiao."', TRANGTHAI='".$trangthai."', TENNGUOINHAN='".$tenchuhd."', SODT='".$sdthoadon."', DIACHI='".$diachihoadon."', CHUYENKHOAN='".$chuyenkhoan."', MACHUYENKHOAN='".$machuyenkhoan."' WHERE MAHD='".$mahd."'";
        $ketqua = mysqli_query($conn,$truyvanhoadon);
	}

    function XoaChiTietHoaDon($mahd){
		global $conn;
		$truyvanxoachitiethd = "DELETE FROM chitiethoadon WHERE MAHD='".$mahd."'";
		mysqli_query($conn,$truyvanxoachitiethd);
	}

    function ThemChiTietHoaDon($mahd,$masp,$soluong){
		global $conn;
		$truyvanthemchitiethoadon = " INSERT INTO chitiethoadon(MAHD,MASP,SOLUONG) VALUES('".$mahd."','".$masp."','".$soluong."')";
		mysqli_query($conn,$truyvanthemchitiethoadon);
	}

    //  Thêm hóa đơn
    function ThemHoaDon(){
        global $conn;
        $tenchuhd = $_POST["tenchuhd"];
        $sdthoadon = $_POST["sdthoadon"];
        $diachihoadon = $_POST["diachihoadon"];
        $ngaydat = $_POST["ngaydat"];
        $ngaygiao = $_POST["ngaygiao"];
        $trangthai = $_POST["trangthai"];
        $chuyenkhoan = $_POST["chuyenkhoan"];
        $machuyenkhoan = $_POST["machuyenkhoan"];
        
        $mangtenchitiethd = isset($_POST["mangtenchitiethd"]) ? $_POST["mangtenchitiethd"] : [];
        $mangsoluongcthd = isset($_POST["mangsoluongcthd"]) ? $_POST["mangsoluongcthd"] : [];

        $truyvan = "INSERT INTO hoadon(TENNGUOINHAN, SODT, DIACHI, NGAYDAT, NGAYGIAO, TRANGTHAI, CHUYENKHOAN, MACHUYENKHOAN) VALUE('".$tenchuhd."', '".$sdthoadon."', '".$diachihoadon."', '".$ngaydat."', '".$ngaygiao."','".$trangthai."', '".$chuyenkhoan."','".$machuyenkhoan."')";
        $ketqua = mysqli_query($conn, $truyvan);

        $mahd = mysqli_insert_id($conn);
        $dem = count($mangtenchitiethd);
        for($i = 0; $i < $dem; $i++){
            $tenchitiethd = $mangtenchitiethd[$i];
            $soluongcthd = $mangsoluongcthd[$i];

            $truyvancon = "INSERT INTO chitiethoadon(MAHD, MASP, SOLUONG) VALUE('".$masp."', '".$tenchitiethd."', '".$soluongcthd."')";
            $kt = mysqli_query($conn, $truyvancon);
        }
        if ($ketqua) {
            echo "Thêm hóa đơn thành công";
        } else {
            echo "Thêm hóa đơn thất bại";
        }
    }

    //Lấy chi tiết hóa đơn
    function LayChiTietHoaDonTheoMa(){
        global $conn;
        $mahd = $_POST["mahd"];

        $truyvan = "SELECT sp.TENSP, cthd.MASP,cthd.MAHD,cthd.SOLUONG FROM chitiethoadon cthd, sanpham sp WHERE cthd.MASP = sp.MASP AND MAHD = '".$mahd."'";
        $ketqua = mysqli_query($conn, $truyvan);
        if ($ketqua) {
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '
                        <tr>
                            <th>
                                Tên sản phẩm: <input type = "text" disabled style = "width: 620px;" data-masp="'.$dong["MASP"].'" id = "mangtenchitiethd" name = "mangtenchitiethd[]" VALUE = "'.$dong["TENSP"].'"> 
                            </th>
                            <th data-mahd = "'.$dong["MAHD"].'">
                                Số lượng: <input type = "number" disabled data-masp="'.$dong["MASP"].'" id = "mangsoluongcthd" name = "mangsoluongcthd[]" VALUE = "'.$dong["SOLUONG"].'">
                                
                            </th>
                            <th>
                                <a class = "btn btn-danger btn_xoacthd "  style = "align: center;">Xóa</a>
                            </th>
                        </tr>';
            }
        } 
        
    }
/*Kết thúc phần hóa đơn */

/*Phần thương hiệu */
    function ThemThuongHieu(){
        global $conn;
        $math = $_POST["math"];
        ThemThuongHieuTheoMaTH($math);
        ThemChiTietThuongHieu($math);
    }

    function ThemThuongHieuTheoMaTH($math){
        global $conn;
        $tenth = $_POST["tenth"];
        $truyvan = "INSERT INTO thuonghieu(TENTHUONGHIEU) VALUES('".$tenth."')";
        mysqli_query($conn, $truyvan);
    }

    function ThemChiTietThuongHieu($math){
        global $conn;
        
        $maloaisp = $_POST["maloaisp"];
        $hinhthuonghieu = $_POST["hinhthuonghieu"];
        $truyvan = "INSERT INTO chitietthuonghieu(MATHUONGHIEU, MALOAISP, HINHTHUONGHIEU) VALUES('".$math."','".$maloaisp."', '".$hinhthuonghieu."')";
        mysqli_query($conn, $truyvan);  
    }
/*Kết thúc phần thương hiệu */

/*Phần quản lý sản phẩm */
    //Tìm kiếm sản phẩm
    function TimKiemSP(){
        global $conn;
        $timkiem = $_POST["timkiem"];
        $truyvan = "SELECT * FROM sanpham, loaisanpham, thuonghieu
        WHERE sanpham.MALOAISP = loaisanpham.MALOAISP AND sanpham.MATHUONGHIEU = thuonghieu.MATHUONGHIEU AND TENSP LIKE '%".$timkiem."%'";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                echo "<td>".$i."</td>";
                echo "<td class = 'anbottom' data-hinhnho = '".$dong["HINHNHO"]."'></td>";
                echo "<td data-hinhlon = '".$dong["HINHLON"]."'><img style = 'width: 100px; height: 100px;' src = '..".$dong["HINHLON"]."'/></td>";
                echo "<td data-tensp = '".$dong["TENSP"]."'>".$dong["TENSP"]."</td>";
                echo "<td data-maloaisp = '".$dong["MALOAISP"]."'>".$dong["TENLOAISP"]."</td>";
                echo "<td data-mathuonghieu = '".$dong["MATHUONGHIEU"]."'>".$dong["TENTHUONGHIEU"]."</td>";
                echo "<td class = 'anbottom' data-thongtin = '".$dong["THONGTIN"]."'></td>";
                echo "<td data-gia = '".$dong["GIA"]."'>".$dong["GIA"]."</td>";
                echo "<td data-soluong = '".$dong["SOLUONG"]."'>".$dong["SOLUONG"]."</td>";
                echo "<td data-id = '".$dong["MASP"]."'>
                            <a class = 'btn btn-info btn_suasp'>Sửa</a>
                            <a class = 'btn btn-danger btn_xoasp'>Xóa</a>
                    </td>";
                echo '</tr>';
                
                $i++;
            }
        }
    }

    //Lấy danh sách sản phẩm
    function LayDanhSachSanPham(){
        global $conn;
        $sotrang = $_POST["sotrang"];
        $limit = ($sotrang-1)*10;
        $truyvan = "SELECT * FROM sanpham, loaisanpham, thuonghieu
        WHERE sanpham.MALOAISP = loaisanpham.MALOAISP AND sanpham.MATHUONGHIEU = thuonghieu.MATHUONGHIEU LIMIT ".$limit.",10";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td class = 'anbottom' data-hinhnho = '".$dong["HINHNHO"]."'></td>";
                    echo "<td data-hinhlon = '".$dong["HINHLON"]."'><img style = 'width: 100px; height: 100px;' src = '..".$dong["HINHLON"]."'/></td>";
                    echo "<td data-tensp = '".$dong["TENSP"]."'>".$dong["TENSP"]."</td>";
                    echo "<td data-maloaisp = '".$dong["MALOAISP"]."'>".$dong["TENLOAISP"]."</td>";
                    echo "<td data-mathuonghieu = '".$dong["MATHUONGHIEU"]."'>".$dong["TENTHUONGHIEU"]."</td>";
                    echo "<td class = 'anbottom' data-thongtin = '".$dong["THONGTIN"]."'></td>";
                    echo "<td data-gia = '".$dong["GIA"]."'>".$dong["GIA"]."</td>";
                    echo "<td data-soluong = '".$dong["SOLUONG"]."'>".$dong["SOLUONG"]."</td>";
                    echo "<td data-id = '".$dong["MASP"]."'>
                                <a class = 'btn btn-info btn_suasp'>Sửa</a>
                                <a class = 'btn btn-danger btn_xoasp'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
    }

    //Cập nhật sản phẩm
    function CapNhatSanPhamTheoMaSP(){
        global $conn;
        $masp = $_POST["masp"];
        $tensp = $_POST["tensp"];
        $giasp = $_POST["giasp"];
        $maloaisp = $_POST["maloaisp"];
        $soluongsp = $_POST["soluongsp"];
        $mathuonghieu = $_POST["mathuonghieu"];
        $thongtinsp = $_POST["thongtinsp"];
        $hinhlon = $_POST["hinhlon"];
        $hinhnho = $_POST["hinhnho"];
        $manv = 1;
        $luotmua = 0;
        
        $mangtenctsp = isset($_POST["mangtenctsp"]) ? $_POST["mangtenctsp"] : [];
        $manggiatrictsp = isset($_POST["manggiatrictsp"]) ? $_POST["manggiatrictsp"]  : []; 
        $mangmachitietsanpham = isset($_POST["mangmachitietsanpham"]) ? $_POST["mangmachitietsanpham"] : [];
        $mangtenctspbosung = isset($_POST["mangtenctspbosung"]) ? $_POST["mangtenctspbosung"] : [];
        $manggiatrictspbosung = isset($_POST["manggiatrictspbosung"]) ? $_POST["manggiatrictspbosung"] : [];

        $truyvan = "UPDATE sanpham SET TENSP = '".$tensp."', GIA = '".$giasp."', MALOAISP = '".$maloaisp."', SOLUONG = '".$soluongsp."', MATHUONGHIEU = '".$mathuonghieu."', THONGTIN = '".$thongtinsp."', HINHLON = '".$hinhlon."',HINHNHO = '".$hinhnho."', MANV = '".$manv."',LUOTMUA = '".$luotmua."' WHERE MASP = '".$masp."'";
        $ketqua = mysqli_query($conn, $truyvan);

        if($ketqua){
            $dem = count($mangmachitietsanpham);
            for($i = 0; $i < $dem; $i++){
                $tenchitiet = $mangtenctsp[$i];
                $giatrichitiet = $manggiatrictsp[$i];
                $machitiet = $mangmachitietsanpham[$i];

                $truyvancon = "UPDATE chitietsanpham SET TENCHITIET = '".$tenchitiet."', GIATRI = '".$giatrichitiet."' WHERE MACHITIET = '".$machitiet."'";
                mysqli_query($conn, $truyvancon);
            }

            $demchitietbs = count($mangtenctspbosung);
            if($demchitietbs > 0){
                for($i = 0; $i < $demchitietbs; $i++){
                    $tenchitietbs = $mangtenctspbosung[$i];
                    var_dump($tenchitietbs);
                    $giatrichitietbs = $manggiatrictspbosung[$i];
                    $truyvanchitiet = "INSERT INTO chitietsanpham(MASP, TENCHITIET, GIATRI) VALUE('".$masp."', '".$tenchitietbs."', '".$giatrichitietbs."')";
                    mysqli_query($conn, $truyvanchitiet);                  
                }
            }
            echo "Cập nhật sản phẩm thành công";
        }else {
            echo "Cập nhật sản phẩm thất bại";
        }
    }

    //Lấy chi tiết sản phẩm
    function LayChiTietSanPhamTheoMa(){
        global $conn;
        $masp = $_POST["masp"];

        $truyvan = "SELECT * FROM chitietsanpham WHERE MASP = '".$masp."'";
        $ketqua = mysqli_query($conn, $truyvan);
        if ($ketqua) {
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr>
                            <th>
                                <input type = "number" name = "mangmactsp[]" id = "mangmachitietsanpham" class = "anbottom" VALUE = "'.$dong["MACHITIET"].'"/>
                                Tên chi tiết: <input class = "phanctsp" type = "text" id = "id_ctsanpham" name = "mangtenctsp[]" VALUE = "'.$dong["TENCHITIET"].'"> 
                            </th>
                            <th data-machitiet = "'.$dong["MACHITIET"].'">
                                Giá trị: <input class = "phanctsp" type = "text" id = "id_giatri" name = "manggiatrictsp[]" VALUE = "'.$dong["GIATRI"].'">
                                <a class = "btn btn-success btn_themctsp anbottom">Thêm</a>
                                <a class = "btn btn-danger btn_xoactsp ">Xóa</a>
                            </th>
                        </tr>';
            }
        } 
        
    }

    //Xóa sản phẩm
    function XoaSanPham(){
        global $conn;
        $masp = $_POST["masp"];
        $kiemtra = false;
        if (XoaChiTietKhuyenMaiTheoMaSP($masp)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        if (XoaChiTietSanPhamTheoMaSP($masp)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        if (XoaChiTietHoaDonTheoMaSP($masp)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        if (XoaDanhGiaTheoMaSP($masp)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        if (XoaChiTietBinhLuanTheoMaSP($masp)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        $truyvan = "DELETE FROM sanpham WHERE MASP = ".$masp;
        $ketqua = mysqli_query($conn, $truyvan);
        if ($ketqua) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        echo $kiemtra;
        
    }

    //  Thêm sản phẩm
    function ThemSanPham(){
        global $conn;
        $tensp = $_POST["tensp"];
        $giasp = $_POST["giasp"];
        $maloaisp = $_POST["maloaisp"];
        $soluongsp = $_POST["soluongsp"];
        $mathuonghieu = $_POST["mathuonghieu"];
        $thongtinsp = $_POST["thongtinsp"];
        $hinhlon = $_POST["hinhlon"];
        $hinhnho = $_POST["hinhnho"];
        $manv = 1;
        $luotmua = 0;
        
        $mangtenctsp = isset($_POST["mangtenctsp"]) ? $_POST["mangtenctsp"] : [];
        $manggiatrictsp = isset($_POST["manggiatrictsp"]) ? $_POST["manggiatrictsp"] : [];

        $truyvan = "INSERT INTO sanpham(TENSP, GIA, MALOAISP, SOLUONG, MATHUONGHIEU, THONGTIN, HINHLON, HINHNHO, MANV, LUOTMUA) VALUE('".$tensp."', '".$giasp."', '".$maloaisp."', '".$soluongsp."', '".$mathuonghieu."','".$thongtinsp."', '".$hinhlon."','".$hinhnho."', '".$manv."','".$luotmua."')";
        $ketqua = mysqli_query($conn, $truyvan);

        $masp = mysqli_insert_id($conn);
        $dem = count($mangtenctsp);
        for($i = 0; $i < $dem; $i++){
            $tenchitiet = $mangtenctsp[$i];
            $giatrichitiet = $manggiatrictsp[$i];

            $truyvancon = "INSERT INTO chitietsanpham(MASP, TENCHITIET, GIATRI) VALUE('".$masp."', '".$tenchitiet."', '".$giatrichitiet."')";
            $kt = mysqli_query($conn, $truyvancon);
        }
        if ($ketqua) {
            echo "Thêm sản phẩm thành công";
        } else {
            echo "Thêm sản phẩm thất bại";
        }
        
    }
/*Kết thúc phần quản lý sản phẩm */

/*Phần quản lý loại sản phẩm */
    //Tìm kiếm loại sản phẩm
    function TimKiemLoaiSP(){
        global $conn;
        $tenLoaiSP = $_POST["timkiem"];
        $truyvan = "SELECT MALOAISP, TENLOAISP, MALOAI_CHA FROM loaisanpham WHERE TENLOAISP LIKE '%".$tenLoaiSP."%'";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td>".$dong["TENLOAISP"]."</td>";
                    echo '<td><input name = "cb_mang[]" data-id = "'.$dong["MALOAISP"].'" type="checkbox" id = "id_chon'.$dong["MALOAISP"].'"></td>';
                echo '</tr>';
                
                $i++;
            }
        }
    }

    //Phân trang loại sản phẩm
    function PhanTrangLoaiSP(){
        global $conn;
        $truyvan = "SELECT MALOAISP, TENLOAISP, MALOAI_CHA FROM loaisanpham";
        $ketqua = mysqli_query($conn, $truyvan);
        $count = ceil(mysqli_num_rows($ketqua)/10);
        echo '<li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>';
        for($i = 1; $i <= $count; $i++){
            if($i == 1){
                echo '<li class = "active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="#">'.$i.'</a></li>';
            }
            
        }
        echo '<li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
    }

    //Xóa loại sản phẩm
    function XoaLoaiSanPham(){
        global $conn;
        $mangmaloainv = $_POST["mangmaloai"];
        for($i = 0; $i < count($mangmaloainv); $i++){
            DeQuyTheoMaLoai($mangmaloainv[$i]);
            XoaCacBangLienQuanLoaiSP($mangmaloainv[$i]);          
        }
    }

    //Lấy danh sách loại sản phẩm
    function LayDanhSachLoaiSP(){
        global $conn;
        $sotrang = $_POST["sotrang"];
        $limit = ($sotrang-1)*10;
        $truyvan = "SELECT MALOAISP, TENLOAISP, MALOAI_CHA FROM loaisanpham LIMIT ".$limit.",10";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td>".$dong["TENLOAISP"]."</td>";
                    echo '<td><input name = "cb_mang[]" data-id = "'.$dong["MALOAISP"].'" type="checkbox" id = "id_chon'.$dong["MALOAISP"].'"></td>';
                echo '</tr>';
                
                $i++;
            }
        }
        
    }

    //Thêm loại sản phẩm
    function ThemLoaiSanPham(){
        global $conn;
        $tenloaisp = $_POST["tenloaisp"];
        $maloaicha = $_POST["maloaicha"];
        if($tenloaisp == ""){
            echo '<script type="text/javascript">alert("Error!!!");</script>';
        }else{
            $truyvan = "INSERT INTO loaisanpham(TENLOAISP, MALOAI_CHA) VALUE('".$tenloaisp."', '".$maloaicha."')";
            $ketqua = mysqli_query($conn, $truyvan);
            if($ketqua){
                echo '<script type="text/javascript">alert("Thêm loại sản phẩm thành công.");</script>';
            }else{
                echo '<script type="text/javascript">alert("Error!!!");</script>';
            }
        }
    }
/*Kết thúc phần loại sản phẩm */

/*Phần nhân viên */
    //Tìm kiếm loại nhân viên
    function TimKiemNV(){
        global $conn;
        $tennv = $_POST["timkiem"];
        $truyvan = "SELECT * FROM nhanvien WHERE TENNV LIKE '%".$tennv."%'";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                echo "<td>".$i."</td>";
                echo "<td >".$dong["TENNV"]."</td>";
                echo "<td>".$dong["TENDANGNHAP"]."</td>";
                echo "<td>".$dong["NGAYSINH"]."</td>";
                echo "<td>".$dong["DIACHI"]."</td>";
                echo "<td>".$gender."</td>";
                echo "<td>".$dong["CMND"]."</td>";
                echo "<td>".$dong["TENLOAINV"]."</td>";
                echo "<td data-id = '".$dong["MANV"]."'>
                            <a class = 'btn btn-info btn_suanv'>Sửa</a>
                            <a class = 'btn btn-danger btn_xoanv'>Xóa</a>
                    </td>";
            echo '</tr>';
                
                $i++;
            }
        }
    }

    //Cập nhật sản phẩm
    function CapNhatNhanVien(){
        global $conn;
        $manv = $_POST["manv"];
        $tennv = $_POST["tennv"];
        $tendangnhap = $_POST["tendangnhap"];
        $matkhau = $_POST["matkhau"];
        $diachi = $_POST["diachi"];
        $ngaysinh = $_POST["ngaysinh"];
        $socmnd = $_POST["socmnd"];
        $loainv = $_POST["loainv"];
        $gioitinh = isset($_POST["gioitinh"]) ? $_POST["gioitinh"] : "";

        $truyvan = "UPDATE nhanvien SET TENNV = '".$tennv."', TENDANGNHAP = '".$tendangnhap."', NGAYSINH = '".$ngaysinh."', DIACHI = '".$diachi."', GIOITINH = '".$gioitinh."', CMND = '".$socmnd."', MALOAINV = '".$loainv."'  WHERE MANV = '".$manv."'";
        $ketqua = mysqli_query($conn, $truyvan);

        if($ketqua){
            echo "Cập nhật sản phẩm thành công";
        }else {
            echo "Cập nhật sản phẩm thất bại";
        }
    }

    //Lấy danh sách nhân viên
    function LayDanhSachNV(){
        global $conn;
        $sotrang = $_POST["sotrang"];
        $limit = ($sotrang-1)*10;
        $truyvan = "SELECT * FROM nhanvien, loainhanvien WHERE nhanvien.MALOAINV = loainhanvien.MALOAINV LIMIT ".$limit.",10";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                if($dong["GIOITINH"] == 1){
                    $gender = "Nữ";
                }else if($dong["GIOITINH"] == 0){
                    $gender = "Nam";
                }
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td >".$dong["TENNV"]."</td>";
                    echo "<td>".$dong["TENDANGNHAP"]."</td>";
                    echo "<td>".$dong["NGAYSINH"]."</td>";
                    echo "<td>".$dong["DIACHI"]."</td>";
                    echo "<td>".$gender."</td>";
                    echo "<td>".$dong["CMND"]."</td>";
                    echo "<td>".$dong["TENLOAINV"]."</td>";
                    echo "<td data-id = '".$dong["MANV"]."'>
                                <a class = 'btn btn-info btn_suanv'>Sửa</a>
                                <a class = 'btn btn-danger btn_xoanv'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
    }

    //  Thêm nhân viên
    function ThemNhanVien(){
        global $conn;
        $tennv = $_POST["tennv"];
        $tendangnhap = $_POST["tendangnhap"];
        $matkhau = $_POST["matkhau"];
        $diachi = $_POST["diachi"];
        $ngaysinh = $_POST["ngaysinh"];
        $socmnd = $_POST["socmnd"];
        $loainv = $_POST["loainv"];
        $gioitinh = isset($_POST["gioitinh"]) ? $_POST["gioitinh"] : "";

        $truyvan = "INSERT INTO nhanvien(TENNV, TENDANGNHAP, MATKHAU, NGAYSINH, DIACHI, GIOITINH, CMND, MALOAINV) VALUE('".$tennv."', '".$tendangnhap."', '".$matkhau."','".$ngaysinh."', '".$diachi."', '".$gioitinh."','".$socmnd."', '".$loainv."')";
        $ketqua = mysqli_query($conn, $truyvan);
        if ($ketqua) {
            echo "Thêm nhân viên thành công";
        } else {
            echo "Thêm nhân viên thất bại";
        }   
    }

    function XoaNhanVien(){
        global $conn;
        $manv = $_POST["manv"];
        $kiemtra = false;
        if (XoaSanPhamTheoMaNV($manv)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        if (XoaChiTietBinhLuanTheoMaNV($manv)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        $truyvan = "DELETE FROM nhanvien WHERE MANV = ".$manv;
        $ketqua = mysqli_query($conn, $truyvan);
        if ($ketqua) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        echo $kiemtra;
    }
/*Kết thúc phần nhân viên */

/*Phần loại nhân viên */
    //Lấy danh sách loại nhân viên
    function LayDanhSachLoaiNV(){
        global $conn;
        $sotrang = $_POST["sotrang"];
        $limit = ($sotrang-1)*10;
        $truyvan = "SELECT * FROM loainhanvien LIMIT ".$limit.",10";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td>".$dong["TENLOAINV"]."</td>";
                    echo "<td data-id = '".$dong["MALOAINV"]."'>
                            <a class = 'btn btn-danger btn_xoaloainv'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
        
    }

    //Thêm loại nhân viên
    function ThemLoaiNhanVien(){
        global $conn;
        $tenloainv = $_POST["tenloainv"];
        $maloainv = $_POST["maloainv"];
        if($tenloainv == ""){
            echo "Bạn cần điền thông tin.";
        }else{
            $truyvan = "INSERT INTO loainhanvien(TENLOAINV, MALOAINV) VALUE('".$tenloainv."', '".$maloainv."')";
            $ketqua = mysqli_query($conn, $truyvan);
            if($ketqua){
                echo "Thêm loại nhân viên thành công.";
            }else{
                echo "Thêm loại nhân viên thất bại!!!";
            }
        }
    }

    //Tìm kiếm loại nhân viên
    function TimKiemLoaiNV(){
        global $conn;
        $tenloainv = $_POST["timkiem"];
        $truyvan = "SELECT * FROM loainhanvien WHERE TENLOAINV LIKE '%".$tenloainv."%'";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td>".$dong["TENLOAINV"]."</td>";
                    echo "<td data-id = '".$dong["MALOAINV"]."'>
                            <a class = 'btn btn-danger btn_xoaloainv'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
    }

    //Phân trang loại nhân viên
    function PhanTrangLoaiNV(){
        global $conn;
        $truyvan = "SELECT * FROM loainhanvien";
        $ketqua = mysqli_query($conn, $truyvan);
        $count = ceil(mysqli_num_rows($ketqua)/10);
        echo '<li>
                    <a href="#" aria-label="Previous">
                        <span aria-hidden="true">&laquo;</span>
                    </a>
                </li>';
        for($i = 1; $i <= $count; $i++){
            if($i == 1){
                echo '<li class = "active"><a href="#">'.$i.'</a></li>';
            }else{
                echo '<li><a href="#">'.$i.'</a></li>';
            }
            
        }
        echo '<li>
                <a href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>';
    }

    //Xóa loại nhân viên
    function XoaLoaiNhanVien(){
        global $conn;
        $maloainv = $_POST["maloainv"];
        $kiemtra = false;
        if (XoaNhanVienTheoMaLoaiNV($maloainv)) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        $truyvan = "DELETE FROM loainhanvien WHERE MALOAINV = ".$maloainv;
        $ketqua = mysqli_query($conn, $truyvan);
        if ($ketqua) {
            $kiemtra = true;
        } else {
            $kiemtra = false;
        }

        echo $kiemtra;
    }
/*Kết thúc phần loại nhân viên */

/*Phần xóa các bảng */

    //Xóa chi tiết bình luân theo mã bình luận
    function XoaChiTietBinhLuanTheoMaBL($maBL){
        global $conn;
        $truyvan = "DELETE FROM chitietbinhluan WHERE MABL = ".$maBL;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa nhân viên theo mã loại nhân viên
    function XoaNhanVienTheoMaLoaiNV($maloaiNV){
        global $conn;
        $truyvan = "DELETE FROM nhanvien WHERE MALOAINV = ".$maloaiNV;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa chi tiết bình luân theo mã bình luận
    function XoaBinhLuanTheoMaBL($maBL){
        global $conn;
        $truyvan = "DELETE FROM binhluan WHERE MABL = ".$maBL;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa sản phẩm theo mã nhân viên
    function XoaSanPhamTheoMaNV($maNV){
        global $conn;
        $truyvan = "DELETE FROM sanpham WHERE MANV = ".$maNV;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa nhân viên theo mã nhân viên
    function XoaNhanVienTheoMaNV($maNV){
        global $conn;
        $truyvan = "DELETE FROM nhanvien WHERE MANV = ".$maNV;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa chi tiết bình luân theo mã nhân viên
    function XoaChiTietBinhLuanTheoMaNV($maNV){
        global $conn;
        $truyvan = "DELETE FROM chitietbinhluan WHERE MANV = ".$maNV;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }
    
    //Đệ quy theo mã loại
    function DeQuyTheoMaLoai($maloaisp){
        global $conn;
        $truyvan = "SELECT * FROM loaisanpham WHERE MALOAI_CHA=".$maloaisp;
        $ketqua = mysqli_query($conn, $truyvan);
        $maloaicha = 0;
        if ($ketqua) {
            while ($dong = mysqli_fetch_array($ketqua)) {
                $maloaicha = $dong["MALOAI_CHA"];
                XoaCacBangLienQuanLoaiSP($maloaicha);
                DeQuyTheoMaLoai($maloaicha);
            }
        }
    }

    //Xóa các bảng liên quan loại sản phẩm
    function XoaCacBangLienQuanLoaiSP($maloaisp){
        LayVaXoaSanPhamTheoMaSP($maloaisp);
        XoaChiTietThuongHieuTheoMaLoai($maloaisp);
        LayVaXoaChiTietKhuyenMaiTheoMaKM($maloaisp);
        XoaKhuyenMaiTheoMaLoai($maloaisp);
        XoaBangLoaiSPTheoMaLoai($maloaisp);
    }

    //Xóa bảng loại sản phẩm theo mã loại
    function XoaBangLoaiSPTheoMaLoai($maloaisp){
        global $conn;
        $truyvan = "DELETE FROM loaisanpham WHERE MALOAISP = ".$maloaisp;
        mysqli_query($conn, $truyvan);
    }

    //Lấy và xóa sản phẩm theo mã sản phẩm
    function LayVaXoaSanPhamTheoMaSP($maloaisp){
        global $conn;
        $truyvan = "SELECT * FROM khuyenmai WHERE MALOAISP=".$maloaisp;
        $ketqua = mysqli_query($conn, $truyvan);
        $maSP = 0;
        if ($ketqua) {
            while ($dong = mysqli_fetch_array($ketqua)) {
                $maSP = $dong["MASP"];
                XoaChiTietKhuyenMaiTheoMaSP($maSP);
                XoaChiTietSanPhamTheoMaSP($maSP);
                XoaChiTietHoaDonTheoMaSP($maSP);
                XoaDanhGiaTheoMaSP($maSP);
                XoaChiTietBinhLuanTheoMaSP($maSP);
            }

            $truyvan = "DELETE FROM sanpham WHERE MALOAISP = ".$maloaisp;
            mysqli_query($conn, $truyvan);

        } 
        
    }

    //Xóa chi tiết bình luận theo mã sản phẩm
    function XoaChiTietBinhLuanTheoMaSP($maSP){
        global $conn;
        $truyvan = "DELETE FROM chitietbinhluan WHERE MASP = ".$maSP;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //XÓa đánh giá theo mã sản phẩm
    function XoaDanhGiaTheoMaSP($maSP){
        global $conn;
        $truyvan = "DELETE FROM danhgia WHERE MASP = ".$maSP;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa chi tiết hóa đơn theo mã sản phẩm
    function XoaChiTietHoaDonTheoMaSP($maSP){
        global $conn;
        $truyvan = "DELETE FROM chitiethoadon WHERE MASP = ".$maSP;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa chi tiết khuyến mại theo mã sản phẩm
    function XoaChiTietKhuyenMaiTheoMaSP($maSP){
        global $conn;
        $truyvan = "DELETE FROM chitietkhuyenmai WHERE MASP = ".$maSP;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Xóa chi tiết sản phẩm theo mã sản phẩm
    function XoaChiTietSanPhamTheoMaSP($maSP){
        global $conn;
        $truyvan = "DELETE FROM chitietsanpham WHERE MASP = ".$maSP;
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            return true;
        }else{
            return false;
        }
    }

    //Lấy và xóa chi tiết khuyến mại theo mã khuyến mại
    function LayVaXoaChiTietKhuyenMaiTheoMaKM($maloaisp){
        global $conn;
        $truyvan = "SELECT * FROM khuyenmai WHERE MALOAISP=".$maloaisp;
        $ketqua = mysqli_query($conn, $truyvan);
        $maKM = 0;
        if ($ketqua) {
            while ($dong = mysqli_fetch_array($ketqua)) {
                $maKM = $dong["MAKM"];
                XoaChiTietKhuyenMaiTheoMaKM($maKM);
            }
        } else {
            # code...
        }
        
    }

    //Xóa chi tiết khuyến mại theo mã khuyên mại
    function XoaChiTietKhuyenMaiTheoMaKM($maKM){
        global $conn;
        $truyvan = "DELETE FROM chitietkhuyenmai WHERE MAKM = ".$maKM;
        mysqli_query($conn, $truyvan);
    }

    //Xóa khuyến mại theo mã loại
    function XoaKhuyenMaiTheoMaLoai($maloaisp){
        global $conn;
        $truyvan = "DELETE FROM khuyenmai WHERE MALOAISP = ".$maloaisp;
        mysqli_query($conn, $truyvan);
    }

    //Xóa chi tiết thương hiệu theo mã loại
    function XoaChiTietThuongHieuTheoMaLoai($maloaisp){
        global $conn;
        $truyvan = "DELETE FROM chitietthuonghieu WHERE MALOAISP = ".$maloaisp;
        mysqli_query($conn, $truyvan);
    }
/*Kết thúc phần xóa các bảng */

?>