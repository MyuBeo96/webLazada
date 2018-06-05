<?php
    include("config.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<title>LOGIN</title>

	<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/animate.css">
	<!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/style.css">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
</head>

<body>
	<div class="container">
		<div class="login-box animated fadeInUp">
			<div class="box-header">
				<h2>Đăng nhập</h2>
			</div>
			<label for="tendangnhap">Tên đăng nhập</label>
			<br/>
			<input type="text" id="tendangnhap" name = "tendangnhap" value=<?php echo isset($_COOKIE["tendangnhap"])?  $_COOKIE["tendangnhap"] : "" ?>>
			<br/>
			<label for="matkhau">Mật khẩu</label>
			<br/>
			<input type="password" id="matkhau" name = "matkhau" value=<?php echo isset($_COOKIE["matkhau"])?  $_COOKIE["matkhau"] : "" ?>>
			<br/>
			<input type = "checkbox" id = "nhotaikhoan" name = "nhotaikhoan"/>
			<label for="nhotaikhoan">Nhớ tài khoản</label>
			<br/>
			<button type="submit" id = "dangnhap">Đăng nhập</button>
			<input type="hidden" id="url" value=<?php echo "http://$_SERVER[HTTP_HOST]/webLazada/" ?>>
			<br/>
		</div>
	</div>
</body>

<script>
	$(document).ready(function () {
		$("body").delegate("#dangnhap", "click", function() {
			tendangnhap = $("#tendangnhap").val();
			matkhau = $("#matkhau").val();
			nhotaikhoan = $("#nhotaikhoan").is(":checked");
			duongdan = $("#url").val();
						
			$.ajax({
					url: "table/function.php", 
					type: "POST",
					data:{
						action: "KiemTraDangNhap",
						tendangnhap: tendangnhap,
						matkhau: matkhau,
						nhotaikhoan: nhotaikhoan,
					},
					success:function(data){
						if(data !=0){
							window.location.replace(duongdan+"/pages/index.php");
						}
					}
				});
		});
		$('#logo').addClass('animated fadeInDown');
		$("input:text:visible:first").focus();
	});
	$('#tendangnhap').focus(function() {
		$('label[for="tendangnhap"]').addClass('selected');
	});
	$('#tendangnhap').blur(function() {
		$('label[for="tendangnhap"]').removeClass('selected');
	});
	$('#matkhau').focus(function() {
		$('label[for="matkhau"]').addClass('selected');
	});
	$('#matkhau').blur(function() {
		$('label[for="matkhau"]').removeClass('selected');
	});
</script>

</html>