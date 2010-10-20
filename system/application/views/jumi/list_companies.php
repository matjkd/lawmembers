<?php

defined('_JEXEC') OR defined('_VALID_MOS') OR die( "Direct Access Is Not Allowed" );



$user =& JFactory::getUser();

$db	= & JFactory::getDBO();
$acl =& JFactory::getACL();
$sitegroupid=$user->gid;

$group = strtolower( $acl->get_group_name( $sitegroupid, 'ARO' ) );


$formusername = $user->username;
$formuserid = $user->id;
$formgid = $user ->gid;
$formusername = str_replace(" ", '', $formusername); 
$formusername = str_replace("\n", '', $formusername); 
$formusername = str_replace("\r", '', $formusername); 



$select_name = mysql_real_escape_string($_POST["select_name"]);
$select_city = mysql_real_escape_string($_POST["select_city"]);
$select_country = mysql_real_escape_string($_POST["select_country"]);
$select_practice = mysql_real_escape_string($_POST["select_practice"]);
$select_region = mysql_real_escape_string($_POST["select_region"]);
?>

<?php

include 'editor.inc';
?>

<div id="accordion" style="width:650px;">
<h3 class="toggler atStart" ><table><tr>
  <td width="150" style="color:#000000; font-weight:bolder;">Company name</td>
  <td width="100">&nbsp;</td>
  <td style="color:#000000;">&nbsp;</td>
	  </tr></table></h3>
<div class="element atStart">
</div>
</div>


<?php

if ($_POST==NULL)
{
// echo "post is null";
}
else
{
$select_practice = str_replace(" ", '&nbsp;', $select_practice); 
$select_country = str_replace(" ", '&nbsp;', $select_country); 
$select_city = str_replace(" ", '&nbsp;', $select_city); 

$sqlarray = array();
if ($select_name!='NULL') {
header("Location:view-company.html?companyid=$select_name");

   $sqlarray[] = "mydb_company.idcompany = '$select_name'";
   
}

if ($select_practice!='NULL') {
   $sqlarray[] = "mydb_company.key_areas LIKE '%$select_practice%'";
}
if ($select_country!='NULL') {
   $sqlarray[] = "mydb_address.country = '$select_country'";
$searchaddress = "INNER JOIN mydb_address ON mydb_company.idcompany=mydb_address.idcompany";
}
if ($select_city!='NULL') {
   $sqlarray[] = "mydb_address.city = '$select_city'";
$searchaddress = "INNER JOIN mydb_address ON mydb_company.idcompany=mydb_address.idcompany";
}
if ($select_region!='NULL') {
   $sqlarray[] = "mydb_address.region = '$select_region'";
$searchaddress = "INNER JOIN mydb_address ON mydb_company.idcompany=mydb_address.idcompany";
}
$mysqlarray = implode($sqlarray, ' AND ');
if ($mysqlarray!=NULL)
{
$where="WHERE";

}
}
$sql="SELECT  * FROM mydb_company $searchaddress $where $mysqlarray ORDER BY company_name ASC"; 
// echo $sql;
        $result=mysql_query($sql)
	    or die (mysql_error());
		while ($row = mysql_fetch_array($result))
				{

?>
<div id="accordion" style="width:650px;" >
	<div style="float:left; width:650px;"><h3 class="toggler atStart"><?php echo $row['company_name']; ?>  - <strong><?php echo $row['city']; ?></strong>
	

	<?php 
	if ($sitegroupid=="25")
	{
	?>
	<a href="add-company.html?companyid=<?php echo $row['idcompany']; ?>" >Edit</a>
	<?php
	}
	?>
	

	




	</div></h3>
<div style="clear:both;"></div>
    
	<div class="element atStart">
	<strong><?php echo $row['country']; ?> <br/><?php echo $row['city']; ?></strong>
    <br/>
    <?php 
    $len=300;
     $txt = substr($row['description'], 0, $len);
               
                $t = split("[\n\r\t ]+", $txt);
                $t = array_slice($t, 0, -1);
                $txt = join(' ', $t);
       
                $txt .= '...';
    
    echo $txt; ?>
    <a href="view-company.html?companyid=<?php echo $row['idcompany']; ?>" >read more</a>
	
    </div>
</div>
<?php





				

}


?>
