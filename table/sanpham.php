<?php
    include("../config.php");
?>

<div class = "page-title">
        <span class = "title">Sản phẩm</span>
        <div class = "description">Quản lý nội dung liên quan đến sản phẩm</div>
</div>
<div>
    <a class = "btn_hienthithemsp btn btn-info">Tạo mới sản phẩm</a>
    <a class = "btn_hienthidssp btn btn-info">Hiển thị danh sách sản phẩm</a>
</div>

<div id = "col-left" style = "width: 100%;" class = "themsanpham anbottom">
    <div class = "page-title">    
       <table id = "table" class="table table-striped table-bordered table-hover" style="width: 100%;">
            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_tensanpham">Tên sản phẩm</label>
                        <input class="form-control" placeholder="Nhập tên sản phẩm" type = "text" id = "id_tensanpham" required>
                    </div>
                </th>

                <th style="width: 15%;">
                    <div class="form-group">
                        <label for = "id_giasanpham">Giá sản phẩm</label>
                        <input class="form-control" placeholder="Nhập giá sản phẩm" type = "number" id = "id_giasanpham" required>
                    </div>
                </th>
            </tr>

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_maloaisp">Mã loại sản phẩm</label>
                        <select class="form-control" id = "id_maloaisp">
                            <option value = "0">Không</option>
                            <?php
                                HienThiDanhMucLoaiSP();
                            ?>
                        </select>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_slsanpham">Số lượng sản phẩm</label>
                        <input class="form-control" placeholder="Nhập số lượng sản phẩm" type = "number" id = "id_slsanpham" required>
                    </div>
                </th>
            </tr>

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_mathuonghieu">Mã thương hiệu</label>
                        <select class="form-control" id = "id_mathuonghieu">
                            <option value = "0">Không</option>
                            <?php
                                LayDanhSachThuongHieu();
                            ?>
                        </select>
                    </div>
                </th>

                <th rowspan = "2">
                    <div class="form-group">
                        <label for = "id_thongtin">Thông tin sản phẩm</label>
                        <textarea class="form-control" rows="2" id = "id_thongtin" placeholder = "Nhập thông tin sản phẩm" required></textarea>
                    </div>
                </th>
            </tr>
            

            <tr>
                <th id="khunghinhlon">
                    <label for = "id_hinhlon">Hình lớn</label>
                    <div class="form-group">
                        <input id = "id_hinhlon" name = "id_hinhlon" class="file" type="file" data-preview-file-type="any" data-upload-url="http://localhost/webLazada/table/uploadhinh.php">
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2" id="khunghinhnho">  
                    <label for = "id_hinhnho">Hình nhỏ</label>
                    <div class="form-group">
                        <input id = "id_hinhnho" name = "id_hinhnho" class="file" type="file" multiple data-preview-file-type="any" data-upload-url="http://localhost/webLazada/table/uploadhinh.php">
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2">
                    <h3>Thông số kỹ thuật</h3>
                    <div id = "khungchitietsanpham">
                        <table>
                            <tr>
                                <th>
                                <input name = "mangtenctsp[]" id = "mangmachitietsanpham" class = "anbottom"/>
                                    Tên chi tiết: <input class = "phanctsp" type = "text" id = "id_ctsanpham" name = "mangtenctsp[]"> 
                                </th>
                                <th>
                                    Giá trị: <input class = "phanctsp" type = "text" id = "id_giatri" name = "manggiatrictsp[]"> 
                                    <a class = "btn btn-success btn_themctsp ">Thêm</a>
                                    <a class = "btn btn-danger btn_xoactsp anbottom">Xóa</a>
                                </th>
                            </tr>
                        </table>
                    </div>
                </th>
            </tr>
        </table>
    
        <input type="button" class="btn btn-primary" id = "btn_themsp" value = "Thêm"/>
        <input type="button" class="btn btn-primary" id = "btn_capnhatsp" value = "Cập nhật"/>

        <div class = "anchitietsanpham">
            <table>
                <tr>
                    <th>
                        Tên chi tiết: <input class = "phanctsp" type = "text" id = "id_ctsanpham" name = "mangtenctsp[]"> 
                    </th>
                    <th>
                        Giá trị: <input class = "phanctsp" type = "text" id = "id_giatri" name = "manggiatrictsp[]"> 
                        <a class = "btn btn-success btn_themctsp">Thêm</a>
                        <a class = "btn btn-danger btn_xoactsp anbottom">Xóa</a>
                    </th>
                </tr>
            </table>
        </div>
    </div>
</div>

<div id = "col-right" style = "width: 100%;" class = "danhsachsp">
        <div id = "card">
            <div class = "page-title">
                <span class = "title">Danh sách sản phẩm</span>
            </div>

            <!-- <input type="button" class="btn btn-danger" id = "btn_xoasp" value = "Xóa" style = "margin-left: 2%;">
            <input type="button" class="btn btn-primary" id = "btn_suasp" value = "Sửa" style = "margin-left: 2%;"> -->
                <div class="form-group input-group" style = "width: 40%; margin-left: 2%;">
                    <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiemsp"/>
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button" id = "btn_timkiemsp"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            

            <!-- /.panel-heading -->
            <div class="panel-body" style = "width: 100%;">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="info">
                                <th>STT</th>
                                <th>Hình sản phẩm</th>
                                <th>Tên sản phẩm</th>
                                <th>Tên loại sản phẩm</th>
                                <th>Tên thương hiệu</th>
                                <th>Giá tiền</th>
                                <th>Số lượng</th>
                                <th style = "width: 125px;">Hình thức</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                LayDanhSachSP(0);
                            ?>                      
                        </tbody>
                    </table>
                    <div id = "phantrangsp" data-tongsotrang = "<?php PhanTrangSP(); ?>">

                    </div>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>

<?php

function LayDanhSachThuongHieu(){
    global $conn;
    $truyvan = "SELECT * FROM thuonghieu";
    $ketqua = mysqli_query($conn, $truyvan);
    if($ketqua){
        while ($dong = mysqli_fetch_array($ketqua)) {
            echo "<option value = '".$dong["MATHUONGHIEU"]."'>".$dong["TENTHUONGHIEU"]."</option>";
        }
    }
}

function PhanTrangSP(){
    global $conn;
    $truyvan = "SELECT * FROM sanpham, loaisanpham, thuonghieu
    WHERE sanpham.MALOAISP = loaisanpham.MALOAISP AND sanpham.MATHUONGHIEU = thuonghieu.MATHUONGHIEU";
    $ketqua = mysqli_query($conn, $truyvan);
    $tongsotrang = ceil(mysqli_num_rows($ketqua)/10);
    echo $tongsotrang;
}

function HienThiDanhMucLoaiSP(){
    global $conn;
    $truyvan = "SELECT MALOAISP, TENLOAISP, MALOAI_CHA FROM loaisanpham";
    $ketqua = mysqli_query($conn, $truyvan);
    if($ketqua){
        while ($dong = mysqli_fetch_array($ketqua)) {
            echo "<option value = '".$dong["MALOAISP"]."'>".$dong["TENLOAISP"]."</option>";
        }
    }
}

function LayDanhSachSP($limit){
    global $conn;
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

?>