<?php
    include("../config.php");
?>

<div class = "row">
    <div id = "col-left" class = "col-sm-6 col-lg-6">
        <div class = "page-title">
            <span class = "title">Loại nhân viên</span>
            <div class = "description">Quản lý nội dung liên quan đến loại nhân viên</div>

            <div class="form-group">
                <label for = "id_loainhanvien">Tên loại nhân viên</label>
                <input class="form-control" placeholder="Tên loại nhân viên" type = "text" id = "id_loainhanvien">
            </div>
            
            <!-- <div class="form-group">
                <label for = "id_maloainv">Mã loại nhân viên</label>
                    <select class="form-control" id = "id_maloainv">
                        <option value = "0">Không</option>
                        
                    </select>
            </div> -->

            <input type="button" class="btn btn-primary" id = "btn_themloainv" value = "Thêm"/>

        </div>
    </div>

    <div id = "col-right" class = "col-sm-6 col-lg-6">
        <div id = "card">
            <div class = "page-title">
                <span class = "title">Danh sách loại nhân viên</span>
            </div>

            <div class="form-group input-group" style = "width: 40%;  margin-left: 2%;">
                <input type="text" class="form-control" placeholder = "Tìm kiếm" id = "txt_timkiemnv"/>
                <span class="input-group-btn">
                    <button class="btn btn-default" type="button" id = "btn_timkiemnv"><i class="fa fa-search"></i></button>
                </span>
            </div>

            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover">
                        <thead>
                            <tr class="info">
                                <th>STT</th>
                                <th>Tên loại nhân viên</th>
                                <th style = "width: 125px;">Hình thức</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                LayDanhSachLoaiNV(0);
                            ?>                      
                        </tbody>
                    </table>
                    
                    <?php
                        PhanTrangLoaiNV();
                    ?>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.panel-body -->
        </div>
    </div>
</div>

<?php

    function PhanTrangLoaiNV(){
        global $conn;
        $truyvan = "SELECT * FROM loainhanvien";
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

    function HienThiDanhMucLoaiNV(){
        global $conn;
        $truyvan = "SELECT * FROM loainhanvien";
        $ketqua = mysqli_query($conn, $truyvan);
        if($ketqua){
            while ($dong = mysqli_fetch_array($ketqua)) {
                echo "<option value = '".$dong["MALOAINV"]."'>".$dong["TENLOAINV"]."</option>";
            }
        }
    }

    function LayDanhSachLoaiNV($limit){
        global $conn;
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
    
?>