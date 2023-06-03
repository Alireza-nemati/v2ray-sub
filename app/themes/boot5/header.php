<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content=";)">
    <meta name="author" content="Salir">
    <META NAME="ROBOTS" CONTENT="NOINDEX, NOFOLLOW">
    <meta name="generator" content="Hugo 0.108.0">
    <title>iPlus</title>

    <link href="https://fonts.googleapis.com/css2?family=Lato:wght@400;700&display=swap" rel="stylesheet">

    <link href="<?= BASE_URL ?>assets/css/bootstrap.rtl.min.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Favicons -->
    <link rel="apple-touch-icon" href="<?= BASE_URL ?>assets/img/images/icons/icon-152x152.png" sizes="152x152">
    <link rel="manifest" href="<?= BASE_URL ?>assets/img/manifest.json">
    <link rel="mask-icon" href="<?= BASE_URL ?>assets/img/logo.svg" color="#712cf9">
    <link rel="icon" href="<?= BASE_URL ?>assets/img/logo.ico">
    <meta name="theme-color" content="#0565e6">


    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }

        .b-example-divider {
            height: 3rem;
            background-color: rgba(0, 0, 0, .1);
            border: solid rgba(0, 0, 0, .15);
            border-width: 1px 0;
            box-shadow: inset 0 .5em 1.5em rgba(0, 0, 0, .1), inset 0 .125em .5em rgba(0, 0, 0, .15);
        }

        .b-example-vr {
            flex-shrink: 0;
            width: 1.5rem;
            height: 100vh;
        }

        .bi {
            vertical-align: -.125em;
            fill: currentColor;
        }

        .nav-scroller {
            position: relative;
            z-index: 2;
            height: 2.75rem;
            overflow-y: hidden;
        }

        .nav-scroller .nav {
            display: flex;
            flex-wrap: nowrap;
            padding-bottom: 1rem;
            margin-top: -1px;
            overflow-x: auto;
            text-align: center;
            white-space: nowrap;
            -webkit-overflow-scrolling: touch;
        }

        .ltr {
            direction: ltr;
        }

        input ,textarea,select,option{
            font-family: 'Lato', sans-serif;
        }
    </style>


    <!-- Custom styles for this template -->
    <link href="<?= BASE_URL ?>assets/fonts/iranyekan/iranyekan.css" rel="stylesheet">
    <link href="<?= BASE_URL ?>assets/css/style.css" rel="stylesheet">

    <!-- Head JS-->
    <script src="<?= BASE_URL ?>assets/js/jquery-3.6.4.min.js"></script>
</head>

<body>

<header>
    <nav class="navbar navbar-expand-md fixed-top navbar-dark bg-primary">
        <div class="container-xl">
            <a class="navbar-brand" href="#"><img src="<?= BASE_URL ?>assets/img/logo.png" width="80px" alt="iplus"></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse"
                    aria-controls="navbarCollapse" aria-expanded="false" aria-label="تبديل التنقل">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav me-auto mb-2 mb-md-0">
                    <?php
                    $menu_html = '<li class="nav-item"><a class="nav-link [active/]" aria-current="page" href="[slug/]"> [title/]</a></li>';
                    load_menu($menu_html);
                    ?>
                </ul>
                <form class="d-flex" role="exit" action="<?= BASE_URL ?>signout">
                    <button class="btn btn-outline-light" type="submit">خروج <i class="bi bi-box-arrow-right"></i> </button>
                </form>
            </div>
        </div>
    </nav>
</header>