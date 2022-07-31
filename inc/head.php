<?php

namespace Inc;

use Helpers\Util;

$filepath  = realpath(dirname(__FILE__));
require_once($filepath . "../../vendor/autoload.php");
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="keywords" content="gia sư online, web gia sư, web gia sư online, website gia sư online, website gia sư, tìm gia sư,tìm khóa học,gia sư công nghệ,gia sư,gia sư tiếng anh,gia sư toán,gia sư Đồng Tháp"/>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>

    <meta content="INDEX,FOLLOW" name="robots" />
    <meta name="copyright" content="Dự án website gia sư trường Đại học Đồng Tháp" />
    <meta name="author" content="Trường Đại học Đồng Tháp" />
    <meta http-equiv="audience" content="General" />
    <meta name="resource-type" content="Document" />
    <meta name="distribution" content="Global" />
    <meta name="revisit-after" content="1 days" />
    <meta name="GENERATOR" content="Trường Đại học Đồng Tháp" />

    <meta name="description" content="Hệ thống gia sư dạy kèm chất lượng cao">
    <meta property="og:title" content="Kết nối dạy và học | Tìm giáo viên, Tìm gia sư">
    <meta property="og:url" content="http://localhost:5050/tutor_webapp/pages/">
    <meta property="og:image" content="">
    <link rel="canonical" href="http://localhost:5050/tutor_webapp/pages/" />
    <meta name="RATING" content="GENERAL" />

    <meta property="og:site_name" content="Education" />
    <meta property="og:type" content="website" />
    <meta property="og:locale" content="vi_VN" />
    <meta property="og:email" content="" />
    <meta property="og:phone_number" content="" />
    <meta property="fb:pages" content="106809601820790" />
    <meta http-equiv="x-dns-prefetch-control" content="on">

    <meta property="og:see_also" content="http://localhost:5050/tutor_webapp/pages/list_tutor" />
    <meta property="og:see_also" content="http://localhost:5050/tutor_webapp/pages/tutor_registration_form" />

    <title><?php if (isset($title)) echo $title;
            else echo "Không tiêu đề" ?></title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.css" integrity="sha256-NAxhqDvtY0l4xn+YVa6WjAcmd94NNfttjNsDmNatFVc=" crossorigin="anonymous" />
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.2.0/dist/select2-bootstrap-5-theme.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/toastify-js/src/toastify.min.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    <!-- <link rel="stylesheet" href="<?= Util::getRootURL() . '/tutor_webapp/public/' . "css/style.css" ?>"> -->

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.5/croppie.min.css" integrity="sha512-zxBiDORGDEAYDdKLuYU9X/JaJo/DPzE42UubfBw9yg8Qvb2YRRIQ8v4KsGHOx2H1/+sdSXyXxLXv5r7tHc9ygg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="<?= mix('css/app.css', 'tutor_webapp/public'); ?>">
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">
    <!-- aos css   -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>