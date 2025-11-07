<?php
    // Load time
    $timer =& new phpTimer();
    $timer->start('main');
    // load ajax
    $sys_lanai->loadAjaxFunction($_REQUEST['modname']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?= _CHARSET; ?>" />
<meta http-equiv="expires" content="0">
<meta name="keywords" content="<?= $obMeta->mtakeywords; ?>" />
<meta name="description" content="<?= $obMeta->mtadescription; ?>" />
<meta name="abstract" content="<?= $obMeta->mtaabstract; ?>" />
<meta name="author" content="<?= $obMeta->mtaauthor; ?>">
<meta name="distribution" content="<?= $obMeta->mtadistribution; ?>">
<meta name="copyright" content="Copyright 2007 redline software">
<meta name="generator" content="Lanai Core - Copyright 2006 Lanai Core Content Management Framework.  All rights reserved." />
<meta name="robots" content="FOLLOW,INDEX">
<link rel="shortcut icon" href="favicon.ico">
<link rel="alternate" type="application/rss+xml" title="<?= $cfg['title']; ?> - RSS Feed" href="<?= $cfg['url']; ?>/feed.php" />
<link rel="alternate" type="application/atom+xml" title="<?= $cfg['title']; ?> - Atom" href="<?= $cfg['url']; ?>/feed.php?feed=ATOM"  />
<title><?= $cfg_title; ?></title>
<link href="theme/<?= $cfg_theme; ?>/style/style.css" rel="stylesheet" type="text/css" />
 <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
      rel="stylesheet" 
      integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
      crossorigin="anonymous">

<?php
    // load ajax code
    $sys_lanai->loadAjaxCode($_REQUEST['modname']);
    // load mm script
    include_once("include/mmscript/mm_script.js");
?>

<!-- calendar stylesheet -->
<link rel="stylesheet" type="text/css" media="all" href="include/jscalendar/calendar-brown.css" title="win2k-cold-1" />
<!-- main calendar program -->
<script type="text/javascript" src="include/jscalendar/calendar.js"></script>
<!-- language for the calendar -->
<script type="text/javascript" src="include/jscalendar/lang/calendar-en.js"></script>
<!-- setup helper -->
<script type="text/javascript" src="include/jscalendar/calendar-setup.js"></script>

</head>
<body>

