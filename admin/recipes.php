<?php
  include("include/header.php");
  include("include/sidebar.php");
?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 mt-3">
          <div class="col-md-1">
            <h1 class="m-0 font-weight-bold">Recipes</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <button class="btn btn-dark mr-2">
              <a href="newrecipe.php" class="text-light">Add Recipes</a>
            </button>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- contents go here start-->
          <div class="col-md-6">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">All Recipes</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
              <table class="table text-center" >
              <thead>
                <tr>
                  <th scope="col" class="text-left">Name</th>
                  <th scope="col" class="text-left">Recipe Price</th>
                  <th scope="col" >Action</th>
                </tr>
              </thead>
              <tbody >
                <?php
                  $select="SELECT * FROM recipe ORDER BY recipe_name";
                  $sql=mysqli_query($db,$select);
                  while($row=mysqli_fetch_assoc($sql)){
                    $recipe_id=$row['recipe_id'];
                    $recipe_name=$row['recipe_name'];
                    $recipe_price=$row['recipe_price'];
                    ?>
                    <tr>
                    <td scope="row" class="text-left"><?php echo $recipe_name;?></td>
                    <td scope="row" class="text-left"><?php echo $recipe_price;?></td>
                    <td>
                      <a href="#recipe_id<?php echo $recipe_id;?>" class="add">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#recipe_id<?php echo $recipe_id;?>" data-whatever="@mdo">Add Ingredients</button>
                      </a>
                      <a href="edititem.php?edit=<?php echo $item_id;?>" class="edit">
                      <button class="btn btn-secondary btn-sm">Edit</button>
                      </a>
                      <a href="#iitem_id<?php echo $item_id;?>" class="delete" data-toggle="modal" data-target="#iitem_id<?php echo $item_id;?>">
                      <button class="btn btn-secondary btn-sm">Delete</button>
                    </a>
                    <!-- Modal delete start -->
                    <div class="modal fade" id="iitem_id<?php echo $item_id;?>" data-backdrop="static"     data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                      <div class="modal-dialog">
                        <div class="modal-content">
                          <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Delete</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          <div class="modal-body text-left">
                            Are you sure to delete this item?
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <a href="stock.php?delete=<?php echo $item_id; ?>" class="btn btn-danger">Delete</a>
                          </div>
                        </div>
                      </div>
                    </div>
                  </td>
                  </tr>
                      <?php
                    }
                ?>

                <!-- delete query code -->
                <?php
                  if(isset($_GET['delete'])){
                    $del_id=$_GET['delete'];
                    $delete_query="DELETE FROM ingredients WHERE item_id='$del_id'";
                    $sql=mysqli_query($db,$delete_query);
                    if($sql){
                      header('Location:stock.php');
                    }
                    else{
                      echo "Error";
                    }
                  }
                ?>
              </tbody>
            </table>
              </div>
          </div>
          </div>
          <!-- contents go here end-->
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php
include("include/footer.php");
?>