<?php


$ip="192.168.1";
$db_host="localhost";
$db_user="u488983909_bhasker";
$db_pass="Bb@8297822101";
$db_name="u488983909_IOT";
$conn=mysqli_connect($db_host,$db_user,$db_pass,$db_name);
if (!$conn) {
  echo "DB Not Connected";
}
if (isset($_REQUEST['save_song'])) {
    $song=$_REQUEST['song'];
  $dob=$_REQUEST['dob'];
  $artist=$_REQUEST['artist'];
    mysqli_query($conn,"INSERT INTO `songs` (name,date,artist) VALUES ('$song','$dob','$artist')");
    header("Location:index.php");
  //$password=$_REQUEST['pass'];
}
if (isset($_REQUEST['save_artist'])) {
    $songs=$_REQUEST['songs'];
    $bio=$_REQUEST['bio'];
  $dob=$_REQUEST['dob'];
  $artist=$_REQUEST['artist'];
    mysqli_query($conn,"INSERT INTO `artists` (name,dob,bio,songs) VALUES ('$artist','$dob','$bio','$songs')");
    header("Location:index.php");
  //$password=$_REQUEST['pass'];
}
if (isset($_REQUEST['login'])) {
  $user_id=$_REQUEST['username'];
  $password=$_REQUEST['pass'];
  $ip=$_REQUEST['ip'];
  move_to_dashboard($user_id,$password,$ip);
}
if (isset($_REQUEST['change'])) {
    $user=$_SESSION['user_id'];
    if (isset($_SESSION['ip'])){
        $ip=$_SESSION['ip'];
    }
    date_default_timezone_set("Asia/Kolkata");
    $date=date('Y-m-d H:i:s');
    $load=$_REQUEST['load'];
    $type=$_REQUEST['type'];
     mysqli_query($conn,"INSERT INTO `act` (user_id,ld,type,date) VALUES ('$user','$load','$type','$date')");
     if($load=="load1" && $type=="on"){
         mysqli_query($conn,"UPDATE status SET st='on' WHERE ld='load1'");
   // echo '<script>window.location.replace("http://'.$ip.'/5/on")</script>';
        
         header("Location:http://".$ip."/5/on");
      
     }
     else if($load=="load1" && $type=="off"){
          mysqli_query($conn,"UPDATE status SET st='off' WHERE ld='load1'");
         //echo '<script>window.location.replace("http://'.$ip.'/5/off")</script>';
          header("Location:http://".$ip."/5/off");
     }
     else if($load=="load2" && $type=="off"){
          mysqli_query($conn,"UPDATE status SET st='off' WHERE ld='load2'");
   /// echo '<script>window.location.replace("http://'.$ip.'/4/off")</script>';
        
          header("Location:http://".$ip."/4/off");
     } 
     else if($load=="load2" && $type=="on"){
          mysqli_query($conn,"UPDATE status SET st='on' WHERE ld='load2'");
    
          header("Location:http://".$ip."/4/on");
     } 
    
     else{
         
     }
     
}
if (isset($_REQUEST['add'])) {
  $user_id=$_REQUEST['username'];
  $password=$_REQUEST['pass'];
  $name=$_REQUEST['name'];
  $des=$_REQUEST['des'];
   $query=mysqli_query($conn,"SELECT * FROM `users` WHERE `user_id`='$user_id'");
  if (mysqli_num_rows($query)==0) {
      mysqli_query($conn,"INSERT INTO `users` (user_id,password,designation) VALUES ('$user_id','$password','$des')");
      echo "INSERT INTO `users` (user_id,password,designation) VALUES ('$user_id','$password','$des'";
      // header("Location:add_user.php?c=0&status=success");
  }
  else{
      header("Location:add_user.php?c=1&status=username_exists");
      
  }
 // move_to_dashboard($user_id,$password);
}
function move_to_dashboard($user_id,$pass,$ip){
  global $conn;
  $query=mysqli_query($conn,"SELECT * FROM `users` WHERE `user_id`='$user_id' AND `password`='$pass'");
  if (mysqli_num_rows($query)==1) {
    $_SESSION['session_id']=session_id();
    $_SESSION['user_id']=$user_id;
    $_SESSION['ip']=$ip;
    header("Location:dashboard.php");
  } else {
            
              
            header("Location:login.php?c=1&status=Incorrect_username_or_password");
          
  }
}
?>