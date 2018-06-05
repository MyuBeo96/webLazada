<?php
    include("../config.php");
?>

<div class = "page-title">
    <span class = "title">Thương hiệu</span>
    <div class = "description">Quản lý nội dung liên quan đến thương hiệu</div>
</div>

<div>
    <a class = "btn_hienthithemth btn btn-info">Tạo mới thương hiệu</a>
    <a class = "btn_hienthidsth btn btn-info">Hiển thị danh sách thương hiệu</a>
</div>

<div id = "col-left" style = "width: 100%;" class = "taomoithuonghieu anbottom">
    <div class = "page-title">

        <table id = "table" class="table table-striped table-bordered table-hover" style="width: 100%;">
            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_tenthuonghieu">Tên thương hiệu</label>
                        <input class="form-control" placeholder="Nhập tên thương hiệu" type = "text" id = "id_tenthuonghieu" required>
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2" id="khunghinhth">  
                    <label for = "id_logoth">Logo thương hiệu</label>
                    <div class="form-group">
                        <input id = "id_logoth" name = "id_logoth" class="file" type="file" data-preview-file-type="any" data-upload-url="http://localhost:8080/webLazada/table/uploadhinhth.php">
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2">
                    <h3>Thêm chi tiết thương hiệu</h3>
                    <div id = "khungthemchitiethoadon">
                        <table class="table table-striped table-bordered table-hover" style  = "width: 100%;">
                            <tr>
                                <th>
                                    <label for = "id_tenloaispchitiet">Tên loại sản phẩm: </label>
                                    <div class="form-group">
                                        <select id = "id_tenloaispchitiet">
                                            <?php
                                                HienThiDanhMucLoaiSP();
                                            ?>
                                        </select>
                                    </div>
                                </th>
                            </tr>
                            <tr>
                                <th>
                                    <label for = "id_hinhspchitiet">Hình sản phẩm: </label>
                                        <div class="form-group">
                                    <input id = "id_hinhspchitiet" name = "id_hinhspchitiet" class="file" type="file" data-preview-file-type="any" data-upload-url="http://localhost:8080/webLazada/table/uploadhinhth.php">
                                    </div>
                                </th>
                                
                            </tr>
                            <tr>
                                <th>
                                    <a class = "btn btn-success btn_themsphd ">Thêm</a>
                                    <a class = "btn btn-danger btn_xoasphd anbottom">Xóa</a>
                                </th>
                            </tr>
                        </table>
                    </div>
                </th>
            </tr>

        </table>
    
        <input type="button" class="btn btn-primary" id = "btn_themth" value = "Thêm"/>
    </div>
</div>

<div id = "col-right" style = "width: 100%;" class = "danhsachthuonghieu">
    <div id = "card">
        <div class = "page-title">
            <span class = "title">Danh sách thương hiệu</span>
        </div>

        <!-- <input type="button" class="btn btn-danger" id = "btn_xoasp" value = "Xóa" style = "margin-left: 2%;">
        <input type="button" class="btn btn-primary" id = "btn_suasp" value = "Sửa" style = "margin-left: 2%;"> -->
            <div class="form-group input-group" style = "width: 40%; margin-left: 2%;">
                <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiemth"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id = "btn_timkiemth"><i class="fa fa-search"></i></button>
                </span>
            </div>
        

        <!-- /.panel-heading -->
        <div class="panel-body" style = "width: 100%;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="info">
                            <th>STT</th>
                            <th>Tên thương hiệu</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Hình thương hiệu</th>
                            <th style = "width: 125px;">Hình thức</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            LayDanhSachTH(0);
                        ?>                    
                    </tbody>
                </table>
                    <?php
                        PhanTrangLoaiThuongHieu();
                    ?>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>

<?php

function PhanTrangLoaiThuongHieu(){
    global $conn;
    $truyvan = "SELECT * FROM thuonghieu, loaisanpham, chitietthuonghieu
    WHERE chitietthuonghieu.MALOAISP = loaisanpham.MALOAISP AND thuonghieu.MATHUONGHIEU = chitietthuonghieu.MATHUONGHIEU";
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

    function LayDanhSachTH($limit){
        global $conn;
        $truyvan = "SELECT * FROM thuonghieu, loaisanpham, chitietthuonghieu
         WHERE chitietthuonghieu.MALOAISP = loaisanpham.MALOAISP AND thuonghieu.MATHUONGHIEU = chitietthuonghieu.MATHUONGHIEU LIMIT ".$limit.",10";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td data-tenth = '".$dong["MATHUONGHIEU"]."'>".$dong["TENTHUONGHIEU"]."</td>";
                    echo "<td data-maloaisp = '".$dong["MALOAISP"]."'>".$dong["TENLOAISP"]."</td>";
                    echo "<td data-hinhth = '".$dong["HINHTHUONGHIEU"]."'><img style = 'width: 200px; height: 200px;' src = '..".$dong["HINHTHUONGHIEU"]."'/></td>";    
                    echo "<td data-id = '".$dong["MATHUONGHIEU"]."'>
                                <a class = 'btn btn-danger btn_xoath'>Xóa</a>
                        </td>";
                echo '</tr>';
                
                $i++;
            }
        }
        
    }
?>