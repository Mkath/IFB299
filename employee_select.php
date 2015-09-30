<?php
echo  '<td style="text-align: center; vertical-align: middle">';
					echo '<select name="assigned_employee">';
					
						try {
						//connection to the database
							$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							//Query database to populate select box
							$owners = $pdo->query("SELECT * FROM employee_property WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
							foreach ($owners as $owner)
							{
								$employeeid = $owner['employeeid'];
								
								$ownersdetails = $pdo->query("SELECT * FROM employee_details WHERE employeeid = $employeeid")->fetchAll(PDO::FETCH_ASSOC);
								foreach ($ownersdetails as $ownersdetail)
								{
									echo '<option value="', $property['propertyid'],'|',$employeeid, '">', $ownersdetail['employee_firstname'], " ", $ownersdetail['employee_lastname'], '</option>';
								}
							}
							
							echo '<option value="',$property['propertyid'],'|Vacant">Unassigned</option>';
							
						}
						catch(PDOException $e)
						{
							echo $e->getMessage();
						}
					//}
					try {
					//connection to the database
						$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						//Query database to populate select box
						$owners = $pdo->query("SELECT * FROM employee_details")->fetchAll(PDO::FETCH_ASSOC);
						
						//  loop through all the results found from the tenants table and add them to the select box
						foreach ($owners as $ownersdetail)
						{
							$ownerid = $ownersdetail['employeeid'];
							echo '<option value="', $property['propertyid'],'|',$ownerid, '">', $ownersdetail['employee_firstname'], " ", $ownersdetail['employee_lastname'], '</option>';
						}
						
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					} 
					$pdo = null;
				
					
					echo '</select>';
?>