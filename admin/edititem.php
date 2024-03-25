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
              <div class="card card-warning">
                <div class="card-header">
                <?php 
                    if(isset($_GET['edit'])){
                        $item_id=$_GET['edit'];
                        $sql="SELECT * FROM ingredients WHERE item_id=$item_id";
                        $result=mysqli_query($db,$sql);
                        $row=mysqli_fetch_assoc($result);
                        $item_name=$row['item_name'];
                        $item_quantity=$row['item_quantity'];
                        $item_price=$row['item_price'];
                        $item_warn=$row['item_warn'];
                    }
                    //field e jate ager value dekhay shesh r value te egulor nam dite hbe
                    if(isset($_POST['update_item'])){
                        $item_id=$_POST['item_id'];
                        $item_name=$_POST['item_name'];
                        $item_name=$_POST['item_name'];
                        $item_quantity=$_POST['item_quantity'];
                        $item_price=$_POST['item_price'];
                        $item_warn=$_POST['item_warn'];
                    
                        $sql="UPDATE ingredients SET item_name='$item_name',item_quantity='$item_quantity', item_price='$item_price', item_warn='$item_warn' WHERE item_id='$item_id'";
                        $result=mysqli_query($db,$sql);
                        if($result){
                            //echo "Updated successfully!";
                            header('location:stock.php');
                        }
                        else{
                            echo "errrror";
                            die(mysqli_error($db));
                        }
                    }
                ?>
                  <h3 class="card-title">Edit  Item</h3>

                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <form action="edititem.php" method="post">
                  <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                    <div class="form-group">
                      <label for="inputName">Item Name</label>
                      <input type="text" id="inputName" name="item_name" value="<?php echo $item_name;?>" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Item Quantity (in kg)</label>
                      <input type="number" id="inputName" name="item_quantity" step="0.01" class="form-control" value="<?php echo $item_quantity;?>" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Item Price (per kg)</label>
                      <input type="number" id="inputName" name="item_price" value="<?php echo $item_price;?>" step="0.01" class="form-control" required>
                    </div>
                    <div class="form-group">
                      <label for="inputName">Warning Quantity (in kg)</label>
                      <input type="number" id="inputName" name="item_warn" step="0.01" class="form-control" value="<?php echo $item_warn;?>" required>
                    </div>
                    <input type="submit" class="btn btn-secondary" value="Update Item" name="update_item">
                  </form>
                </div>
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