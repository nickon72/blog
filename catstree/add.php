<?

global $HTTP_GET_VARS;
$catid='';
if (isset($HTTP_GET_VARS['catid'])) $catid = trim($HTTP_GET_VARS['catid']);

include "dblayer.php";

$id = dbfetch(dbquery("select max(catid) from treetest"));
$myid = $id[0]+1;

$sql="INSERT INTO treetest (catid,parcat,name) VALUES ('$myid','$catid','CATEG $myid-$catid')";
$res=dbquery($sql);

global $HTTP_REFERER;
header("Location: $HTTP_REFERER");


?>