<?php
    $insert= false;
    $server="localhost";
    $username="root";
    $password="";
    $db="notes";
     
    $connection=mysqli_connect($server,$username,$password,$db);

    if($connection==false){
        echo "ERROR";
    }
    else{

        // echo"succesful";
    }

    if(isset($_GET['deletes'])){
      $sno=$_GET['deletes'];
      // echo $sno;
      $sqlQ="DELETE FROM `notesdata` WHERE `notesdata`.`Sr.No` = $sno";
      $result=mysqli_query($connection,$sqlQ);
    }
    if($_SERVER["REQUEST_METHOD"]=="POST"){
      if(isset($_POST['snoEdit'])){ 
        // echo "yes i am done";
        $srno=$_POST['snoEdit'];
        $title=$_POST['title'];
        $des=$_POST['des'];

        $sqlQ="UPDATE `notesdata` SET `Notes Title` = '$title', `Notes Description` = '$des' WHERE `notesdata`.`Sr.No` = $srno";
        $result=mysqli_query($connection,$sqlQ);


      }
      else{

   

        $title=$_POST['title'];
        $des=$_POST['des'];

        $sqlQ="INSERT INTO `notesdata` (`Notes Title`, `Notes Description`) VALUES ( '$title', '$des')";
        $result=mysqli_query($connection,$sqlQ);
        if($result){
            $insert=true;
        }

    }
  }



?>

<!doctype html>
<html lang="en">
  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- boot strap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    
    <!-- DATA TABLE CSS CDN -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">

    <title>CRUD APP</title>
  </head>
  <body>





  
  <!-- Button trigger modal -->


<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="container my-5 mr-5">
            <h2>Edit Notes</h2>
        <form action="/CRUD_APP/index.php" method="POST">
          <input type="hidden" name="snoEdit" id="snoEdit">
        <div class="mb-3">
            <label for="title" class="form-label" >Note Title</label>
            <input type="text" class="form-control" rows="5" id="titleEdit" name="title" aria-describedby="emailHelp" >
            <div id="text" class="form-text">Enter title of your daily routine work as a remainder on a note so that you can'nt forget.</div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" rows="8" id="desEdit" name="des" style="height: 100px"></textarea>
            <label for="des">Notes Description</label>
        </div>
        <button type="submit" class="btn btn-primary btn-sm my-5">Update Notes</button>
        </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
  

<!-- NavBAR -->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">PHP CRUD</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="#">About</a>
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
        if($insert){
            echo"<div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>Success!</strong> You data have been added succesfully.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
          </div>";
        } 
        ?>



        <div class="container my-5 mr-5">
            <h2>Add Notes</h2>
        <form action="/CRUD_APP/index.php" method="POST">
        <div class="mb-3">
            <label for="title" class="form-label" >Note Title</label>
            <input type="text" class="form-control" rows="5" id="title" name="title" aria-describedby="emailHelp" >
            <div id="text" class="form-text">Enter title of your daily routine work as a remainder on a note so that you can'nt forget.</div>
        </div>
        <div class="form-floating">
            <textarea class="form-control" rows="8" id="des" name="des" style="height: 100px"></textarea>
            <label for="des">Notes Description</label>
        </div>
        <button type="submit" class="btn btn-primary btn-sm my-5">Add Notes</button>
        </form>
        </div>


        <div class="container">
        <table class="table" id="myTable">
                <thead>
                  <tr>
                    <th scope="col">SR NO</th>
                    <th scope="col">TITLE</th>
                    <th scope="col">DESCRIPTION</th>
                    <th scope="col">TIME</th>
                    <th scope="col">ACTIONS</th>

                  </tr>
                </thead>
                <tbody>
            <?php
             $sqlQ="SELECT * FROM `notesdata`";
             $result=mysqli_query($connection,$sqlQ);
            //  $row=mysqli_num_rows($result);
            //  echo $row;             
                $srno=1;
             while($row=mysqli_fetch_assoc($result)){

                
                echo "<tr>
                    <th scope='row'>" . $srno."</th>
                    <td>".$row['Notes Title']. "</td>
                    <td>".$row['Notes Description']."</td>
                    <td>".$row['dtime']."</td>
                    <td>'<button type='button' class='btn btn-primary edits' id=".$row['Sr.No']." data-bs-toggle='modal' data-bs-target='#editModal'>EDIT</button>
                    <button  class='btn btn-danger btn-sm deletes' id=d".$row['Sr.No'].">DELETE</button>   '
                    </td>
                  
                  </tr>";
                  $srno+=1;
            }
            echo "<br/>";
            ?>
             </tbody>
              </table> 
        </div>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.3.js" integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script src="./assets/js.js"></script>

  </body>
</html>