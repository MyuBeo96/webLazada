<?php
    include("../config.php");
?>

<div class = "page-title">
    <span class = "title">Khuyến mại</span>
    <div class = "description">Quản lý nội dung liên quan đến khuyến mại</div>
</div>

<div>
    <a class = "btn_hienthithemkm btn btn-info">Tạo mới khuyến mại</a>
    <a class = "btn_hienthidskm btn btn-info">Hiển thị danh sách khuyến mại</a>
</div>

<div id = "col-left" style = "width: 100%;" class = "taomoikhuyenmai anbottom">
    <div class = "page-title">

        <table id = "table" class="table table-striped table-bordered table-hover" style="width: 100%;">
            <tr>
                <th>
                    <div class="form-group">
                        <label for = "id_tenkm">Tên khuyến mại</label>
                        <input class="form-control" placeholder="Nhập tên khuyến mại" type = "text" id = "id_tenkm" required>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_maloaisanpham">Mã loại sản phẩm</label>
                        <select class="form-control" id = "id_maloaisanpham">
                            <option value = "0">Không</option>
                        </select>
                    </div>
                </th>
            </tr>

            <tr>
            <th>
                    <div class="form-group">
                        <label for = "id_ngaybatdau">Ngày bắt đầu</label>
                        <input class="form-control" id = "id_ngaybatdau" type = "date" required></input>
                    </div>
                </th>

                <th>
                    <div class="form-group">
                        <label for = "id_ngayketthuc">Ngày kết thúc</label>
                        <input class="form-control" id = "id_ngayketthuc" type = "date" required></input>
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2" id="khunghinhkm">  
                    <label for = "id_hinhkm">Hình khuyến mãi</label>
                    <div class="form-group">
                        <input id = "id_hinhkm" name = "id_hinhkm" class="file" type="file" data-preview-file-type="any" data-upload-url="http://localhost/webLazada/table/uploadhinhkm.php">
                    </div>
                </th>
            </tr>

            <tr>
                <th colspan = "2">
                    <h3>Thêm chi tiết khuyến mại</h3>
                    <div id = "khungchitietkm">
                        <table>
                            <tr>
                                <th>
                                <input name = "mangtenctkm[]" id = "mangmachitietkhuyenmai" class = "anbottom"/>
                                    Mã sản phẩm khuyến mại: <input class = "phanctkm" type = "text" id = "id_spkm" name = "mangtenspkm[]"> 
                                </th>
                                <th>
                                    Phần trăm khuyến mại: <input class = "phanctkm" type = "number" id = "id_phantramkm" name = "mangphantramkm[]"> 
                                    <a class = "btn btn-success btn_themctkm ">Thêm</a>
                                    <a class = "btn btn-danger btn_xoactkm anbottom">Xóa</a>
                                </th>
                            </tr>
                        </table>
                    </div>
                </th>
            </tr>
        </table>
    
        <input type="button" class="btn btn-primary" id = "btn_themsp" value = "Thêm"/>
        <input type="button" class="btn btn-primary" id = "btn_capnhatsp" value = "Cập nhật"/>
    </div>
</div>

<div id = "col-right" style = "width: 100%;" class = "danhsachkhuyenmai">
    <div id = "card">
        <div class = "page-title">
            <span class = "title">Danh sách khuyến mại</span>
        </div>

        <!-- <input type="button" class="btn btn-danger" id = "btn_xoasp" value = "Xóa" style = "margin-left: 2%;">
        <input type="button" class="btn btn-primary" id = "btn_suasp" value = "Sửa" style = "margin-left: 2%;"> -->
            <div class="form-group input-group" style = "width: 40%; margin-left: 2%;">
                <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiemkm"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id = "btn_timkiemkm"><i class="fa fa-search"></i></button>
                </span>
            </div>
        

        <!-- /.panel-heading -->
        <div class="panel-body" style = "width: 100%;">
            <div class="table-responsive">
                <table class="table table-striped table-bordered table-hover">
                    <thead>
                        <tr class="info">
                            <th>STT</th>
                            <th>Tên khuyến mại</th>
                            <th>Tên loại sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Ngày bắt đầu</th>
                            <th>Ngày kết thúc</th>
                            <th>Hình khuyến mại</th>
                            <th>Giảm giá</th>
                            <th style = "width: 125px;">Hình thức</th>
                        </tr>
                    </thead>
                    <tbody>  
                        <?php
                            LayDanhSachKhuyenMai(0);
                        ?>                  
                    </tbody>
                </table>
                <?php
                        PhanTrangKhuyenMai();
                    ?>
            </div>
            <!-- /.table-responsive -->
        </div>
        <!-- /.panel-body -->
    </div>
</div>

<?php

function PhanTrangKhuyenMai(){
    global $conn;
    $truyvan = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm, sanpham sp, loaisanpham lsp WHERE km.MAKM = ctkm.MAKM AND km.MALOAISP =  lsp.MALOAISP AND ctkm.MASP = sp.MASP";
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

function LayDanhSachKhuyenMai($limit){
    global $conn;
    $truyvan = "SELECT * FROM khuyenmai km, chitietkhuyenmai ctkm, sanpham sp, loaisanpham lsp WHERE km.MAKM = ctkm.MAKM AND km.MALOAISP =  lsp.MALOAISP AND ctkm.MASP = sp.MASP LIMIT ".$limit.",10";
    $ketqua = mysqli_query($conn, $truyvan);
    if($ketqua){
        $i = 1;
        while ($dong = mysqli_fetch_array($ketqua)) {
            echo '<tr class = "success">';
                echo "<td>".$i."</td>";
                echo "<td>".$dong["TENKM"]."</td>";
                echo "<td>".$dong["TENLOAISP"]."</td>";
                echo "<td>".$dong["TENSP"]."</td>";
                echo "<td>".$dong["NGAYBATDAU"]."</td>";
                echo "<td>".$dong["NGAYKETTHUC"]."</td>";
                echo "<td><img style = 'width: 240px; height: 80px;' src = '..".$dong["HINHKHUYENMAI"]."'/></td>";
                echo "<td>".$dong["PHANTRAMKM"]."</td>";
                echo "<td data-id = '".$dong["MAKM"]."'>
                            <a class = 'btn btn-info btn_suakm'>Sửa</a>
                            <a class = 'btn btn-danger btn_xoakm'>Xóa</a>
                    </td>";
            echo '</tr>';
            
            $i++;
        }
    }
    
}

?>