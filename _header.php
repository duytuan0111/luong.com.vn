<?php 
include("config.php");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title><?php echo $page_title; ?></title>
<meta name="description" content='<?php echo $meta_des; ?>'/>
<meta name="Keywords" content='<?php echo $meta_key; ?>'/>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="robots" content="noindex, nofollow"/>
<meta property="og:title" content="<?php echo $page_title; ?>" />
<meta property="og:description" content="<?php echo $meta_des; ?>" />
<link rel="stylesheet" type="text/css" href="/ssl/assets/css/select2.min.css">
<link rel="stylesheet" href="/ssl/assets/css/style.css">
<link rel="stylesheet" href="/ssl/assets/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-130208644-4"></script>
<script>
	window.dataLayer = window.dataLayer || [];
	function gtag(){dataLayer.push(arguments);}
	gtag('js', new Date());

	gtag('config', 'UA-130208644-4');
</script>
</head>
<body>
<header class="<?php echo (isset($home) && ($home == true) ? 'header-home' : '' ) ?>">
	<?php if (!isset($home) || $home !== true) { ?>
	<div class="header-top <?php echo (!isset($home) || $home !== true) ? 'header-sub' : '' ?>">
		<div class="container">
			<div class="row header-sub-desk">
				<div class="col-md-7 col-xs-8 col-sm-7">
					<a href="/"><img src="/ssl/assets/images/logo-white.png" alt="Trang chủ"></a>
				</div>	
				<div class="col-md-5 col-xs-4 col-sm-5">
					<div class="header-top-right-desktop pull-right">
						<?php if (isset($_COOKIE["UT"]) && ($_COOKIE["UT"] == 0 || $_COOKIE["UT"] == 1)) { ?>
						<a href="/tra-cuu-luong.html" class="btn-home">Tra cứu lương</a>
						<a href="<?php echo ($_COOKIE["UT"] == 0) ? '/ung-vien/quan-ly-chung.html' : '/quan-ly-chung-ntd.html'; ?>" class="user-profile">
							<img src="/ssl/assets/images/user-login.png" alt="Trang cá nhân">
						</a>
						<a href="/dang-xuat.html" class="user-logout">Đăng xuất</a>
						<?php } else { ?>
						<a href="/tra-cuu-luong.html" class="btn-home">Tra cứu lương</a>
						<div class="group-login-border">
							<div class="group-login">
								<a href="dang-nhap.html">Đăng nhập</a> <span style="color: #FFFFFF;">|</span> <a href="dang-ky.html">Đăng kí</a>
							</div>
						</div>
						<?php } ?>
					</div>
					<div class="header-top-right-moblie" style="display: none">
						<a href="#modal-home" data-toggle="modal" class="btn-home"><img src="/ssl/assets/images/icon-menu.png"></a>
						<div class="modal fade" id="modal-home">
							<div class="modal-dialog">
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title"><a href="/tra-cuu-luong.html">Tra cứu lương</a></h4>
									</div>
									<div class="modal-body">
										<a href="dang-nhap.html" class="login-mb">Đăng nhập</a> <span style="color: #FFB11B">|</span> <a href="dang-ky.html" class="login-mb">Đăng kí</a>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="row header-sub-mb" style="display: none">
				<div class="col-md-4 col-xs-3 col-sm-4">
					<a href="#modal-search-sub" data-toggle="modal"><img src="/ssl/assets/images/img-search.png"></a>
					<div class="modal fade" id="modal-search-sub">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
								</div>
								<div class="modal-body">
									<div class="row search-form-act search-form-mobile" style="display: none;">
										<div class="col-xs-12 input-search-mb">
											<i class="far fa-keyboard" style="color: #05BAB9"></i>
											<input type="text" class="ui-autocomplete-input" name="search" placeholder="Nhập tên công việc bạn muốn tìm">
										</div>
										<div class="col-xs-12 input-search-mb">
											<i class="fas fa-map-marker-alt" style="color: #05BAB9"></i>
											<select class="city">
												<option value>Địa điểm</option>
												<?php foreach ($arrcity as $key => $value) { ?>
												<option value="<?php echo $value['cit_id'] ?>" data-name="<?php echo $value['cit_name']; ?>" ><?php echo $value['cit_name'] ?></option>
												<?php } ?>
											</select>
										</div>
										<div class="col-xs-12">
											<a href="javascript:void(0)" class="btn-search-header"><i class="fa fa-search"></i> Tìm kiếm</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-md-3 col-xs-5 col-sm-4">
					<a href="/"><img src="/ssl/assets/images/logo-white.png" alt="Trang chủ" class="mg-sub-mb" style="display: inline-block; margin-top: -10px;margin-left: 10px; text-align: center;"></a>
				</div>	
				<div class="col-md-5 col-xs-4 col-sm-4">
					<div class="header-top-right-desktop">
						<a href="/tra-cuu-luong.html" class="btn-home">Tra cứu lương</a>
						<div class="group-login">
							<a href="/dang-nhap.html">Đăng nhập</a> <span style="color: #FFFFFF;">|</span> <a href="dang-ky.html">Đăng kí</a>
						</div>
					</div>
					<div class="header-top-right-moblie" style="display: none">
						<a href="#modal-home-sub" data-toggle="modal" class="btn-home"><img src="/ssl/assets/images/icon-menu.png"></a>
						<div class="modal fade" id="modal-home-sub">
							<div class="modal-dialog">
								<div class="modal-content">
									<?php if (isset($_COOKIE["UT"]) && ($_COOKIE["UT"] == 0 || $_COOKIE["UT"] == 1)) { ?>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title"><a href="<?php echo ($_COOKIE["UT"] == 0) ? '/ung-vien/quan-ly-chung.html' : '/quan-ly-chung-ntd.html'; ?>"><img src="/ssl/assets/images/icon-user-mb.png" alt="Trang cá nhân"> <span class="sp-user">Trang cá nhân</span></a></h4>
									</div>
									<div class="modal-body">
										<a href="/tra-cuu-luong.html" class="login-mb title-login">Tra cứu lương</a>
										<a href="/dang-xuat.html" class="login-mb">Đăng xuất</a>
									</div>
									<?php } else { ?>
									<div class="modal-header">
										<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
										<h4 class="modal-title"><a href="/tra-cuu-luong.html">Tra cứu lương</a></h4>
									</div>
									<div class="modal-body">
										<a href="/dang-nhap.html" class="login-mb">Đăng nhập</a> <span style="color: #FFB11B; display: inline-block; margin: 0px 18px;">|</span> <a href="dang-ky.html" class="login-mb">Đăng kí</a>
									</div>
									<?php } ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>	
	</div>
	<?php } ?>
	<div class="container">
		<?php if (isset($home) && $home == true) { ?>
		<div class="row header-top <?php echo (!isset($home) || $home !== true) ? 'header-sub' : '' ?>">
			<div class="col-md-7 col-xs-8 col-sm-9">
				<?php if (isset($home) && $home == true) { ?>
				<a href="/"><img src="/ssl/assets/images/logo.png" alt="Trang chủ"></a>				
				<?php } else { ?>
				<a href="/"><img src="/ssl/assets/images/logo-white.png" alt="Trang chủ"></a>
				<?php } ?>
			</div>	
			<div class="col-md-5 col-xs-4 col-sm-3">
				<div class="header-top-right-desktop pull-right">
					<a href="/tra-cuu-luong.html" class="btn-home">Tra cứu lương</a>
					<?php if (isset($_COOKIE["UT"]) && ($_COOKIE["UT"] == 0 || $_COOKIE["UT"] == 1)) { ?>
					<a href="<?php echo ($_COOKIE["UT"] == 0) ? '/ung-vien/quan-ly-chung.html' : '/quan-ly-chung-ntd.html'; ?>" class="user-profile">
						<img src="/ssl/assets/images/user-login.png" alt="Trang cá nhân">
					</a>
					<a href="/dang-xuat.html" class="user-logout">Đăng xuất</a>
					<?php } else { ?>
					<div class="group-login-border">
						<div class="group-login">
							<a href="/dang-nhap.html">Đăng nhập</a> <span style="color: #FFFFFF;">|</span> <a href="dang-ky.html">Đăng kí</a>
						</div>
					</div>
					<?php } ?>
				</div>
				<div class="header-top-right-moblie" style="display: none">
					<a href="#modal-home" data-toggle="modal" class="btn-home"><img src="/ssl/assets/images/icon-menu.png"></a>
					<div class="modal fade" id="modal-home">
						<div class="modal-dialog">
							<div class="modal-content">
								<?php if (isset($_COOKIE["UT"]) && ($_COOKIE["UT"] == 0 || $_COOKIE["UT"] == 1)) { ?>
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title"><a href="<?php echo ($_COOKIE["UT"] == 0) ? '/ung-vien/quan-ly-chung.html' : '/quan-ly-chung-ntd.html'; ?>"><img src="/ssl/assets/images/icon-user-mb.png" alt="Trang cá nhân"> <span class="sp-user">Trang cá nhân</span></a></h4>
								</div>
								<div class="modal-body">
									<a href="/tra-cuu-luong.html" class="login-mb title-login">Tra cứu lương</a>
									<a href="/dang-xuat.html" class="login-mb">Đăng xuất</a>
								</div>
								<?php } else { ?>
								<div class="modal-header">
									<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
									<h4 class="modal-title"><a href="/tra-cuu-luong.html">Tra cứu lương</a></h4>
								</div>
								<div class="modal-body">
									<a href="/dang-nhap.html" class="login-mb">Đăng nhập</a> <span style="color: #FFB11B;display: inline-block; margin: 0px 18px;">|</span> <a href="dang-ky.html" class="login-mb">Đăng kí</a>
								</div>
								<?php } ?>
							</div>
						</div>
					</div>
				</div>
			</div>	
		</div>
		<?php } ?>
		<div class="header-main <?php echo  (!isset($home) || $home !== true) ? 'header-main-sub' : '' ?>">
			<?php if (isset($home) && ($home == true)) { ?>
			<h1>Tra cứu lương - So sánh lương của bạn với đồng nghiệp</h1>
			<p>Khảo sát mức lương theo ngành nghề, tra cứu lương nhanh chóng tại Timviec365.com.vn</p>
			<?php } else { ?>
			<?php if (isset($ds_viec_lam) && $ds_viec_lam == true) { ?>
			<p class="breadcrumbs">
				<a href="/" class="link-a"><img src="/ssl/assets/images/icon-home.png" style="padding-bottom: 4px;" alt="Trang chủ"> Trang chủ /</a>
				<a href="/tra-cuu-luong.html" class="link-a"> Tra cứu lương /</a>
				<a href="javascript:void(0)" class="link-current"> Danh sách việc làm <?php echo $title_search; ?></a>
			</p>
			<?php } else { ?>
			<p class="breadcrumbs">
				<a href="/" class="link-a"><img src="/ssl/assets/images/icon-home.png" style="padding-bottom: 4px;" alt="Trang chủ"> Trang chủ /</a>
				<a href="/tra-cuu-luong.html" class="link-a"> Tra cứu lương /</a>
				<a href="javascript:void(0)" class="link-current"> Tra cứu lương của <?php echo $title_search; ?></a>
			</p>
			<?php } ?>
			<?php } ?>
			<div class="border-search-form <?php echo  (!isset($home) || $home !== true) ? 'border-search-form-sub' : '' ?>" >
				<div class="search-form search-form-act">
					<div class="search-left">
						<i class="far fa-keyboard" style="color: #05BAB9"></i>
						<input type="text" class="ui-autocomplete-input" name="search" placeholder="Nhập tên công việc bạn muốn tìm">
						<img src="/ssl/assets/images/span-input.png">
					</div>
					<div class="search-main">
						<i class="fas fa-map-marker-alt" style="color: #05BAB9"></i>
						<select class="city">
							<option value>Địa điểm</option>
							<?php foreach ($arrcity as $key => $value) { ?>
							<option value="<?php echo $value['cit_id'] ?>" data-name="<?php echo $value['cit_name']; ?>" ><?php echo $value['cit_name'] ?></option>
							<?php } ?>
						</select>
						<img src="/ssl/assets/images/span-input.png">
					</div>
					<div class="search-right">
						<a href="javascript:void(0)" class="btn-search-header"><i class="fas fa-search"></i> Tìm kiếm</a>
					</div>
				</div>
			</div>
			<?php if (isset($home) && $home == true) { ?>
			<div class="row search-form-act search-form-mobile" style="display: none;">
				<div class="col-xs-12 input-search-mb">
					<i class="far fa-keyboard" style="color: #05BAB9"></i>
					<input type="text" class="ui-autocomplete-input" name="search" placeholder="Nhập tên công việc bạn muốn tìm">
				</div>
				<div class="col-xs-12 input-search-mb">
					<i class="fas fa-map-marker-alt" style="color: #05BAB9"></i>
					<select class="city">
						<option value>Địa điểm</option>
						<?php foreach ($arrcity as $key => $value) { ?>
						<option value="<?php echo $value['cit_id'] ?>" data-name="<?php echo $value['cit_name']; ?>" ><?php echo $value['cit_name'] ?></option>
						<?php } ?>
					</select>
				</div>
				<div class="col-xs-12">
					<a href="javascript:void(0)" class="btn-search-header"><i class="fa fa-search"></i> Tìm kiếm</a>
				</div>
			</div>
			<?php } ?>
		</div>
	</div>
</header>