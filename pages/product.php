<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
            include("header.html");
        ?>
    </head>
    <body>

        <div id="wrapper">

            <!-- Navigation -->
            <?php
                include("navigation.php");
            ?>

            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">QUẢN LÝ</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
                        switch($_GET["page"]){
                            case 'loaisanpham':
                                include("../table/loaisanpham.php");
                                break;

                            case 'sanpham':
                                include("../table/sanpham.php");
                                break;

                            case 'loainhanvien':
                                include("../table/loainhanvien.php");
                                break;

                            case 'thanhvien':
                                include("../table/thanhvien.php");
                                break;

                            case 'thuonghieu':
                                include("../table/thuonghieu.php");
                                break;

                            case 'donhang':
                                include("../table/donhang.php");
                                break;

                            case 'khuyenmai':
                                include("../table/khuyenmai.php");
                                break;

                            default: 
                                break;
                        }
                    ?>
                </div>
                <!-- /.row -->
            </div>
            <!-- /#page-wrapper -->

        </div>
        <!-- /#wrapper -->

        <?php
            include("footer.html");
        ?>

    </body>
</html>
