<!DOCTYPE html>
<html>
	<head>
		<title>Web Programming Assignment</title>
		<link href="page4CSS.css" rel="stylesheet" type="text/css"/>
		<script type="text/javascript" src="javascript.js"></script>
	</head>

	<?php
		include 'pageLayout.inc';
	?>

			<div id="content">
				<p>
					<h2>Create an Account</h2>
						<form name="survey" onsubmit="return validate(survey)" action="processData.php" method="post">
							<div>
								<label for="Name">First and Last Name:</label><br>
								<input type="text" id="Name" name="Name" style="width: 500px" onkeypress="invisible('nameMissing')" value="<?php
								if(isset($_POST['Name']))
									echo htmlspecialchars($_POST['Name'])?>"/>
								<span id="nameError" class="error" style="color:red">
									<?php if (isset($errors['Name'])) echo $errors['Name'] ?>
								</span><br>
							</div>
							</br>
							<div>
								<label for="username">User name (6 char' min.):</label><br>
								<input type="text" id="username" name="username" style="width: 500px" onkeypress="invisible('usernameMissing')" value="<?php
								if(isset($_POST['username']))
									echo htmlspecialchars($_POST['username'])?>"/>
								<span id="usernameError" class="error" style="color:red">
									<?php if (isset($errors['username'])) echo $errors['username'] ?>
								</span>
							</div>
							</br><p>
							<div>
								<label for="password">Password (6 char' min.):</label><br>
								<input type="password" id="password" name="password" style="width: 500px">
								<span id="passwordError" class="error" style="color:red">
									<?php if (isset($errors['password'])) echo $errors['password'] ?>
								</span><br>
								Re-enter Password<br>
								<input type="password" name="confirmuserpw" style="width: 500px" onkeypress="invisible('differentPW')"><br>
								<span id="differentPW" style="color:red; visibility:hidden">*Password is invalid! Ensure both fields are entered and identical.</span>
							</div>
							</br>
							<div>
								<label for="email">Email Address:</label><br>
								<input type="text" id="email" name="email" style="width: 500px" onkeypress="invisible('emailMissing')" value="<?php
								if(isset($_POST['email']))
									echo htmlspecialchars($_POST['email'])?>"/>
								<span id="emailError" class="error" style="color:red">
									<?php if (isset($errors['email'])) echo $errors['email'] ?>
								</span>
							</div>
							<p>
							<div>
								<label for="country">Country/region:</label><br>
								<select name="country" style="width: 500px" onclick="invisible('countryError')">
									<option value="">Select Country</option>
									<option value="AU">Australia</option>
									<option value="AF">Afghanistan</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AG">Angola</option>
									<option value="AI">Anguilla</option>
									<option value="AG">Antigua &amp; Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AA">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AT">Austria</option>
									<option value="AZ">Azerbaijan</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BE">Belgium</option>
									<option value="BZ">Belize</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia</option>
									<option value="BL">Bonaire</option>
									<option value="BA">Bosnia &amp; Herzegovina</option>
									<option value="BW">Botswana</option>
									<option value="BR">Brazil</option>
									<option value="BC">British Indian Ocean Ter</option>
									<option value="BN">Brunei</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="IC">Canary Islands</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Islands</option>
									<option value="CF">Central African Republic</option>
									<option value="TD">Chad</option>
									<option value="CD">Channel Islands</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="CI">Christmas Island</option>
									<option value="CS">Cocos Island</option>
									<option value="CO">Colombia</option>
									<option value="CC">Comoros</option>
									<option value="CG">Congo</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="CT">Cote D'Ivoire</option>
									<option value="HR">Croatia</option>
									<option value="CU">Cuba</option>
									<option value="CB">Curacao</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="DK">Denmark</option>
									<option value="DJ">Djibouti</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="TM">East Timor</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El Salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FA">Falkland Islands</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="FS">French Southern Ter</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GB">Great Britain</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GN">Guinea</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HW">Hawaii</option>
									<option value="HN">Honduras</option>
									<option value="HK">Hong Kong</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IA">Iran</option>
									<option value="IQ">Iraq</option>
									<option value="IR">Ireland</option>
									<option value="IM">Isle of Man</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kazakhstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="NK">Korea North</option>
									<option value="KS">Korea South</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgyzstan</option>
									<option value="LA">Laos</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libya</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MO">Macau</option>
									<option value="MK">Macedonia</option>
									<option value="MG">Madagascar</option>
									<option value="MY">Malaysia</option>
									<option value="MW">Malawi</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Islands</option>
									<option value="MQ">Martinique</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="ME">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="MI">Midway Islands</option>
									<option value="MD">Moldova</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Nambia</option>
									<option value="NU">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="AN">Netherland Antilles</option>
									<option value="NL">Netherlands (Holland, Europe)</option>
									<option value="NV">Nevis</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NW">Niue</option>
									<option value="NF">Norfolk Island</option>
									<option value="NO">Norway</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau Island</option>
									<option value="PS">Palestine</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua New Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PO">Pitcairn Island</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="ME">Republic of Montenegro</option>
									<option value="RS">Republic of Serbia</option>
									<option value="RE">Reunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russia</option>
									<option value="RW">Rwanda</option>
									<option value="NT">St Barthelemy</option>
									<option value="EU">St Eustatius</option>
									<option value="HE">St Helena</option>
									<option value="KN">St Kitts-Nevis</option>
									<option value="LC">St Lucia</option>
									<option value="MB">St Maarten</option>
									<option value="PM">St Pierre &amp; Miquelon</option>
									<option value="VC">St Vincent &amp; Grenadines</option>
									<option value="SP">Saipan</option>
									<option value="SO">Samoa</option>
									<option value="AS">Samoa American</option>
									<option value="SM">San Marino</option>
									<option value="ST">Sao Tome &amp; Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="RS">Serbia</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="OI">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SD">Sudan</option>
									<option value="SR">Suriname</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syria</option>
									<option value="TA">Tahiti</option>
									<option value="TW">Taiwan</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania</option>
									<option value="TH">Thailand</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad &amp; Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TU">Turkmenistan</option>
									<option value="TC">Turks &amp; Caicos Is</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB">United Kingdom</option>
									<option value="US">United States of America</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VS">Vatican City State</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Vietnam</option>
									<option value="VB">Virgin Islands (Brit)</option>
									<option value="VA">Virgin Islands (USA)</option>
									<option value="WK">Wake Island</option>
									<option value="WF">Wallis &amp; Futana Is</option>
									<option value="YE">Yemen</option>
									<option value="ZR">Zaire</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>
								<span id="countryError" class="error" style="color:red">
									<?php if (isset($errors['country']))
										echo $errors['country'] ?>
								</span>
								<span id="countryError" style="color:red; visibility:hidden">*Country is a required field</span>
							</div>
							<p>
							</br>
							Birthdate<br>
							<div id="birthdatecontainer">
								<select name="BirthDay" style="width: 166px" onclick="invisible('birthError')">
									<option value="">Day</option><option value="1">1</option><option value="2">2</option>
									<option value="3">3</option><option value="4">4</option><option value="5">5</option><option value="6">6</option>
									<option value="7">7</option><option value="8">8</option><option value="9">9</option><option value="10">10</option>
									<option value="11">11</option><option value="12">12</option><option value="13">13</option><option value="14">14</option>
									<option value="15">15</option><option value="16">16</option><option value="17">17</option><option value="18">18</option>
									<option value="19">19</option><option value="20">20</option><option value="21">21</option><option value="22">22</option>
									<option value="23">23</option><option value="24">24</option><option value="25">25</option><option value="26">26</option>
									<option value="27">27</option><option value="28">28</option><option value="29">29</option><option value="30">30</option><option value="31">31</option>
								</select>

								<select name="BirthMonth" style="width: 166px" onclick="invisible('birthError')">
									<option value="">Month</option><option value="jan">January</option><option value="feb">February</option><option value="mar">March</option><option value="apr">April</option><option value="may">May</option>
									<option value="jun">June</option><option value="jul">July</option><option value="aug">August</option><option value="sep">September</option><option value="oct">October</option>
									<option value="nov">November</option><option value="dec">December</option>
								</select>
								<select name="BirthYear" style="width: 166px" onclick="invisible('birthError')">
									<option value="">Year</option><option value="2015">2015</option><option value="2014">2014</option><option value="2013">2013</option><option value="2012">2012</option><option value="2011">2011</option><option value="2010">2010</option><option value="2009">2009</option><option value="2008">2008</option><option value="2007">2007</option><option value="2006">2006</option>
									<option value="2005">2005</option><option value="2004">2004</option><option value="2003">2003</option><option value="2002">2002</option><option value="2001">2001</option><option value="2000">2000</option><option value="1999">1999</option><option value="1998">1998</option><option value="1997">1997</option><option value="1996">1996</option>
									<option value="1995">1995</option><option value="1994">1994</option><option value="1993">1993</option><option value="1992">1992</option><option value="1991">1991</option><option value="1990">1990</option><option value="1989">1989</option><option value="1988">1988</option><option value="1987">1987</option><option value="1986">1986</option>
									<option value="1985">1985</option><option value="1984">1984</option><option value="1983">1983</option><option value="1982">1982</option><option value="1981">1981</option><option value="1980">1980</option><option value="1979">1979</option><option value="1978">1978</option><option value="1977">1977</option><option value="1976">1976</option>
									<option value="1975">1975</option><option value="1974">1974</option><option value="1973">1973</option><option value="1972">1972</option><option value="1971">1971</option><option value="1970">1970</option><option value="1969">1969</option><option value="1968">1968</option><option value="1967">1967</option><option value="1966">1966</option>
									<option value="1965">1965</option><option value="1964">1964</option><option value="1963">1963</option><option value="1962">1962</option><option value="1961">1961</option><option value="1960">1960</option><option value="1959">1959</option><option value="1958">1958</option><option value="1957">1957</option><option value="1956">1956</option>
									<option value="1955">1955</option><option value="1954">1954</option><option value="1953">1953</option><option value="1952">1952</option><option value="1951">1951</option><option value="1950">1950</option><option value="1949">1949</option><option value="1948">1948</option><option value="1947">1947</option><option value="1946">1946</option>
									<option value="1945">1945</option><option value="1944">1944</option><option value="1943">1943</option><option value="1942">1942</option><option value="1941">1941</option><option value="1940">1940</option><option value="1939">1939</option><option value="1938">1938</option><option value="1937">1937</option><option value="1936">1936</option>
									<option value="1935">1935</option><option value="1934">1934</option><option value="1933">1933</option><option value="1932">1932</option><option value="1931">1931</option><option value="1930">1930</option><option value="1929">1929</option><option value="1928">1928</option><option value="1927">1927</option><option value="1926">1926</option>
									<option value="1925">1925</option><option value="1924">1924</option><option value="1923">1923</option><option value="1922">1922</option><option value="1921">1921</option><option value="1920">1920</option><option value="1919">1919</option><option value="1918">1918</option><option value="1917">1917</option><option value="1916">1916</option>
									<option value="1915">1915</option><option value="1914">1914</option><option value="1913">1913</option><option value="1912">1912</option><option value="1911">1911</option><option value="1910">1910</option><option value="1909">1909</option><option value="1908">1908</option><option value="1907">1907</option><option value="1906">1906</option>
									<option value="1905">1905</option>
								</select>
								<span id="birthError" class="error" style="color:red">
									<?php if (isset($errors['birthError']))
										echo $errors['birthError'] ?>
								</span>
								<span id="birthError" style="color:red; visibility:hidden">*Birthdate is invalid</span>
							</div></br>
							Gender<br>
							<input type="radio" id="gender" name="gender" value="male" onclick="invisible('genderError')"> <font size="2">Male</font>
							<input type="radio" id="gender" name="gender" value="female" onclick="invisible('genderError')"> <font size="2">Female</font>
							<span id="genderError" class="error" style="color:red">
								<?php if (isset($errors['gender']))
									echo $errors['gender'] ?>
							</span>
							<span id="genderError" style="color:red; visibility:hidden">*Gender is a required field</span>
							</br><p>
							<div>
								<label for="address">Address:</label><br>
								<textarea rows="3" cols="30" id="address" name="address" style="width: 500px" onkeypress = "invisible('addressError')" value="<?php
								if(isset($_POST['address']))
									echo htmlspecialchars($_POST['address'])?>"></textarea>
								<span id="addressError" class="error" style="color:red">
									<?php if (isset($errors['address'])) echo $errors['address'] ?>
								</span><br>
							</div>
							<span id="addressError" style="color:red; visibility:hidden">*Address is a required field</span>
							</br>
							<br>
							<input type="submit" value="Create Account" style="width: 500px">
							</br>
						</form>
					</p>
			</div>

			<div id="footer">
				Francis O'loghlin: (Student ID)<br>
				Sean Little: n9106201
			</div>
		</div>
	</body>
</html>