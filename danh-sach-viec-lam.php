<?php
include("config.php");
$title_search 		= $cat_name = $cit_name = $tag_name = $keyword = "";
$ds_viec_lam 		= true;
$cat_id 			= getValue('cat_id', 'GET', 'int', 0);
$tag_id 			= getValue('tag_id', 'GET', 'int', 0);
$salary 			= getValue('salary', 'GET', 'int', 0);
$city 				= getValue('city', 'GET', 'int', 0);
$han_luong			= $array_muc_luong[$salary];
$urlcano = $urlhome = $domain.'/tra-cuu-luong.html';
if ($cat_id > 0) {
	if (in_array($cat_id, $db_cat[$cat_id])) {
		$cat_name 		= $db_cat[$cat_id]['cat_name'];
		$title_search  .= $cat_name;
	} else {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: $urlhome");
		exit();
	}
}
if ($tag_id > 0) {
	if (in_array($tag_id, $db_tags_sll[$tag_id])) {
		$tag_name 		= $db_tags_sll[$tag_id]['tag_name'];
		$title_search  .= $tag_name;
	} else {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: $urlhome");
		exit();
	}
}
if ($city > 0) {
	if (in_array($city, $arrcity[$city])) {
		$cit_name 		= $arrcity[$city]['cit_name'];
		$title_search  .= " tại ".$cit_name;
	} else {
		header("HTTP/1.1 301 Moved Permanently"); 
		header("Location: $urlhome");
		exit();
	}
}
if ($salary == 0 || $salary > 11) {
	Header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: $urlhome");
	exit();
} else {
	if ($cat_id > 0) {
		if ($city > 0) {
			$urlcano = $domain."/danh-sach-viec-lam.html?salary=".$salary."&cat_id=".$cat_id."&city=".$city;
		} else {
			$urlcano = $domain."/danh-sach-viec-lam.html?salary=".$salary."&cat_id=".$cat_id."&city=0";
		}
	} else if ($cat_id == 0 && $city > 0 && $tag_id == 0) {
		$urlcano = $domain."/danh-sach-viec-lam.html?salary=".$salary."&cat_id=0&city=".$city;
	} else if ($cat_id == 0 && $city == 0 && $tag_id == 0) {
		$urlcano = $domain."/danh-sach-viec-lam.html?salary=".$salary."&cat_id=0&city=0";
	} else if ($tag_id > 0) {
		if ($city > 0) {
			$urlcano = $domain."/danh-sach-viec-lam.html?salary=".$salary."&tag_id=".$tag_id."&city=".$city;
		} else {
			$urlcano = $domain."/danh-sach-viec-lam.html?salary=".$salary."&tag_id=".$tag_id."&city=0";
		}
	}
}
$title_search  	   .= " lương ".$han_luong;
$page_title = $title_search;
$urluri = $domain.$_SERVER['REQUEST_URI'];
if(($urlcano != $urluri))
{
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: $urlcano");
	exit();
}
include_once('_header.php');
?>
<main class="main-salary-detail">
	<div class="container">
		<h2 style="margin-top:0px">Danh sách việc làm <?php echo $title_search; ?></h2>
		<div class="border-bot" style="width: 87px;"></div>
		<div class="salary-detail-chart">
		<?php
		$timenow 	= time();
		$timenow1 	= $timenow - 86400 * 730; // 260
		$sql_ttd = "SELECT new.new_id, new_title, new_alias, new_city, new_cap_bac, new_money,new_han_nop,usc_id,usc_company,usc_alias,new_mota,usc_create_time,usc_logo FROM new JOIN user_company ON user_company.usc_id = new.new_user_id JOIN new_multi ON new_multi.new_id = new.new_id WHERE new.new_create_time > $timenow1 AND new.new_money = ".$salary." ";
		if ($city > 0) {
			$sql_ttd .= " AND FIND_IN_SET($city, new.new_city)  ";
		}
		if ($cat_id > 0) {
				$sql_ttd .= " AND FIND_IN_SET($cat_id, new.new_cat_id)  AND length(new.new_cat_id) <= 3 ORDER BY new.new_cat_id ASC ";
		}
		if ($tag_id > 0) {
			$sql_ttd .= " AND ((new.new_title like '%".str_replace(' ','%',$tag_name)."%')) ";
		}
		$db_ttd  	= new db_query($sql_ttd." LIMIT 0,8");
		$db_sbv  	= new db_query($sql_ttd);
		$sobaiviet 	= mysql_num_rows($db_sbv->result);
		?>
		<div class="row list-new-hot">
			<?php while($key = mysql_fetch_array($db_ttd->result)) { ?>
			<?php
			if (array_key_exists($key['new_cap_bac'], $array_capbac)) {
				$chuc_vu = $array_capbac[$key['new_cap_bac']];
			} else {
				$chuc_vu = $array_capbac[0];
			}

			if (array_key_exists($key['new_money'], $array_muc_luong)) {
				$muc_luong = $array_muc_luong[$key['new_money']];
			} else {
				$muc_luong = $array_muc_luong[0];
			}
			?>
			<div class="col-md-6 col-xs-12 col-sm-12 salary-detail-job">
				<div class="hot-top-right">
					<p>Hot</p>
				</div>
				<div class="row salary-detail-job-top">
					<div class="col-md-3 col-xs-3 salary-detail-left">
						<img src="<?= geturlimageAvatar($key['usc_create_time']).$key['usc_logo']  ?>" onerror='this.onerror=null;this.src="/ssl/assets/images/tai-xuong.png";' alt="<?php echo  $key['usc_company'] ?>">
					</div>
					<div class="col-md-9 col-xs-9 salary-detail-right">
						<p><a href="<?php echo rewriteNews($key['new_id'], $key['new_title'], $key['new_alias']); ?>" title="<?php echo $key['new_title']; ?>"><?php echo $key['new_title']; ?></a></p>
						<p>
							<img src="/ssl/assets/images/building-icon.png">
							<a href="<?php echo rewrite_company($key['usc_id'], $key['usc_company'], $key['usc_alias']); ?>" title="<?php echo $key['usc_company']; ?>"><?php echo $key['usc_company']; ?></a>
						</p>
						<p>
							<span><img src="/ssl/assets/images/location-icon.png">
								<?php 
								if ($key['new_city'] !== '') {
									$arr_name 	= [];
									$list_cit 	= explode(',', $key['new_city']);
									foreach ($list_cit as $index => $val) {
										$arr_name[] = $arrcity[$val]['cit_name'];
									}
									$arr_name 	= implode(', ', $arr_name);
								} else {
									$arr_name = "Toàn quốc";
								}
								echo $arr_name;
								?>
							</span>
							<span><img src="/ssl/assets/images/clock-icon.png"> <?php echo date('d/m/Y', $key['new_han_nop']); ?></span>
							<span><img src="/ssl/assets/images/icon-money.png"> <?php echo $muc_luong ?></span>
						</p>
					</div>
				</div>
				<style type="text/css">
					p {
						font-family: Open Sans;
						font-style: bold;
						font-weight: normal;
						font-size: 16px;
						line-height: 28px;
						color: #333333;
					}
				</style>
				<p style="text-align: left;" class="slary-detail-job-bot">
					<?php echo truncate($key['new_mota'], 200); ?>
				</p>
			</div>
			<?php } ?>
		</div>
		<?php if ($sobaiviet == 0) { ?>
		<p style="text-align: center;">Chưa cập nhật bản ghi</p>
		<?php } ?>
		<?php if ($sobaiviet > 8) { ?>
		<a href="javascript:void(0)" class="see-more-job" id="2"> Xem thêm việc làm <i class="fas fa-angle-double-down"></i></a>
		<?php } ?>
	</div>
</div>
<div class="container">
	<div class="related-position">
		<h3 class="cv-related">So sánh lương theo ngành nghề</h2>
			<div class="border-bot" style="width: 330px; float: left;"></div>
		</div>
		<div class="salary-by-job">
			<div class="salary-by-job-border">
				<div class="row row-industry">
					<?php
					$sql_db_cat 	= "SELECT cat_id,cat_name,cat_tags,cat_count,cat_ut,cat_count_uv FROM category WHERE cat_active = 1 ORDER BY cat_order DESC, cat_count DESC LIMIT 0,18";
					$qr_db_cat 		= new db_query($sql_db_cat);
					?>
					<?php while ($key = mysql_fetch_array($qr_db_cat->result)) { ?>
					<div class="col-md-4 col-xs-12 col-sm-6">
						<a href="luong-<?php echo replaceTitle($key['cat_name']); ?>-v<?php echo $key['cat_id']; ?>.html" title="Lương <?php echo $key['cat_name']; ?>"><i class="fas fa-xs fa-circle" style="color: #FFB11B"></i> Lương <?php echo $key['cat_name']; ?></a>
					</div>
					<?php } ?>
				</div>
			</div>
		</div>
		<a href="javascript:void(0)" class="see-more-industry" id="2"> Xem thêm ngành nghề <i class="fas fa-angle-double-down"></i></a>
		<div class="related-position">
			<h3 class="cv-related">Top từ khóa tìm kiếm</h2>
				<div class="border-bot" style="width: 220px; float: left;"></div>
			</div>
			<div class="list-related-position">
				<a href="/luong-nhan-vien-kinh-doanh-v9.html" class="list-related-a" title="Lương Nhân viên kinh doanh">Nhân viên kinh doanh</a>
				<a href="/luong-ke-toan-kiem-toan-v1.html" class="list-related-a" title="Lương Kế toán - kiểm toán">Kế toán - kiểm toán</a>
				<a href="/luong-it-phan-mem-v13.html" class="list-related-a" title="Lương IT phần mềm">IT phần mềm</a>
				<a href="/luong-kd-bat-dong-san-v33.html" class="list-related-a" title="Lương Bất động sản">Bất động sản</a>
				<a href="/luong-bao-hiem-v66.html" class="list-related-a" title="Lương Bảo hiểm">Bảo hiểm</a>
			</div>
		</div>
	</main>
	<?php include_once('_footer.php'); ?>
	<script type="text/javascript">
		$('.see-more-job').on('click', function(event) {
			var page 		= $(this).attr('id');
			var cat_id 		= <?php echo $cat_id; ?>;
			var tag_id 		= <?php echo $tag_id; ?>;
			var tag_name	= '<?php echo $tag_name; ?>';
			var city 		= <?php echo $city; ?>;
			var salary 		= <?php echo $salary; ?>;
			var keyword 	= '<?php echo $keyword; ?>';
			$.ajax({
				url: 'ssl/load-more.php',
				type: 'POST',
				data: {page_no: page, cat_id: cat_id, tag_id, tag_name, city: Number(city), salary: salary, keyword: keyword},
				success: function(data) {
					var j = parseInt(page) + 1;
					$('.see-more-job').attr('id', j);
					if (data !== '') {
						$('.list-new-hot').append(data);
					} else {
						$(this).css('display', 'none');
						alert('Đã tải hết tin tuyển dụng');
					}
				},
				error: function(xhr) {
					alert("Error");
				}
			})
		});
		//
		$('.see-more-industry').on('click', function(event) {
			var page = $(this).attr('id');
			$.ajax({
				url: 'ssl/load-more-industry.php',
				type: 'POST',
				data: {page_no: page},
				success: function(data) {
					var j = parseInt(page) + 1;
					$('.see-more-industry').attr('id', j);
					if (data !== '') {
						$('.row-industry').append(data);
					} else {
						alert('Đã tải hết ngành nghề liên quan');
					}
				},
				error: function (xhr) {
					alert('Error');
				}
			})	
		});
	</script>