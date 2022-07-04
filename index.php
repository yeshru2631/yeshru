<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
  <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
</head>

<body>
  <div id="addOns">
    <!--song details-->
    <button class="open-button" onclick="addsong()">Add Song</button>
    <div class="form-popup" id="myForm">
      <form action="redirect.php" class="form-container">
        <h1>Add Song Here!</h1>
        <label for="text"><b>Song Name</b></label>
        <input type="text" placeholder="Enter songs" name="song" required>
        <label for="text"><b>Date Released</b></label>
        <input type="date" id="date" name="date">
        <input type="submit"><br><br>
        <label for="text"><b>ArtWork</b></label>
        <input type="file" id="myFile" name="filename">
        <input type="submit"> <br> <br>
        <label for="text"><b>Artist Name</b></label>
        <input type="text" placeholder="Enter name of the Artist" name="artist" required>
        <input type="hidden" name="save_song" value="1">
        <button type="save_song" class="btn">Save</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
    <!--artist details-->
    <button class="open-button1" onclick="addartist()">Add Artist</button>
    <div class="form-popup1" id="myForm1">
      <form action="redirect.php" class="form-container">
        <h1>Add Artist Details</h1>
        <label for="text"><b>Artist Name</b></label>
        <input type="text" placeholder="Enter name of the Artist" name="artist" required>
        <label for="text"><b>Songs</b></label>
        <input type="text" placeholder="Enter songs" name="songs" required>
       
        <label for="date"><b>Date Of Birth: </b></label>
        <input type="date" id="date" name="dob"><br><br>
        <label for="Bio"><b>Bio </b></label><br><br>
        <textarea name="bio" id="Bio" cols="40" rows="10"></textarea>
         <input type="hidden" name="save_artist" value="1">
       
        <button type="save_artist" class="btn">Save</button>
        <button type="button" class="btn cancel" onclick="closeForm()">Close</button>
      </form>
    </div>
<!--tables-->
<!-- PHP code to establish connection with the localserver -->
<?php

// Username is spotify
$db_host="localhost";
$db_user="u488983909_bhasker";
$db_pass="Bb@8297822101";
$db_name="u488983909_IOT";
$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
// Checking for connections
if (!$conn) {
  echo "DB Not Connected";
}

// SQL query to select data from database
$sql = " SELECT * FROM artists";
$result = $conn->query($sql);

?>
<!-- HTML code to display data in tabular format -->
  <section>
    <h1>Top Artists</h1>
    <!-- TABLE CONSTRUCTION -->
    <table>
      <tr>
        <th>Artists</th>
        <th>Date of Birth</th>
        <th>Bio</th>
        <th>Songs</th>
      </tr>
      <!-- PHP CODE TO FETCH DATA FROM ROWS -->
      <?php
        // LOOP TILL END OF DATA
        while($rows=$result->fetch_assoc())
        {
      ?>
      <tr>
        <!-- FETCHING DATA FROM EACH
          ROW OF EVERY COLUMN -->
        <td><?php echo $rows['name'];?></td>
        <td><?php echo $rows['dob'];?></td>
        <td><?php echo $rows['bio'];?></td>
        <td><?php echo $rows['songs'];?></td>
      </tr>
      <?php
        }
      ?>
    </table>
  </section>
</body>

</html>


    <script>
      function addsong() {
        document.getElementById("myForm").style.display = "block";
      }

      function closeForm() {
        document.getElementById("myForm").style.display = "none";
      }
      function addartist() {
        document.getElementById("myForm1").style.display = "block";
      }
      function closeForm() {
        document.getElementById("myForm1").style.display = "none";
      }
    </script>

  </div>
  <div></div>
  <div></div>
</body>

</html>