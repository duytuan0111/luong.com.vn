<?php
function trungbinhluongsauthang($title, $cat_id, $city, $type) {
	$timenow 	= time();
	$timenow1 	= $timenow - 86400 * 1000; // 180 260
	$timenow2   = strtotime($timenow.' - 60 day');
	$query 		= "SELECT c1.cat_name, c1.cat_id, COUNT(c1.new_cat_id) AS sobaiviet, SUM(c1.new_money) AS tongtien,
	SUM(CASE WHEN c1.new_money = 1 THEN 1 ELSE 0 END) AS tongthuongluong,
	SUM(CASE WHEN c1.new_money = 2 THEN 1 ELSE 0 END) AS tong13,
	SUM(CASE WHEN c1.new_money = 3 THEN 1 ELSE 0 END) AS tong35,
	SUM(CASE WHEN c1.new_money = 4 THEN 1 ELSE 0 END) AS tong57,
	SUM(CASE WHEN c1.new_money = 5 THEN 1 ELSE 0 END) AS tong710,
	SUM(CASE WHEN c1.new_money = 6 THEN 1 ELSE 0 END) AS tong1015,
	SUM(CASE WHEN c1.new_money = 7 THEN 1 ELSE 0 END) AS tong1520,
	SUM(CASE WHEN c1.new_money = 8 THEN 1 ELSE 0 END) AS tong2030,
	SUM(CASE WHEN c1.new_money = 9 THEN 1 ELSE 0 END) AS tong300,
	SUM(CASE WHEN c1.new_money = 10 THEN 1 ELSE 0 END) AS tong500,
	SUM(CASE WHEN c1.new_money = 11 THEN 1 ELSE 0 END) AS tong1000
	FROM (SELECT c.cat_name, c.cat_id, n.new_cat_id, n.new_money FROM category AS c INNER JOIN new AS n ON c.cat_id = n.new_cat_id WHERE 1 AND n.new_create_time > ".$timenow1." ";
	if ($city !== 0) {
		$query .= " AND FIND_IN_SET(".$city.", n.new_city) ";
	}
	if ($cat_id !== 0){
		if ($cat_id < 200) {
			$query .= " AND FIND_IN_SET(".$cat_id.", n.new_cat_id) AND c.cat_id = ".$cat_id." AND length(n.new_cat_id) <= 3";
		} else if ($cat_id > 200) {
			$query .= " And ((n.new_title like '%".str_replace(' ','%',$title)."%')) ";
		}
	} 
	if ($type == 3) {
		$query .= " And ((n.new_title like '%".str_replace(' ','%',$title)."%')) ";
	}
	$query .= "   ORDER BY n.new_cat_id ASC) AS c1 "; // GROUP BY c1.cat_name ORDER BY c1.cat_id ASC LIMIT 30
	$db_qr = new db_query($query);
	if (mysql_num_rows($db_qr->result) > 0) {
		$tg1 	= "";
		$tg2  	= "";
		$tgall	= 0;
		// $row2 	= mysql_fetch_assoc($db_qr1->result);
		if ($title != '') {
			$query4 = "SELECT P.new_cat_id, t.cat_name, t.cat_id FROM new as P LEFT JOIN category as t on t.cat_id = P.new_cat_id WHERE P.new_han_nop > '".$timenow."'  AND (MATCH(P.new_title) AGAINST ('+".str_replace(' ',' +',$title)."' IN BOOLEAN MODE) OR (P.new_title like '%".str_replace(' ','%',$title)."%')) or P.new_city ='".$city."' GROUP BY P.new_cat_id LIMIT 0,1";
		} else {
			$query4 = "SELECT P.new_cat_id, t.cat_name, t.cat_id FROM new as P LEFT JOIN category as t on t.cat_id = P.new_cat_id WHERE P.new_han_nop > '".$timenow."' AND P.new_city = '".$city."' GROUP BY P.new_cat_id LIMIT 0,1";
		}
		$drcat = new db_query($query4);
		$row3  = mysql_fetch_assoc($drcat->result);
		while($itemcat = mysql_fetch_array($db_qr->result)) {
			$arrLuongTB=array(1500000,4000000,6000000,8500000,12500000,17500000,2500000);
			$arrbuocnhay=array(500000,1000000,1000000,1500000,2500000,2500000,5000000);
			if (($itemcat['sobaiviet'] - $itemcat['tongthuongluong']) !== 0) {
				$trungbinh_mau = ($itemcat['sobaiviet'] - $itemcat['tongthuongluong']);
			} else {
				$trungbinh_mau = 1;
			}
			$trungbinh=(($itemcat['tong13']*$arrLuongTB[0])+($itemcat['tong35']*$arrLuongTB[1])+($itemcat['tong57']*$arrLuongTB[2])+($itemcat['tong710']*$arrLuongTB[3])+($itemcat['tong1015']*$arrLuongTB[4])+($itemcat['tong1520']*$arrLuongTB[5])+($itemcat['tong2030']*$arrLuongTB[6])+($itemcat['tong300']*30000000)+($itemcat['tong500']*50000000)+($itemcat['tong1000']*100000000))/$trungbinh_mau;
			$vitrikhoangluong=0;
			
			for($i=0;$i<7;$i++){
				if(($trungbinh >= ($arrLuongTB[$i] -$arrbuocnhay[$i]))&&($trungbinh < ($arrLuongTB[$i] +$arrbuocnhay[$i]))){
					$vitrikhoangluong=$i;
				}
			}
			$detail_salary  = ['tongthuongluong'=> $itemcat['tongthuongluong'],'sobaiviet' => $itemcat['sobaiviet'], 'tong13' => $itemcat['tong13'], 'tong35' => $itemcat['tong35'], 'tong57' => $itemcat['tong57'], 'tong710' => $itemcat['tong710'], 'tong1015' => $itemcat['tong1015'], 'tong1520' => $itemcat['tong1520'], 'tong2030' => $itemcat['tong2030'], 'tong300' => $itemcat['tong300'], 'tong500' => $itemcat['tong500'], 'tong1000' => $itemcat['tong1000'], 'trungbinh' => intval($trungbinh)]; 
			$arrLuong=array('1000000-3000000','3000000-5000000','5000000-7000000','7000000-10000000','10000000-15000000','15000000-20000000','20000000-30000000');
			$arrtb=explode('-',$arrLuong[$vitrikhoangluong]);
			if($row3['cat_id']==$itemcat['cat_id']){
				$tg2[]=['idnn'=>$itemcat['cat_id'],'nganhnghe'=>$itemcat['cat_name'],'trungbinh'=>$trungbinh,'khoangluong'=>number_format($arrtb[0]).' - '.number_format($arrtb[1]), 'sobaiviet'=>$itemcat['sobaiviet']];
			}else{
				$tg1[]=['idnn'=>$itemcat['cat_id'],'nganhnghe'=>$itemcat['cat_name'],'trungbinh'=>$trungbinh,'khoangluong'=>number_format($arrtb[0]).' - '.number_format($arrtb[1]),'sobaiviet'=>$itemcat['sobaiviet']];
			}
			$tgall+=1;
		}
		if ($type == 0) {
			echo   intval($trungbinh);
		} else {
			return  $detail_salary;
		}
		
	}
}

function luongcaonhatthapnhat($findkey, $cat_id,$tag_id,$tag_name, $noilamviec) {
	$timenow 	= time();
	$timenow1 	= $timenow - 86400 * 1000; // 180 // 260
	$tg="";
	$arrkey1="";
	$arrkey = "";
	$query="SELECT COUNT(n.new_id) as tongsobanghi,SUM(n.new_money) as tongluong,
	SUM(CASE WHEN n.new_money = 1 THEN 1 ELSE 0 END) AS tongthuongluong,
	SUM(CASE WHEN n.new_money = 2 THEN 1 ELSE 0 END) AS tu1den3,
	SUM(CASE WHEN n.new_money = 3 THEN 1 ELSE 0 END) AS tu3den5,
	SUM(CASE WHEN n.new_money = 4 THEN 1 ELSE 0 END) AS tu5den7,
	SUM(CASE WHEN n.new_money = 5 THEN 1 ELSE 0 END) AS tu7den10,
	SUM(CASE WHEN n.new_money = 6 THEN 1 ELSE 0 END) AS tu10den15,
	SUM(CASE WHEN n.new_money = 7 THEN 1 ELSE 0 END) AS tu15den20,
	SUM(CASE WHEN n.new_money = 8 THEN 1 ELSE 0 END) AS tu20den30,
	SUM(CASE WHEN n.new_money = 9 THEN 1 ELSE 0 END) AS hon30,
	SUM(CASE WHEN n.new_money = 10 THEN 1 ELSE 0 END) AS hon50,
	SUM(CASE WHEN n.new_money = 11 THEN 1 ELSE 0 END) AS hon100
	FROM new as n";
	$query .=" WHERE n.new_create_time > ".$timenow1."";
	if(intval($noilamviec) > 0){
		$query .=" AND FIND_IN_SET('".$noilamviec."',n.new_city)";
	}
	if($cat_id > 0)
	{
		$query  .= " AND FIND_IN_SET($cat_id, n.new_cat_id)  AND length(n.new_cat_id) <= 3";
	}
	if ($tag_id > 0) {
		$query .= " AND n.new_title LIKE '%".str_replace(' ','%',$tag_name)."%'";
	}
	if($findkey != ''){
		$query .= " AND n.new_title LIKE '%".str_replace(' ','%',$findkey)."%'";
	}
	$dbcompany = new db_query($query);
	if(mysql_num_rows($dbcompany->result) > 0)
	{
		$tg="";
		while($itemcat = mysql_fetch_array($dbcompany->result))
		{
			$arrLuong=array('1000000-3000000','3000000-5000000','5000000-7000000','7000000-10000000','10000000-15000000','15000000-20000000','20000000-30000000','30000000-30000000','50000000-50000000','100000000-100000000');
			$arrsapxep=array($itemcat['tu1den3'],$itemcat['tu3den5'],$itemcat['tu5den7'],$itemcat['tu7den10'],$itemcat['tu10den15'],$itemcat['tu15den20'],$itemcat['tu20den30'],$itemcat['hon30'],$itemcat['hon50'], $itemcat['hon100']);
			$arrbien=[2,3,4,5,6,7,8,9,10,11];
			$arrLuongTB=array(1500000,4000000,6000000,8500000,12500000,17500000,2500000);
			$arrbuocnhay=array(500000,1000000,1000000,1500000,2500000,2500000,5000000);
			$tong=0;

			if($itemcat['tongsobanghi'] > 5){  
				for($j1=0;$j1 < count($arrLuongTB);$j1++ ){
					$tong+=$arrLuongTB[$j1]*$arrsapxep[$j1];
				}
				$tong+=$arrsapxep[7]*30000000;
				$tong+=$arrsapxep[8]*50000000;
				$tong+=$arrsapxep[9]*100000000;
                $trungbinh=$tong/($itemcat['tongsobanghi'] - $itemcat['tongthuongluong']);// - $itemcat->tongthuongluong - $itemcat->tongthuongluong
                $sodu=0;//($itemcat->tongluong)%($itemcat->tongsobanghi);// - $itemcat->tongthuongluong - $itemcat->tongthuongluong
                for($j1=0;$j1< count($arrLuongTB);$j1++ ){
                	if(($trungbinh >=($arrLuongTB[$j1]-$arrbuocnhay[$j1]) ) && ($trungbinh <=($arrLuongTB[$j1]+$arrbuocnhay[$j1]) )){
                		$sodu=$j1; 
                	}
                }
                $thapnhat=0;
                $sobanghithapnhat=0;
                $chay=0;
                if($sodu <=3){
                	$trungbinh1=4;
                }else{
                	$trungbinh1=$sodu;
                }
                for($i=0;$i< ($trungbinh1 -2);$i++)
                {
                	if($chay<=2){
                		if($arrsapxep[$i] > 0){
                            $thapnhat+=$arrLuongTB[$i]*$arrsapxep[$i];//($arrsapxep[$i]*$arrbien[$i]);
                            $sobanghithapnhat+=$arrsapxep[$i];
                            $chay+=1;
                        }

                    }
                }
                if($thapnhat==0){
                	for($i=0;$i< ($trungbinh1 -1);$i++)
                	{
                		if($chay<=3){
                			if($arrsapxep[$i] > 0){
                            $thapnhat+=$arrLuongTB[$i]*$arrsapxep[$i];//($arrsapxep[$i]*$arrbien[$i]);
                            $sobanghithapnhat+=$arrsapxep[$i];
                            $chay+=1;
                        }

                    }
                }
            }
                //$arrtb=explode('-',$arrLuong[(int)($thapnhat/$sobanghithapnhat) -1]); 
            if ($sobanghithapnhat == 0) {
            	$thapnhat=0;
            } else {
            	$thapnhat=$thapnhat/$sobanghithapnhat;
            } 
                //intval($arrtb[0])+((intval($arrtb[1]) - intval($arrtb[0])) * ($thapnhat%$sobanghithapnhat))/($sobanghithapnhat);
            $caonhat=0;
            $sobanghicaonhat=0;
            for($j=($trungbinh1+1);$j< count($arrsapxep);$j++)
            {   
            	if($j < 7){
		                    $caonhat+=$arrLuongTB[$j]*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
		                    $sobanghicaonhat+=$arrsapxep[$j];
		                }else if($j==7){
	                        $caonhat+=30000000*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
	                        $sobanghicaonhat+=$arrsapxep[$j];
	                    }else if($j==8){
	                        $caonhat+=50000000*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
	                        $sobanghicaonhat+=$arrsapxep[$j];
	                    }else if($j==9){
	                        $caonhat+=100000000*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
	                        $sobanghicaonhat+=$arrsapxep[$j];
	                    }
	                }
	                if($caonhat==0) {
	                	for($j=($trungbinh1);$j< count($arrsapxep);$j++) {
	                		if($j < 7) {
		                    $caonhat+=$arrLuongTB[$j]*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
		                    $sobanghicaonhat+=$arrsapxep[$j];
		                }else if($j==7){
	                        $caonhat+=30000000*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
	                        $sobanghicaonhat+=$arrsapxep[$j];
	                    }else if($j==8){
	                        $caonhat+=50000000*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
	                        $sobanghicaonhat+=$arrsapxep[$j];
	                    }else if($j==9){
	                        $caonhat+=100000000*$arrsapxep[$j];//($arrsapxep[$j]*$arrbien[$j]);
	                        $sobanghicaonhat+=$arrsapxep[$j];
	                    }
	                } 
	            }
                //var_dump($sobanghicaonhat);die();
                //$arrtb=explode('-',$arrLuong[(int)($caonhat/$sobanghicaonhat) -1]); 
	            if ($sobanghicaonhat == 0) {
	            	$caonhat=0;
	            } else {
	            	$caonhat=$caonhat/$sobanghicaonhat;
	            }
                //$arrtb=explode('-',$arrLuong[$trungbinh -1]);   
                //$luongtb=intval($arrtb[0])+((intval($arrtb[1]) - intval($arrtb[0])) * $sodu)/($itemcat->tongsobanghi);// - $itemcat->tongthuongluong
	            if($caonhat == 0){
	            	$caonhat=$trungbinh;
	            }
	            if ($thapnhat == 0) {
	            	$thapnhat == $trungbinh;
	            }
	            $tg=array('trungbinh'=>intval($trungbinh),'soluong'=>$itemcat['tongsobanghi'],'caonhat'=>intval($caonhat),'thapnhat'=>intval($thapnhat),'soluongthapnhat'=>$sobanghithapnhat,'sobanghicaonhat'=>$sobanghicaonhat);
                //$tg[]=$itemcat;
	        }else{
	        	$tg=array('trungbinh'=>0,'soluong'=>0,'caonhat'=>0,'thapnhat=>0','soluongthapnhat'=>0,'sobanghicaonhat'=>0);;  
	        }
	    }
	}
	return  json_encode($tg); 
}
//
function convert_number_to_words($number) {
	$hyphen      = ' ';
	$conjunction = '  ';
	$separator   = ' ';
	$negative    = 'âm ';
	$decimal     = ' phẩy ';
	$dictionary  = array(
		0                   => 'Không',
		1                   => 'Một',
		2                   => 'Hai',
		3                   => 'Ba',
		4                   => 'Bốn',
		5                   => 'Năm',
		6                   => 'Sáu',
		7                   => 'Bảy',
		8                   => 'Tám',
		9                   => 'Chín',
		10                  => 'Mười',
		11                  => 'Mười một',
		12                  => 'Mười hai',
		13                  => 'Mười ba',
		14                  => 'Mười bốn',
		15                  => 'Mười năm',
		16                  => 'Mười sáu',
		17                  => 'Mười bảy',
		18                  => 'Mười tám',
		19                  => 'Mười chín',
		20                  => 'Hai mươi',
		30                  => 'Ba mươi',
		40                  => 'Bốn mươi',
		50                  => 'Năm mươi',
		60                  => 'Sáu mươi',
		70                  => 'Bảy mươi',
		80                  => 'Tám mươi',
		90                  => 'Chín mươi',
		100                 => 'trăm',
		1000                => 'ngàn',
		1000000             => 'triệu',
		1000000000          => 'tỷ',
		1000000000000       => 'nghìn tỷ',
		1000000000000000    => 'ngàn triệu triệu',
		1000000000000000000 => 'tỷ tỷ'
	);

	if (!is_numeric($number)) {
		return false;
	}

	if (($number >= 0 && (int) $number < 0) || (int) $number < 0 - PHP_INT_MAX) {
	// overflow
		trigger_error(
			'convert_number_to_words only accepts numbers between -' . PHP_INT_MAX . ' and ' . PHP_INT_MAX,
			E_USER_WARNING
		);
		return false;
	}

	if ($number < 0) {
		return $negative . convert_number_to_words(abs($number));
	}

	$string = $fraction = null;

	if (strpos($number, '.') !== false) {
		list($number, $fraction) = explode('.', $number);
	}

	switch (true) {
		case $number < 21:
		$string = $dictionary[$number];
		break;
		case $number < 100:
		$tens   = ((int) ($number / 10)) * 10;
		$units  = $number % 10;
		$string = $dictionary[$tens];
		if ($units) {
			$string .= $hyphen . $dictionary[$units];
		}
		break;
		case $number < 1000:
		$hundreds  = $number / 100;
		$remainder = $number % 100;
		$string = $dictionary[$hundreds] . ' ' . $dictionary[100];
		if ($remainder) {
			$string .= $conjunction . convert_number_to_words($remainder);
		}
		break;
		default:
		$baseUnit = pow(1000, floor(log($number, 1000)));
		$numBaseUnits = (int) ($number / $baseUnit);
		$remainder = $number % $baseUnit;
		$string = convert_number_to_words($numBaseUnits) . ' ' . $dictionary[$baseUnit];
		if ($remainder) {
			$string .= $remainder < 100 ? $conjunction : $separator;
			$string .= convert_number_to_words($remainder);
		}
		break;
	}

	if (null !== $fraction && is_numeric($fraction)) {
		$string .= $decimal;
		$words = array();
		foreach (str_split((string) $fraction) as $number) {
			$words[] = $dictionary[$number];
		}
		$string .= implode(' ', $words);
	}

	return $string;
}
?>
