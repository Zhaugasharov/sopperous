<?php

if (isset($_GET['lang'])) {
    $lang = \App\Http\Helpers::filter($_GET['lang']);
    if ($lang == "en_US") {
        $language = \App\Http\Helpers::LangEN();
    } elseif ($lang == "ru_RU") {
        $language = \App\Http\Helpers::LangRU();
    }
} else {
    $lang = 'ru_RU';
    $language = \App\Http\Helpers::LangRU();
}

$language = $language[0];
?>

<!DOCTYPE html >
<html lang="ru">

@include('landing.layout.app')

<body>

@include('landing.layout.header')

@yield('content')

<script>
    var action_text = "<?=$language['action']; ?>";
</script>


<link href="/zipper/css/jquery.fancybox.min.css" rel="stylesheet" type="text/css">
<link href="/zipper/css/animate.css" rel="stylesheet" type="text/css">
<link href="/zipper/css/owl.carousel.min.css" rel="stylesheet" type="text/css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="/zipper/js/owl.carousel.min.js"></script>
<script src="/zipper/js/jquery.fancybox.min.js"></script>
<script src="/zipper/js/jquery.animateNumber.min.js"></script>
<script src="/zipper/js/js.js"></script>

@yield('js')

</body>
</html>