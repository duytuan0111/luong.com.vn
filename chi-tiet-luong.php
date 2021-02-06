<?php
include("config.php");
include('_globals.php');
$title_search 	= $cat_name = $cit_name = $tag_name = "";
$cat_id 		= getValue('cat_id', 'int', 'GET', 0);
$tag_id 		= getValue('tag_id', 'int', 'GET', 0);
$cit_id 		= getValue('cit_id', 'int', 'GET', 0);
$keyword 		= getValue('keyword', 'str', 'GET', '');
if ($cat_id > 0) {
	$cat_name 		 = $db_cat[$cat_id]['cat_name'];
	$title_search  	.= $cat_name;
}
if ($tag_id > 0) {
	$tag_name 		 = $db_tags_sll[$tag_id]['tag_name'];
	$sala_cat_id	 = $db_tags_sll[$tag_id]['cat_id'];
	$alias_name 	 = $db_tags_sll[$tag_id]['tag_alias'];

	$title_search   .= $tag_name;
}
if ($keyword !== '') {
	$title_search 	.= $keyword;
}
if ($cit_id > 0) {
	$cit_name = $arrcity[$cit_id]['cit_name'];
	$title_search 	.= " Tại ".$cit_name;
}
// $page_title =	  "Lương ".$title_search." | timviec365.com.vn";
// Canonical
$urlhome = $urlcano = $domain.'/tra-cuu-luong.html';
if ($cat_id  !== 0 && $cit_id == 0 && $tag_id == 0) { // Page ngành nghề
	$urlcano = 	$domain.'/luong-'.replaceTitle($cat_name).'-v'.$cat_id.'.html';
	$page_title 	 = "Tra cứu mức lương $cat_name hiện nay | Timviec3365.com.vn";
	$meta_key		 = "lương $cat_name";
	$meta_des 		 = "Tra cứu mức lương $cat_name hiện nay. Tham khảo mức lương trung bình $cat_name mới nhất được tổng hợp liên tục trên Timviec365.com.vn";
} else if ($cat_id == 0 && $cit_id !== 0 && $tag_id == 0 && $keyword == '') { // page tỉnh thành
	$urlcano = $domain.'/luong-tai-'.replaceTitle($cit_name).'-k'.$cit_id.'.html';
	$page_title 	 = "Tra cứu mức lương tại $cit_name mới nhất - Timviec365.com.vn";
	$meta_key		 = "lương tại $cit_name";
	$meta_des 		 = "Tra cứu mức lương trung bình tại $cit_name hiện nay chính xác nhất. Tham khảo ngay mức lương tại $cit_name theo các công việc từ nhà tuyển dụng trên địa bàn.";
} else if ($cat_id !== 0 && $cit_id !== 0 && $tag_id == 0) { // page ngành nghề tại tỉnh thành
	$urlcano 	= $domain."/luong-".replaceTitle($cat_name)."-tai-".replaceTitle($cit_name)."-v".$cat_id."b".$cit_id.".html";
	$page_title 	 = "Tra cứu mức lương $cat_name tại $cit_name hiện nay | Timviec3365.com.vn";
	$meta_key		 = "lương $cat_name tại $cit_name";
	$meta_des 		 = "Tra cứu mức lương $cat_name tại $cit_name hiện nay. Tham khảo mức lương trung bình $cat_name tại $cit_name mới nhất được tổng hợp liên tục trên Timviec365.com.vn";
} else if ($cat_id == 0 && $cit_id == 0 && $tag_id !== 0) { // page tag
	$urlcano = $domain.rewriteTagSll($tag_id, $alias_name);
	$page_title 	 = "Tra cứu mức lương $tag_name hiện nay | Timviec365.com.vn";
	$meta_key		 = "lương $tag_name";
	$meta_des 		 = "Tra cứu mức lương $tag_name hiện nay. Tham khảo mức lương trung bình $tag_name mới nhất được tổng hợp liên tục trên Timviec365.com.vn";
} else if ($cat_id == 0 && $cit_id !== 0 && $tag_id !== 0) { // page tag tại tỉnh thành
	$urlcano = $domain."/luong-".replaceTitle($tag_name)."-tai-".replaceTitle($cit_name)."-m".$tag_id."b".$cit_id.".html";
	$page_title 	 = "Tra cứu mức lương $tag_name tại $cit_name hiện nay | Timviec365.com.vn";
	$meta_key		 = "lương $tag_name tại $cit_name";
	$meta_des 		 = "Tra cứu mức lương $tag_name tại $cit_name hiện nay. Tham khảo mức lương trung bình $tag_name tại $cit_name mới nhất được tổng hợp liên tục trên Timviec365.com.vn";
} else if ($keyword !== '' && $cat_id == 0 && $cit_id == 0) { // page từ khóa
	$keyword_n 	= str_replace(' ', '+', trim($keyword));
	$urlcano 	= $domain."/chi-tiet-luong.html?keyword=".$keyword_n;
	$page_title 	 = "Tra cứu mức lương $keyword hiện nay | Timviec3365.com.vn";
	$meta_key		 = "lương $keyword";
	$meta_des 		 = "Tra cứu mức lương $keyword hiện nay. Tham khảo mức lương trung bình $keyword mới nhất được tổng hợp liên tục trên Timviec365.com.vn";
} else if ($keyword !== '' && $cat_id == 0 && $cit_id !== 0) {
	$keyword_n 	= str_replace(' ', '+', trim($keyword));
	$urlcano 	= $domain."/chi-tiet-luong.html?keyword=".$keyword_n."&cit_id=".$cit_id;
	$page_title 	 = "Tra cứu mức lương $keyword tại $cit_name  hiện nay | Timviec3365.com.vn";
	$meta_key		 = "lương $keyword tại $cit_name";
	$meta_des 		 = "Tra cứu mức lương $keyword tại $cit_name hiện nay. Tham khảo mức lương trung bình $keyword tại $cit_name mới nhất được tổng hợp liên tục trên Timviec365.com.vn";
}
$urluri = $domain.$_SERVER['REQUEST_URI'];
if($urlcano != $urluri)
{
	header("HTTP/1.1 301 Moved Permanently"); 
	header("Location: $urlcano");
	exit();
}
// Xử lí lương trung bình
// cao nhất, thấp nhất
$caonhatthapnhat 			= luongcaonhatthapnhat($cat_name, $cat_id, $tag_id, $tag_name, $cit_id);
$caonhatthapnhat_decode		= json_decode($caonhatthapnhat);
$sobanghi					= $caonhatthapnhat_decode->soluong;
// Nếu số tin tuyển dụng > 5 thì mới tính toán
if ($sobanghi > 5) {
	$thapnhat 					= $caonhatthapnhat_decode->thapnhat;
	$caonhat 					= $caonhatthapnhat_decode->caonhat;
	$trungbinh 					= $caonhatthapnhat_decode->trungbinh;
} else {
	$thapnhat = 0;
	$caonhat  = 0;
}
//
if ($keyword !== '' && $cat_id == 0 && $cit_id == 0) {
	$detail_sala 	= trungbinhluongsauthang($keyword, $cat_id, $cit_id, 3);
} else if ($keyword !== '' &&  $cat_id == 0 && $cit_id > 0) {
	$detail_sala 	= trungbinhluongsauthang($keyword, $cat_id, $cit_id, 3);
} else {
	$detail_sala	= trungbinhluongsauthang($cat_name, $cat_id, $cit_id, 2);
}
include('_header.php');
?>
<main class="main-salary-detail">
	<div class="container">
		<h1>Tra cứu lương <?php echo $title_search; ?></h1>
		<?php if ($sobanghi > 5 && $trungbinh > 0) { ?>
		<h2>Biểu đồ lương <?php echo $title_search; ?></h2>
		<div class="border-bot" style="width: 87px;"></div>
		<div class="salary-detail-chart">
			<div id="container"></div>
			<table id="datatable" style="display: none;">
				<thead>
					<tr>
						<th></th>
						<th>Việc làm</th>

					</tr>
				</thead>
				<tbody>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=1&cat_id=0&city=0" >Thương lượng</a></th>
						<td><?php echo $detail_sala['tongthuongluong']; ?></td>
					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=2&cat_id=0&city=0">1 tr - 3 tr</a></th>
						<td><?php echo $detail_sala['tong13']; ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=3&cat_id=0&city=0">3 tr - 5 tr</a></th>
						<td><?php echo $detail_sala['tong35']; ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=4&cat_id=0&city=0">5 tr - 7 tr</a></th>
						<td><?php echo $detail_sala['tong57']; ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=5&cat_id=0&city=0">7 tr - 10 tr</a></th>
						<td><?php echo $detail_sala['tong710']; ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=6&cat_id=0&city=0">10 tr - 15 tr</a></th>
						<td><?php echo $detail_sala['tong1015']; ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=7&cat_id=0&city=0">15 tr -20 tr</a></th>
						<td><?php echo $detail_sala['tong1520'] ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=8&cat_id=0&city=0">20 tr - 30 tr</a></th>
						<td><?php echo $detail_sala['tong2030'] ?></td>

					</tr>
					<tr>
						<th><a href="danh-sach-viec-lam.html?salary=9&cat_id=0&city=0">30 tr trở lên</a></th>
						<td><?php echo ($detail_sala['tong300'] + $detail_sala['tong500'] + $detail_sala['tong1000']); ?></td>

					</tr>
				</tbody>
			</table>
		</div>
		<div class="row">
			<div class="col-md-5 col-sm-5 salary-avg-left">
				<div class="salary-avg-left-1">
					<p class="salary-mn"><?php echo number_format($trungbinh); ?> vnđ</p>
					<p class="salary-mn-txt">( <?php echo convert_number_to_words($trungbinh);  ?> Việt Nam Đồng)</p>
					<p class="salay-mn-txt-1">Mức lương trung bình của <span style="color:#05BAB9"><?php echo $title_search; ?></span> là:
					<?php echo number_format($trungbinh); ?> VNĐ</p>
				</div>
			</div>
			<div class="col-md-7 col-sm-7 salary-avg-right">
				<div id="container2">

				</div>
			</div>
		</div>
		<?php } ?>
	</div>
	<?php 
	$timenow 	= time();
	$timenow1 	= $timenow - 86400 * 260; // 260 
	$sql_ttd = "SELECT new.new_id, new_title, new_alias, new_city, new_cap_bac, new_money,usc_id,usc_company,usc_alias,new_mota,usc_create_time,usc_logo FROM new JOIN user_company ON user_company.usc_id = new.new_user_id JOIN new_multi ON new_multi.new_id = new.new_id WHERE 1 ";
	if ($cit_id > 0) {
		$sql_ttd .= " AND FIND_IN_SET($cit_id, new.new_city) ";
	}
	if ($cat_id > 0) {
		$sql_ttd .= " AND FIND_IN_SET($cat_id, new.new_cat_id)  AND length(new.new_cat_id) <= 3 ";
	}
	if($tag_id > 0){
		$sql_ttd .= " AND new.new_title LIKE '%".str_replace(' ','%',$tag_name)."%'";
	}
	if($keyword !== ''){
		$sql_ttd .= " AND ((new.new_title LIKE '%".str_replace(' ','%',$keyword)."%')) ";
	}
	$sql_ttd .=	" ORDER BY new_id DESC LIMIT 0,9";
	$db_ttd  = new db_query($sql_ttd);
	$sobaiviet = mysql_num_rows($db_ttd->result);
	?>
	<div class="news">
		<h2>Danh sách tin tuyển <?php echo $title_search; ?></h2>
		<div class="border-bot" style="width: 87px;"></div>
		<div class="container">
			<div class="row list-new">
				<?php 
				if ($sobaiviet > 0) { 
					while($key = mysql_fetch_array($db_ttd->result)) 
					{
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
				<div class="col-md-4 col-sm-6 col-xs-12 list-new-detail">
					<div class="row">
						<div class="col-md-3 col-xs-3 list-new-detail-left">
							<img src="<?= geturlimageAvatar($key['usc_create_time']).$key['usc_logo']  ?>" onerror='this.onerror=null;this.src="/ssl/assets/images/tai-xuong.png";' alt="<?php echo  $key['usc_company']; ?>" style="width: 100px; height: 100px; border-radius: 10px">
						</div>
						<div class="col-md-9 col-xs-9 list-new-detail-right">
							<h3><a href="<?php echo rewriteNews($key['new_id'], $key['new_title'], $key['new_alias']); ?>" title="Lương <?php echo $key['new_title']; ?>"><?php echo $key['new_title']; ?></a></h3>
							<p><img src="/ssl/assets/images/icon-money.png"> <?php echo $muc_luong; ?> </p>
						</div>
					</div>
				</div>
				<?php } } else { ?>
				<p style="text-align: center;padding-right: 85px;">Không tìm thấy bản ghi liên quan</p>
				<?php } ?>
			</div>
		</div>

	</div>
	<div class="container">
		<div class="related-position">
			<h3 class="cv-related">Chức vụ liên quan</h3>
				<div class="border-bot" style="width: 100;"></div>
			</div>
			<style type="text/css">
				.hide-related-position {
					max-height: 42px;
					overflow: hidden;
				}
			</style>
		<div class="list-related-position hide-related-position">
			<?php 
			if ($cat_id != 0  && $keyword == '') {
				$sql_tag = "SELECT tag_id, tag_name, tag_alias FROM tbl_tags WHERE tag_type = ".$cat_id." AND tag_parent = 3 LIMIT 0,10";
			} else if ($tag_id != 0 && $keyword == '') {
				$sql_tag = "SELECT tag_id, tag_name, tag_alias FROM tbl_tags WHERE tag_type = ".$sala_cat_id." AND tag_parent = 3 LIMIT 0,10 ";
			} else if ($cat_id == 0 && $keyword !== '') {
				$key_search = str_replace(' ', '%', trim($keyword));
				$sql_tag = " SELECT tag_id, tag_name, tag_alias FROM tbl_tags WHERE tag_name LIKE '%$key_search%' AND tag_parent = 3 LIMIT 0,10 ";
			} else if ($cat_id == 0  && $keyword == '' && $cit_id > 0) {
				$sql_tag = " SELECT tag_id, tag_name, tag_alias FROM tbl_tags WHERE tag_city = $cit_id AND tag_parent = 3 LIMIT 0,10 ";
			}
			$db_tag  = new db_query($sql_tag); 
			$num_row1= mysql_num_rows($db_tag->result);
			if ($num_row1 > 0) { 
				while ($list_tag = mysql_fetch_array($db_tag->result)) { 
			?>
			<a href="<?php echo rewriteUrlTag($list_tag['tag_alias'], $list_tag['tag_id']); ?>" title="<?php echo "Việc làm ".$list_tag['tag_name']; ?>" class="list-related-a"><?php echo "Việc làm ".$list_tag['tag_name']; ?></a>
			<?php } ?>
			<a href="javascript:void(0)" class="load-more-related-position" style="color:#FFB11B;"><i class="fas fa-plus-circle"></i></a>
			<?php } else { ?>
			<p style="text-align: center;">không tìm thấy bản ghi liên quan</p>
			<?php } ?>
		</div>
	</div>
	<div class="container">
		<div class="related-position">
			<h3 class="cv-related" style="margin-top: 0px">Lương liên quan</h3>
				<div class="border-bot" style="width: 100;"></div>
			</div>
			<style type="text/css">
				.hide-related-position-1 {
					max-height: 42px;
					overflow: hidden;
				}
			</style>
		<?php
			if ($tag_id != 0 && $cat_id == 0 && $cit_id == 0 ) {
		?>
		<div class="list-related-position-1 hide-related-position-1">
			<?php 
			$sql_chuvulq 	= "SELECT * FROM tbl_tags_salary WHERE cat_id = $sala_cat_id LIMIT 0,10 ";
			$db_chuvulq 	= new db_query($sql_chuvulq);
			$num_row2		= mysql_num_rows($db_chuvulq->result);
			if ($num_row2 > 0) { 
				while ($values = mysql_fetch_array($db_chuvulq->result)) { 
					$url = rewriteTagSll($values['tag_id'],$values['tag_alias']);
			?>
			<a href="<?= $url ?>" class="list-related-a" title="<?php echo "Lương ".$values['tag_name']; ?>"><?php echo "Lương ".$values['tag_name']; ?></a>
			<?php } ?>
			<a href="javascript:void(0)" class="load-more-related-position-1" style="color:#FFB11B;"><i class="fas fa-plus-circle"></i></a>
			<?php } else { ?>
			<p style="text-align: center;">không tìm thấy bản ghi liên quan</p>
			<?php } ?>
		</div>
		<?php } else if ($cat_id != 0 && $tag_id == 0 && $cit_id == 0) { ?>
		<div class="list-related-position-1 hide-related-position-1">
			<?php 
			$sql_chuvulq 	= "SELECT * FROM tbl_tags_salary WHERE cat_id = $cat_id LIMIT 0,20 ";
			$db_chuvulq 	= new db_query($sql_chuvulq);
			$num_row2		= mysql_num_rows($db_chuvulq->result);
			if ($num_row2 > 0) { 
				while ($val = mysql_fetch_array($db_chuvulq->result)) { 
			?>
			<a href="luong-<?php echo $val['tag_alias']; ?>-m<?php echo $val['tag_id']; ?>.html" title="Lương <?php echo $val['tag_name'];  ?>" class="list-related-a"><?php echo "Lương ".$val['tag_name']; ?></a>
			<?php } ?>
			<a href="javascript:void(0)" class="load-more-related-position-1" style="color:#FFB11B;"><i class="fas fa-plus-circle"></i></a>
			<?php } else { ?>
			<p style="text-align: center;">không tìm thấy bản ghi liên quan</p>
			<?php } ?>
		</div>
		<?php } else if ($cat_id == 0 && $cit_id > 0 && $keyword == '' && $tag_id == 0) { ?>
		<div class="list-related-position-1 hide-related-position-1">
			<?php 
			foreach ($arrcity as $key => $val) { 
			?>
			<a href="luong-tai-<?php echo replaceTitle($val['cit_name']); ?>-k<?php echo $val['cit_id']; ?>.html" title="Lương <?php echo $val['tag_name'];  ?>" class="list-related-a"><?php echo "Lương tại ".$val['cit_name']; ?></a>
			<?php } ?>
			<a href="javascript:void(0)" class="load-more-related-position-1" style="color:#FFB11B;"><i class="fas fa-plus-circle"></i></a>
			
		</div>
		<?php } else if ($cat_id == 0 && $keyword !== '') {  ?>
		<div class="list-related-position-1 hide-related-position-1">
			<?php 
			$key_search 	= str_replace(' ', '%', trim($keyword));
			$sql_chuvulq 	= "SELECT * FROM tbl_tags_salary WHERE tag_name LIKE '%$key_search%' LIMIT 0,20 ";
			$db_chuvulq 	= new db_query($sql_chuvulq);
			$num_row2		= mysql_num_rows($db_chuvulq->result);
			if ($num_row2 > 0) { 
				while ($val = mysql_fetch_array($db_chuvulq->result)) {
			?>
			<a href="luong-<?php echo $val['tag_alias']; ?>-m<?php echo $val['tag_id']; ?>.html" title="Lương <?php echo $val['tag_name'];  ?>" class="list-related-a"><?php echo "Lương ".$val['tag_name']; ?></a>
			<?php } ?>
			<a href="javascript:void(0)" class="load-more-related-position-1" style="color:#FFB11B;"><i class="fas fa-plus-circle"></i></a>
			<?php } else { ?>
			<p style="text-align: center;">không tìm thấy bản ghi liên quan</p>
			<?php } ?>
		</div>
		<?php } ?>
	</div>
</main>
<?php include_once('_footer.php'); ?>
<script type="text/javascript">
	var trungbinh 		= <?php echo $trungbinh; ?>;
	var sobanghi 		= <?php echo $sobanghi; ?>;
	var caonhat 		= <?php echo $caonhat; ?>;
	if (caonhat < trungbinh) {
		caonhat = trungbinh;
	}
	var thapnhat 		= <?php echo $thapnhat; ?>;
	// Format Number
	function FormatNumber(nStr)
	{
		nStr += '';
		x = nStr.split('.');
		x1 = x[0];
		x2 = x.length > 1 ? '.' + x[1] : '';
		var rgx = /(\d+)(\d{3})/;
		while (rgx.test(x1)) {
			x1 = x1.replace(rgx, '$1' + ',' + '$2');
		}
		return x1 + x2;
	}
	if (trungbinh > 0 && sobanghi > 5) {
	// biểu đồ
	Highcharts.chart('container', {
		plotOptions: {
			column :{
				point:{
					cursor: 'pointer',
					events:{
						click:function(){
							var base_url 	= '<?php echo $domain; ?>';
							var cat_id 		= <?php echo $cat_id; ?>;
							var city 		= <?php echo $cit_id; ?>;
							var tag_id 		= <?php echo $tag_id; ?>;
							var salary 		= this.x + 1;
							if (cat_id > 0) {
								$url_redirect 	= 'danh-sach-viec-lam.html?salary='+salary+'&cat_id='+cat_id+'&city='+city;
							} else if (tag_id > 0) {
								$url_redirect 	= 'danh-sach-viec-lam.html?salary='+salary+'&tag_id='+tag_id+'&city='+city;
							} else if (city > 0) {
								$url_redirect 	= 'danh-sach-viec-lam.html?salary='+salary+'&cat_id='+cat_id+'&city='+city;
							}
							window.location.href = $url_redirect;
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
					text: 'Việc làm'
				}
			},
			tooltip: {
				style: {
					pointerEvents: 'auto'
				},
				formatter: function () {
					return '<b>' + this.point.name + '</b><br/>' +
					this.point.y + ' ' + this.series.name.toLowerCase();
				}
			}
		});
		// Biểu đồ lương trung bình
		Highcharts.chart('container2', {
			chart: {
				type: ''
			},
			exporting: {
				enabled: false
			},
			title: {
				text: ''
			},
			xAxis: {
				categories: ['Thấp nhất', 'Trung bình', 'Cao Nhất']
			},
			yAxis: {
				title: {
					text: 'Triệu vnđ'
				}
			},
			tooltip: {
				formatter: function () {
					return '<b>Lương </b> <b>' + this.x +
					'</b>: <b>' + FormatNumber(this.y) + ' vnđ</b>';
				}
			},
			credits: {
				enabled: false
			},
			series: [{
				name: 'Lương trung bình kế toán',
				data: [thapnhat, trungbinh, caonhat]
			}]
		});
	}
</script>