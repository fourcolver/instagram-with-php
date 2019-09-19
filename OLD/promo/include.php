<?php

if (isset($_POST['wallTitle'])) {
    $wallTitle = $_POST['wallTitle'];
} else {
    $wallTitle = '';
}

if (isset($_POST['logo'])) {
    $logo = $_POST['logo'];
} else {
    $logo = '';
}

if (isset($_POST['background'])) {
    $background = $_POST['background'];
} else {
    $background = '';
}

if (isset($_POST['headline'])) {
    $headline = $_POST['headline'];
} else {
    $headline = '';
}

if (isset($_POST['caption'])) {
    $caption = $_POST['caption'];
} else {
    $caption = '';
}

if (isset($_POST['cta'])) {
    $cta = $_POST['cta'];
} else {
    $cta = '';
}

if (isset($_POST['share'])) {
    $share = $_POST['share'];
} else {
    $share = '';
}

if (isset($_POST['promo'])) {
    $promo = $_POST['promo'];
} else {
    $promo = '';
}
