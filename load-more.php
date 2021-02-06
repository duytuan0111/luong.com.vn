<?php 
include_once('config.php');
$limit 		= 8;
$kq		 	= [];
$page  		= getValue('page_no', 'int', 'POST', 2);
$start 		= ($limit * $page) - $limit;
$city 		= getValue('city','int','POST',0);	
$cat_id 	= getValue('cat_id','int','POST',0);
$tag_id 	= getValue('tag_id', 'int', 'POST', 0);
$tag_name 	= getValue('tag_name', 'str', 'POST', '');
$keyword  	= getValue('keyword','str','POST','');	
$salary 	= getValue('salary', 'int', 'POST', 0);
$timenow 	= time();
	$timenow1 	= $timenow - 86400 * 730; // 180 260
	$sql 		= "SELECT new.new_id, new_title, new_alias, new_city, new_cap_bac, new_money,new_han_nop,usc_id,usc_company,usc_alias,new_mota,usc_create_time,usc_logo FROM new JOIN user_company ON user_company.usc_id  = new.new_user_id JOIN new_multi ON new_multi.new_id = new.new_id WHERE new.new_create_time > $timenow1 ";
	if ($salary > 0) {
		$sql  	.= " AND new.new_money = $salary ";
	}
	if ($city > 0) {
		$sql 	.= " AND FIND_IN_SET($city, new.new_city) ";
	}
	if ($cat_id > 0) {
		$sql  	.= " AND FIND_IN_SET($cat_id, new.new_cat_id)  AND length(new.new_cat_id) <= 3 ";
	}
	if ($tag_id > 0) {
		$sql 	.= " AND ((new.new_title like '%".str_replace(' ','%',$tag_name)."%')) ";
	}
	$sql 			.= "LIMIT $start,".($limit + 1 )."";

	$db_qr 		= new db_query($sql);
	$output  	= '';
	if (mysql_num_rows($db_qr->result) > 0) {
		while ($key = mysql_fetch_assoc($db_qr->result)) {
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
			// $check_ml = array_search($key['new_cap_bac'], $array_capbac)
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

			$output 	.= '<div class="col-md-6 col-xs-12 col-sm-12 salary-detail-job">
			<div class="hot-top-right">
			<p>Hot</p>
			</div>
			<div class="row salary-detail-job-top">
			<div class="col-md-3 col-xs-3 salary-detail-left">
			<img src="'.geturlimageAvatar($key['usc_create_time']).$key['usc_logo'].'" onerror='.'this.onerror=null;this.src="/ssl/assets/images/tai-xuong.png";'.' alt="'.$key['usc_company'].'">
			</div>
			<div class="col-md-9 col-xs-9 salary-detail-right">
			<p><a href="'.rewriteNews($key['new_id'], $key['new_title'], $key['new_alias']).'">'.$key['new_title'].'</a></p>
			<p>
			<img src="/ssl/assets/images/building-icon.png">
			<a href="'.rewrite_company($key['usc_id'], $key['usc_company'], $key['usc_alias']).'">'.$key['usc_company'].'</a>
			</p>
			<p>
			<span><img src="/ssl/assets/images/location-icon.png">'.$arr_name.'</span>
			<span><img src="/ssl/assets/images/clock-icon.png"> '.date('d/m/Y', $key['new_han_nop']).'</span>
			<span><img src="/ssl/assets/images/icon-money.png"> '.$muc_luong.' </span>
			</p>
			</div>
			</div>
			<p style="text-align: left;" class="slary-detail-job-bot">
			'.truncate($key['new_mota'], 200).'
			</p>
			</div>';
		}	
	}
	echo $output;
	
	?>