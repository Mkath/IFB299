<?php
echo  '<td style="text-align: center; vertical-align: middle">';
					echo '<select name="assigned_values">';
					
					if ($assigned_properties != "assigned")
					{
						echo '<option value="none">Select</option>';
					}
					else
					{
						//echo '<option value="none">Select</option>';
						try {
						//connection to the database
							$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							
							//Query database to populate select box
							$tenants = $pdo->query("SELECT * FROM tenant_details WHERE propertyid = $propertyid")->fetchAll(PDO::FETCH_ASSOC);
							foreach ($tenants as $tenant)
							{
								echo '<option value="', $property['propertyid'],'|', $tenant['tenantid'], '">', $tenant['tenant_username']," | ", $tenant['tenant_firstname'], " ", $tenant['tenant_lastname'], '</option>';
							}
							
							echo '<option value="',$property['propertyid'],'|Vacant">Vacant</option>';
							
						}
						catch(PDOException $e)
						{
							echo $e->getMessage();
						}
					}
					try {
					//connection to the database
						$pdo = new PDO("mysql:host=$dbhost;dbname=$dbname",$dbuser,$dbpass);
						$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						//Query database to populate select box
						$tenants2 = $pdo->query("SELECT * FROM tenant_details WHERE propertyid IS NULL ORDER BY tenant_firstname")->fetchAll(PDO::FETCH_ASSOC);
											//  loop through all the results found from the tenants table and add them to the select box
						foreach ($tenants2 as $tenant)
						{
							
							echo '<option value="', $property['propertyid'],'|', $tenant['tenantid'], '">', $tenant['tenant_username']," | ", $tenant['tenant_firstname'], " ", $tenant['tenant_lastname'], '</option>';
						}
						
					}
					catch(PDOException $e)
					{
						echo $e->getMessage();
					}
					$pdo = null;
				
					
					echo '</select>';
?>