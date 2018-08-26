<?php
require_once __DIR__ . '/functions.php';

$phone1 = "+77012230621";
$phone1wp = "77012230621";
$phone1i2 = "+7 (701) 223-06-21";

$phone2 = "+77014447005";
$phone2i2 = "+7 (701) 444-70-05";

if (isset($_GET['lang'])) {
    $lang = filter($_GET['lang']);
    if ($lang == "en_US") { 
        $language = LangEN();
    } elseif ($lang == "ru_RU") { 
        $language = LangRU();
    }      
} else {
	 $lang = 'ru_RU';
	 $language = LangRU();
}

$language = $language[0];
?>

	<!DOCTYPE html >
	<html lang="ru">

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<title><?=$language['site-title']; ?></title>
		<meta name=viewport content="width=device-width, initial-scale=1">
		<meta name="robots" content="index, follow" />
		<meta name="keywords" content="" />
		<meta name="description" content="<?=$language['description']; ?>" />

		<!-- <link rel="stylesheet/less" type="text/css" href="css/main.less">
		<script src="js/less.min.js" type="text/javascript"></script>-->
		<link href="css/main.css" rel="stylesheet" type="text/css">
		<link rel="canonical" href="http://gxp.kz" />
		<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
		<link rel="apple-touch-icon" sizes="144x144" href="/apple-touch-icon.png">
		<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
		<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
		<link rel="manifest" href="/site.webmanifest">
		<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
		<meta name="msapplication-TileColor" content="#da532c">
		<meta name="theme-color" content="#ffffff">

	</head>

	<body>
		<div class="fake" id='top'>
			<div class="w100 siteTop animated" id='siteTop'>
				<div class="container">
					<a class="pull"><img src="img/menu.jpg" alt=""></a>
					<ul>
						<li><a class='scroll' href="#top"><?=$language['menu1']; ?></a></li>
						<li><a class='scroll' href="#advantages"><?=$language['menu3']; ?></a></li>
						<li><a class='scroll' href="#steps"><?=$language['menu2']; ?></a></li>
						<li><a class='scroll' href="#reviews"><?=$language['menu4']; ?></a></li>
						<li><a class='scroll' href="#contacts"><?=$language['menu5']; ?></a></li>
					</ul>
					<div class="logo">
						<img src='img/logo.gif' alt='<?=$language['logo_title']; ?>'>
					</div>
					<div class="right">
						<div class="langs">
							<a href="/login" class="active">Вход</a>
						</div>
						<div class="phones">
							<div class='flex'>
								<img src="img/phone-icon.png" alt="">
								<div class="flex fdc">
									<a class='phone' href='tel:<?=$phone1; ?>'>
										<?=$phone1i2; ?>
									</a>
									<a class='phone' href='tel:<?=$phone2; ?>'>
										<?=$phone2i2; ?>
									</a>
								</div>
							</div>
							<a data-src="#modal" data-fancybox class='v1' onclick="$('#info').val('<?=$language['callback']; ?>, шапка сайта')"><?=$language['callback']; ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="first-block w100">
			<div class="container">
				<h1 class='animated'><?=$language['h1']; ?></h1>
				<h2 class='animated'><?=$language['h2']; ?></h2>
				<a class='v1' href="/register"><?=$language['callback2']; ?></a>
			</div>
		</div>

		<div class="counts w100 grad">
			<div class="container owl-carousel owl-counts">
				<div class="item">
					<h4><?=$language['count1_name_prev']; ?> <i class="fa fa-question" aria-hidden="true"></i></h4>
					<p><?=$language['count1_text']; ?></p>
				</div>
				<div class="item">
					<h4><?=$language['count1_name_prev']; ?> <i class="fa fa-chart-line" aria-hidden="true"></i></h4>
					<p><?=$language['count2_text']; ?></p>
				</div>
				<div class="item">
					<h4><?=$language['count1_name_prev']; ?> <i class="fa fa-info" aria-hidden="true"></i></h4>
					<p><?=$language['count3_text']; ?></p>
				</div>
				<!--<div class="item">
					<h4><?/*=$language['count2_name']; */?> <span id='count4'>0</span></h4>
					<p><?/*=$language['count4_text']; */?></p>
				</div>
				<div class="item">
					<h4><?/*=$language['count2_name']; */?> <span id='count5'>0</span></h4>
					<p><?/*=$language['count5_text']; */?></p>
				</div>-->
			</div>
		</div>

		<div class="service w100 pad" id='service'>
			<div class="container">
				<h2><?=$language['count1_text']; ?></h2>
				<div class="line"></div>
				<!--<h3 class="title_def"><?/*=$language['service']; */?></h3>-->
				<div class="flex owl-carousel owl-service animated">
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/11.png" alt=""></div>
							<p><?=$language['s1']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/12.png" alt=""></div>
							<p><?=$language['s2']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/13.png" alt=""></div>
							<p><?=$language['s3']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/14.png" alt=""></div>
							<p><?=$language['s4']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="service w100 pad" id='service'>
			<div class="container">
				<h2><?=$language['count2_text']; ?></h2>
				<div class="line"></div>
				<!--<h3 class="title_def"><?/*=$language['service']; */?></h3>-->
				<div class="flex owl-carousel owl-service2 animated">
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/21.png" alt=""></div>
							<p><?=$language['s5']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/22.png" alt=""></div>
							<p><?=$language['s6']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/icons/23.png" alt=""></div>
							<p><?=$language['s7']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="service w100 pad" id='service'>
			<div class="container">
				<h2><?=$language['count3_text']; ?></h2>
				<div class="line"></div>
				<!--<h3 class="title_def"><?/*=$language['service']; */?></h3>-->
				<div class="flex owl-carousel owl-service animated">
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/i5.png" alt=""></div>
							<p><?=$language['s9']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/i5.png" alt=""></div>
							<p><?=$language['s10']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/i5.png" alt=""></div>
							<p><?=$language['s11']; ?></p>
						</div>
					</div>
					<div class="i">
						<div class="item">
							<div class="image"><img src="img/i5.png" alt=""></div>
							<p><?=$language['s12']; ?></p>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="about w100 pad grad" id='advantages'>
			<div class="container">
				<h3 class="title_def white"><?=$language['company']; ?></h3>
				<div class="owl-carousel owl-about animated">
					<div class="item">
						<div class="size"><i class="fa fa-clone" aria-hidden="true"></i></div>
						<p><?=$language['c1']; ?></p>
					</div>
					<div class="item">
						<div class="size"><i class="fa fa-mobile" aria-hidden="true"></i></div>
						<p><?=$language['c2']; ?></p>
					</div>
					<div class="item">
						<div class="size"><i class="fa fa-video" aria-hidden="true"></i></div>
						<p><?=$language['c3']; ?></p>
					</div>
				</div>

			</div>
		</div>

<!--		<div class="about-us w100 pad">
			<div class="container">
				<h3 class="title_def"><?/*=$language['about']; */?></h3>
				<div class="flex">
					<p><?/*=$language['about_text1']; */?></p>
					<p><?/*=$language['about_text2']; */?></p>
				</div>
				<div class="text">
					<p><?/*=$language['about_text3']; */?></p>
				</div>
				<h3 class="title_def"><?/*=$language['cert']; */?></h3>
				<div class="cert">
					<a href='img/certificates/1.jpg' data-fancybox='certificates'><img src='img/certificates/thumbs/1.jpg' alt=''></a>
					<a href='img/certificates/2.jpg' data-fancybox='certificates'><img src='img/certificates/thumbs/2.jpg' alt=''></a>
				</div>
			</div>
		</div>-->

		<div class="steps pad w100" id="steps">
			<div class="container">
				<h3 class="title_def"><?=$language['steps']; ?></h3>
				<img class='back' src='img/line-back.png' alt=''>
				<div class="flex">
					<div class="item i1">
						<div class="top">1</div>
						<p><?=$language['step1']; ?></p>
					</div>
					<div class="item i2">
						<div class="top">2</div>
						<p><?=$language['step2']; ?></p>
					</div>
					<div class="item i3">
						<div class="top">3</div>
						<p><?=$language['step3']; ?></p>
					</div>
					<div class="item i5">
						<div class="top">5</div>
						<p><?=$language['step5']; ?></p>
					</div>
					<div class="item i4">
						<div class="top">4</div>
						<p><?=$language['step4']; ?></p>
					</div>
					<div class="item i6">
						<div class="top">6</div>
						<p><?=$language['step6']; ?></p>
					</div>
				</div>
				<div class="last">
					<div class="top"></div>
					<p><?=$language['step6']; ?></p>
				</div>
				<a href="/register" class="v1"><?=$language['callback2']; ?></a>
			</div>
		</div>

		<div class="partners w100 grad pad">
			<div class="container">
				<h3 class="title_def white"><?=$language['partners']; ?></h3>
				<div class="owl-carousel owl-partners animated">
					<div class="item"><img src="img/p5.png" alt=""></div>
					<div class="item"><img src="img/p6.png" alt=""></div>
					<div class="item"><img src="img/p7.png" alt=""></div>
					<div class="item"><img src="img/p8.png" alt=""></div>
					<div class="item"><img src="img/p1.png" alt=""></div>
					<div class="item"><img src="img/p2.png" alt=""></div>
					<div class="item"><img src="img/p3.png" alt=""></div>
					<div class="item"><img src="img/p4.png" alt=""></div>
					<div class="item"><img src="img/p9.png" alt=""></div>
					<div class="item"><img src="img/p10.png" alt=""></div>
					<div class="item"><img src="img/p11.png" alt=""></div>
					<div class="item"><img src="img/p12.png" alt=""></div>
				</div>
				<a data-src="#modal" data-fancybox="" class="v1 white" onclick="$('#info').val('Мы сотрудничаем')"><?=$language['callback3']; ?></a>
			</div>
		</div>

		<div class="team w100 pad">
			<div class="container">
				<p class="text">
					<?=$language['team_text']; ?>
				</p>
				<h3 class="title_def"><?=$language['team']; ?></h3>
				<div class="owl-carousel owl-team">
					<div class="item grad">
						<h4><?=$language['count1_name_prev']; ?></h4>
						<p><?=$language['t1']; ?></p>
					</div>
					<div class="item grad">
						<p><?=$language['t2']; ?></p>
					</div>
					<div class="item grad">
						<p><?=$language['t3']; ?></p>
					</div>
					<div class="item grad">
						<p><?=$language['t4']; ?></p>
					</div>
				</div>
			</div>
		</div>

		<div class="w100 pad reviews" id='reviews'>
			<div class="container">
				<h3 class="title_def"><?=$language['reviews']; ?></h3>
				
					<?php if ($lang == 'ru_RU') { ?>
					<div class="owl-carousel owl-reviews">
						<a href="img/reviewsRU/3.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/3.jpg" alt=""></a>
						<a href="img/reviewsRU/1.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/1.jpg" alt=""></a>
						<a href="img/reviewsRU/4.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/4.jpg" alt=""></a>
						<a href="img/reviewsRU/6.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/6.jpg" alt=""></a>
						<a href="img/reviewsRU/2.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/2.jpg" alt=""></a>
						<a href="img/reviewsRU/7.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/7.jpg" alt=""></a>
						<a href="img/reviewsRU/8.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/8.jpg" alt=""></a>
						<a href="img/reviewsRU/5.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/5.jpg" alt=""></a>
					</div>
					<?php } else { ?>
					<div class="owl-carousel owl-reviews">
						<a href="img/reviewsENG/1.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/1.jpg" alt=""></a>
						<a href="img/reviewsRU/1.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/1.jpg" alt=""></a>
						<a href="img/reviewsRU/4.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/4.jpg" alt=""></a>
						<a href="img/reviewsRU/6.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/6.jpg" alt=""></a>
						<a href="img/reviewsRU/2.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/2.jpg" alt=""></a>
						<a href="img/reviewsRU/7.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/7.jpg" alt=""></a>
						<a href="img/reviewsRU/8.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/8.jpg" alt=""></a>
						<a href="img/reviewsRU/5.jpg" data-fancybox="reviews"><img src="img/reviewsRU/thumbs/5.jpg" alt=""></a>
					</div>
					<?php } ?>
				
			</div>
		</div>

		<div class="questions pad grad">
			<div class="container">
				<h3 class="title_def white"><?=$language['quest']; ?></h3>
				<p><?=$language['quest_text']; ?></p>
				<form action="action.php" method="post">
					<input type="text" class="name" name="name" placeholder="<?=$language['name']; ?>">
					<input type="tel" name="tel" class="tel" placeholder="<?=$language['phone']; ?>" required>
					<input type="hidden" name="info" value="Есть вопросы">
					<button><?=$language['callback3']; ?></button>
					<div class="loading">
						<img src="css/fancybox_loading.gif" alt="Загрузка">
					</div>
				</form>
			</div>
		</div>
		
		<div class="contacts pad w100" id="contacts">
			<div class="container">
				<h3 class="title_def"><?=$language['contacts']; ?></h3>
				<p><strong><?=$language['contacts_name']; ?></strong></p>
				<p><?=$language['contacts_address']; ?></p>
				<p><?=$language['contacts_phones']; ?>:<a class='phone' href='tel:<?=$phone1; ?>'><b><?=$phone1i2; ?></b></a>, <a class='phone' href='tel:<?=$phone2; ?>'><b><?=$phone2i2; ?></b></a></p>
				<p>website: <a href="www.gxp.kz" target="_blank">www.gxp.kz</a></p>
				<p>Email: <a href="mailto:info@gxp.kz">info@gxp.kz</a></p>
				<div class="social">
					<a href="http://facebook.com/gxp.kz/" target="_blank"><img src='img/fb.png' alt='Facebook'></a>
					<a href="https://api.whatsapp.com/send?phone=<?=$phone1wp; ?>" target="_blank"><img src='img/wp.png' alt='WhatsApp'></a>
					<a href="http://instagram.com/gxpcompany" target="_blank"><img src='img/insta.png' alt='Instagram'></a>
				</div>
			</div>
		</div>
		
		<div class="w100 map">
			<script async src="https://api-maps.yandex.ru/services/constructor/1.0/js/?um=constructor%3A5adfe126702b0c731d9fb872658247dbc1ae981303ff1ff849a026b625ab03aa&amp;width=100%25&amp;height=400&amp;lang=ru_RU&amp;scroll=false"></script>
		</div>

		<div class="footer w100">
			<div class="container">
				<a href='http://bgpro.kz' title="<?=$language['develop_title']; ?>" target="_blank"><?=$language['develop']; ?></a>
			</div>
		</div>
		
		<div class="w100 wpMobile">
			<a href="https://api.whatsapp.com/send?phone=<?=$phone1wp; ?>" target="_blank">Написать в WhatsApp</a>
		</div>

		<div class="modal grad" id="modal">
			<h2><?=$language['modal']; ?></h2>
			<p><?=$language['modal_text']; ?></p>
			<form action="action.php" method="post">
				<input type="text" class="name" name="name" placeholder="<?=$language['name']; ?>"><br>
				<input type="tel" name="tel" class="tel" placeholder="<?=$language['phone']; ?>" required><br>
				<input type="hidden" name="info" id="info" value="Обратный звонок">
				<button><?=$language['callback']; ?></button>
				<div class="loading">
					<img src="css/fancybox_loading.gif" alt="Загрузка">
				</div>
			</form>
		</div>
	<script>
	var action_text = "<?=$language['action']; ?>";	
	</script>

	
	<link href="css/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
	<link href="css/animate.css" rel="stylesheet" type="text/css">
	<link href="css/owl.carousel.min.css" rel="stylesheet" type="text/css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="js/owl.carousel.min.js"></script>
	<script src="js/jquery.fancybox.min.js"></script>
	<script src="js/jquery.animateNumber.min.js"></script>
	<script src="js/js.js"></script>
	</body>
	</html>
