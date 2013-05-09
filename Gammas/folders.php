<?php

// Create folder
if (isset($_POST['createFolderSubmit']))
{
	    $addFolders = "INSERT INTO folders (name, owner)
		VALUES ('".$_POST['foldername']."', '".$_SESSION['sess_user']."')";
		$result2 = mysql_query($addFolders);
		$folderid = mysql_insert_id();

		$addMemberFolders = "INSERT INTO foldersMembers (idFolders, idMembers)
		VALUES (".$folderid.", ".$idMembers.")" ;
		$result3 = mysql_query($addMemberFolders);		
}

 
print_r($_SESSION . '<br>');
print_r($_POST);

// Share with a member
if (isset($_POST['memberShare']))
{
	$hiddenFolderid = $_POST['hiddenFolderid'];
	$idMember = $POST['enterMemberShare'];
	
	print '<script type="text/javascript">'; 
	print 'alert(" '.$hiddenFolderid.$idMember.' ")'; 
	print '</script>';
	
	$kollaID = "SELECT id FROM members WHERE email = '".$_SESSION['idMember']."'";
	$result2 = mysql_query($kollaID);
	$row = mysql_fetch_array($result2);
	$idMember = $row['id']; 
	
	$addMemberFolders = "INSERT INTO foldersMembers (idFolders, idMembers)
	VALUES (".$hiddenFolderid.", ".$idMember.")" ;
	$result3 = mysql_query($addMemberFolders);
}



/*if($_SESSION['newMemberShare'] = 1)
{
	$addMemberFolders = "INSERT INTO foldersMembers (idFolders, idMembers)
	VALUES (".$_POST['hiddenFolderid'].", ".$idMembers.")" ;
	$result3 = mysql_query($addMemberFolders);
}*/
?>
 
 
 
 <div class="modal hide fade" id="shareWithMembers" tabindex="-1" role="dialog" aria-labelledby="shareWithMembersLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Create a new folder.</h3>
  </div>
  
  <!-- Här ska ladda upp grejjerna vara!!!!! -->
  <div class="modal-body" align="center">

<form method="POST" action="" name="createFolder">
<input type="text" placeholder="Enter a foldername: " name="foldername">
<br />
<input type="submit" name="createFolderSubmit" class="btn btn-success" style="width:200px;" value="Create" id="submit" />
</form>
   
 </div>
</div>

 
 
 
 <div class="modal hide fade" id="createFolderModal" tabindex="-1" role="dialog" aria-labelledby="createFolderModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal">x</button>
    <h3>Create a new folder.</h3>
  </div>
  
  <!-- Här ska ladda upp grejjerna vara!!!!! -->
  <div class="modal-body" align="center">

<form method="POST" action="" name="createFolder">
<input type="text" placeholder="Enter a foldername: " name="foldername">
<br />
<input type="submit" name="createFolderSubmit" class="btn btn-success" style="width:200px;" value="Create" id="submit" />
</form>
   
 </div>
</div>

   
   
   <table class="table table-striped" id="folderOverview">
          <thead>
            <tr>
              <th>Folder</th>
              <th>Action</th>

            </tr>
          </thead>
          <tbody>

            <?php 

       // Kollar vilka folders den har rättighet till.
            $kollaFolder = "SELECT idFolders FROM foldersMembers WHERE idMembers = '".$idMembers."'";
            $result3 = mysql_query($kollaFolder);

     // För alla folders som finns till en användare.
            while($row2 = mysql_fetch_array($result3))
            {
             $idFolders1 = $row2['idFolders']; 
			 
     // Hämtar allt från folders (foldernamnet).
             $getFolderNames = "SELECT * FROM folders WHERE id =" .$idFolders1;
             $result8 = mysql_query($getFolderNames);

             while ($folderNameArray = mysql_fetch_array($result8))
             {
              echo "<tr>";
              echo "<td>";
              echo '<i class="icon-folder-open"></i> <a href="?folder='.$folderNameArray['id'].'"> ' . $folderNameArray['name'].'</a>'; 
              echo "</td>";
			  
			  echo "<td>";
			  echo '			   
			   
			   <form action="" name="optionsform" method="post">
			   <input type="hidden" value="'.$folderNameArray['id'].'" name="hiddenFolderid"/>
			   
			   Member name:<input type="text" name="enterMemberShare" style="width:150px;"></input>
			   
			   <input type="submit" class="btn btn-mini" name="memberShare" value="Share" 	  style="width:50px;" style="height:20px"></input><br />
			   
			   <input type="submit" class="btn btn-mini" name="rename" value="Rename" style="width:50px;"></input><br />
			   <input type="submit" class="btn btn-mini" name="delete" value="Delete" style="width:50px;"></input>
			   
			   </form> ';
			   
			  echo "</td>";  
              echo "</tr>";
			  //<a href="#shareWithMembers" data-toggle="modal">Sharea </a>
			  //<a class="btn btn-info" data-toggle="modal" href="#shareWithMembers" style="width: 50px;">Sha</a>

            }
          }

          ?>
          <tr>
            <td> 
              <form method="post">
                <i class="icon-trash"></i><button type="submit" name="trash" class="btn btn-link">Trashcan</button>
              </form>

            </td>        
          </tr>

        </tbody>
      </table>



<center>
<a class="btn btn-info" data-toggle="modal" href="#createFolderModal" style="width: 150px;">Create folder</a>
 </center>




<?php

if (isset($_GET['folder']))
{
	$hide=0;

// visar alla filer som är i trashen på en specifik mapp.
  if (isset($_POST['trash']))
  {
    $hide = 1;
  }


  $kollOk = 0;
  $KollOmManFarSe = "SELECT * FROM foldersMembers WHERE idFolders =".$_GET['folder'];
  $resultKoll = mysql_query($KollOmManFarSe);


while ($restest = mysql_fetch_array($resultKoll))
  {
  
  $idMembersKoll = $restest['idMembers']; 

  if ($idMembers == $idMembersKoll)
  {
   $idFolders = $_GET['folder'];
  
  $checkFolderOwner = "SELECT owner FROM folders WHERE id =".$_GET['folder'];
  $resultcheckOwner = mysql_query($checkFolderOwner);
  $rescheckOwner = mysql_fetch_array($resultcheckOwner);
  $folderOwner = $rescheckOwner['owner']; 
  
  $kollOk = 1;
  
   
  }
  
  }
 
 
 if ($kollOk = 0){
  		 echo '<script>
   		alert("You do not have permission to this shit!!");
   		</script>';
 }
}

?>