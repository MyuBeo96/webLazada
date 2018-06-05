<?php
    include("../config.php");
?>

<div class = "page-title">
        <span class = "title">Thành viên</span>
        <div class = "description">Quản lý nội dung liên quan đến thành viên</div>
</div>

<div>
    <a class = "btn_hienthithemnv btn btn-info">Tạo mới thành viên</a>
    <a class = "btn_hienthidsnv btn btn-info">Hiển thị danh sách thành viên</a>
</div>

<div id = "col-left" style = "width: 100%;" class = "taomoithanhvien anbottom">
    <div class = "page-title">

        <table id = "table" class="table table-striped table-bordered table-hover" style="width: 100%;">
            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_tennhanvien">Tên thành viên</label>
                        <input class="form-control" placeholder="Nhập tên thành viên" type = "text" id = "id_tennhanvien" required>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_tendangnhap">Tên đăng nhập</label>
                        <input class="form-control" placeholder="Nhập tên đăng nhập" type = "text" id = "id_tendangnhap" required>
                    </div>
                </th>
            </tr>

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_matkhau">Mật khẩu</label>
                        <input class="form-control" placeholder="Nhập mật khẩu" type = "password" id = "id_matkhau" required>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_diachi">Địa chỉ</label>
                        <textarea class="form-control" rows="2" id = "id_diachi" placeholder = "Nhập địa chỉ" required></textarea>
                    </div>
                </th>
            </tr>

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_ngaysinh">Ngày sinh</label>
                        <input class="form-control" type = "date" id = "id_ngaysinh" required>
                    </div>
                </th>

                <th >
                    <div class="form-group">
                        <label for = "id_gioitinh">Giới tính</label>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gioitinh" id="gt_nu" value="1">Nữ
                            </label>
                        </div>
                        <div class="radio">
                            <label>
                                <input type="radio" name="gioitinh" id="gt_nam" value="0">Nam
                            </label>
                        </div>
                    </div>
                </th>
            </tr>
            

            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_scmnd">Số chứng minh nhân dân</label>
                        <input class="form-control" placeholder="Nhập số chứng minh nhân dân" type = "number" id = "id_scmnd" required>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_loainv">Loại nhân viên</label>
                        <select class="form-control" id = "id_loainv">
                            <option value = "0">Không</option>
                            <?php
                                LayDanhSachLoaiNhanVien();
                            ?>
                        </select>
                    </div>
                </th>
            </tr>
        </table>
    
        <input type="button" class="btn btn-primary" id = "btn_themnv" value = "Thêm"/>
        <input type="button" class="btn btn-primary" id = "btn_capnhatnv" value = "Cập nhật"/>
    </div>
</div>

<div id = "col-right" style = "width: 100%;" class = "danhsachnhanvien">
    <div id = "card">
        <div class = "page-title">
            <span class = "title">Danh sách thành viên</span>
        </div>

        <!-- <input type="button" class="btn btn-danger" id = "btn_xoasp" value = "Xóa" style = "margin-left: 2%;">
        <input type="button" class="btn btn-primary" id = "btn_suasp" value = "Sửa" style = "margin-left: 2%;"> -->
            <div class="form-group input-group" style = "width: 40%; margin-left: 2%;">
                <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiemnhanvien"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id = "btn_timkiemnhanvien"><i class="fa fa-search"></i></button>
                </span>
            </div>
        

        <!-- /.panel-heading -->
        <div class="panel-body" style = "width: 100%;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover danhsach">
                    <thead>
                        <tr class="info">
                            <th>STT</th>
                            <th>Tên thành viên</th>
                            <th>Tên đăng nhập</th>
                            <th>Ngày sinh</th>
                            <th>Địa chỉ</th>
                            <th>Giới tính</th>
                            <th>Số chứng minh nhân dân</th>
                            <th>Tên loại nhân viên</th>
                            <th style = "width: 125px;">Hình thức</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <?php
                            LayDanhSachNV(0);
                        ?>                     
                    </tbody>
                </table>
                <?php
                        PhanTrangNV();
                    ?> 
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>

<?php

function PhanTrangNV(){
    global $conn;
    $truyvan = "SELECT * FROM nhanvien, loainhanvien WHERE nhanvien.MALOAINV = loainhanvien.MALOAINV";
    $ketqua = mysqli_query($conn, $truyvan);
    $count = ceil(mysqli_num_rows($ketqua)/10);
    echo '<div>
            <nav>
                <ul class="pagination">
                    <li>
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
                        </li>
                    </ul>
                </nav>
            </div>';
}

    function LayDanhSachLoaiNhanVien(){
        global $conn;
        $truyvan = "SELECT * FROM loainhanvien";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo "<option value = '".$dong["MALOAINV"]."'>".$dong["TENLOAINV"]."</option>";
            }
        }
    }

    function LayDanhSachNV($limit){
        global $conn;
        $truyvan = "SELECT * FROM nhanvien, loainhanvien
         WHERE nhanvien.MALOAINV = loainhanvien.MALOAINV LIMIT ".$limit.",10";
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
                    echo "<td class = 'anbottom' data-matkhau = '".$dong["MATKHAU"]."'>".$dong["MATKHAU"]."</td>";
                    echo "<td data-tennv = '".$dong["TENNV"]."'>".$dong["TENNV"]."</td>";
                    echo "<td data-tendangnhap = '".$dong["TENDANGNHAP"]."'>".$dong["TENDANGNHAP"]."</td>";
                    echo "<td data-ngaysinh = '".$dong["NGAYSINH"]."'>".$dong["NGAYSINH"]."</td>";
                    echo "<td data-diachi = '".$dong["DIACHI"]."'>".$dong["DIACHI"]."</td>";
                    echo "<td data-gioitinh = '".$dong["GIOITINH"]."'>".$gender."</td>";
                    echo "<td data-cmnd = '".$dong["CMND"]."'>".$dong["CMND"]."</td>";
                    echo "<td data-maloainv = '".$dong["MALOAINV"]."'>".$dong["TENLOAINV"]."</td>";
                    echo "<td data-id = '".$dong["MANV"]."'>
                                <a class = 'btn btn-info btn_suanv'>Sửa</a>
                                <a class = 'btn btn-danger btn_xoanv'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
        
    }
    
?>