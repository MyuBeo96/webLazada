<?php
    include("../config.php");
?>

<div class = "row">
    <div id = "col-left" class = "col-sm-6 col-lg-6">
        <div class = "page-title">
            <span class = "title">Loại sản phẩm</span>
            <div class = "description">Quản lý nội dung liên quan đến loại sản phẩm</div>

            <div class="form-group">
                <label for = "id_loaisanpham">Tên loại sản phẩm</label>
                <input class="form-control" placeholder="Tên loại sản phẩm" type = "text" id = "id_loaisanpham">
            </div>
            
            <div class="form-group">
                <label for = "id_maloaicha">Mã loại cha</label>
                    <select class="form-control" id = "id_maloaicha">
                        <option value = "0">Không</option>
                        <?php
                            HienThiDanhMucLoaiSP();
                        ?>
                    </select>
            </div>

            <input type="button" class="btn btn-primary" id = "btn_themloaisp" value = "Thêm"/>

        </div>
    </div>

    <div id = "col-right" class = "col-sm-6 col-lg-6">
        <div id = "card">
            <div class = "page-title">
                <span class = "title">Danh sách loại sản phẩm</span>
            </div>

            <input type="button" class="btn btn-danger" id = "btn_xoaloaisp" value = "Xóa" style = "margin-left: 2%;">

            <div class="form-group input-group" style = "width: 40%; float: right; margin-right: 2%;">
                <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiem"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id = "btn_timkiem"><i class="fa fa-search"></i></button>
                </span>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="info">
                                <th>STT</th>
                                <th>Tên loại sản phẩm</th>
                                <th> <div class="checkbox">
                                    <label>
                                        <input type="checkbox" id = "id_chontatca" value = "Chọn tất cả">
                                    </label>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                LayDanhSachLoaiSP(0);
                            ?>                      
                        </tbody>
                    </table>
                    <?php
                        PhanTrangLoaiSP();
                    ?> 
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>

<?php

    function PhanTrangLoaiSP(){
        global $conn;
        $truyvan = "SELECT MALOAISP, TENLOAISP, MALOAI_CHA FROM loaisanpham";
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

    function LayDanhSachLoaiSP($limit){
        global $conn;
        $truyvan = "SELECT MALOAISP, TENLOAISP, MALOAI_CHA FROM loaisanpham LIMIT ".$limit.",10";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            $i = 1;
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo '<tr class = "success">';
                    echo "<td>".$i."</td>";
                    echo "<td>".$dong["TENLOAISP"]."</td>";
                    echo '<td><div class="checkbox">
                                <label>
                                    <input name = "cb_mang[]" data-id = "'.$dong["MALOAISP"].'" type="checkbox" id = "id_chon'.$dong["MALOAISP"].'">
                                </label>
                            </div>
                        </td>';
                echo '</tr>';
                
                $i++;
            }
        }
        
    }
    
?>