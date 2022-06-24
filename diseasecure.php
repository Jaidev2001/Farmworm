<?php
//include("index.php");
$insert=false;
$update=false;
$delete=false;
$dsn="mysql:host=localhost;dbname=farmworm";
$conn=new PDO($dsn,"root","");
if(!$conn)
{
  echo "sorry we failed to connect:";
}

if(isset($_GET['delete'])){
  $sno = $_GET['delete'];
  $delete = true;
  $sql = "DELETE FROM `animal_disease` WHERE `id` = $sno";
  $stmt=$conn->query($sql);
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
  if (isset( $_POST['snoEdit'])){

    //UPDATE THE RECORD
    $sno = $_POST["snoEdit"];
    $disease = $_POST["diseaseEdit"];
    $affected= $_POST['affectedEdit'];
  //  $pic= $_POST['PICTURE'];
  $des= $_POST['descriptionEdit'];
  $symptoms= $_POST['symptomsEdit'];
  $cure= $_POST['cureEdit'];
  $prevention= $_POST['preventionEdit'];
  

  //SQL QUERY TO BE EXECUTED
  $sql="UPDATE `animal` SET `NAME_OF_ANIMAL`='$name',`DESCRIPTION`='$des',`BREED`='$breed',`LIFETIME`='$lyftime',`PLACE`='$place',`environment`='$envirnmnt',`Height`='$Height',`weight`='$weight' WHERE `animal`.`id`=$sno";

  $stmt=$conn->query($sql);
  if($stmt)
  {
      $update=true;
  }
  else
     {
        echo "We could not update!!!";
     }
    }
  else
  {
    $disease = $_POST["DISEASE"];
    $affected= $_POST['AFFECTED'];
  //  $pic= $_POST['PICTURE'];
  $des= $_POST['DESCRIPTION'];
  $symptoms= $_POST['SYMPTOMS'];
  $cure= $_POST['CURE'];
  $prevention= $_POST['PREVENTION'];

  //picture add
$target_dir = "images/";
$target_file = $target_dir . basename($_FILES['PICTURE']['name']);
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$file_temp = $_FILES['PICTURE']['tmp_name'];
if ( $_FILES["PICTURE"]["size"] > 16000000)
{
  echo "The image size is greater than 2MB, please upload less than 2MB";
}
else{
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
  echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
  $uploadOk = 0;
}
else{
$unique_image = substr(md5(time()), 0, 10).'.'.$imageFileType;
$file_image_upload="images/".$unique_image;

  if(move_uploaded_file($file_temp,$file_image_upload))
  {
    $sql="INSERT INTO `animal` (`PICTURE`) VALUES ('$file_image_upload')";
    $stmt=$conn->query($sql);
  }
  else
  echo "SOME ERROR OCCURED";

}
}

  $sql="INSERT INTO `animal_disease`(`DISEASE`, `AFFECTED`, `DESCRIPTION`, `SYMPTOMS`, `CURE`, `PREVENTION`) VALUES ('$disease','$affected','$des','$symptoms','$cure','$prevention')";

  
  $stmt=$conn->query($sql);
  if($stmt)
  {
    
     $insert=true;
    
  }
  else
   echo "error";
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Disease and Cure</title>

    <!-- CSS only -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
<link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">

<style>
  * {
    box-sizing: border-box;
  }

  input[type=text],
  select,
  textarea {
    width: 100%;
    padding: 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    resize: vertical;
  }

  label {
    padding: 12px 12px 12px 0;
    display: inline-block;
  }

  input[type=submit] {
    background-color: #04AA6D;
    color: white;
    padding: 12px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    float: right;
  }

  input[type=submit]:hover {
    background-color: #45a049;
  }

  .container {
    border-radius: 5px;
    background-color: #f2f2f2;
    padding: 20px;
  }

  .col-25 {
    float: left;
    width: 25%;
    margin-top: 6px;
  }

  .col-75 {
    float: left;
    width: 75%;
    margin-top: 6px;
  }

  /* Clear floats after the columns */
  .row:after {
    content: "";
    display: table;
    clear: both;
  }

  /* Responsive layout  */
  @media screen and (max-width: 600px) {

    .col-25,
    .col-75,
    input[type=submit] {
      width: 100%;
      margin-top: 0;
    }
  }
</style>


</head>


<body>
    <!-- ****NAVIGATION BAR** -->
    <nav class="navbar navbar-expand-lg" style="background-color:#75efbc;">
        <div class="container-fluid">
          <a class="navbar-brand" href="/farmworm/anu.php">
            <img src="" alt="" width="30" height="24" class="d-inline-block align-text-top">
            Farmworm
          </a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="#">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/farmworm/anu.php">ANIMAL'S INFORMATION</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown"
                  aria-expanded="false">
                  Category
                </a>
                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <li><a class="dropdown-item" href="/farmworm/anu.php">Animals</a></li>
                    <li><a class="dropdown-item" href="#">Fruits</a></li>
                    <li><a class="dropdown-item" href="#">Vegetables</a></li>
                    <li><a class="dropdown-item" href="#">Fishes</a></li>
                  <li>
                    <hr class="dropdown-divider">
                  </li>
                  <li><a class="dropdown-item" href="#">Something else here</a></li>
                </ul>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
              </li>
            </ul>
            <form class="d-flex" role="search">
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
              <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
          </div>
        </div>
      </nav>
    

    <h2>ANIMAL'S DISEASE AND CURE</h2>
    <div class="container">
      <form action="/farmworm/diseasecure.php" method="post" name="f1" enctype="multipart/form-data">
    
        <div class="row">
            <div class="col-25">
              <label for="DISEASE">DISEASE</label>
            </div>
            <div class="col-75">
                <input type="text" name="DISEASE"  placeholder="YOU CAN
    WRITE DISEASE HERE.."> <br>
            </div>
          </div>
    
        <div class="row">
            <div class="col-25">
              <label for="AFFECTED ANIMALS">AFFECTED ANIMALS</label>
            </div>
            <div class="col-75">
                <input type="checkbox" id="CATTLE" name="CATTLE">
                <label for="CATTLE">CATTLE</label>
                <input type="checkbox" id="BUFFALO" name="BUFFALO">
                <label for="BUFFALO">BUFFALO</label>
                <input type="checkbox" id="CAMEL" name="CAMEL">
                <label for="CAMEL">CAMEL</label>
                <input type="checkbox" id="GOATS" name="GOATS">
                <label for="GOATS">GOATS</label>
                <input type="checkbox" id="SHEEP" name="SHEEP">
                <label for="SHEEP">SHEEP</label>
                <input type="checkbox" id="HORSE" name="HORSE">
                <label for="HORSE">HORSE</label>
            </div>
          </div>
    
      <div class="row">
        <div class="col-25">
          <label for="PICTURE">PICTURE</label>
        </div>
        <div class="col-75">
            <input type="file" name="PICTURE" src=" "><br>
        </div>
      </div>
    
      <div class="row">
        <div class="col-25">
          <label for="DESCRIPTION">DESCRIPTION</label>
        </div>
        <div class="col-75">
    
          <textarea  id="DESCRIPTION" name="DESCRIPTION" rows="3" placeholder="YOU CAN WRITE
    DESCRIPTION HERE.."></textarea><br>
        </div></div>
    
        <div class="row">
            <div class="col-25">
              <label for="SYMPTOMS">SYMPTOMS</label>
            </div>
            <div class="col-75">
                <input type="text" name="SYMPTOMS"  placeholder="YOU CAN
    WRITE SYMPTOMS HERE.."> <br>
            </div>
          </div>
    
    
    
          <div class="row">
            <div class="col-25">
              <label for="CURE">CURE</label>
            </div>
            <div class="col-75">
                <input type="text" name="CURE"  placeholder="YOU CAN WRITE
    CURE HERE.."> <br>
            </div>
          </div>
    
          <div class="row">
            <div class="col-25">
              <label for="PREVENTION">PREVENTION</label>
            </div>
            <div class="col-75">
                <input type="text" name="PREVENTION"  placeholder="YOU CAN
    WRITE PREVENTION HERE.."> <br>
            </div>
          </div>
    
    
    
      <br>
      <div class="row">
        <input type="submit" value="Submit">
      </div>
      </form>
    </div>
    
<!--     
    <h2>CARE</h2>
    <div class="container">
      <form action="/action_page.php">
    
        <div class="row">
            <div class="col-25">
              <label for=" ANIMAL NAME">ANIMAL NAME</label>
            </div>
            <div class="col-75">
                <select id="NAME OF ANIMAL" name="NAME OF ANIMAL">
                    <option value="CATTLE">CATTLE</option>
                    <option value="BUFFALO">BUFFALO</option>
                    <option value="CAMEL">CAMEL</option>
                    <option value="GOATS">GOATS</option>
                    <option value="SHEEP">SHEEP</option>
                    <option value="HORSE">HORSE</option>
                  </select>
            </div>
          </div>
    
    
          <div class="row">
            <div class="col-25">
              <label for="CARE">CARE</label>
            </div>
            <div class="col-75">
                <input type="text" name="CARE"  placeholder="YOU CAN WRITE
    CARE HERE.."> <br>
            </div>
          </div>
    
    
    
       <div class="row">
        <div class="col-25">
          <label for="PICTURE">PICTURE</label>
        </div>
        <div class="col-75">
            <input type="file" name="PICTURE" src=" "><br>
        </div>
      </div>
      <H3>VETERINARY</H3>
    
    
    
    
          <div class="row">
            <div class="col-25">
              <label for="VETERINARY STORE">VETERINARY STORE NAME</label>
            </div>
            <div class="col-75">
                <input type="text" name="VETERINARY STORE NAME"
    placeholder="YOU CAN WRITE VETERINARY STORE NAME HERE.."> <br>
            </div>
          </div>
    
          <div class="row">
            <div class="col-25">
              <label for="ADDRESS">ADDRESS</label>
            </div>
            <div class="col-75">
                <input type="text" name="ADDRESS"  placeholder="YOU CAN
    WRITE ADDRESS HERE.."> <br>
            </div>
          </div>
    
          <div class="row">
            <div class="col-25">
              <label for="PHONE NUMBER">PHONE NUMBER</label>
            </div>
            <div class="col-75">
                <input type="tel" name="PHONE NUMBER"  placeholder="YOU
    CAN WRITE PHONE NUMBER HERE.."> <br>
            </div>
          </div>
    
    
    
      <br>
      <div class="row">
        <input type="submit" value="Submit">
      </div>
      </form>
    </div> -->



<!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
  crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>
</html>