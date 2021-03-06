<?php include'header.php'; ?>
<!-- Main -->
        <header class="major">
            <h2>Ciphers & Algorithms</h2>
            <p><?php echo $_POST["cipherName"] ?></p>
        </header>
        <div class="container">
            <div class="row">
                <div class="4u">
                    <section>
                        <h3>Ciphers</h3>
                        <ul class="alt">
                            <?php echo getCipherList(); ?>
                        </ul>
                    </section>
                </div>
                <div class="8u skel-cell-important">
                    <section>
                        <?php 
							date_default_timezone_set("Asia/Kolkata");
							if($_POST["cipherName"]=='CAESAR CIPHER'){
								if($_POST["caesarKey"])
								{
									if($_FILES["CipherFile"]["name"])
									{
										if(isset($_SESSION['userEmail'])){
											$uemail=$_SESSION['userEmail'];
											$target_dir = "CipherPlainUploads/";
											$time = date("Y-m-d-His");
											$target_file = $target_dir . "$uemail-".$time."-". basename($_FILES["CipherFile"]["name"]);
											if(move_uploaded_file($_FILES["CipherFile"]["tmp_name"],$target_file))
											{
												$readHandle = fopen($target_file,"r");
												$string= fgets($readHandle);
												fclose($readHandle);
												echo "<h3>Encrypted Text : &nbsp</h3>";
												echo "<blockquote><b>".caesar($string,$_POST["caesarKey"])."</b></blockquote>";
												$wtarget_dir = "CipherEncryptedUploads/";
												$wtarget_file = $wtarget_dir . "$uemail-".$time."-". basename($_FILES["CipherFile"]["name"]);
												$writeHandle = fopen($wtarget_file,"w");
												fwrite($writeHandle,caesar($string,$_POST["caesarKey"]));
												echo "<a href=$wtarget_file class=\"button special\" target=\"_blank\">Download File</a>";
											}
											else
												echo "File Not Uploaded, May be invalid File Type! Please Try Again!";
										}
									}
									else
									{
										echo "<h3>Encrypted Text : &nbsp</h3>";
										echo "<blockquote><b>".caesar($_POST["caesarPlaintext"],$_POST["caesarKey"])."</b></blockquote>";
									}
								}
								else
									echo "Please Enter Key for Caesar Cipher";
							}
							else if ($_POST["cipherName"]=='VIGENERE CIPHER') {
								if($_POST["VigenereKey"])
								{
									if($_FILES["vCipherFile"]["name"])
									{
										if(isset($_SESSION['userEmail'])){
											$uemail=$_SESSION['userEmail'];
											$target_dir = "CipherPlainUploads/";
											$time = date("Y-m-d-His");
											$target_file = $target_dir . "$uemail-".$time."-". basename($_FILES["vCipherFile"]["name"]);
											if(move_uploaded_file($_FILES["vCipherFile"]["tmp_name"],$target_file))
											{
												$readHandle = fopen($target_file,"r");
												$string= fgets($readHandle);
												fclose($readHandle);
												echo "<h3>Encrypted Text : &nbsp</h3>";
												echo "<blockquote><b>".VigenereCipher($string,$_POST["VigenereKey"])."</b></blockquote>";
												$wtarget_dir = "CipherEncryptedUploads/";
												$wtarget_file = $wtarget_dir . "$uemail-".$time."-". basename($_FILES["vCipherFile"]["name"]);
												$writeHandle = fopen($wtarget_file,"w");
												fwrite($writeHandle,VigenereCipher($string,$_POST["VigenereKey"]));
												echo "<a href=$wtarget_file class=\"button special\" target=\"_blank\">Download File</a>";
											}
											else
												echo "File Not Uploaded, May be invalid File Type! Please Try Again!";
										}
									}
									else
									{
										echo "<h3>Encrypted Text : &nbsp</h3>";
										echo "<blockquote><b>".VigenereCipher($_POST["VigenerePlaintext"],$_POST["VigenereKey"])."</b></blockquote>";
									}
								}		
								else
									echo "Please Enter Key for Caesar Cipher";								
							}
						?>
                    </section>
                </div>
            </div>
        </div>      
<?php include'footer.php'; ?>