<?php
include_once('config.php');
$limit 	= 18;
$kq 	= [];
$page  		= getValue('page_no', 'int', 'POST', 2);
$start 		= ($limit * $page) - $limit;
$sql 		= "SELECT cat_id,cat_name,cat_tags,cat_count,cat_ut,cat_count_uv FROM category WHERE cat_active = 1 ORDER BY cat_order DESC, cat_count DESC LIMIT $start,".($limit + 1)."";
$db_qr 		= new db_query($sql);
$output  	= '';
if (mysql_num_rows($db_qr->result) > 0) {
	while ($key = mysql_fetch_assoc($db_qr->result)) {
		$output .= '<div class="col-md-4 col-xs-12 col-sm-6">
		<a href="luong-'.replaceTitle($key['cat_name']).'-v'.$key['cat_id'].'.html" title="Lương '.$key['cat_name'].'"><i class="fas fa-xs fa-circle" style="color: #FFB11B"></i> Lương '.$key['cat_name'].'</a>
		</div>';
	}
}
echo $output;
?>