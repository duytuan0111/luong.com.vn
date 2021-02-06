<? include('../includes/inc_footer.php') ?>
<style type="text/css">
	.coppy-left img{
				margin-right: 10px;
	}
	.footer_mb ul {
		list-style: none;
	}
	.copyright .h1 {
		font-weight: 600;
    	font-family: 'Lato' !important;
	}	
	.coppy-left p {
		color: #FFFFFF;
		font-family: 'Lato';
		font-size: 17px;
	}
	.doi_tac {
		font-family: 'Lato';
		font-weight: 400;
	}
	.doi_tac p {
		color: #FFFFFF;
		font-family: 'Lato';
	}
	@media screen and (max-width: 479px) {
		.doi_tac ul {
			padding-left: 17px;
		}
		
	}
</style>
</body>
<script src="/ssl/assets/js/jquery.min.js"></script>
<script src="/ssl/assets/js/bootstrap.min.js"></script>
<script src="/ssl/assets/js/select2.min.js"></script>
<script src="/ssl/assets/js/jquery-ui.js"></script>
<script src="/ssl/assets/js/Highcharts-8.2.2/code/highcharts.js"></script>
<script src="/ssl/assets/js/Highcharts-8.2.2/code/modules/data.js"></script>
<script src="/ssl/assets/js/Highcharts-8.2.2/code/modules/exporting.js"></script>
<script src="/ssl/assets/js/Highcharts-8.2.2/code/modules/accessibility.js"></script>
<script src="/js/lazysizes.min.js"></script>
<script type="text/javascript">
	// alert( 'Màn hình: ' + screen.width + 'x' + screen.height );
	jQuery(document).ready(function($) {
		$('.city').select2();
		//
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
		$('.load-more-related-position').on('click', function(event) {
			if ($('.list-related-position').hasClass('hide-related-position')) {
				$('.list-related-position ').removeClass('hide-related-position');
				$(this).find('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
			} else {
				$('.list-related-position ').addClass('hide-related-position');
				$(this).find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
			}
		});
		$('.load-more-related-position-1').on('click', function(event) {
			if ($('.list-related-position-1').hasClass('hide-related-position-1')) {
				$('.list-related-position-1').removeClass('hide-related-position-1');
				$(this).find('i').removeClass('fa-plus-circle').addClass('fa-minus-circle');
			} else {
				$('.list-related-position-1').addClass('hide-related-position-1');
				$(this).find('i').removeClass('fa-minus-circle').addClass('fa-plus-circle');
			}
		});
		// xem  thêm lương
		$('.see-more-salary').on('click', function(event) {
			if ($('.main-salary-1-right').hasClass('compact-salary')) {
				$('.main-salary-1-right').removeClass('compact-salary');
				$(this).html('Ẩn bớt <i class="fas fa-angle-double-up"></i>');
			} else {
				$('.main-salary-1-right').addClass('compact-salary');
				$(this).html('Xem thêm <i class="fas fa-angle-double-down"></i>');
			}
			
		});
		// xem thêm lương theo thành phố
		$('.see-more-salary-by-city').on('click', function(event) {
			if ($('.salary-by-city-right').hasClass('compact-salary-by-city')) {
				$('.salary-by-city-right').removeClass('compact-salary-by-city');
				$('.border-dashed').removeClass('compact-salary-by-city-dashed');
				$(this).html('Ẩn bớt <i class="fas fa-angle-double-up"></i>');
			} else {
				$('.salary-by-city-right').addClass('compact-salary-by-city');
				$('.border-dashed').addClass('compact-salary-by-city-dashed');
				$(this).html('Xem thêm <i class="fas fa-angle-double-down"></i>');
			}
		});

		function remove_accent(title='')
		{

            //Đổi chữ hoa thành chữ thường
            slug = title.toLowerCase();

            //Đổi ký tự có dấu thành không dấu
            slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
            slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
            slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
            slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
            slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
            slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
            slug = slug.replace(/đ/gi, 'd');
            //Xóa các ký tự đặt biệt
            slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
            //Đổi khoảng trắng thành ký tự gạch ngang
            slug = slug.replace(/ /gi, "-");
            //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
            //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
            slug = slug.replace(/\-\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-\-/gi, '-');
            slug = slug.replace(/\-\-\-/gi, '-');
            slug = slug.replace(/\-\-/gi, '-');
            //Xóa các ký tự gạch ngang ở đầu và cuối
            slug = '@' + slug + '@';
            slug = slug.replace(/\@\-|\-\@|\@/gi, '');
            return slug;
        }
		//
		<?php 
		$arrcate_sala = $arrtag_sala = [];
		$objcate_sala = $objtag_sala = $obj_all = '';
		foreach ($db_tags_sll as $k => $v) {
			$arrtag_sala[] = $v['tag_name'];
			$objtag_sala[$v['tag_id']] = mb_strtolower($v['tag_name']);
		}
		foreach ($db_cat as $k => $v) {
			$arrcate_sala[] = $v['cat_name'];
			$objcate_sala[$v['cat_id']] = mb_strtolower($v['cat_name']);
		} 
		?>
		function getKeyByValue(object, value) {
			return Object.keys(object).find(key => object[key] === value);
		}
		// 
		var cate_ssl 		= <?= json_encode($arrcate_sala) ?>;
		var tag_ssl 		= <?= json_encode($arrtag_sala) ?>;
		var obj_cate_ssl	= <?= json_encode($objcate_sala) ?>;
		var obj_tag_ssl		= <?= json_encode($objtag_sala) ?>;
		var arr_search_ssl 	= cate_ssl.concat(tag_ssl);
		var base_url 		= '<?php echo $domain; ?>';
		// xử lí thanh search
		$('.btn-search-header').on('click', function(event) {
			event.preventDefault();
			// 
			var city       = $(this).parents('.search-form-act').find('.city').find(':selected').val();
			var city_name  = $(this).parents('.search-form-act').find('.city').find(':selected').attr('data-name');
			var keyword    = $(this).parents('.search-form-act').find('.ui-autocomplete-input').val().toLowerCase().trim();
			if (city > 0 || keyword !== '') {
				if (keyword !== '') {
					if (Object.values(obj_cate_ssl).indexOf(keyword) > -1) {
						var idcate 	= getKeyByValue(obj_cate_ssl, keyword);
						slug 		= remove_accent(keyword);
						if (city > 0) {
							var slug_city 	= remove_accent(city_name);
							var slug_key 	= remove_accent(keyword);
							url 			= '/luong-'+slug_key+'-tai-'+slug_city+'-v'+idcate+'b'+city+'.html';
						} else {
							url 			= '/luong-'+slug+'-v'+idcate+'.html'
						}
					} else if (Object.values(obj_tag_ssl).indexOf(keyword) > -1) {
						var idtag 			= getKeyByValue(obj_tag_ssl, keyword);
						slug 				= remove_accent(keyword);
						if (city > 0) {
							var slug_city 	= remove_accent(city_name);
							var slug_key 	= remove_accent(keyword);
							url 			= '/luong-'+slug_key+'-tai-'+slug_city+'-m'+idtag+'b'+city+'.html';
						} else {
							url 		 	= '/luong-'+slug+'-m'+idtag+'.html';
						}
					} else {
						var key_replace 	= keyword.replaceAll(' ', '+');
						if (city > 0) {
							url 			= '/chi-tiet-luong.html?keyword='+key_replace+'&cit_id='+city;
						} else {
							url 			= '/chi-tiet-luong.html?keyword='+key_replace;
						}
					}
				} else if (keyword == '' && city > 0) {
					slug_city 	= remove_accent(city_name);
					url 		= '/luong-tai-'+slug_city+'-k'+city+'.html';
				}
				window.location.href = url;
			} else {
				alert('Vui lòng chọn trường tìm kiếm !');
			}
		});
		// Auto complete		
		$( ".ui-autocomplete-input" ).autocomplete({
			source: arr_search_ssl
		});
	});
</script>
</html>