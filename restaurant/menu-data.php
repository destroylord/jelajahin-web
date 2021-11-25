<div class="container">
					<div class="row mt-3">
						<div class="col-12">
							<div class="card">
								<div class="card-body">
                                <?php
									// Include config file
									include_once "../conection.php";

									// Attempt select query execution
									$sql = mysqli_query($link, "SELECT * FROM menu");
									while ($data = mysqli_fetch_array($sql)){
										echo "<table class='table table-hover my-0'>";
											echo "<tr>";
												echo "<td>" . $row['name'] . "</td>";
												echo "<td>" . $row['description'] . "</td>";
												echo "<td>" . $row['price'] . "</td>";
												echo "<td>";
													echo "<a href='update.menu.php? id=". $row['uuid_menu'] ."' title='Update Record' data-toggle='tooltip'><span class='align-middle' data-feather='edit-3' style='color: black;'></span></a>";
													echo "<a href='delete.menu.php? id=". $row['uuid_menu'] ."' title='Delete Record' data-toggle='tooltip'><span class='align-middle mx-3' data-feather='trash' style='color: black;'></span></a>";
												echo "</td>";
											echo "</tr>";
									}
									
										
								?>
								</div>
							</div>
						</div>
					</div>
					</div>