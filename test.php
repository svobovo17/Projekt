<?php
$alphabet = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
$pass = substr(str_shuffle($alphabet), 0, 10);
echo $pass;
?>