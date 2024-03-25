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
                  <h3 class="card-title">Add New Item</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <form action="newitem.php" method="post">
                    <div class="form-group">
                      <label for="inputName">Item Name</label>
                      <input type="text" id="inputName" name="item_name" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Item Quantity (in kg)</label>
                      <input type="number" id="inputName" name="item_quantity" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Item Price (per kg)</label>
                      <input type="number" id="inputName" name="item_price" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Warning Quantity (in kg)</label>
                      <input type="number" id="inputName" name="item_warn" step="0.01" class="form-control" required>
                    </div>
                    <input type="submit" class="btn btn-secondary" value="Add Item" name="add_item">
                  </form>
                </div>
                <?php
                if(isset($_POST['add_item'])){
                  $item_name = $_POST['item_name'];
                  $item_price = $_POST['item_price'];
                  $item_quantity = $_POST['item_quantity'];
                  $item_warn = $_POST['item_warn'];

                  $item_name_lower=strtolower($item_name);
                  $same="SELECT * FROM ingredients";
                  $same_sql=mysqli_query($db,$same);
                  
                  $flag=1;
                  while($row=mysqli_fetch_assoc($same_sql)){
                    $pitem_name=$row['item_name'];
                    $pitem_name_lower=strtolower($pitem_name);
                    if($item_name_lower==$pitem_name_lower){
                      $flag=0;
                    }
                  }

                  if($flag==1){
                    $add_item="INSERT INTO ingredients (item_name, item_price, item_quantity,item_warn) VALUES('$item_name','$item_price','$item_quantity','$item_warn')";
                    $add_item_sql=mysqli_query($db,$add_item);
                    if($add_item_sql){
                      header('Location:stock.php');
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
                                  <p class="mb-4">This item already exists.</p>
                                  <form class="text-right">
                                      <button type="submit" class="btn btn-dark ">
                                        <a href="stock.php" class="text-light ">Close</a></button>
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