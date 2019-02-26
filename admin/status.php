<?php 
// include_once('../api/config/database.php');
// include_once('./objects/statusClass.php');
// include_once('./objects/categoryClass.php');
// $database = new Database();
// $db = $database->getConnection();
// $status = new Status($db);
// $status->status="hello";
// $status->category_id="1";
// $status->created_at=date('Y-m-d H:i:s');
// $status->create();

// $category = new Category($db);
// $category->name = "love";
// $category->description = "";
// $category->created = date('Y-m-d H:i:s');
// $category->create();
$active = 'status';
$success = null;
$url = "http://" . $_SERVER['SERVER_NAME'].'/arbites-status/admin/' ;
include_once('./header.php');
include_once('../api/config/database.php');
include_once('./objects/statusClass.php');
include_once('./objects/categoryClass.php');
       
$database = new Database();
$db = $database->getConnection();
$status = new Status($db);
// query products
$stmt = $status->read();
$num = $stmt->rowCount();
if(isset($_POST['store-status'])){
    // $url = "http://" . $_SERVER['SERVER_NAME'].'/arbites-status/admin/status.php' ;
    if(!$_POST['status'] || !$_POST['category']){
        $success = "fail";
        echo "<script>
            var msg = 'error while storing'
            demo.showNotification('top','center','danger',msg)
        </script>";
    }else{
        $success = "fail";
       
        $status->status=$_POST['status'];
        $status->author=$_POST['author'];
        $status->category_id=$_POST['category'];
        $status->created_at=date('Y-m-d H:i:s');
        $status->create();
         echo "<script>
            var msg = 'Stored successfully'
            demo.showNotification('top','center','success',msg)
        </script>";
    }
    // header("Location:".$url);

}
?>
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Add New Status</h4>
                    </div>
                    <div class="content ">
                        <form method="post" action="">
                        <!-- <form method="post" action="<?php// echo $url.'store/storeStatus.php'?>"> -->
                        <div class="form-group">
                            <label for="status">Status</label>
                            <textarea required class="form-control" rows="5" id="status" name="status"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="author">Author (optional)</label>
                            <input typwe="text" class="form-control" rows="5" id="author" name="author"/>
                        </div>

                        <div class="form-group">
                            <label for="sel1">Select Category:</label>
                            <select class="form-control" id="categroy" name="category">
                                <option value="1">Uncategorized</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-fill btn-info" value="store-status" name="store-status">Submit</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="card">
                    <div class="header">
                        <h4 class="title">Striped Table with Hover</h4>
                        <p class="category">Here is a subtitle for this table</p>
                    </div>
                    <div class="content table-responsive table-full-width">
                        <table class="table table-hover table-striped">
                            <thead>
                                <th>ID</th>
                                <th>Status</th>
                                <th>Category</th>
                                <th>Likes</th>
                                <th>Comemnt</th>
                            </thead>
                            <tbody>
                            <?php if($num>0){ $i=1;
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
                                        extract($row);?>
                                        <tr>
                                            <td><?php echo $i++ ?></td>
                                            <td><?php echo $status?></td>
                                            <td><?php echo $category_name?></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                            <?php }
                            } ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    include_once('./footer.php')
?>
