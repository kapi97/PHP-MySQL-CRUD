<!DOCTYPE html>
<html>
    <head>
        <title>PHP CRUD</title>
        <script scr="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        
    </head>
    
    <body>
        
        <?php require_once 'process.php'; ?>
        
        <?php
        if (isset($_SESSION['message'])): ?>
        <div class="alert alert-<?=$_SESSION['msg_type']?>">
            
            <?php
                echo $_SESSION['message'];
                unset($_SESSION['message']);
             ?>
        </div>
        <?php endif ?>
        
        <div class="container">
        
        <?php
            $mysqli = new mysqli('localhost', 'root', 'root', 'telcrud') or die(mysqli_error($mysqli));
            $result = $mysqli->query("SELECT * FROM telephones") or die($mysqli->error);
            /*$result = $mysqli->query("SELECT * FROM brand INNER JOIN product ON brand.brand_id = product.brand_id
     
            INNER JOIN client ON product.product_id = client.product_id") or die($mysqli->error);*/
            //INNER JOIN client ON brand.brand_id = client.brand_id
        
        //pre_r($result);
        //lub
        //pre_r($result->fetch_assoc());
        ?>
        
        <div class="row justify-content-center">
            <table class="table">
                <thead>
                    <tr>
                        <th>Brand</th>
                        <th>Product</th>
                        <th>Client</th>
                        <th colspan="2">Action</th>
                    </tr>
                </thead>
            <?php
                while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['brand_name']; ?></td>
                    <td><?php echo $row['product_name']; ?></td>
                    <td><?php echo $row['client_name']; ?></td>
                    
                    <td>
                        <a href="index.php?edit=<?php echo $row['id']; ?>"
                           class="btn btn-info">Edit</a>
                        <a href="process.php?delete=<?php echo $row['id']; ?>"
                           class="btn btn-danger">Delete</a>
                    </td>
                </tr>
            <?php endwhile; ?>
            </table>
        </div>
        
        <?php
        
        function pre_r($array){
            echo '<pre>';
            print_r($array);
            echo '</pre>';
        }
        ?>
                
        
        <div class="row justify-content-center">
        <form action="process.php" method="POST">
            
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            
            <div class="form-group">
            <label>Brand name</label>
            <input type="text" name="brand_name" class="form-control" value="<?php echo $name; ?>" placeholder="Enter brand name">
            </div>
            
            <div class="form-group">
            <label>Product name</label>
            <input type="text" name="product_name" class="form-control" value="<?php echo $location; ?>" placeholder="Enter product name">
            </div>
            
            <div class="form-group">
            <label>Client name</label>
            <input type="text" name="client_name" class="form-control" value="<?php echo $location; ?>" placeholder="Enter client name">
            </div>
            
            <div class="form-group">
                
                <?php
                if ($update == false):
                ?>
                    <button type="submit" class="btn btn-info" name="update">Update</button>
                <?php else: ?>
            <button type="submit" class="btn btn-primary" name="save">Save</button>
                
                <?php endif; ?>
            </div>
        </form>
        </div>
        </div>
    </body>
</html>