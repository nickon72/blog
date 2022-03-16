<?

 //Начало отсчета времени
 $timeparts = explode(" ",microtime());

 //Подключение файла функций БД
 include "dblayer.php";
 //Подключение файла заголовка
 include "header.php";

 function maketree ($rootcatid, $sql, $maxlevel) {
  // $rootcatid - ID корневой категории;
  // $sql - запрос для извлечения данных;
  // $maxlevel - макс.уровень вложения; 0 - любой
  $result=dbquery($sql);
  while (list($catid,$parcat,$name) = dbfetch($result)) {
   $table[$parcat][$catid] = $name;
   $partable[$catid][$parcat] = $name;
  };
  $result=buildparent($rootcatid,$table,$partable);
  if ($result!='') $result.='<br>';
  $result.=makebranch($rootcatid,$table,0,$maxlevel);
  RETURN $result;
 }

 function makebranch ($parcat, $table, $level, $maxlevel){
  //Строим древовидную ветку с уровня $level
  $result='';
  if (isset($table[$parcat])) {
   $list=$table[$parcat];
   asort($list);
   while (list($key,$val)=each($list)) {
    if ($level=='0') {
     $output="<img src=0.gif width=16 height=14>";
    }
    else {
     $width=($level+1)*16;
     $output="<img src=void.gif width=$width height=14>";
    };
    //HTML-вывод, который можно менять
    $result.= "$output ";
    if ($level!='0') { 
     if (isset($table[$key])) { $result.= "<img src=0.gif width=16 height=14>&nbsp;"; }
     else { $result.= "<img src=1.gif width=16 height=14>&nbsp;"; }
    }
    $result.= "<a href=index.php?catid=$key>$val</a> (<a href=add.php?catid=$key>+</a>/<a href=del.php?catid=$key onclick='return window.confirm(\"Удаляем?\")'>-</a>)<br>\n";
    if ((isset($table[$key])) AND (($maxlevel>$level+1) OR ($maxlevel=='0'))) {
     $result.= makebranch($key,$table,$level+1,$maxlevel);
    };
   };
  }
  RETURN $result;
 }

 function buildparent($catid,$table,$partable){
  //Строим горзонтальную линейку к текущей категории
  $output='';
  if ($catid!=0) {
   $list=$partable[$catid];
   $result=each($list);
   $output="<img src=0.gif width=16 height=14>&nbsp;<a href=index.php?catid=$result[0]>$result[1]</a> ";
   $output=buildparent($result[0],$table,$partable).$output;
  };
  RETURN $output;
 }

 if (!isset($catid)) { //категория по умолчанию
  $catid=0;
 };

 $maxlevel=0;
 print maketree($catid,"SELECT catid,parcat,name FROM treetest order by parcat",$maxlevel);

 //Итоги по времени
 $starttime = $timeparts[1].substr($timeparts[0],1);
 $timeparts = explode(" ",microtime());
 $endtime = $timeparts[1].substr($timeparts[0],1);
 $totaltime=bcsub($endtime,$starttime,6);
 print "<font size=\"1\">Время работы $totaltime с.</font>";
?>
