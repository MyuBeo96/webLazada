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
                        <h1 class="page-header">Thống kê</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <?php
                        switch($_GET["page"]){
                            case 'flot':
                                include("../table/flot.php");
                                break;

                            case 'morris':
                                include("../table/morris.php");
                                break;

                            case 'loainhanvien':
                                include("../table/loainhanvien.php");
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
