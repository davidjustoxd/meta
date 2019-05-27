<?php
session_name('meta');
session_start();
session_destroy();
header("Location:.");
?>