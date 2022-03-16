<?

global $HTTP_GET_VARS;
$catid='';
if (isset($HTTP_GET_VARS['catid'])) $catid = trim($HTTP_GET_VARS['catid']);

include "dblayer.php";

$sql = "select catid,parcat,name from treetest";
$res=dbquery($sql);
while (list($id,$parcat,$name) = dbfetch($res)) {
 $table[$parcat][$id] = $name;
}
$lst = "delete from treetest where catid=$catid or parcat=$catid";
$lst.=makebranch($catid,$table);

$res=dbquery($lst);
global $HTTP_REFERER;
header("Location: $HTTP_REFERER");


function makebranch ($parcat, $table){
 $result='';
 if (isset($table[$parcat])) {
  $list=$table[$parcat];
  while (list($key,$val)=each($list)) {
   $result.= " or catid=$key";
   if (isset($table[$key])) {
    $result.= makebranch($key,$table);
   };
  };
 }
 RETURN $result;
}


?>