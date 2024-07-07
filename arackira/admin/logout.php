<?php
include "../config.php";
session_start();
session_unset();
header("Location: $indexURL/admin/login.php");