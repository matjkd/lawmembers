<?php
defined('_JEXEC') OR defined('_VALID_MOS') OR die( "Direct Access Is Not Allowed" );
$user =& JFactory::getUser();
$formusername = $user->username;
$formuserid = $user->id;
$formgid = $user ->gid;

$submit = mysql_real_escape_string($_POST["submit"]);
$companyid = mysql_real_escape_string($_GET["companyid"]);

if (isset($companyid))
{
$sql="SELECT * FROM mydb_company WHERE idcompany='$companyid'";
        $result=mysql_query($sql)
        or die (mysql_error());
			while ($row = mysql_fetch_array($result))

				{

				extract($row);
$key_areas = explode(",","$key_areas");
				}

}

if ($company_image==NULL) { $company_image="noimage.jpg"; }

?>
<div style="width:980px; height:279px; background-image:url('images/firmheader.jpg')">
<div style="width:279px; height:259px; float:left; padding:20px 0 0 20px; ">
<img src="images/stories/companies/<?php echo $company_image;?>"  width="239" height="239" style="border:1px white solid;" /></div>
<div style="width:675px; height:259px; float:right; padding:20px 0 0 0; color:#ffffff;">

<?php

$sql="SELECT * FROM mydb_address WHERE idcompany='$idcompany' LIMIT 1";



        $result=mysql_query($sql)



        or die (mysql_error());



			while ($row = mysql_fetch_array($result))



				{



				extract($row);
                
echo "<span id=\"h10\">$country</span><br/>";



				}

$sql="SELECT * FROM mydb_address WHERE idcompany='$idcompany'";



        $result=mysql_query($sql)



        or die (mysql_error());



			while ($row = mysql_fetch_array($result))



				{



				extract($row);
                
echo "<span id=\"h11\">$city </span><br/> ";



				}

?>

<div id="headerfoot">

</div>
</div>
</div>