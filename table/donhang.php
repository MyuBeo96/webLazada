<?php
    include("../config.php");
?>

<div class = "page-title">
        <span class = "title">Hóa đơn</span>
        <div class = "description">Quản lý nội dung liên quan đến hóa đơn</div>
</div>

<div>
    <a class = "btn_hienthithemhd btn btn-info">Tạo mới hóa đơn</a>
    <a class = "btn_hienthidshd btn btn-info">Hiển thị danh sách hóa đơn</a>
</div>

<div id = "col-left" style = "width: 100%;" class = "taomoihoadon anbottom">
    <div class = "page-title">

        <table id = "table" class="table table-striped table-bordered table-hover" style="width: 100%;">
            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_tenchuhd">Chủ đơn hàng</label>
                        <input class="form-control" placeholder="Nhập tên chủ đơn hàng" type = "text" id = "id_tenchuhd" required>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_hdsdt">Số điện thoại</label>
                        <input class="form-control" placeholder="Nhập số điện thoại đơn hàng" type = "number" id = "id_hdsdt" required>
                    </div>
                </th>
            </tr>

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_hddiachi">Địa chỉ</label>
                        <input class="form-control" placeholder="Nhập địa chỉ chủ đơn hàng" type = "text" id = "id_hddiachi" required>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_ngaydat">Ngày đặt</label>
                        <input class="form-control" id = "id_ngaydat" type = "date" required></input>
                    </div>
                </th>
            </tr>

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_trangthai">Trạng thái</label>
                        <select class="form-control" id = "id_trangthai">
                            <option value = "Đang chờ kiểm duyệt">Đang chờ kiểm duyệt</option>
                            <option value = "Hủy đơn hàng">Hủy đơn hàng</option>
                            <option value = "Đang giao hàng">Đang giao hàng</option>
                            <option value = "Hoàn thành">Hoàn thành</option>
                        </select>
                    </div>
                </th>

                <th >
                    <div class="form-group">
                        <label for = "id_ngaygiao">Ngày giao</label>
                        <input class="form-control" id = "id_ngaygiao" type = "date" required></input> 
                    </div>
                </th>
            </tr>
            

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_chuyenkhoan">Hình thức thanh toán</label>
                        <select class="form-control" id = "id_chuyenkhoan">
                            <option value = "0">Chưa thanh toán</option>
                            <option value = "1">Đã thanh toán</option>
                        </select>
                    </div>
                </th>

                <th >
                    <div class="form-group">
                        <label for = "id_machuyenkhoan">Mã chuyển khoản (Nếu có)</label>
                        <input class="form-control" id = "id_machuyenkhoan" type = "number"></input> 
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2">
                    <h3>Thêm chi tiết hóa đơn</h3>
                    <div id = "khungthemchitiethoadon">
                        <table style  = "width: 100%;">
                            <tr>
                                <th>
                                    Tên sản phẩm: 
                                    <select id = "id_tenspchitiet">
                                        <?php
                                            HienThiDanhSachSP();
                                        ?>
                                    </select>
                                </th>
                                <th>
                                    Số lượng: <input type = "number" id = "id_soluonghd"  value  = "1"> 
                                </th>
                                <th>
                                    <a class = "btn btn-success btn_themsphd ">Thêm</a>
                                    <a class = "btn btn-danger btn_xoasphd anbottom">Xóa</a>
                                </th>
                            </tr>
                        </table>
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2">
                <h3>Danh sách chi tiết hóa đơn</h3>
                    <div id = "khungdanhsachchitiethoadon">
                        <table class="table table-striped table-bordered table-hover">
                            <tbody>
                            
                            </tbody>
                            <!-- <tr>
                                <th>
                                    Tên sản phẩm: <input type = "text" style = "width: 620px;" id = "mangtenchitiethd" name = "mangtenchitiethd[]"> 
                                </th>
                                <th>
                                    Số lượng: <input type = "number" id = "mangsoluongcthd" name = "mangsoluongcthd[]"> 
                                    <a class = "btn btn-danger btn_xoacthd">Xóa</a>
                                </th>
                            </tr> -->
                        </table>
                    </div>
                </th>
            </tr>
        </table>
    
        <input type="button" class="btn btn-primary" id = "btn_themhd" value = "Thêm"/>
        <input type="button" class="btn btn-primary" id = "btn_capnhathd" value = "Cập nhật"/>

    </div>
</div>

<div id = "col-right" style = "width: 100%;" class = "danhsachhoadon">
    <div id = "card">
        <div class = "page-title">
            <span class = "title">Danh sách hóa đơn</span>
        </div>

        <!-- <input type="button" class="btn btn-danger" id = "btn_xoasp" value = "Xóa" style = "margin-left: 2%;">
        <input type="button" class="btn btn-primary" id = "btn_suasp" value = "Sửa" style = "margin-left: 2%;"> -->
            <div class="form-group input-group" style = "width: 40%; margin-left: 2%;">
                <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiemhd"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id = "btn_timkiemhd"><i class="fa fa-search"></i></button>
                </span>
            </div>
        

        <!-- /.panel-heading -->
        <div class="panel-body" style = "width: 100%;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover danhsach">
                    <thead>
                        <tr class="info">
                            <th>STT</th>
                            <th>Tên chủ hóa đơn</th>
                            <th>Số điện thoại</th>
                            <th>Địa chỉ</th>
                            <th>Tình trạng</th>
                            <th>Ngày đặt</th>
                            <th>Ngày giao</th>
                            <th>Chuyển khoản</th>
                            <th>Mã chuyển khoản (Nếu có)</th>
                            <th style = "width: 125px;">Hình thức</th>
                        </tr>
                    </thead>
                    <tbody> 
                        <?php LayDanhSachDonHang(0); ?>                   
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>

<?php

function HienThiDanhSachSP(){
    global $conn;
    $truyvan = "SELECT TENSP, MASP FROM sanpham";
    $ketqua = mysqli_query($conn, $truyvan);
    if($ketqua){
        while ($dong = mysqli_fetch_array($ketqua)) {
            echo "<option value = '".$dong["MASP"]."'>".$dong["TENSP"]."</option>";
        }
    }
}

    function LayDanhSachDonHang($limit){
        global $conn;
        $truyvan = "SELECT * FROM hoadon";
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
?>