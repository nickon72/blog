<?
// ������� � �� catstree ������� treetest � ������: 
// catid mediumint(5) NOT NULL auto_increment (id ���������)
// parcat mediumint(5) NOT NULL (id �������� ��� ���)
// name varchar(50) NOT NULL (�������� ���������)
// � ��������� �� 500 �������� ��������� ������

include "dblayer.php";
include "header.php";

$num=50;

$sql="CREATE TABLE treetest (   catid mediumint(5) NOT NULL auto_increment, parcat mediumint(5) NOT NULL,   name varchar(50) NOT NULL,   UNIQUE catid (catid))";
dbquery($sql);

srand((double)microtime()*1000000);

print "<a href=index.php>���������</a><br>";

dbquery("delete from treetest where catid>0");

for ($i=1;$i<=$num;$i++) {
 if ($i>$num/5) {
  $parcat=rand(1,$num);
 }
 else { $parcat=0; }
 $sql="INSERT INTO treetest (catid,parcat,name) VALUES ('$i','$parcat','CATEG $i-$parcat')";
 dbquery($sql);
 print "$i - $parcat<br>";
};
?>
