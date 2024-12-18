<?php
session_start();
include("app/core/functions.php");

session_destroy();
redirect("login.php");
die();