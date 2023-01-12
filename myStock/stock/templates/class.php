<?php
session_start();
include 'connection.php';
$total = 0;
$TotalProfit = 0;
class KIDOTI{
	function login(){
        global $connect;
        
        $query =  $connect->prepare("SELECT * FROM tbl_user WHERE username = ? AND user_password = ?");

        $query->bind_param('ss',$username,$password);

        $username = $_POST['username'];
        $password = md5($_POST['password']);

        $query->execute();

        $result = $query->get_result();
        
        if(mysqli_num_rows($result) === 1){
            
            
            $row = mysqli_fetch_assoc($result);
            
            $dbusername = $row['username'];
            $dbuserID = $row['user_id'];
            $dbpassword = $row['user_password'];
            
            if($dbusername == $username && $dbpassword == $password){
                //session_start(); // SESSION START //
                $_SESSION['name'] = $row['fname']." ".$row['lname'];
                $_SESSION['id'] = $row['user_id'];
                $_SESSION['Privl'] = $row['privilage'];
                
               echo " <script>
                    window.location='dashboard.php';
                </script>";

            }else{
                return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-danger\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Incorrect username or password <i class='fa fa-warning'></i></strong></center>
                            </div>
                        </div>
                    </div>";
            }
        }else{
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-danger\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Incorrect username or password <i class='fa fa-warning'></i></strong></center>
                            </div>
                        </div>
                    </div>";
            }

    }

    function addUser(){
        global $connect;

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $userpassword = md5($_POST['password']);
        $privilage = $_POST['privilage'];

        $query =  $connect->prepare("INSERT INTO tbl_user(fname, lname, phone, email, username, user_password,privilage) VALUES (?,?,?,?,?,?,?)");
        $query->bind_param('sssssss',$fname, $lname, $phone, $email, $username, $userpassword,$privilage);

        $query->execute();

        if ($query->affected_rows >= 1) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> User successfull added <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-danger\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Sorry! user not added <i class='fa fa-danger'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }
        
    }

    function viewUser(){
        global $connect;
        
        $query =  $connect->prepare("SELECT * FROM tbl_user");
        $query->execute();

        $result = $query->get_result();

        if(mysqli_num_rows($result) >= 1){
            while ($row = $result->fetch_assoc()) {
              print "<tr>
                    <td>{$row['fname']} {$row['lname']}</td>
                    <td>".$row['email']."</td>
                    <td>".$row['phone']."</td>
                    <td>".$row['username']."</td>
                    <td>".$row['privilage']."</td>
                    <td>
                        <div class='dropdown'>
                            <a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
                                <i class='dw dw-more'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                <a class='dropdown-item' data-toggle='modal' data-target='#EditUser".$row['user_id']."' type='button'><i class='dw dw-edit2'></i> Edit</a>
                                <a class='dropdown-item' href='#'><i class='dw dw-eye'></i> View</a>
                                <!--<a class='dropdown-item' href='#'><i class='dw dw-delete-3'></i> Delete</a>-->
                            </div>
                        </div>
                    </td>";
                    echo "</tr>";
                    echo "
                        <!-- Modal Edit Product -->
                    <div class='col-md-4 col-sm-12 mb-30'>
                        <div class='modal fade' id='EditUser".$row['user_id']."' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title' style='color:#00f!important' id='myLargeModalLabel'>Edit User</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                </div>
                                <form method='post' action='#'>
                                    <div class='modal-body'>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>First Name: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='fname' type='text' value='".$row['fname']."' required>
                                                <input class='form-control' name='user_id' type='hidden' value='".$row['user_id']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Last Name: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='lname' type='text' value='".$row['lname']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Mobile: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='phone' type='text' value='".$row['phone']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Email: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='email' type='email' value='".$row['email']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>UserName: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='username' type='text' value='".$row['username']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Password: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='password' type='text' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Privilage: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <select class='custom-select col-12' name='privilage'>
                                                    <option value='".$row['privilage']."'>{$row['privilage']}</option>
                                                    <option value='Administrator'>Administrator</option>
                                                    <option value='Saler'>Saler</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <button type='submit' name='UpdateUser'  class='btn btn-primary'>Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    ";
            }
        }
        
    }

    function editUser(){
        global $connect;
        $user_id = $_POST['user_id'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $username = $_POST['username'];
        $userpassword = md5($_POST['password']);
        $privilage = $_POST['privilage'];

        $sql = "UPDATE tbl_user SET fname = '$fname',lname = '$lname',phone = '$phone',email = '$email',username = '$username',user_password = '$userpassword',privilage = '$privilage' WHERE user_id = '$user_id'";
        $result = $connect->query($sql) or die(mysqli_error($connect));
        if ($result == true) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> User Updated Successfull <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            echo "<script>alert('Data NOT Updated')</script>";
        }
    }

    function addProduct(){
        global $connect;

        $PrName = $_POST['Pname'];
        $Buyprice = $_POST['Buyprice'];
        $Saleprice = $_POST['Saleprice'];
        $quantity = $_POST['quantity'];
        $user_id = $_SESSION['id'];

        $sql = "SELECT * FROM tbl_product WHERE PrName = '$PrName'";
        $result = $connect->query($sql);
        if($result->num_rows > 0){
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-warning\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\">Sorry! This Product already exist <i class='fa fa-warning'></i></strong></center>
                            </div>
                        </div>
                    </div>";
            
        }else{
            $query =  $connect->prepare("INSERT INTO tbl_product(PrName,Buyprice,Saleprice,quantity, user_id) VALUES (?,?,?,?,?)");
            $query->bind_param('sssss',$PrName,$Buyprice,$Saleprice,$quantity, $user_id);

            $query->execute();

            if ($query->affected_rows >= 1) {
                return " <div id=\"ifr\">
                            <div class=\"col-md-12\">
                                <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                                    <center><strong class=\"\"> Product successfull added <i class='fa fa-check'></i></strong></center>
                                </div>
                            </div>
                        </div>";
            }else{
                return " <div id=\"ifr\">
                            <div class=\"col-md-12\">
                                <div class=\"alert alert-danger\" role=\"alert\" id=\"myAlert\">
                                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                        <span aria-hidden=\"true\">&times;</span>
                                    </button>
                                    <center><strong class=\"\"> Sorry! Sector not added <i class='fa fa-danger'></i></strong></center>
                                </div>
                            </div>
                        </div>";
            }
        }
        
    }

    function viewProduct(){
        global $connect;
        
        $query =  $connect->prepare("SELECT * FROM tbl_product");
        $query->execute();

        $result = $query->get_result();

        if(mysqli_num_rows($result) >= 1){
            while ($row = $result->fetch_assoc()) {
              print "<tr>";
                if($row['Quantity'] < 10){
                    echo"<td style='color:blue;font-weight:bold'>".$row['PrName']."</td>";
                }
                else{echo "<td>".$row['PrName']."</td>";}
                   echo" <td>".$row['Buyprice']."</td>
                    <td>".$row['Saleprice']."</td>
                    <td>".$row['Quantity']."</td>
                    <td>
                        <div class='dropdown'>
                            <a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
                                <i class='dw dw-more'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                <a class='dropdown-item' data-toggle='modal' data-target='#EditProduct".$row['PrID']."' type='button'><i class='dw dw-edit2'></i> Edit</a>
                                <!--<a class='dropdown-item' href='#'><i class='dw dw-delete-3'></i> Delete</a>-->
                            </div>
                        </div>
                    </td>";
                    echo "</tr>";
                    echo "
                        <!-- Modal Edit Product -->
                    <div class='col-md-4 col-sm-12 mb-30'>
                        <div class='modal fade' id='EditProduct".$row['PrID']."' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title' style='color:#00f!important' id='myLargeModalLabel'>Edit Product</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                </div>
                                <form method='post' action='#'>
                                    <div class='modal-body'>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Product Name: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='Pname' type='text' value='".$row['PrName']."' required>
                                                <input class='form-control' name='PrID' type='hidden' value='".$row['PrID']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Buy Price:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='Buyprice' value='".$row['Buyprice']."' min='1' type='number' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Sale Price:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='Saleprice' value='".$row['Saleprice']."' min='1' type='number' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Quantity:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' min='1' name='quantity' value='".$row['Quantity']."' type='number' required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <button type='submit' name='UpdateProduct'  class='btn btn-primary'>Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    ";
            }
        }
        
    }

    function selectProduct(){
        global $connect;
        
        $query =  $connect->prepare("SELECT * FROM tbl_product WHERE quantity > 1");

        $query->execute();

        $result = $query->get_result();

        if ($query->affected_rows >= 1) {
            while($row = $result->fetch_assoc()){
                echo"<option value='".$row['PrID']."'>{$row['PrName']}</option>";
            }
        } 
    }

    function LowStockProduct(){
        global $connect;
        
        $query =  $connect->prepare("SELECT * FROM tbl_product WHERE quantity < 10");

        $query->execute();

        $result = $query->get_result();

        if ($query->affected_rows >= 1) {
            while($row = $result->fetch_assoc()){
                echo "<li class='list-group-item d-flex justify-content-between align-items-center'>
                                    ".$row['PrName']."
                        <span class='badge badge-primary badge-pill'>".$row['Quantity']."</span>
                    </li>";
            }
        } 
    }

    function editProduct(){
        global $connect;
        $PID = $_POST['PrID'];
        $PrName = $_POST['Pname'];
        $Buyprice = $_POST['Buyprice'];
        $Saleprice = $_POST['Saleprice'];
        $quantity = $_POST['quantity'];

        $sql = "UPDATE tbl_product SET PrName = '$PrName',Buyprice = '$Buyprice',Saleprice = '$Saleprice',Quantity = '$quantity' WHERE PrID = '$PID'";
        $result = $connect->query($sql) or die(mysqli_error($connect));
        if ($result == true) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> The Product Updated Successfull <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            echo "<script>alert('Data NOT Updated')</script>";
        }
    }

    function salling($check){
        global $connect;

        $productID = $_POST['product'];
        $quantity = $_POST['quantity'];
        $saleDate = date('Y-m-d');
        $discount = 0;
        $CsID = 1;

        if(!empty($_POST['discount'])){
            $discount = $_POST['discount'];
        }
        //Select product to get the current quantity of it
        $query1 =  $connect->prepare("SELECT * FROM tbl_product WHERE PrID = '$productID'");
        $query1->execute();
        $result = $query1->get_result();
        $row = $result->fetch_assoc();

        $currentQuantity = $row['Quantity'];
        $remainQuantity = $currentQuantity - $quantity;

        //Update product quantity
        $query2 = $connect->prepare("UPDATE tbl_product SET Quantity = ? WHERE PrID = ?");
        $query2->bind_param('ss', $remainQuantity, $productID);
        $query2->execute();

        if($check != "customer"){
            $Payment = "Yes";
            $query =  $connect->prepare("INSERT INTO tbl_sale(PrID, CsID, SaleQuantity, Discount,payment, SaleDate) VALUES (?,?,?,?,?,?)");
            $query->bind_param('ssssss',$productID, $CsID, $quantity, $discount,$Payment, $saleDate);
        }else{
            $Payment = "No";
            $CsID = $_POST['CsID'];
            $query =  $connect->prepare("INSERT INTO tbl_sale(PrID, CsID, SaleQuantity, Discount,payment, SaleDate) VALUES (?,?,?,?,?,?)");
            $query->bind_param('ssssss',$productID, $CsID, $quantity, $discount,$Payment, $saleDate);
        }
        $query->execute();

        if ($query->affected_rows >= 1 && $query2 == true) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Successfull salling Product <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-danger\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Sorry! salling not complete <i class='fa fa-danger'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }
        
    }

    function viewSales($check,$id){
        global $connect;
        global $total;
        global $TotalProfit;
        if($check == "sales"){
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Buyprice) AS TotalBuy FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'Yes' GROUP BY tbl_product.PrName");
        }
        elseif ($check == "today") {
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Buyprice) AS TotalBuy FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'Yes' AND tbl_sale.SaleDate = CURRENT_DATE() GROUP BY tbl_product.PrName");
        }
        elseif ($check == "searchDate") {
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Buyprice) AS TotalBuy FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'Yes' AND tbl_sale.SaleDate = '$id' GROUP BY tbl_product.PrName");
        }
         elseif ($check == "searchMonth") {
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Buyprice) AS TotalBuy FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'Yes' AND MONTH(tbl_sale.SaleDate) = '$id' GROUP BY tbl_product.PrName");
        }
        else{
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantitySold,SUM(tbl_sale.Discount) AS TDiscount,tbl_product.Quantity AS Remain,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Buyprice) AS TotalBuy FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'No' AND tbl_sale.CsID = $id GROUP BY tbl_product.PrName");
        }
        $query->execute();

        $result = $query->get_result();

        if(mysqli_num_rows($result) >= 1){
            while ($row = $result->fetch_assoc()) {
                $TotalAmount = ($row['TotalAmount'])-($row['TDiscount']);
                $Profit = $TotalAmount-($row['TotalBuy']);
                $TotalProfit += $Profit;
                $total += $TotalAmount;
              print "<tr>
                    <td>".$row['PrName']."</td>
                    <td>".$row['QuantitySold']."</td>";
                    if($check != "customer"){
                        echo "<td>".$row['Remain']."</td>";}
                   echo " <td>".$TotalAmount."</td>
                          <td>".$Profit."</td>
                    <td>
                        <div class='dropdown'>
                            <a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
                                <i class='dw dw-more'></i>
                            </a>";
                            if($check == "customer"){
                                echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                <a class='dropdown-item' data-toggle='modal' data-target='#Payment".$row['PrID']."' type='button'><i class='dw dw-edit2'></i> Pay</a>
                            </div>";}
                            echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                <a class='dropdown-item' data-toggle='modal' data-target='#".$row['PrID']."' type='button'><i class='dw dw-edit2'></i> Edit</a>
                                </div>";
                       echo" </div>
                    </td>";
                    echo "</tr>";
                    echo "
                        <!-- Modal Edit Product -->
                    <div class='col-md-4 col-sm-12 mb-30'>
                        <div class='modal fade' id='Payment".$row['PrID']."' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title' style='color:#00f!important' id='myLargeModalLabel'>Are you sure want to Pay ".$row['PrName']."?</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                </div>
                                <form method='post' action='customer.php'>
                                    <div class='modal-body'>
                                        <div class='form-group row'>
                                        <input type='hidden' value='".$row['PrID']."' name='pId'/>
                                        <input type='hidden' value='".$row['CsID']."' name='cId'/>
                                            <h4>The Cost is: ".$TotalAmount."</h4>
                                        </div>
                                        
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>NO</button>
                                        <button type='submit' name='pay'  class='btn btn-primary'>YES</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>";
                    
            }
        }
        
    }

    function viewLoans($check){
        global $connect;
        global $total;
        if($check != "date"){
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantityLoan,SUM(tbl_sale.Discount) AS TDiscount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'No' AND tbl_sale.SaleDate = '$check' GROUP BY tbl_product.PrName");
        }
        else{
            $query =  $connect->prepare("SELECT tbl_sale.CsID,tbl_product.PrID,tbl_product.PrName,SUM(tbl_sale.SaleQuantity) AS QuantityLoan,SUM(tbl_sale.Discount) AS TDiscount,(SUM(tbl_sale.SaleQuantity)*tbl_product.Saleprice) AS TotalAmount FROM tbl_product INNER JOIN tbl_sale USING(PrID) WHERE tbl_sale.payment = 'No' GROUP BY tbl_product.PrName");
        }
        $query->execute();

        $result = $query->get_result();

        if(mysqli_num_rows($result) >= 1){
            while ($row = $result->fetch_assoc()) {
                $TotalAmount = ($row['TotalAmount'])-($row['TDiscount']);
                $total += $TotalAmount;
              print "<tr>
                    <td>".$row['PrName']."</td>
                    <td>".$row['QuantityLoan']."</td>";
                   echo " <td>".$TotalAmount."</td>
                    <td>
                        <div class='dropdown'>
                            <a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
                                <i class='dw dw-more'></i>
                            </a>";
                            echo "<div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                <a class='dropdown-item' data-toggle='modal' data-target='#".$row['PrID']."' type='button'><i class='dw dw-edit2'></i> Edit</a>
                                </div>";
                       echo" </div>
                    </td>";
                    echo "</tr>";
                    
            }
        }
        
    }

    function Payment(){
        global $connect;
        $PID = $_POST['pId'];
        $CID = $_POST['cId'];

        $sql = "UPDATE tbl_sale SET payment = 'Yes' WHERE PrID = '$PID' AND CsID = '$CID'";
        $result = $connect->query($sql) or die(mysqli_error($connect));
        if ($result == true) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> The Product Paid Successfull <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            echo "<script>alert('Data NOT Updated')</script>";
        }
    }

    function addCustomer(){
        global $connect;

        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $query =  $connect->prepare("INSERT INTO tbl_customer(fname, lname,gender,address,phone) VALUES (?,?,?,?,?)");
        $query->bind_param('sssss',$fname, $lname,$gender, $address, $phone);

        $query->execute();

        if ($query->affected_rows >= 1) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Customer successfull added <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-danger\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> Sorry! user not added <i class='fa fa-danger'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }
        
    }

    function viewCustomer(){
        global $connect;
        
        $query =  $connect->prepare("SELECT * FROM tbl_customer INNER JOIN tbl_sale USING(CsID) WHERE CsID != 1 GROUP BY tbl_Sale.CsID");
        $query->execute();

        $result = $query->get_result();

        if(mysqli_num_rows($result) >= 1){
            while ($row = $result->fetch_assoc()) {
              print "<tr>
                    <td>{$row['fname']} {$row['lname']}</td>
                    <td>".$row['gender']."</td>
                    <td>".$row['address']."</td>
                    <td>".$row['phone']."</td>";
                    $query1 =  $connect->prepare("SELECT * FROM tbl_customer INNER JOIN tbl_sale USING(CsID) WHERE CsID != 1 AND tbl_sale.CsID = ".$row['CsID']." AND tbl_sale.payment = 'No'");
                    $query1->execute();
                    $result1 = $query1->get_result();
                    if(mysqli_num_rows($result1) > 0){
                       echo "<td style='color:#f00'>Not Pay</td>";
                    }else{
                       echo "<td style='color:#0f0'>Paid</td>";
                    }
                    echo"<td>
                        <div class='dropdown'>
                            <a class='btn btn-link font-24 p-0 line-height-1 no-arrow dropdown-toggle' href='#' role='button' data-toggle='dropdown'>
                                <i class='dw dw-more'></i>
                            </a>
                            <div class='dropdown-menu dropdown-menu-right dropdown-menu-icon-list'>
                                <a class='dropdown-item' href='customerDetails.php?id=".$row['CsID']."&n={$row['fname']} {$row['lname']}'><i class='dw dw-eye'></i> View</a>
                                <a class='dropdown-item' data-toggle='modal' data-target='#EditCustomer".$row['CsID']."' type='button'><i class='dw dw-edit2'></i> Edit</a>
                                <a class='dropdown-item' href='#'><i class='dw dw-delete-3'></i> Delete</a>
                            </div>
                        </div>
                    </td>";
                    echo "</tr>";
                    echo "
                        <!-- Modal Edit Product -->
                    <div class='col-md-4 col-sm-12 mb-30'>
                        <div class='modal fade' id='EditCustomer".$row['CsID']."' tabindex='-1' role='dialog' aria-labelledby='myLargeModalLabel' aria-hidden='true'>
                        <div class='modal-dialog modal-dialog-centered'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h4 class='modal-title' style='color:#00f!important' id='myLargeModalLabel'>Edit Customer</h4>
                                    <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>×</button>
                                </div>
                                <form method='post' action='customer.php'>
                                    <div class='modal-body'>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>First Name: </label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='fname' type='text' placeholder='First Name Here' value='".$row['fname']."' required>
                                                <input class='form-control' name='CsID' type='hidden' value='".$row['CsID']."'>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Last Name:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='lname' placeholder='Last Name Here' type='text' value='".$row['lname']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Gender:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <select class='custom-select col-12' name='gender'>
                                                    <option value='Male'>Male</option>
                                                    <option value='Female'>Female</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Address:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='address' placeholder='Address Here' type='text' value='".$row['address']."' required>
                                            </div>
                                        </div>
                                        <div class='form-group row'>
                                            <label class='col-sm-12 col-md-2 col-form-label'>Mobile:</label>
                                            <div class='col-sm-12 col-md-10'>
                                                <input class='form-control' name='phone' type='tel' value='".$row['phone']."' required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-secondary' data-dismiss='modal'>Close</button>
                                        <button type='submit' name='updateCustomer'  class='btn btn-primary'>Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    </div>
                    ";
            }
        }
        
    }

    function editCustomer(){
        global $connect;
        $CsID = $_POST['CsID'];
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $gender = $_POST['gender'];
        $address = $_POST['address'];
        $phone = $_POST['phone'];

        $sql = "UPDATE tbl_customer SET fname = '$fname',lname = '$lname',gender = '$gender',address = '$address',phone = '$phone' WHERE CsID = '$CsID'";
        $result = $connect->query($sql) or die(mysqli_error($connect));
        if ($result == true) {
            return " <div id=\"ifr\">
                        <div class=\"col-md-12\">
                            <div class=\"alert alert-info\" role=\"alert\" id=\"myAlert\">
                                <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-label=\"Close\">
                                    <span aria-hidden=\"true\">&times;</span>
                                </button>
                                <center><strong class=\"\"> The Customer Updated Successfull <i class='fa fa-check'></i></strong></center>
                            </div>
                        </div>
                    </div>";
        }else{
            echo "<script>alert('Data NOT Updated')</script>";
        }
    }


}