<?php
$home 			= true;
$page_title 	= "Tra cứu lương, so sánh lương của bạn 2021 - Timviec365.com.vn";
$meta_des 		= "Tra cứu lương, so sánh lương của bạn nhanh chóng, chính xác. Tham khảo mức lương trung bình theo vị trí công việc của bạn tại website Timviec365.com.vn";
$meta_key 		= "so sánh lương, tra cứu lương";
include_once('_header.php');
$sql_db_cat 	= "SELECT cat_id,cat_name,cat_tags,cat_count,cat_ut,cat_count_uv FROM category WHERE cat_active = 1 ORDER BY cat_order DESC, cat_count DESC LIMIT 0,12";
$sql_db_cit     = "SELECT cit_id,cit_name,cit_count,postcode,cit_count_uv FROM city ORDER BY cit_count DESC,cit_name ASC LIMIT 0,18";
$qr_db_cit 		= new db_query($sql_db_cit);
$qr_db_cat 		= new db_query($sql_db_cat);
include('_globals.php');
?>
<main>
	<div class="container">
		<h2>Lương Theo Ngành nghề</h2>
		<div class="border-bot" style="width: 87px;"></div>
		<div class="row main-salary-1">
			<div class="col-md-4 col-xs-12 main-salary-1-left">
				<div id="container"></div>
			</div>
			<?php ?>
			<div class="col-md-8 col-xs-12 main-salary-1-right compact-salary">
				<?php while ($db_cat_litmit  = mysql_fetch_array($qr_db_cat->result)) { ?>
				<div class="col-md-6 col-sm-6 main-salary-1-right-a">
					<a href="luong-<?php echo replaceTitle($db_cat_litmit['cat_name']); ?>-v<?php echo $db_cat_litmit['cat_id']; ?>.html" title="Lương <?php echo $db_cat_litmit['cat_name']; ?>" ><i class="fas fa-xs fa-circle" style="color: #FFB11B"></i> Lương <?php echo $db_cat_litmit['cat_name']; ?></a>
				</div>
				<?php } ?>
			</div>
			<a href="javascript:void(0)" style="display: none" class="see-more-salary">Xem thêm <i class="fas fa-angle-double-down"></i></a>
		</div>
	</div>
	<div class="main-mid">
		<h2 style="padding-top: 34px;">Top việc làm hot tại timviec365.com.vn</h2>
		<div class="border-bot" style="width: 204px;margin-bottom: 50px;"></div>
		<div class="container list-hot-job">
			<div class="col-md-3 col-sm-3 col-xs-6 hot-job job-kd">
				<a href="/viec-lam-nhan-vien-kinh-doanh-c9p0.html">
					<img src="/ssl/assets/images/viec-lam-kinh-doanh.png" class="img-kd" alt="Việc Làm Kinh Doanh">
					<img src="/ssl/assets/images/viec-lam-kinh-doanh-trang.png" alt="Việc Làm Kinh Doanh" class="img-kd-top" style="display: none">
					<p>Việc Làm Kinh Doanh</p>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 hot-job job-bh">
				<a href="/viec-lam-bao-hiem-c66p0.html">
					<img src="/ssl/assets/images/viec-lam-bao-hiem.png" alt="Việc Làm Kinh Doanh" class="img-bh">
					<img src="/ssl/assets/images/viec-lam-bao-hiem-trang.png" alt="Việc Làm Kinh Doanh" class="img-bh-top" style="display: none">
					<p>Việc Làm Bảo Hiểm</p>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 hot-job job-it">
				<a href="/viec-lam-it-phan-mem-c13p0.html">
					<img src="/ssl/assets/images/viec-lam-it.png" style="width: 73px" alt="Việc Làm Kinh Doanh" class="img-it">
					<img src="/ssl/assets/images/viec-lam-it-trang.png" alt="Việc Làm Kinh Doanh" class="img-it-top" style="display: none">
					<p>Việc Làm IT Phần Mềm</p>
				</a>
			</div>
			<div class="col-md-3 col-sm-3 col-xs-6 hot-job job-bds">
				<a href="viec-lam-kd-bat-dong-san-c33p0.html">
					<img src="/ssl/assets/images/viec-lam-bds.png" style="width: 73px" alt="Việc Làm Kinh Doanh" class="img-bds">
					<img src="/ssl/assets/images/viec-lam-bds-trang.png" alt="Việc Làm Kinh Doanh" class="img-bds-top" style="display: none">
					<p>Việc Làm Bất Động Sản</p>
				</a>
			</div>
		</div>
	</div>
	<div class="main-bot container">
		<h2 style="padding-top: 80px;" class="salary-by-city">Lương theo tỉnh thành</h2>
		<div class="border-bot" style="width: 112px;"></div>
		<div class="row salary-by-city">
			<div class="col-md-5 col-sm-5 col-xs-12">
				<img src="/ssl/assets/images/img-code.png" alt="Lương theo tỉnh thành" class="img-res">
			</div>
			<div class="col-md-7 col-sm-7 col-xs-12 salary-by-city-right compact-salary-by-city">
				<div class="border-dashed compact-salary-by-city-dashed">
					<?php while ($db_cit_limit = mysql_fetch_array($qr_db_cit->result)) { ?>
					<div class="col-md-4 col-sm-6 salary-by-city-a">
						<a href="luong-tai-<?php echo replaceTitle($db_cit_limit['cit_name']);  ?>-k<?php echo $db_cit_limit['cit_id']; ?>.html" title="Lương tại <?php echo $db_cit_limit['cit_name']; ?>" ><i class="fas fa-xs fa-circle" style="color: #FFB11B"></i> Lương tại <?php echo $db_cit_limit['cit_name']; ?></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<div>
			<a href="javascript:void(0)" class="see-more-salary-by-city" style="display: none">Xem thêm <i class="fas fa-angle-double-down"></i></a>
			<a href="/tao-cv-online.html"><img src="/ssl/assets/images/cv-home.png" alt="Tạo cv online" class="img-res cv-home"></a>
			<a href="/tao-cv-online.html"><img src="/ssl/assets/images/banner-home-mobile.png" alt="Tạo cv online" class="img-res cv-home cv-home-mobile" style="display: none"></a>
		</div>
	</div>
	<!-- Dữ liệu biểu đồ -->
	<table id="datatable" style="display: none;">
		<thead>
			<tr>
				<th></th>
				<th>Lương</th>

			</tr>
		</thead>
		<tbody>
			<tr>
				<th><a href="javascript:void(0)">Kế toán</a></th>
				<td><?php trungbinhluongsauthang('Kế toán - Kiểm toán', 1, 0, 0); ?></td>
			</tr>
			<tr>
				<th><a href="javascript:void(0)">IT phần mềm</a></th>
				<td><?php trungbinhluongsauthang('IT phần mềm', 13, 0, 0); ?></td>

			</tr>
			<tr>
				<th><a href="javascript:void(0)">Bất động sản</a></th>
				<td><?php trungbinhluongsauthang('KD bất động sản', 33, 0, 0); ?></td>

			</tr>
			<tr>
				<th><a href="javascript:void(0)">Kinh doanh</a></th>
				<td><?php trungbinhluongsauthang('Nhân viên kinh doanh', 9, 0, 0); ?></td>

			</tr>

		</tbody>
	</table>
</main>
<?php include_once('_footer.php') ?>
<script type="text/javascript">
// Biểu đồ
Highcharts.chart('container', {
	plotOptions: {
		column :{
			point:{
				cursor: 'pointer',
				events:{
					click:function(){
						// alert(this.x);
					}
				}
			}
		}
	},
	exporting: {
		enabled: false
	},
	credits: {
		enabled: false },
		data: {
			table: 'datatable'
		},
		chart: {
			type: 'column'
		},
		title: {
			text: ''
		},
		yAxis: {
			allowDecimals: false,
			title: {
				text: 'triệu vnđ'
			}
		},
		tooltip: {
			style: {
				pointerEvents: 'auto'
			},
			formatter: function () {
				return '<b>' + this.point.name + '</b><br/>' +
				FormatNumber(this.point.y) + ' vnđ';
			}
		}
	});
</script>