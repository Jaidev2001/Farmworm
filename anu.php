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
  $sql = "DELETE FROM `animal` WHERE `id` = $sno";
  $stmt=$conn->query($sql);
}

if($_SERVER['REQUEST_METHOD']=='POST')
{
  if (isset( $_POST['snoEdit'])){

    //UPDATE THE RECORD
    $sno = $_POST["snoEdit"];
    $name= $_POST['nameEdit'];
  //  $pic= $_POST['PICTURE'];
  $des= $_POST['descriptionEdit'];
  $breed= $_POST['breedEdit'];
  $lyftime= $_POST['lifetimeEdit'];
  $place= $_POST['placeEdit'];
  $envirnmnt= $_POST['environmentEdit'];
  $Height= $_POST['heightEdit'];
  $weight= $_POST['weightEdit'];

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
  $name= $_POST['NAME_OF_ANIMAL'];
  // $pic= $_POST['PICTURE'];
  $des= $_POST['DESCRIPTION'];
  $breed= $_POST['BREED'];
  $lyftime= $_POST['LIFETIME'];
  $place= $_POST['PLACE'];
  $envirnmnt= $_POST['environment'];
  $Height= $_POST['Height'];
  $weight= $_POST['weight'];

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
    goto abc;
  }
  else
  echo "SOME ERROR OCCURED";

}
}
  abc:
  $sql="INSERT INTO
`animal`(`NAME_OF_ANIMAL`,`DESCRIPTION`,`BREED`,`LIFETIME`,`PLACE`,`environment`,`Height`,`weight`,`PICTURE`)
VALUES ('$name','$des','$breed','$lyftime','$place','$envirnmnt','$Height','$weight','$file_image_upload')";

  
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
  <title>Form Design</title>
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

  <!-- Edit Modal -->
  <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editModalLabel">Edit this Note</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form action="/farmworm/anu.php" method="POST">
          <div class="modal-body">
            <input type="hidden" name="snoEdit" id="snoEdit">


            <div class="form-group">
              <label for="name">Name of the animal</label>
              <textarea class="form-control" id="nameEdit" name="nameEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="desc">Note Description</label>
              <textarea class="form-control" id="descriptionEdit" name="descriptionEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="breed">Breed </label>
              <textarea class="form-control" id="breedEdit" name="breedEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="lifetime">AVG Lifetime</label>
              <textarea class="form-control" id="lifetimeEdit" name="lifetimeEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="place">Place</label>
              <textarea class="form-control" id="placeEdit" name="placeEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="environment">Environment</label>
              <textarea class="form-control" id="environmentEdit" name="environmentEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="height">Height</label>
              <textarea class="form-control" id="heightEdit" name="heightEdit" rows="3"></textarea>
            </div>
            <div class="form-group">
              <label for="weight">Weight</label>
              <textarea class="form-control" id="weightEdit" name="weightEdit" rows="3"></textarea>
            </div>
          </div>
          <div class="modal-footer d-block mr-auto">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  <nav class="navbar navbar-expand-lg" style="background-color:#75efbc;">
    <div class="container-fluid">
      <a class="navbar-brand" href="/farmworm/anu.php">
      <h1 class="fw-bold text-primary m-0">Fa<span class="text-secondary">rmwo</span>rm</h1>
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
            <a class="nav-link" href="/farmworm/diseasecure.php">Diseases and Cure</a>
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
<?php
if($insert)
{
 echo"<div class='alert alert-warning alert-dismissible fade show' role='alert'>
 <strong>SUCCESS!</strong> Inserted Data.
 <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
}
?>
<?php
  if($update){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been updated successfully
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
      
    </button>
  </div>";
  }
  ?>
   <?php
  if($delete){
    echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
    <strong>Success!</strong> Your data has been deleted successfully
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'>
      
    </button>
  </div>";
  }
  ?>
  <h2>ANIMAL'S INFORMATION</h2>
  <div class="container">
    <form action="/farmworm/anu.php" method="post" name="f1" enctype="multipart/form-data">
      <div class="row">
        <div class="col-25">
          <label for="NAME OF ANIMAL">NAME OF ANIMAL</label>
        </div>
        <div class="col-75">
          <select id="NAME OF ANIMAL" name="NAME_OF_ANIMAL">
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
          <label for="PICTURE">PICTURE</label>
        </div>
        <div class="col-75">
          <input type="file" name="PICTURE" id="PICTURE" src=" " accept="image/.jpg"><br>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="DESCRIPTION">DESCRIPTION</label>
        </div>
        <div class="col-75">

          <textarea id="DESCRIPTION" rows="3" placeholder="YOU CAN WRITE
DESCRIPTION HERE.." name="DESCRIPTION"></textarea><br>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="BREED">BREED</label>
        </div>
        <div class="col-75">
          <input type="text" name="BREED" placeholder="YOU CAN
WRITE BREED HERE.."> <br>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="life time">AVERAGE LIFE TIME</label>
        </div>
        <input type="number" name="LIFETIME" placeholder="YOU CAN
WRITE LIFE TIME HERE..">
      </div>

      <div class="row">
        <div class="col-25">
          <label for="Place">PLACE</label>
        </div>
        <div class="col-75">
          <input type="text" name="PLACE" placeholder="YOU CAN
WRITE Place HERE.."> <br>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="environment">ENVIRONMENT</label>
        </div>
        <div class="col-75">
          <input type="text" name="environment" placeholder="YOU
CAN WRITE environment HERE.."> <br>
        </div>
      </div>

      <div class="row">
        <div class="col-25">
          <label for="Physical Appearance">PHYSICAL APPEARANCE</label>
        </div>
        <div class="col-75">
          <label for="Physical Appearance">Average Height</label>
          <input type="number" name="Height" placeholder="YOU CAN
WRITE Height HERE..">
          <label for="Physical Appearance">Average weight</label>
          <input type="number" name="weight" placeholder="YOU CAN
WRITE weight HERE..">
          <br>
        </div>
      </div>

      <br>
      <div class="row">
        <input type="submit" name="Submit" value="Submit">
      </div>
    </form>
  </div>





  <table class="table" id="myTable">
    <thead>
      <tr>
        <th scope="col">id</th>
        <th scope="col">Name</th>
        <th scope="col">Description</th>
        <th scope="col">Breed</th>
        <th scope="col">Lifetime</th>
        <th scope="col">Place</th>
        <th scope="col">Environment</th>
        <th scope="col">Height</th>
        <th scope="col">Weight</th>
        <th scope="col">Image</th>


        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody>
      <?php
  $sql="SELECT * FROM `animal`";
  $stmt=$conn->prepare($sql);
  $stmt->execute();
  $sno=0;
  while($row=$stmt->fetch(PDO::FETCH_ASSOC))
  {
    $sno++;
  echo "<tr>
  <th scope='row'>". $sno . "</th>
  <td>". $row['NAME_OF_ANIMAL'] . "</td>
  <td>". $row['DESCRIPTION'] . "</td>
  <td>". $row['BREED'] . "</td>
  <td>". $row['LIFETIME'] . "</td>
  <td>". $row['PLACE'] . "</td>
  <td>". $row['environment'] . "</td>
  <td>". $row['Height'] . "</td>
  <td>". $row['weight'] . "</td>
  <td>". $row['PICTURE'] . "</td>
  
  <td> <button class='edit btn btn-sm btn-primary' id=".$row['id'].">Edit</button> <button class='delete btn btn-sm btn-primary' id=d".$row['id'].">Delete</button>  </td>
</tr>";
  }
  ?>


    </tbody>
  </table>






  <!-- JavaScript Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2"
    crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
    crossorigin="anonymous"></script>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

  <script>
    $(document).ready(function () {
      $('#myTable').DataTable();
    });
  </script>
  <script>
    edits = document.getElementsByClassName('edit');
    Array.from(edits).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        tr = e.target.parentNode.parentNode;
        name = tr.getElementsByTagName("td")[0].innerText;
        description = tr.getElementsByTagName("td")[1].innerText;
        breed = tr.getElementsByTagName("td")[2].innerText;
        lifetime = tr.getElementsByTagName("td")[3].innerText;
        place = tr.getElementsByTagName("td")[4].innerText;
        environment = tr.getElementsByTagName("td")[5].innerText;
        height = tr.getElementsByTagName("td")[6].innerText;
        weight = tr.getElementsByTagName("td")[7].innerText;


        console.log(name, description, breed, lifetime, place, environment, height, weight);
        nameEdit.value = name;
        descriptionEdit.value = description;
        breedEdit.value = breed;
        lifetimeEdit.value = lifetime;
        placeEdit.value = place;
        environmentEdit.value = environment;
        heightEdit.value = height;
        weightEdit.value = weight;
        snoEdit.value = e.target.id;
        console.log(e.target.id)
        $('#editModal').modal('toggle');
      })
    })
    deletes = document.getElementsByClassName('delete');
    Array.from(deletes).forEach((element) => {
      element.addEventListener("click", (e) => {
        console.log("edit ");
        sno = e.target.id.substr(1);

        if (confirm("Are you sure you want to delete this Data!")) {
          console.log("yes");
          window.location = `/farmworm/anu.php?delete=${sno}`;
          // TODO: Create a form and use post request to submit a form
        }
        else {
          console.log("no");
        }
      })
    })

  </script>
</body>

</html>