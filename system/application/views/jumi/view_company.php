<?php

defined('_JEXEC') OR defined('_VALID_MOS') OR die( "Direct Access Is Not Allowed" );



$user =& JFactory::getUser();

$formusername = $user->username;

$formuserid = $user->id;

$formgid = $user ->gid;



$db	= & JFactory::getDBO();
$acl =& JFactory::getACL();
$sitegroupid=$user->gid;

$group = strtolower( $acl->get_group_name( $sitegroupid, 'ARO' ) );


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
				}


}





?>

<div style="width:100%;  float:left;">

<?php 

if($active == 1)
	{
				echo "<h2>$company_name";
				
				
				if ($sitegroupid=="25")
						{
						?>
						 - <a href="add-company.html?companyid=<?php echo $companyid; ?>" >Edit</a>
						<?php
						}
				
				echo "</h2>Website:<a href='http://$company_web'>$company_web</a><br/>$description<br/>";
	
	}
if($active == 0)
	{
		 header( 'Location: http://www.laworld.com/list-companies.html' ) ;
	}


 ?>

</div>

<br/>

