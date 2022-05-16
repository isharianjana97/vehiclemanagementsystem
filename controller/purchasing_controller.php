<?php
include '../commons/sessions.php';
include '../model/purchasing_model.php';
include '../model/product_model.php';
$purchaingObj = new Purchasing();
$productObj = new Product();

if(!isset($_GET["status"]))
{    
   ?>
<script> window.location="../view/login.php"</script>
    <?php
}
else
{
    $status=$_GET["status"];
    
    switch ($status)
    {
        case "add_note":
         
            $reqdate=$_POST["req_date"];
            $note_id= $purchaingObj->addNote($reqdate);
            $_SESSION["note_id"]=$note_id;  //  we can access this value across pages
            ?>
                <div class="row">
                                <div class="col-md-5">
                                    <label class="control-label">Temporary Id: <?php echo $note_id;  ?></label>
                                </div>
                </div>
                <div class="row">
                    <div class="col-md-12">&nbsp;</div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label class="control-label">Select Product</label>
                        <?php
                            $productResult=$productObj->getAllProducts();    // calling the function
                        ?>
                        <select class="form-control" id="prid">
                            <?php
                                while($productrow=$productResult->fetch_assoc())
                                {
                            ?>
                            <option value="<?php echo $productrow["product_id"]  ?>"><?php echo ucwords($productrow["product_name"]);  ?> </option>    <!-- products -->
                            <?php
                                }
                            ?>
                        </select>
                        </div>    
                    </div>
                    <div class="col-md-3">
                          <div class="form-group">
                            <label class="control-label">Qty</label>   <!-- quantity -->
                        <input type="text" class="form-control" id="qty"/>
                          </div>
                    </div>
                    <div class="col-md-3">
                        <br/>
                        <button class="btn btn-success" id="btnaddnoteitem">
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                    </div>
                </div>



            <?php
        break;
        
        case "add_note_item":
            
            
        break;    
    
        case "addlocation":
            
            $location=$_POST["location"];
            
            $locationArray=  explode(",", $location);
            
            $lat=$locationArray[0];
           $long=$locationArray[1];
           
           $locationName=$_POST["location_name"];
           
           $purchaingObj->addLocation($locationName, $lat, $long);
           
           ?>
                <script> window.location="../view/maphandling.php"</script>
           <?php
            
           //  save in the system
            
            break;
        
        
    }
    
    
}
