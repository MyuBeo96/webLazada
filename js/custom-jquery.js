/*Phần chi tiết hóa đơn */
    // Xử lý xóa chi tiết hóa đơn
    $("body").delegate(".btn_xoacthd", "click", function() {
        $(this).closest("tr").remove();
    });

    //Xử lý thêm chi tiết hóa đơn
    $(".btn_themsphd ").click(function() {
        var masp = $("#id_tenspchitiet").val();
        var tenspct = $("#id_tenspchitiet :selected").text();
        var slsphd = $("#id_soluonghd").val();

        var kiemtra = false;
        $("input[name = 'mangsoluongcthd[]']").each(function(){
            if($(this).attr("data-masp") == masp){
                kiemtra = true;
                slsphd = parseInt(slsphd) + parseInt($(this).val());
                $(this).val(slsphd);
            }
        });
        var content ='<tr>' + 
                            '<th>'+
                                'Tên sản phẩm: <input type = "text" disabled style = "width: 620px;" data-masp="'+masp+'" value = "'+ tenspct +'" id = "mangtenchitiethd" name = "mangtenchitiethd[]">'+
                            '</th>' +
                            '<th>' +
                               'Số lượng: <input type = "number" data-masp="'+masp+'" disabled value = "'+ slsphd +'" id = "mangsoluongcthd" name = "mangsoluongcthd[]">' +
                                
                            '</th>'+
                            '<th>'+
                                '<a class = "btn btn-danger btn_xoacthd" style = "align: center;">Xóa</a>'+
                            '</th>'+
                        '</tr>';
        if(!kiemtra){
            $("#khungdanhsachchitiethoadon").find("tbody").append(content);
        }
        
    });
/*Kết thúc phần chi tiết hóa đơn */

/*Quản lý hóa đơn */
    //Tìm kiếm hóa đơn
    $("#btn_timkiemhd").click(function() {
        var timkiem = $("#txt_timkiemhd").val();
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "TimKiemHD",
                timkiem: timkiem,
            },
            success:function(dulieu){
                $("table.danhsach").find("tbody").empty();
                $("table.danhsach").find("tbody").append(dulieu);
                $("ul.pagination").remove();
            }
        });
    });

    //Thêm hóa đơn
    $("#btn_themhd").click(function(){
        var tenchuhd = $("#id_tenchuhd").val();
        var sdthoadon = $("#id_hdsdt").val();
        var diachihoadon = $("#id_hddiachi").val();
        var trangthai = $("#id_trangthai").val();
        var ngaydat = $("#id_ngaydat").val();
        var ngaygiao = $("#id_ngaygiao").val();
        var chuyenkhoan = $("#id_chuyenkhoan").val();
        var machuyenkhoan = $("#id_machuyenkhoan").val();

        var mangmachitiethd = [];
        var mangtenchitiethd = [];
        $("input[name = 'mangtenchitiethd[]']").each(function(){
            var mahd = $.trim($(this).attr("data-masp"));
            var value = $.trim($(this).val());
            if(value.length > 0){
                mangmachitiethd.push(mahd);
                mangtenchitiethd.push(value);
            }   
        });

        var mangsoluongcthd = [];
        $("input[name = 'mangsoluongcthd[]']").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                mangsoluongcthd.push(value);
            }   
        });
        
        // $.ajax({
        //     url: "../table/function.php", 
        //     type: "POST",
        //     data:{
        //         action: "ThemHoaDon",
        //         tenchuhd: tenchuhd,
        //         sdthoadon: sdthoadon,
        //         diachihoadon: diachihoadon,
        //         trangthai: trangthai,
        //         ngaydat: ngaydat,
        //         ngaygiao: ngaygiao,
        //         chuyenkhoan: chuyenkhoan,
        //         machuyenkhoan: machuyenkhoan,
        //     },
        //     success:function(data){
        //         alert(data);
        //     }
        // });
    });

    //Cập nhật hóa đơn
    $("#btn_capnhathd").click(function() {
        var mahd = $(this).attr("data-id");
        var tenchuhd = $("#id_tenchuhd").val();
        var sdthoadon = $("#id_hdsdt").val();
        var diachihoadon = $("#id_hddiachi").val();
        var trangthai = $("#id_trangthai").val();
        var ngaydat = $("#id_ngaydat").val();
        var ngaygiao = $("#id_ngaygiao").val();
        var chuyenkhoan = $("#id_chuyenkhoan").val();
        var machuyenkhoan = $("#id_machuyenkhoan").val();

        var mangmachitiethd = [];
        var mangtenchitiethd = [];
        $("input[name = 'mangtenchitiethd[]']").each(function(){
            var value = $.trim($(this).attr("data-masp"));
            var tesp = $.trim($(this).val());
            alert(value);
            if(value.length > 0){
                mangmachitiethd.push(value);
                mangtenchitiethd.push(tesp);
            }   
        });

        var mangsoluongcthd = [];
        $("input[name = 'mangsoluongcthd[]']").each(function(){
            var value = $.trim($(this).attr("data-masp"));
            if(value.length > 0){
                mangsoluongcthd.push(value);
            }   
        });

        $.ajax({
                url: "../table/function.php", 
                type: "POST",
                data:{
                    action: "CapNhatHoaDon",
                    mahd: mahd,
                    tenchuhd: tenchuhd,
                    sdthoadon: sdthoadon,
                    diachihoadon: diachihoadon,
                    trangthai: trangthai,
                    ngaydat: ngaydat,
                    ngaygiao: ngaygiao,
                    chuyenkhoan: chuyenkhoan,
                    machuyenkhoan: machuyenkhoan,
                    mangmachitiethd: mangmachitiethd,
                    mangtenchitiethd: mangtenchitiethd,
                    mangsoluongcthd: mangsoluongcthd,
                },
                success:function(data){
                    alert(data);
                }
            });
    });

    //Sửa hóa đơn
    $("body").delegate(".btn_suahd", "click", function(){
        machuyenkhoan = 0;
        var mahd = $(this).parent().attr("data-id");
        $("#btn_capnhathd").attr("data-id", mahd);

        dong = $(this).closest("tr");
        dong.find("td").each(function() {
            if ($(this).attr("data-tennn")) {
                tennguoinhan = $(this).attr("data-tennn");
            } else if($(this).attr("data-sodt")){
                sodt = $(this).attr("data-sodt");
            }else if($(this).attr("data-diachi")){
                diachi = $(this).attr("data-diachi");
            }else if($(this).attr("data-trangthai")){
                trangthai = $(this).attr("data-trangthai");
            }else if($(this).attr("data-ngaydat")){
                ngaydat = $(this).attr("data-ngaydat");
            }else if($(this).attr("data-ngaygiao")){
                ngaygiao = $(this).attr("data-ngaygiao");
            }else if($(this).attr("data-chuyenkhoan")){
                chuyenkhoan = $(this).attr("data-chuyenkhoan");
            }else if($(this).attr("data-machuyenkhoan")){
                machuyenkhoan = $(this).attr("data-machuyenkhoan");
            }
        });

        $("#id_tenchuhd").val(tennguoinhan);
        $("#id_hdsdt").val(sodt);
        $("#id_hddiachi").val(diachi);
        $("#id_trangthai").val(trangthai).trigger("change");
        $("#id_ngaydat").val(ngaydat);
        $("#id_ngaygiao").val(ngaygiao);
        $("#id_chuyenkhoan").val(chuyenkhoan).trigger("change");
        $("#id_machuyenkhoan").val(machuyenkhoan);

        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "LayChiTietHoaDonTheoMa",
                mahd: mahd,
            },
            success:function(data){
                $("#khungdanhsachchitiethoadon").find("tbody").empty();
                $("#khungdanhsachchitiethoadon").find("tbody").prepend(data);
            }
        });
    });

        //Hiển thị tạo mới hóa đơn
        $(".btn_hienthithemhd").click(function() {
            $(".taomoihoadon").fadeIn(1000, "swing");
            $(".danhsachhoadon").fadeOut(1000, "swing");
        });
    
        //Hiển thị danh sách hóa đơn
        $(".btn_hienthidshd").click(function() {
            $(".taomoihoadon").fadeOut(1000, "swing");
            $(".danhsachhoadon").fadeIn(1000, "swing");
        });

/*Kết thúc quản lý hóa đơn */

/*Quản lý khuyến mại*/

    //Hiển thị tạo mới khuyến mại
    $(".btn_hienthithemkm").click(function() {
        $(".taomoikhuyenmai").fadeIn(1000, "swing");
        $(".danhsachkhuyenmai").fadeOut(1000, "swing");
    });

    //Hiển thị danh sách khuyến mại
    $(".btn_hienthidskm").click(function() {
        $(".taomoikhuyenmai").fadeOut(1000, "swing");
        $(".danhsachkhuyenmai").fadeIn(1000, "swing");
    });

/*Kết thúc quản lý khuyến mại */

/*Quản lý thương hiệu*/
    //Hiển thị tạo mới thương hiệu
    $(".btn_hienthithemth").click(function() {
        $(".taomoithuonghieu").fadeIn(1000, "swing");
        $(".danhsachthuonghieu").fadeOut(1000, "swing");
    });

    //Hiển thị danh sách thương hiệu
    $(".btn_hienthidsth").click(function() {
        $(".taomoithuonghieu").fadeOut(1000, "swing");
        $(".danhsachthuonghieu").fadeIn(1000, "swing");
    });

    $("#btn_themth").click(function(){
        var tenth = $("#id_tenthuonghieu").val();
        var maloaisp = $("#id_maloaisanpham").val();
        var hinhthuonghieu = "/hinhthuonghieu/" + $("#khunghinhth").find(".file-preview-success .file-footer-caption").attr("title");
        alert (math);
        // $.ajax({
        //     url: "../table/function.php", 
        //     type: "POST",
        //     data:{
        //         action: "ThemThuongHieu",
        //         math: math,
        //         tenth: tenth,
        //         maloaisp: maloaisp,
        //         hinhthuonghieu: hinhthuonghieu,
        //     },
        //     success:function(data){
        //         alert(data);
        //     }
        // });
    });
/*Kết thúc phần quản lý thương hiệu */

/*Phần quản trị sản phẩm */
    //Hiển thị thêm sản phẩm
    $(".btn_hienthithemsp").click(function() {
        $(".themsanpham").fadeIn(1000, "swing");
        $(".danhsachsp").fadeOut(1000, "swing");
    });

    //Hiển thị danh sách sản phẩm
    $(".btn_hienthidssp").click(function() {
        $(".themsanpham").fadeOut(1000, "swing");
        $(".danhsachsp").fadeIn(1000, "swing");
    });

    //Tìm kiếm sản phẩm
    $("#btn_timkiemsp").click(function() {
        var timkiem = $("#txt_timkiemsp").val();
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "TimKiemSP",
                timkiem: timkiem,
            },
            success:function(dulieu){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(dulieu);
                $("ul.pagination").remove();
            }
        });
    });

    //Phân trang sản phẩm
    $("#phantrangsp").bootpag({
        total: $("#phantrangsp").attr("data-tongsotrang"),
        maxVisible: 5,
        page: 1,
    }).on("page", function(event, sotrang){
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "LayDanhSachSanPham",
                sotrang: sotrang,
            },
            success:function(data){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(data);
            }
        });
    
    });

    //Cập nhật sản phẩm
    $("#btn_capnhatsp").click(function() {
        var masp = $(this).attr("data-id");
        var tensp = $("#id_tensanpham").val();
        var maloaisp = $("#id_maloaisp").val();
        var soluongsp = $("#id_slsanpham").val();
        var mathuonghieu = $("#id_mathuonghieu").val();
        var giasp = $("#id_giasanpham").val();
        var hinhlon = "/hinhsanpham/" + $("#khunghinhlon").find(".file-footer-caption").attr("title");
        
        var counthinhnho = $("#khunghinhnho").find(".file-preview-success .file-footer-caption").length;
        $("#khunghinhnho").find(".file-preview-success .file-footer-caption").each(function(index) {
            if ((counthinhnho - 1) == index) {
                hinhnho += "/hinhsanpham/" + $(this).attr("title");
            } else {
                hinhnho += "/hinhsanpham/" + $(this).attr("title") + ",";
            }
        });
        var thongtinsp = tinyMCE.get("id_thongtin").getContent();

        var mangtenctsp = [];
        $("input[name = 'mangtenctsp[]']").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                mangtenctsp.push(value);
            }
            
        });

        var manggiatrictsp = [];
        $("#khungchitietsanpham tr th:nth-child(2) input[name = 'manggiatrictsp[]']").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                manggiatrictsp.push(value);
            }
            
        });

        var mangmachitietsanpham = [];
        $("input[name = 'mangmactsp[]']").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                mangmachitietsanpham.push(value);
            }
            
        });

        var mangtenctspbosung = [];
        $("input[name = 'mangtenctsp[]'][disabled]").each(function(){
            var value = $.trim($(this).val());
            alert (value);
            if(value.length > 0){
                mangtenctspbosung.push(value);
            }
            
        });

        var manggiatrictspbosung = [];
        $("input[name = 'manggiatrictsp[]'][disabled]").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                manggiatrictspbosung.push(value);
            }
            
        });
        
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "CapNhatSanPhamTheoMaSP",
                masp: masp,
                tensp: tensp,
                maloaisp: maloaisp,
                soluongsp: soluongsp,
                mathuonghieu: mathuonghieu,
                giasp: giasp,
                thongtinsp: thongtinsp,
                hinhlon: hinhlon,
                hinhnho: hinhnho,
                mangtenctsp: mangtenctsp,
                manggiatrictsp: manggiatrictsp,
                mangmachitietsanpham: mangmachitietsanpham,
                mangtenctspbosung: mangtenctspbosung,
                manggiatrictspbosung: manggiatrictspbosung,
            },
            success:function(data){
                alert(data);
            }
        });
    });

    //Xóa sản phẩm
    $("body").delegate(".btn_xoasp", "click", function() {
        var masp = $(this).parent().attr("data-id");
        This = $(this);
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "XoaSanPham",
                masp: masp,
            },
            success:function(data){
                if(data == true){
                    This.closest("tr").remove();
                    $.ajax({
                        url: "../table/function.php", 
                        type: "POST",
                        data:{
                            action: "LayDanhSachSanPham",
                            sotrang: 1,
                        },
                        success:function(dulieu){
                            $("table.table").find("tbody").empty();
                            $("table.table").find("tbody").append(dulieu);
                        }
                    });
                }else{
                    alert("Xóa thất bại");
                }
            }
        });
    });

    $(".btn_suasp").click(function() {
        $(".themsanpham").fadeIn(1000, "swing");
        $(".danhsachsp").fadeOut(1000, "swing");
    });

    //Hiển thị danh sách sản phẩm
    $("#btn_capnhatsp").click(function() {
        $(".themsanpham").fadeOut(1000, "swing");
        $(".danhsachsp").fadeIn(1000, "swing");
    });

    //Sửa sản phẩm
    $("body").delegate(".btn_suasp", "click", function() {

        loadhinhlon = '<label for = "id_hinhlon">Hình lớn</label><div class="form-group"><input id = "id_hinhlon" name = "id_hinhlon" class="file-loading" type="file" data-preview-file-type="any" data-upload-url="http://localhost:8080/webLazada/table/uploadhinh.php"></div>';
        $("#khunghinhlon").empty();
        $("#khunghinhlon").append(loadhinhlon);

        loadhinhnho = '<label for = "id_hinhnho">Hình nhỏ</label><div class="form-group"><input id = "id_hinhnho" name = "id_hinhnho" class="file-loading" type="file" multiple data-preview-file-type="any" data-upload-url="http://localhost:8080/webLazada/table/uploadhinh.php"></div>';
        $("#khunghinhnho").empty();
        $("#khunghinhnho").append(loadhinhnho);

        dong = $(this).closest("tr");

        hinhnho = "";
        hinhlon = "";
        tensp = "";
        maloaisp = 0;
        mathuonghieu = 0;
        thongtinsp = "";
        giasp = 0;
        soluongsp = 0;

        var masp = $(this).parent().attr("data-id");
        $("#btn_capnhatsp").attr("data-id", masp);

        dong.find("td").each(function() {
            if ($(this).attr("data-hinhnho")) {
                hinhnho = $(this).attr("data-hinhnho");
            } else if($(this).attr("data-hinhlon")){
                hinhlon = $(this).attr("data-hinhlon");
            }else if($(this).attr("data-tensp")){
                tensp = $(this).attr("data-tensp");
            }else if($(this).attr("data-maloaisp")){
                maloaisp = $(this).attr("data-maloaisp");
            }else if($(this).attr("data-mathuonghieu")){
                mathuonghieu = $(this).attr("data-mathuonghieu");
            }else if($(this).attr("data-thongtin")){
                thongtinsp = $(this).attr("data-thongtin");
            }else if($(this).attr("data-gia")){
                giasp = $(this).attr("data-gia");
            }else if($(this).attr("data-soluong")){
                soluongsp = $(this).attr("data-soluong");
            }
        });

        $("#id_tensanpham").val(tensp);
        $("#id_maloaisp").val(maloaisp);
        $("#id_slsanpham").val(soluongsp);
        $("#id_mathuonghieu").val(mathuonghieu);
        $("#id_giasanpham").val(giasp);
        tinyMCE.get("id_thongtin").setContent(thongtinsp);

        vitricat = hinhlon.lastIndexOf("/");
        tenhinhlon = hinhlon.substring(vitricat + 1);

        $("#id_hinhlon").fileinput({
            overwriteInitial: false,
            initialPreview: [
                ".." + hinhlon,
            ],
            initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
            initialPreviewFileType: 'image', // image is the default and can be overridden in config below
            initialPreviewConfig: [
                {caption: tenhinhlon},
            ],
        });

        arrayhinhnhocat = hinhnho.split(",");
        arrayhinhnho = [];
        arraytenhinhnho = [];
        for(i = 0; i < arrayhinhnhocat.length; i++){
            arrayhinhnho.push(".." + arrayhinhnhocat[i]);

            vitricat_1 = arrayhinhnhocat[i].lastIndexOf("/");
            tenhinhnho = arrayhinhnhocat[i].substring(vitricat_1 + 1);

            arraytenhinhnho.push({caption: tenhinhnho});
        }
        

        $("#id_hinhnho").fileinput({
            overwriteInitial: false,
            initialPreview: arrayhinhnho,
            initialPreviewAsData: true, // identify if you are sending preview data only and not the raw markup
            initialPreviewFileType: 'image', // image is the default and can be overridden in config below
            initialPreviewConfig: arraytenhinhnho,
        });

        //load chi tiết sản phẩm
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "LayChiTietSanPhamTheoMa",
                masp: masp,
            },
            success:function(data){
                $("#khungchitietsanpham").empty();
                $("#khungchitietsanpham").prepend($(".anchitietsanpham").clone().removeClass("anchitietsanpham"));
                $("#khungchitietsanpham").find("tbody").prepend(data);
            }
        });
        
    });

    //xử lý thêm sản phẩm
    $("#btn_themsp").click(function(){
        var tensp = $("#id_tensanpham").val();
        var maloaisp = $("#id_maloaisp").val();
        var soluongsp = $("#id_slsanpham").val();
        var mathuonghieu = $("#id_mathuonghieu").val();
        var giasp = $("#id_giasanpham").val();
        var hinhlon = "/hinhsanpham/" + $("#khunghinhlon").find(".file-preview-success .file-footer-caption").attr("title");
        
        var hinhnho = "";
        var counthinhnho = $("#khunghinhnho").find(".file-preview-success .file-footer-caption").length;
        $("#khunghinhnho").find(".file-preview-success .file-footer-caption").each(function(index) {
            if ((counthinhnho - 1) == index) {
                hinhnho += "/hinhsanpham/" + $(this).attr("title");
            } else {
                hinhnho += "/hinhsanpham/" + $(this).attr("title") + ",";
            }
        });

        var thongtinsp = tinyMCE.get("id_thongtin").getContent();

        var mangtenctsp = [];
        $("input[name = 'mangtenctsp[]']").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                mangtenctsp.push(value);
            }   
        });

        var manggiatrictsp = [];
        $("input[name = 'manggiatrictsp[]']").each(function(){
            var value = $.trim($(this).val());
            if(value.length > 0){
                manggiatrictsp.push(value);
            }   
        });
        
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "ThemSanPham",
                tensp: tensp,
                maloaisp: maloaisp,
                soluongsp: soluongsp,
                mathuonghieu: mathuonghieu,
                giasp: giasp,
                thongtinsp: thongtinsp,
                hinhlon: hinhlon,
                hinhnho: hinhnho,
                mangtenctsp: mangtenctsp,
                manggiatrictsp: manggiatrictsp,
            },
            success:function(data){
                alert(data);
            }
        });
    });

    //tynimce của mô tả sản phẩm
    tinymce.init({
        selector: 'textarea#id_thongtin',
        height: 270,
        width: 600,
        menubar: false,
        plugins: [
        'advlist autolink lists link image charmap print preview anchor textcolor',
        'searchreplace visualblocks code fullscreen',
        'insertdatetime media table contextmenu paste code help wordcount'
        ],
        toolbar: 'insert | undo redo |  formatselect | bold italic backcolor  | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | help',
        content_css: [
        '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
        '//www.tinymce.com/css/codepen.min.css'],
    });

/*Phần chi tiết sản phẩm */

    // Xử lý xóa chi tiết sản phẩm
    $("body").delegate(".btn_xoactsp", "click", function() {
        $(this).closest("tr").remove();
        // var machitietsp = $(this).parent().attr("data-machitiet");
        // This = $(this);
        // $.ajax({
        //     url: "../table/function.php", 
        //     type: "POST",
        //     data:{
        //         action: "XoaChiTietSanPhamTheoMCT",
        //         machitietsp: machitietsp,
        //     },
        //     success:function(data){
        //         // alert("data");
        //         This.closest("tr").remove(); 
        //         if(data == true){
        //             This.closest("tr").remove();
        //         }else{
        //             alert("Xóa thất bại");
        //         }
        //     }
        // });
    });

    //Xử lý thêm chi tiết sản phẩm
    $("body").delegate(".btn_themctsp", "click", function() {
        var khungchitietsanpham = $(".anchitietsanpham").clone().removeClass("anchitietsanpham");
        $("#khungchitietsanpham").append(khungchitietsanpham);

        $(this).parent().find(".btn_xoactsp").removeClass("anbottom");
        $(this).closest("tr").find("input").attr("disabled", true);
        $(this).remove();
    });
/*Kết thúc phần chi tiết sản phẩm */

/*Phần loại sản phẩm */
    //Tìm kiếm loại sản phẩm
    $("#btn_timkiem").click(function() {
        var timkiem = $("#txt_timkiem").val();
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "TimKiemLoaiSP",
                timkiem: timkiem,
            },
            success:function(dulieu){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(dulieu);
                $("ul.pagination").remove();
            }
        });
    });

    //Thêm loại sản phẩm
    $("#btn_themloaisp").click(function(){
        // var giatri = $("#id_maloaicha").val();
        // alert(giatri);
        var tenloaisp = $("#id_loaisanpham").val();
        var maloaicha = $("#id_maloaicha").val();
        This = $(this);
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "ThemLoaiSanPham",
                tenloaisp: tenloaisp,
                maloaicha: maloaicha
            },
            success:function(data){
                // This.after(data);
                //load lại nội dung khi thêm loại sản phẩm
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "LayDanhSachLoaiSP",
                        sotrang: 1,
                    },
                    success:function(dulieu){
                        $("table.table").find("tbody").empty();
                        $("table.table").find("tbody").append(dulieu);
                    }
                });

                //Hiển thị phân trang
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "PhanTrangLoaiSP",
                    },
                    success:function(dulieuphantrang){
                        $("ul.pagination").empty();
                        $("ul.pagination").append(dulieuphantrang);
                    }
                });
            }
        });
    });

    //Phân trang loại sản phẩm
    $( "body" ).delegate( "ul.pagination>li", "click", function() {
        var sotrang = $(this).text();
        $("ul.pagination>li").removeClass("active");
        $(this).addClass("active");
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "LayDanhSachLoaiSP",
                sotrang: sotrang,
            },
            success:function(data){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(data);
            }
        });
    });

    //Sự kiện xóa loại sản phẩm
    $("#btn_xoaloaisp").click(function() {
        var mangcheckbox = [];
        $("input[name='cb_mang[]']:checked").each(function() {
            var maloai = $(this).attr("data-id");
            mangcheckbox.push(maloai);
        });
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "XoaLoaiSanPham",
                mangmaloai: mangcheckbox,
            },
            success:function(data){
                //load lại nội dung khi xóa loại sản phẩm
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "LayDanhSachLoaiSP",
                        sotrang: 1,
                    },
                    success:function(dulieu){
                        $("table.table").find("tbody").empty();
                        $("table.table").find("tbody").append(dulieu);
                    }
                });

                //Hiển thị phân trang
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "PhanTrangLoaiSP",
                    },
                    success:function(dulieuphantrang){
                        $("ul.pagination").empty();
                        $("ul.pagination").append(dulieuphantrang);
                    }
                });
            }
        });
    });

    //Xu ly check loại sản phẩm
    $("#id_chontatca").change(function(){
        var allcheckbox = $(this).closest("table").find("tbody input:checkbox");
        if($(this).is(":checked")){
            allcheckbox.prop("checked", true);
        }else{
            allcheckbox.prop("checked", false);
        }
    });
/*Kết thúc phần loại sản phẩm */

/*Phần loại nhân viên */
    //Sự kiện xóa loại nhân viên
    $("body").delegate(".btn_xoaloainv", "click", function() {
        var maloainv = $(this).parent().attr("data-id");
        This = $(this);
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "XoaLoaiNhanVien",
                maloainv: maloainv,
            },
            success:function(data){
                if(data == true){
                    This.closest("tr").remove();
                    $.ajax({
                        url: "../table/function.php", 
                        type: "POST",
                        data:{
                            action: "LayDanhSachLoaiNV",
                            sotrang: 1,
                        },
                        success:function(dulieu){
                            $("table.table").find("tbody").empty();
                            $("table.table").find("tbody").append(dulieu);
                        }
                    });
                }else{
                    alert("Xóa thất bại");
                }
            }
        });
    });

    //Phân trang loại nhân viên
    $( "body" ).delegate( "ul.pagination>li", "click", function() {
        var sotrang = $(this).text();
        $("ul.pagination>li").removeClass("active");
        $(this).addClass("active");
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "LayDanhSachLoaiNV",
                sotrang: sotrang,
            },
            success:function(data){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(data);
            }
        });
    });

    //Tìm kiếm loại nhân viên
    $("#btn_timkiemnv").click(function() {
        var timkiem = $("#txt_timkiemnv").val();
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "TimKiemLoaiNV",
                timkiem: timkiem,
            },
            success:function(dulieu){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(dulieu);
                $("ul.pagination").remove();
            }
        });
    });

    //Thêm loại nhân viên
    $("#btn_themloainv").click(function(){
        var tenloainv = $("#id_loainhanvien").val();
        var maloainv = $("#id_maloainv").val();
        This = $(this);
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "ThemLoaiNhanVien",
                tenloainv: tenloainv,
                maloainv: maloainv
            },
            success:function(data){
                // alert(data);
                // This.after(data);
                //load lại nội dung khi thêm loại nhân viên
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "LayDanhSachLoaiNV",
                        sotrang: 1,
                    },
                    success:function(dulieu){
                        $("table.table").find("tbody").empty();
                        $("table.table").find("tbody").append(dulieu);
                    }
                });

                //Hiển thị phân trang
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "PhanTrangLoaiNV",
                    },
                    success:function(dulieuphantrang){
                        $("ul.pagination").empty();
                        $("ul.pagination").append(dulieuphantrang);
                    }
                });
            }
        });
    });

    //Xu ly check loại nhân viên
    $("#id_chontatcanv").change(function(){
        var allcheckbox = $(this).closest("table").find("tbody input:checkbox");
        if($(this).is(":checked")){
            allcheckbox.prop("checked", true);
        }else{
            allcheckbox.prop("checked", false);
        }
    });

/*Kết thúc phần loại nhân viên */

/*Phần nhân viên */

    //Tìm kiếm nhân viên
    $("#btn_timkiemnhanvien").click(function() {
        var timkiem = $("#txt_timkiemnhanvien").val();
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "TimKiemNV",
                timkiem: timkiem,
            },
            success:function(dulieu){
                $("table.table").find("tbody").empty();
                $("table.table").find("tbody").append(dulieu);
                $("ul.pagination").remove();
            }
        });
    });

    //Hiển thị tạo mới nhân viên
    $(".btn_hienthithemnv").click(function() {
        $(".taomoithanhvien").fadeIn(1000, "swing");
        $(".danhsachnhanvien").fadeOut(1000, "swing");
    });

    //Hiển thị danh sách nhân viên
    $(".btn_hienthidsnv").click(function() {
        $(".taomoithanhvien").fadeOut(1000, "swing");
        $(".danhsachnhanvien").fadeIn(1000, "swing");
    });

    //Hiển thị tạo mới nhân viên
    $(".btn_suanv").click(function() {
        $(".taomoithanhvien").fadeIn(1000, "swing");
        $(".danhsachnhanvien").fadeOut(1000, "swing");
    });

    //Hiển thị danh sách nhân viên
    $("#btn_capnhatnv").click(function() {
        $(".taomoithanhvien").fadeOut(1000, "swing");
        $(".danhsachnhanvien").fadeIn(1000, "swing");
    });

    //Sửa nhân viên
    $("body").delegate(".btn_suanv", "click", function(){
        var manv = $(this).parent().attr("data-id");
        $("#btn_capnhatnv").attr("data-id", manv);

        dong = $(this).closest("tr");
        dong.find("td").each(function() {
            if ($(this).attr("data-tennv")) {
                tennhanvien = $(this).attr("data-tennv");
            } else if($(this).attr("data-tendangnhap")){
                tendangnhap = $(this).attr("data-tendangnhap");
            }else if($(this).attr("data-ngaysinh")){
                ngaysinh = $(this).attr("data-ngaysinh");
            }else if($(this).attr("data-diachi")){
                diachi = $(this).attr("data-diachi");
            }else if($(this).attr("data-gioitinh")){
                gioitinh = $(this).attr("data-gioitinh");
            }else if($(this).attr("data-cmnd")){
                cmnd = $(this).attr("data-cmnd");
            }else if($(this).attr("data-maloainv")){
                maloainv = $(this).attr("data-maloainv");
            }else if($(this).attr("data-matkhau")){
                matkhau = $(this).attr("data-matkhau");
            }
        });

        if(gioitinh == 1){
            $("input[name=gioitinh]").val(["1"]);
        }else if(gioitinh == 0){
            $("input[name=gioitinh]").val(["0"]);
        }
        $("#id_tennhanvien").val(tennhanvien);
        $("#id_tendangnhap").val(tendangnhap);
        $("#id_ngaysinh").val(ngaysinh);
        $("#id_diachi").val(diachi);
        $("#id_scmnd").val(cmnd);
        $("#id_loainv").val(maloainv);
        $("#id_matkhau").val(matkhau);
    });

    //Cập nhật thành viên
    $("#btn_capnhatnv").click(function() {
        var manv = $(this).attr("data-id");
        var tennv = $("#id_tennhanvien").val();
        var tendangnhap = $("#id_tendangnhap").val();
        var matkhau = $("#id_matkhau").val();
        var diachi = $("#id_diachi").val();
        var ngaysinh = $("#id_ngaysinh").val();
        var gioitinh = $('[name=gioitinh]:radio:checked').val();
        var socmnd = $("#id_scmnd").val();
        var loainv = $("#id_loainv").val();
        // alert(manv);
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "CapNhatNhanVien",
                manv: manv,
                tennv: tennv,
                tendangnhap: tendangnhap,
                matkhau: matkhau,
                diachi: diachi,
                ngaysinh: ngaysinh,
                socmnd: socmnd,
                loainv: loainv,
                gioitinh: gioitinh,
            },
            success:function(data){
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "LayDanhSachNV",
                        sotrang: 1,
                    },
                    success:function(dulieu){
                        $("table #danhsach").find("tbody").empty();
                        $("table #danhsach").find("tbody").append(dulieu);
                    }
                });
            }
        });
    });

    //Thêm nhân viên
    $("#btn_themnv").click(function(){
        var tennv = $("#id_tennhanvien").val();
        var tendangnhap = $("#id_tendangnhap").val();
        var matkhau = $("#id_matkhau").val();
        var diachi = $("#id_diachi").val();
        var ngaysinh = $("#id_ngaysinh").val();
        var gioitinh = $('[name=gioitinh]:radio:checked').val();
        var socmnd = $("#id_scmnd").val();
        var loainv = $("#id_loainv").val();

        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "ThemNhanVien",
                tennv: tennv,
                tendangnhap: tendangnhap,
                matkhau: matkhau,
                diachi: diachi,
                ngaysinh: ngaysinh,
                socmnd: socmnd,
                loainv: loainv,
                gioitinh: gioitinh,
            },
            success:function(data){
                alert(data);
                $.ajax({
                    url: "../table/function.php", 
                    type: "POST",
                    data:{
                        action: "LayDanhSachNV",
                        sotrang: 1,
                    },
                    success:function(dulieu){
                        $("table #danhsach").find("tbody").empty();
                        $("table #danhsach").find("tbody").append(dulieu);
                    }
                });
            }
        });
    });

    //Xóa nhân viên
    $("body").delegate(".btn_xoanv", "click", function() {
        var manv = $(this).parent().attr("data-id");
        This = $(this);
        $.ajax({
            url: "../table/function.php", 
            type: "POST",
            data:{
                action: "XoaNhanVien",
                manv: manv,
            },
            success:function(data){
                if(data == true){
                    This.closest("tr").remove();
                    alert("Xóa nhân viên thành công");
                    $.ajax({
                        url: "../table/function.php", 
                        type: "POST",
                        data:{
                            action: "LayDanhSachNV",
                            sotrang: 1,
                        },
                        success:function(dulieu){
                            $("table #danhsach").find("tbody").empty();
                            $("table #danhsach").find("tbody").append(dulieu);
                        }
                    });
                }else{
                    alert("Xóa nhân viên thất bại");
                }
            }
        });
    });