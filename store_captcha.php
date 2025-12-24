<?php
session_start();
$_SESSION['captcha'] = $_GET['code'] ?? '';

