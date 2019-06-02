<?php
# FileName="Connection_php_mysql.htm"
# Type="MYSQL"
# HTTP="true"
$hostname_RiskManagement = "localhost";
$database_RiskManagement = "riskmanagementsystem";
$username_RiskManagement = "root";
$password_RiskManagement = "";
$RiskManagement = mysql_pconnect($hostname_RiskManagement, $username_RiskManagement, $password_RiskManagement) or trigger_error(mysql_error(),E_USER_ERROR); 
?>