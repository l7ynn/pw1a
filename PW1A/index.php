<?php include "inc/conn.php";?><?php include "inc/pubs.php";?>
<!doctype html><?php $tts = date("YmdHis",time());?>
<html lang="zh-CN">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width,minimum-scale=1.0,maximum-scale=1.0" />
<meta name="apple-mobile-web-app-capable" content="yes" />
<title><?php echo $title;?>,96448.cn</title>
<meta name="author" content="yujianyue, admin@ewuyi.net">
<meta name="copyright" content="www.12391.net">
<link href="inc/css/style.css?t=170828" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="inc/js/js.js?t=170828"></script>
</head>
<body onLoad="inst();">
<div class="html">
<div class="divs" id="divs">
<div id="head" class="head" onclick="location.href='?t=<?php echo $tts;?>';">
<?php echo $title;?>
</div>
<div class="main" id="main">
<?php 

$stime=microtime(true); 
$codes = trim($_POST['code']);
$shuru1 = trim($_POST['name']);
if(!$shuru1){
?>
<form name="queryForm" method="post" action="?t=<?php echo $tts;?>" onsubmit="return startRequest(0);">
<div class="so_box" id="11">
<input name="name" type="text" class="txts" id="name" value="" placeholder="请输入<?php echo $tiaojian1;?>" onfocus="st('name',1)" onBlur="startRequest(2)" />
</div>
<?php 
if($ismas=="1"){
?>
<div class="so_box" id="33">
<input name="code" type="text" class="txts" id="code" placeholder="请输入验证码" onfocus="this.value=''" onBlur="startRequest(3)" />
<div class="more" id="clearkey">
<img src="inc/code.php?t=<?php echo $tts;?>" id="Codes" onClick="this.src='inc/code.php?t='+new Date();" />
</div></div>
<?php }?>
<div class="so_but">
<input type="submit" name="button" class="buts" id="sub" value="立即查询" />
<input type="button" class="buts" value="刷新本页" name="print" onclick="location.reload();">
</div>
<div class="so_bus" id="tishi">
说明:【<?php echo $tiaojian1;?><?php 
if($ismas=="1"){
?>+验证码<?php }?>】都输入正确才显示相应结果。<br>
<!---你的其他说明在这里添加：开始-->
内容输入参考：<br>
http://12391.net/LA1sqlite/sqlite.csv
<!--你的其他说明在这里添加：结束-->
</div>
<div id="tishi1" style="display:none;">请输入<?php echo $tiaojian1;?></div>
<div id="tishi4" style="display:none;">请输入4数字验证码</div>
</form>
<?php 
}else{

if($ismas=="1"){
session_start();
if($codes!=$_SESSION['PHP_M2T']){
 webalert("请正确输入验证码！");
}
}

if(!$shuru1){
 webalert("请输入$tiaojian1!");
}

$files = $UpDir."/".$dbtype;

$files = charaget($files);

if(!file_exists($files)){
$files = characet($files);
}

if(!file_exists($files)){
 webalert('请检查数据库文件');
}

$ii = 0;
$iy = 0;
echo "<br><!--{$sqlr}-->";
echo "<br><!--startprint-->";
$connstr = "DRIVER=Microsoft Access Driver (*.mdb);DBQ={$files}"; 
$connid = @odbc_connect( $connstr,"","",SQL_CUR_USE_ODBC ) or die ("数据库连接错误!"); 
$sqlr = "select * from [{$biao}] where {$tiaojian1}='". $shuru1 ."'"; 
$sql = charaget($sqlr);
$query = @odbc_do( $connid, $sql); 
$fieldcount = odbc_num_fields($query); 
echo "<h1>查询结果</h1>\r\n";
echo "<table cellspacing=\"0\" class=\"table\"> \r\n";
  echo '<tr class="tt">';
for( $i=0; $i<$fieldcount; $i++){ 
$info = characet(odbc_field_name($query,$i+1)); 
  echo "<td>$info</td>";
} 
  echo '</tr>';
if(odbc_fetch_row($query)){ 
$iy ++;
  echo '<tr>';
for( $i=0; $i<$fieldcount; $i++){ 
$info = characet(odbc_result($query,$i+1)); 
  echo "<td>$info</td>";
} 
  echo '</tr>';
} 

if($iy<1){
  echo '<tr>';
  echo "<td colspan={$i}>没有查询到相关信息哦</td>";
  echo '</tr>';
}

  echo '</table>';
echo '<!--endprint-->';

?>
<div class="so_but">
<input type="button" class="buts" value="预 览" name="print" onclick="preview()">
<input type="button" class="buts" value="返 回" id="reset" onclick="location.href='?t=back';"></div>
<?php 
}
$etime=microtime(true);
$total=$etime-$stime;
echo "<!----页面执行时间：{$total} ]秒--->";
?>
</div>
<div class="boto" id="boto">
&copy;<?php echo date('Y');?>&nbsp; <a href="<?php echo $copyu;?>" target="_blank"><?php echo $copyr;?></a>
</div>
</div>
</div>
<!--
万用查分1-3条件都得输对(推荐)
版本1说明: 网页版   直接查询   精准(等于关系)
输入要素:查询下拉选择+1到3输入框+可选验证码
查询规则:1到3输入框+可选验证码都得完全输对
用途描述:各种保密性不高的成绩查询、分班、录取、证书等查询等。
在线演示: http://cha1demo.12391.net 
免费开通: http://add.12391.net/?type=cha&isde=0 

密码登录查询本人工资成绩版(推荐)[登录查询]
版本2说明: 网页版   登录查询   精准(等于关系)
输入要素:查询下拉选择+1到3输入框+可选验证码
查询规则:只搜索数据中查询条件就是登录名的内容（只查自己）
注意查询条件列：数字字母组成；查询条件列任一列内容等于账号则显示该条信息。
用途描述:需要保密的成绩查询、工资查询、物业水电费查询等。
在线演示: http://cha3demo.12391.net 
免费开通: http://add.12391.net/?type=dec&isde=1 

通用模糊查询单输入框多条件版(推荐)
版本3说明: 网页版   直接查询   精准(等于关系)
输入要素:查询下拉选择+1个输入框(对应多条件)+可选验证码
查询规则:1到多查询条件任一一列包含即可显示查询结果
用途描述:各种二维表格的检索用途，可以精准(等于)也可以模糊查询(包含)。
在线演示: http://soo1demo.12391.net 
免费开通: http://add.12391.net/?type=soo&isde=0 

通用模糊查询单输入框多条件版(推荐)[登录查询]
版本4说明: 网页版   登录查询   精准/模糊选一
输入要素:查询下拉选择+1个输入框(对应多条件)+可选验证码
查询规则:1到多查询条件任一一列包含即可显示查询结果
用途描述:各种二维表格的检索用途，可以精准(等于)也可以模糊查询(包含)。
在线演示: http://soo3demo.12391.net 
免费开通: http://add.12391.net/?type=soo&isde=1 

-->
</body>
</html>