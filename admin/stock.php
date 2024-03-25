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
            <h1 class="m-0 font-weight-bold">Stocks</h1>
          </div><!-- /.col -->
          <div class="col-md-6">
            <button class="btn btn-dark mr-2">
              <a href="newitem.php" class="text-light">Add New Item</a>
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
          <div class="col-md-8">
            <div class="card card-dark">
              <div class="card-header">
                <h3 class="card-title">All Ingredients</h3>

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
                  <th scope="col" class="text-left">Quantity</th>
                  <th scope="col" class="text-left">Price</th>
                  <th scope="col" >Action</th>
                  <th scope="col">Warning</th>
                </tr>
              </thead>
              <tbody >
                <?php
                  $select="SELECT * FROM ingredients ORDER BY item_name";
                  $sql=mysqli_query($db,$select);
                  while($row=mysqli_fetch_assoc($sql)){
                    $item_id=$row['item_id'];
                    $item_name=$row['item_name'];
                    $item_price=$row['item_price'];
                    $item_quantity=$row['item_quantity'];
                    $item_warn=$row['item_warn'];
                    ?>
                    <tr>
                    <td scope="row" class="text-left"><?php echo $item_name;?></td>
                    <td scope="row" class="text-left"><?php echo $item_quantity." kg";?></td>
                    <td scope="row" class="text-left"><?php echo $item_quantity*$item_price . " Tk";?></td>
                    <td>
                      <a href="#item_id<?php echo $item_id;?>" class="add">
                        <button class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#item_id<?php echo $item_id;?>" data-whatever="@mdo">Add Stock</button>
                      </a>
                      <!-- modal add start -->
                        <div class="modal fade" id="item_id<?php echo $item_id;?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                          <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel"><?php echo "Add ".$item_name." Quantity";?></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                  <span aria-hidden="true">&times;</span>
                                </button>
                              </div>
                              <div class="modal-body">
                                <form action="stock.php" method="post">
                                  <div class="form-group text-left">
                                    <label for="recipient-name" class="col-form-label text-left">Add Quantity (in kg)</label>
                                    <input type="number" step="0.01" class="form-control" id="recipient-name" name="add_quantity" required>
                                  </div>
                                  <input type="hidden" name="item_id" value="<?php echo $item_id;?>">
                                  <input type="hidden" name="item_quantity" value="<?php echo $item_quantity;?>">
                                  <div class="form-group text-right">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <input type="submit" class="btn btn-dark" value="Add" name="add_item1">
                                  </div>
                                </form>
                              </div>
                                <?php
                                  if(isset($_POST['add_item1'])){
                                    $add_quantity= $_POST['add_quantity'];
                                    $item_id= $_POST['item_id'];
                                    $item_quantity= $_POST['item_quantity'];
                                    $item_quantity_num=(float)$item_quantity;
                                    $add_quantity_num=(float)$add_quantity;
                                    $sum=$item_quantity_num+$add_quantity_num;
                                    $final_quantity=(string)$sum;
                                    $update_item="UPDATE ingredients SET item_quantity='$final_quantity' WHERE item_id='$item_id'";
                                    $update_cat_sql=mysqli_query($db,$update_item);
                                    if($update_cat_sql){
                                      header('Location:stock.php');
                                      //echo "<span class='alert alert-success'>category added</span>";
                                    }
                                    else{
                                      echo "error";
                                    }
                                  }
                                ?>
                            </div>
                          </div>
                        </div>
                      <!-- modal add end -->
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
                <td scope="row">
                  <?php
                    $item_quantity_num=(float)$item_quantity;
                    $item_warn_num=(float)$item_warn;
                    if($item_quantity_num==0){?>
                      <button type="button" class="btn btn-danger btn-sm" >Out Of Stock</button>
                    <?php
                    }
                    else if($item_quantity_num>$item_warn_num){?>
                      <button type="button" class="btn btn-success btn-sm px-4">In Stock</button>
                      <?php
                    }
                    else{?>
                      <button type="button" class="btn btn-warning btn-sm px-3">Low Stock</button>
                      <?php
                    }
                  ?></td>
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