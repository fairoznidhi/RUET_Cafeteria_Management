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
          <div class="col-md-5">
            
          </div><!-- /.col -->
          <div class="col-md-6">
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
                  <h3 class="card-title">Add New Recipe</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <form action="newrecipe.php" method="post">
                    <div class="form-group">
                      <label for="inputName">Recipe Name</label>
                      <input type="text" id="inputName" name="recipe_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Recipe Price</label>
                      <input type="number" id="inputName" name="recipe_price" step="0.01" class="form-control" required>
                    </div>
                    <input type="submit" class="btn btn-secondary" value="Add Item" name="add_recipe">
                  </form>
                </div>
                <?php
                if(isset($_POST['add_recipe'])){
                  $recipe_name = $_POST['recipe_name'];
                  $recipe_price = $_POST['recipe_price'];

                  $recipe_name_lower=strtolower($recipe_name);
                  $same="SELECT * FROM recipe";
                  $same_sql=mysqli_query($db,$same);
                  
                  $flag=1;
                  while($row=mysqli_fetch_assoc($same_sql)){
                    $precipe_name=$row['recipe_name'];
                    $precipe_name_lower=strtolower($precipe_name);
                    if($recipe_name_lower==$precipe_name_lower){
                      $flag=0;
                    }
                  }

                  if($flag==1){
                     $add_recipe="INSERT INTO recipe(recipe_name, recipe_price) VALUES('$recipe_name','$recipe_price');";
                     $add_recipe_sql=mysqli_query($db,$add_recipe);
                     if($add_recipe_sql){
                       header('Location:recipes.php');
                     }
                     else{
                       echo "error";
                     }
                  }
                  else{?>
                    <div id="myModal" class="modal fade">
                      <div class="modal-dialog">
                          <div class="modal-content">
                              <div class="modal-header">
                                  <h5 class="modal-title">Alert!</h5>
                                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                              </div>
                              <div class="modal-body">
                                  <p class="mb-4">This recipe already exists.</p>
                                  <form class="text-right">
                                      <button type="submit" class="btn btn-dark ">
                                        <a href="recipes.php" class="text-light ">Close</a></button>
                                  </form>
                              </div>
                          </div>
                      </div>
                  </div>
                  <?php
                  }
                }
                ?>
                <!-- /.card-body -->
              </div>

              <!-- /.card -->
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