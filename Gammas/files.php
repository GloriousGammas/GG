<?php
      
// Gömma en fil om man trycker på krysset jämte filen.
if (isset($_GET['deleteid']))
{
	$hide = "UPDATE files SET hide = 1 WHERE id = " . $_GET['deleteid'];
	$resultUpdate = mysql_query($hide);
}
?>

      <table class="table table-hover sortable" id="overview">
        <thead>
          <tr>
            <th>Filename</th>
            <th>Modifed</th>
            <th>Size</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>



          <?php
	  
// Hämtar allt (alla filer) som tillhör en specifik folder.   
$getFileIDs = "SELECT * FROM foldersFiles WHERE idFolders = '".$idFolders."'";
$result5 = mysql_query($getFileIDs);

// För varje fil som tillhör en användare:
while($idFilesArray = mysql_fetch_array($result5))
{

// Hämtar filiinfo.
$getFileInfo = "SELECT * FROM files WHERE id = '".$idFilesArray['idFiles']."' AND hide =".$hide;
$result6 = mysql_query($getFileInfo);

    // Skriver ut alla filer:
           while($FileInfoArray = mysql_fetch_array($result6))
           {
             echo "<tr>";
             echo "<td>";

             echo "<b>" . $FileInfoArray['name'] . "</b>";
             echo "</td>";

             echo "<td>";
             echo  $FileInfoArray['date'];
             echo "</td>";

             echo "<td>";
             echo round(($FileInfoArray['size'] / 1024),2) . " <b>KB</b>";
             echo "</td>";


             echo "<td>";
             echo '<div class="btn-group">';
			 
			 // Knapp för att hämta fil.
             echo '<a class="btn" href="';
             echo "http://gg.dlucodesign.se/upload/".$folderOwner."/" .$FileInfoArray['name'];

			// Knapp för att "gömma" en fil.
             echo '"><i class="icon-download-alt"></i></a>
             <a class="btn" href="?deleteid='.$FileInfoArray['id'] . '"><i class="icon-remove"></i></a>
             </div>
             </td>
             </tr>';

           }
         }


         ?> 
       </tbody>
     </table>