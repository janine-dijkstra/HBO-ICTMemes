
<?php
    /*
        [DESCRIPTION]
        This file does (something).

        [INFO]
        Author:     Stef
        Date:       11-10-2019
    */

    // Check if the user is allowed on the admin page
    if (!$Loggedin) {
      //Er is niemand ingelogd!
      require ("notallowed.php");
      exit;
    }
    // Then check if the user is allowed
    if (!$LoggedinUserrole == 'admin' OR !$LoggedinUserrole == 'uber-admin' OR $LoggedinUserrole == "user") {
      //Er is geen admin ingelogd, maar een user
      require ("notallowed.php");
      exit;
    }
?>

<h1 class="page-header">
            School admins
            <p class="lead">(<a href="http://www.bootply.com/128936">with off-canvas sidebar</a>)</p>
          </h1>

          <div class="row placeholders">
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <!-- <img src="#" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">  THIS IS SO YOU CAN IMPORT AN IMAGE -->
              <h4>Aantal scholen</h4>
              <span class="text-muted">
				  <?php 
					$query = "select count(schoolnaam) from school";
					$result = $dbConnection->query($query);
					$whatevz = mysqli_fetch_assoc($result);
					echo $whatevz['count(schoolnaam)'];
				  ?>
				  </span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <!-- <img src="#" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">  THIS IS SO YOU CAN IMPORT AN IMAGE -->
              <h4>Aantal admins</h4>
              <span class="text-muted">
			      <?php 
					$query = "select count(username) from user where userrole in ('admin', 'uber-admin');";
					$result = $dbConnection->query($query);
					$whatevz = mysqli_fetch_assoc($result);
					echo $whatevz['count(username)'];
				  ?>
			  </span>
            </div>
            <!--<div class="col-xs-6 col-sm-3 placeholder text-center">
              <!-- <img src="#" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">  THIS IS SO YOU CAN IMPORT AN IMAGE -->
              <!--<h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>
            <div class="col-xs-6 col-sm-3 placeholder text-center">
              <!-- <img src="#" class="center-block img-responsive img-circle" alt="Generic placeholder thumbnail">  THIS IS SO YOU CAN IMPORT AN IMAGE -->
              <!--<h4>Label</h4>
              <span class="text-muted">Something else</span>
            </div>-->
          </div>
          
          <hr>

          <h2 class="sub-header">Here's a table</h2>
          <div class="table-responsive">
            <table class="table table-striped">
                  <?php
				  $query = "select schoolnaam from school order by 1";
				  $result = $dbConnection->query($query);
				  while ($record = mysqli_fetch_assoc($result))
				  {
					echo "<tr><th>".$record['schoolnaam']."</th>";
					$sql = "select * from user where userrole in ('admin', 'uber-admin') and schoolnaam in ('".$record['schoolnaam']."');";
					$dinges = $dbConnection->query($sql);
					while ($dinkus = mysqli_fetch_assoc($dinges))
					{
						//echo "<td>".$dinkus['user-ID']."</td>
						echo "<td>".$dinkus['username']."</td>";
						//<td>".$dinkus['userrole']."</td>";
					}
					echo "</tr>";
				  }
                  ?>
            </table>
          </div>

          
      </div><!--/row-->
	</div>
</div><!--/.container-->

<!-- This file is going to be required on a page. No need to put ending or starting html tags! -->