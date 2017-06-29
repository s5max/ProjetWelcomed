<?php

session_name('wmd');session_start();

if(isset($_SESSION['post']['detail']['title'])){unset($_SESSION['post']['detail']['title']);}
if(isset($_SESSION['post']['detail']['content'])){unset($_SESSION['post']['detail']['content']);}
if(isset($_SESSION['post']['detail']['retrocession'])){unset($_SESSION['post']['detail']['retrocession']);}
if(isset($_SESSION['post']['detail']['company'])){unset($_SESSION['post']['detail']['company']);}
if(isset($_SESSION['post']['detail']['contract'])){unset($_SESSION['post']['detail']['contract']);}
if(isset($_SESSION['post']['detail']['daytime'])){unset($_SESSION['post']['detail']['daytime']);}
