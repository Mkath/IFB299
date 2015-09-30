<?php
echo  '<td style="text-align: center; vertical-align: middle">';
					echo '<select name="assigned_owner">';
					
						//echo '<option value="none">Select</option>';
						try {
						//connection to the database
							$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							//Query database to populate select box
							$owners = $pdo->query("SELECT * FROM propertyowner_property WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
							foreach ($owners as $owner)
							{
								$ownerid = $owner['propertyownerid'];
								
								$ownersdetails = $pdo->query("SELECT * FROM propertyowner_details WHERE propertyownerid = $ownerid")->fetchAll(PDO::FETCH_ASSOC);
								foreach ($ownersdetails as $ownersdetail)
								{
									echo '<option value="', $property['propertyid'],'|',$ownerid, '">', $ownersdetail['propertyowner_firstname'], " ", $ownersdetail['propertyowner_lastname'], '</option>';
								}
							}
							
							echo '<option value="',$property['propertyid'],'|Vacant">unassigned</option>';
							
						}
						catch(PDOException $e)
						{
							echo $e->getMessage();
						}
				
					try {
					//connection to the database
						$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						//Query database to populate select box
						$owners = $pdo->query("SELECT * FROM propertyowner_details")->fetchAll(PDO::FETCH_ASSOC);
						
						//  loop through all the results found from the tenants table and add them to the select box
						foreach ($owners as $ownersdetail)
						{
							$ownerid = $ownersdetail['propertyownerid'];
							echo '<option value="', $property['propertyid'],'|',$ownerid, '">', $ownersdetail['propertyowner_firstname'], " ", $ownersdetail['propertyowner_lastname'], '</option>';
						}
						
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					} 
					$pdo = null;
				
					
					echo '</select>';
?>