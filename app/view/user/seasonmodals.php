<!-- edit season header info -->
<div id="editSeasonHeaderModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Edit Season Details</h3>               
            </div>
            <div class="modal-body">  
                <?php foreach($getSeasonHeader as $seasonheader){?>
                <form role="form" id="updateseasonheaderform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="updateseasonheader" name="updateseasonheader" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                    <div class="form-group">
                        <label for="editseason">Season:</label>
                        <input type="text" class="form-control" id="editseason" name="editseason" placeholder="" value="<?php echo $seasonheader['regYear']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="editstartdate">Start Date:</label>
                        <input type="text" class="form-control" id="editstartdate" name="editstartdate" placeholder="" value="<?php echo $seasonheader['startDate1']; ?>" />
                    </div>
                    <div class="form-group">
                        <label for="editenddate">End Date:</label>
                        <input type="text" class="form-control" id="editenddate" name="editenddate" placeholder="" value="<?php echo $seasonheader['endDate1']; ?>" />
                    </div>
<!--                    <div class="form-group">
                        <label for="editprocurement">Procurement Amount:</label>
                        <input type="text" class="form-control" id="editprocurement" name="editprocurement" placeholder="" value="<?php echo $seasonheader['procurement']; ?>" />
                    </div>-->
                </form>  
                <?php } ?> 
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="updateSeason()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>

<!-- insert advance -->
<div id="InsertAdvanceModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-sm">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Upload Advance</h3>               
            </div>
            <div class="modal-body">  
                <?php foreach($getSeasonHeader as $seasonheader){?>
                <form role="form" id="InsertAdvanceform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="InsertAdvance" name="InsertAdvance" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>">                     
                    <div class="form-group">
                            <label for="editseason">Upload Advance CSV: *</label>
                            <input class="form-group" type="file" name="file" />
                    </div>
                </form>  
                <?php } ?> 
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="InsertAdvance()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>

<!-- Add districts -->
<div class="modal fade" id="addDistrictsModal" tabindex="-1" role="dialog" aria-labelledby="myModal" aria-hidden="true">
          <div class="modal-dialog modal-md">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="AddDistrictsTitle">Add NIS Districts</h4>
              </div>
              <div class="modal-body">                  
                    <form role="form" id="AddDistrictsform" enctype="multipart/form-data" onsubmit="return false">                        
                        <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                        <input type="hidden" id="AddDistricts" name="AddDistricts" >
                        <table id="exampleLstActivities" class="table table-striped table-bordered tblDistricts" cellspacing="0" width="100%"> 
                            <tr>
                                <th>Select</th>
                                <th>District</th>
                            </tr>
                        </table> 
                    </form>
              </div>
              <div class="modal-footer">
                    <button type="button" class='btn btn-danger deleteDistricts'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreDistricts'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddNISDistricts()">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
              </div>
            </div>
          </div>
        </div>

<!-- ADD MARKET CENTERS -->
<div id="addMarketCenterModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Add Market Centers</h3>               
            </div>
            <div class="modal-body">  
                <form role="form" id="addNewMarketCenterform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addNewMarketCenter" name="addNewMarketCenter" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="marketcentername">Market Center: *</label>
                            <input type="text" class="form-control" id="marketcentername" name="marketcentername" placeholder="Enter Market Center" />
                        </div>
<!--                        <div class="form-group">
                            <label for="mpa">MPA: *</label>
                            <input type="text" class="form-control" id="mpa" name="mpa" placeholder="Enter Market Procurement Amount" />
                        </div> -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editseason">Gacs File: *</label>
                            <input class="form-group" type="file" name="file" />
                        </div> 
                    </div>
                </div>
                </form>  
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="addNewMKC()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>


<!-- MAKE PURCHASES -->
<div id="addPurchasesModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Add Purchases</h3>               
            </div>
            <div class="modal-body">  
                <form role="form" id="addPurchaseform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addPurchase" name="addPurchase" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editseason">Upload Purchase Data CSV:</label>
                            <input class="form-group" type="file" name="file" />
                        </div> 
                    </div>
                </div>
                </form>  
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="addNewPurchase()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>

<!-- ADD SORTING DATA -->
<div id="addSortingModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Add Shelling Data</h3>               
            </div>
            <div class="modal-body">  
                <form role="form" id="addSortingform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addSorting" name="addSorting" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editseason">Upload Shelling Data CSV:</label>
                            <input class="form-group" type="file" name="file" />
                        </div> 
                    </div>
                </div>
                </form>  
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="addNewSorting()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>

<!-- DELETE PURCHASE -->
<div id="PurchaseDelete" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>DELETE MODAL</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="adduserform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="adduser" name="adduser" >
                    <div class="form-group">
                        <label for="cname1">USER ID:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">Names:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">Surname:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">Email:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                    <div class="form-group">
                        <label for="cname1">District:</label>
                        <input type="text" class="form-control" id="cname1" name="cname1" placeholder="Please enter the name of the activity" />
                    </div>
                </form>
            </div>                            
            <div class="modal-footer"> 
                <button class="btn btn-success" onclick="Adduser()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>

<!-- edit purchase -->
<div id="PurchaseEditModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Edit Purchase</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="editpurchaseform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="editpurchase" name="editpurchase" >
                <input type="hidden" id="editpurchaseid" name="editpurchaseid" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                <div class="nav-tabs-custom nav-pills-success">
                    <ul class="nav nav-tabs nav-pills-success">
                        <li class="active"><a href="#market" data-toggle="tab"><strong>Market Center</strong></a></li>
                        <li><a href="#farmer" data-toggle="tab"><strong>Farmer</strong></a></li>
                        <li><a href="#receiptheader" data-toggle="tab"><strong>Receipt</strong></a></li>
                        <li><a href="#receiptdetails" data-toggle="tab"><strong>Nuts</strong></a></li>
                    </ul>
                    <div class="tab-content"> 
                        <div class="tab-pane active" id="market"> 
                            <div class="form-group">
                                <label for="mkc">Market Center:</label>
                                <input type="text" class="form-control" id="mkc" name="mkc" />
                            </div>
                            <button class="btn btn-success" onclick="EditPurchaseMKC()">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                        </div>
                            <div class="tab-pane" id="farmer">
                               <div class="form-group">
                                <label for="cname1">Membership:</label>
                                <select id="selectMe" name="editfarmertype" class="form-control"  onchange="ShowHideDiv()"> 
                                    <option value="none">None</option>
                                    <option value="member">Member</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div id="option1" class="group">
                                    <label for="editfarmer">Farmer:</label>
                                    <input type="text" class="form-control" id="editfarmername" name="editfarmername"  />
                                    <label for="cname1">Gender:</label>
                                    <select id="farmergender" name="farmergender" class="form-control"> 
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                </div>
                                <div id="option2" class="group">
                                    <label for="mnumber">Member Number:</label>
                                    <input type="text" class="form-control" id="mnumber" name="mnumber"  />
                                </div>
                            </div>
                            <button class="btn btn-success" onclick="EditPurchaseF()">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                        </div>
                        <div class="tab-pane" id="receiptheader">
                            <div class="form-group">
                                <label for="receipt">Receipt:</label>
                                <input type="text" class="form-control" id="receipt" name="receipt" />
                            </div>
                            <div class="form-group">
                                <label for="rdate">Date:</label>
                                <input type="text" class="form-control" id="rdate" name="rdate"  />
                            </div>
                            <button class="btn btn-success" onclick="EditPurchaseR()">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                        </div>
                        <div class="tab-pane" id="receiptdetails">
                            <div class="form-group">
                                <label for="varietytype">Variety:</label>
                                <select id="varietytype" name="varietytype" class="form-control"> 
                                    <option value="CG7">CG7</option>
                                    <option value="CHALIM">CHALIM</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="qty">QTY:</label>
                                <input type="text" class="form-control" id="qty" name="qty" />
                            </div>
<!--                            <div class="form-group">
                                <label for="cum">Cum:</label>
                                <input type="text" class="form-control" id="cum" name="cum" />
                            </div>-->
                            <div class="form-group">
                                <label for="price">Price:</label>
                                <input type="text" class="form-control" id="price" name="price" />
                            </div>
                            <div class="form-group">
                                <label for="mwk">MWK:</label>
                                <input type="text" class="form-control" id="mwk" name="mwk" />
                            </div>
                            <button class="btn btn-success" onclick="EditPurchaseRD()">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>                            
<!--            <div class="modal-footer"> 
                <button class="btn btn-success" onclick="EditPurchase()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>-->
            </div>            
        </div>
    </div>

<!-- ADD CASUAL WORKER -->
<div id="addCasualWorkerModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Add Casual Worker</h3>               
            </div>
            <div class="modal-body">  
                <form role="form" id="addCasualWorkersform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="addCasualWorkers" name="addCasualWorkers" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                <div class="row">                    
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="editseason">Upload Casual Workers:</label>
                            <input class="form-group" type="file" name="file" />
                        </div> 
                    </div>
                </div>
                </form>  
            </div>                            
            <div class="modal-footer">                   
                <button class="btn btn-success" onclick="addNewCasualWorkers()">Save</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
            </div>
            </div>            
        </div>
    </div>

<!-- EDIT CASUAL WORKER -->
<div id="CasualWorkerEditModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-md">
        <!-- modal content -->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h3>Edit Casual Worker</h3><br>
            </div>
            <div class="modal-body">                                                           
                <form role="form" id="editWorkerform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="editWorker" name="editWorker" >
                <input type="hidden" id="editWorkerid" name="editWorkerid" >
                <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
                <div class="nav-tabs-custom nav-pills-success">
                    <ul class="nav nav-tabs nav-pills-success">
                        <li class="active"><a href="#casualworkertab" data-toggle="tab"><strong>Casual Worker Name</strong></a></li>
                        <li><a href="#warehousetab" data-toggle="tab"><strong>Warehouse</strong></a></li>
                    </ul>
                    <div class="tab-content"> 
                        <div class="tab-pane active" id="casualworkertab"> 
                            <div class="form-group">
                                <label for="editfname">First Name:</label>
                                <input type="text" class="form-control" id="editfname" name="editfname"  />
                            </div>
                            <div class="form-group">
                                <label for="editlname">Last Name:</label>
                                <input type="text" class="form-control" id="editlname" name="editlname"  />
                            </div>
                            <div class="form-group">
                                <label for="editgender">Gender:</label>
                                <select id="editgender" name="editgender" class="form-control"> 
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <button class="btn btn-success" onclick="EditCWinfo()">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                        </div>
                        <div class="tab-pane" id="warehousetab">
                            <div class="form-group">
                                <label for="mkc">Market Center:</label>
                                <select class="form-control" id="warehouseid" name="warehouseid">
                                <?php foreach ($lstWarehouses as $optionMemberList) { ;?>
                                   <option value="<?php echo $optionMemberList['warehouseid']; ?>"><?php echo $optionMemberList['fieldname']; ?></option>
                               <?php  } ;?>
                               </select>
                            </div>
                            <button class="btn btn-success" onclick="EditCWH()">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                        </div>
                    </div>
                </div>
                </form>
            </div>                            
            </div>            
        </div>
    </div>

<!-- EDIT CASUAL WORKER WAREHOUSE -->
<div id="CasualWorkerWHSModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Edit CASUAL WORKER Warehouse</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="editWarehouseCWform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="editWarehouseCW" name="editWarehouseCW" >
            <input type="hidden" id="editWarehouseCWID" name="editWarehouseCWID" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">Select Warehouse:</label>
                        <select class="form-control" id="whss" name="whss">
                        <?php foreach ($lstWarehouses as $optionMemberList) { ;?>
                           <option value="<?php echo $optionMemberList['warehouseid']; ?>"><?php echo $optionMemberList['fieldname']; ?></option>
                        <?php  } ;?>
                        </select>
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="editWarehouseCWs()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- ADD BUYER -->
<div id="addBuyersModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Add Buyers</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="addnewBuyersform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="addnewBuyers" name="addnewBuyers" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">Upload Buyers:</label>
                        <input class="form-group" type="file" name="file" />
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="addnewBuyersSeason()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- EDIT BUYER MKC -->
<div id="BuyerMKCModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Edit Buyer Market Center</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="editMKCBuyersform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="editMKCBuyers" name="editMKCBuyers" >
            <input type="hidden" id="editMKCBuyersID" name="editMKCBuyersID" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">Market Center:</label>
                        <select class="form-control" id="marketcs" name="marketcs">
                        <?php foreach ($lstmarketcs as $optionMemberList) { ;?>
                           <option value="<?php echo $optionMemberList['marketcenterid']; ?>"><?php echo $optionMemberList['fieldname']; ?></option>
                       <?php  } ;?>
                       </select>
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="editMKCbuyer()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>


<!-- ADD WAREHOUSE  -->
<div id="addWarehouseModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Add Warehouse</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="addnewWarehouseform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="addnewWarehouse" name="addnewWarehouse" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">Upload Warehouse:</label>
                        <input class="form-group" type="file" name="file" />
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="addnewWarehouseSeason()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- EDIT WAREHOUSE IPC -->
<div id="WarehouseIPCModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Edit Warehouse IPC</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="editWarehouseIPCform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="editWarehouseIPC" name="editWarehouseIPC" >
            <input type="hidden" id="editWarehouseIPCID" name="editWarehouseIPCID" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">IPCs:</label>
                        <select class="form-control" id="ipcss" name="ipcss">
                        <?php foreach ($lstIPCs as $optionMemberList) { ;?>
                           <option value="<?php echo $optionMemberList['IPCid']; ?>"><?php echo $optionMemberList['fieldname']; ?></option>
                       <?php  } ;?>
                       </select>
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="editWarehouseIPCs()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- EDIT WAREHOUSE -->
<div id="editWarehouseModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Edit Warehouse Name</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="editWarehouseNameform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="editWarehouseName" name="editWarehouseName" >
            <input type="hidden" id="editWarehouseNameID" name="editWarehouseNameID" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>">           
                <div class="form-group">
                    <label for="warehouseName">WAREHOUSE:</label>
                    <input type="text" class="form-control" id="warehouseName" name="warehouseName"  />
                </div>    
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="editWarehouseName()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- ADD GRADING -->
<div id="addGradingModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Add Sorting and Grading</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="addnewGradingDataform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="addnewGradingData" name="addnewGradingData" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">Upload Sorting and Grading Data:</label>
                        <input class="form-group" type="file" name="file" />
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="addnewGradingDatas()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- addDispatchModal -->
<div id="addDispatchModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-md">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Add Dispatch Trips</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="addnewDispatchDataform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="addnewDispatchData" name="addnewDispatchData" >
            <input type="hidden" id="seasonID" name="seasonID" value="<?php echo $id; ?>"> 
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="editseason">Upload Dispatch Data:</label>
                        <input class="form-group" type="file" name="file" />
                    </div> 
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="addnewDispatchDatas()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>

<!-- edit dispatch -->
<div id="editDispatchModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3>Edit Dispatch</h3>               
        </div>
        <div class="modal-body">  
            <form role="form" id="editDispatchform" enctype="multipart/form-data" onsubmit="return false">
            <input type="hidden" id="editDispatch" name="editDispatch" >
            <input type="text" id="editDispatchID" name="editDispatchID" >
            <input type="text" id="seasonID" name="seasonID" value="<?php echo $id; ?>">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="dateDispatch">Date:</label>
                    <input type="text" class="form-control" id="dateDispatch" name="dateDispatch"  />
                    </div> 
                    <div class="form-group">
                        <label for="departureDispatch">Departure:</label>
                        <select class="form-control" id="departureDispatch" name="departureDispatch">
                        <?php foreach ($DispatchLocations as $optionMemberList) { ;?>
                           <option value="<?php echo $optionMemberList['dispatchbuyersid']; ?>"><?php echo $optionMemberList['fieldname']; ?></option>
                       <?php  } ;?>
                       </select>
                    </div>
                    <div class="form-group">
                        <label for="destinationDispatch">Destination:</label>
                        <select class="form-control" id="destinationDispatch" name="destinationDispatch">
                        <?php foreach ($DispatchLocations as $optionMemberList) { ;?>
                           <option value="<?php echo $optionMemberList['dispatchbuyersid']; ?>"><?php echo $optionMemberList['fieldname']; ?></option>
                       <?php  } ;?>
                       </select>
                    </div>
                    <div class="form-group">
                    <label for="cg7Dispatch">CG7:</label>
                    <input type="text" class="form-control" id="cg7Dispatch" name="cg7Dispatch"  />
                    </div>
                    <div class="form-group">
                        <label for="chalimDispatch">CHALIM:</label>
                        <input type="text" class="form-control" id="chalimDispatch" name="chalimDispatch"  />
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                    <label for="confirmedDispatch">Confirmed:</label>
                    <select class="form-control" id="confirmedDispatch" name="confirmedDispatch">
                       <option value="1">YES</option>
                       <option value="0">NO</option>
                    </select>
                    </div>
                    <div class="form-group">
                        <label for="confirmedbyDispatch">Confirmed By:</label>
                        <input type="text" class="form-control" id="confirmedbyDispatch" name="confirmedbyDispatch"  />
                    </div>
                    <div class="form-group">
                        <label for="confirmeddateDispatch">Confirmed Date:</label>
                        <input type="text" class="form-control" id="confirmeddateDispatch" name="confirmeddateDispatch"  />
                    </div>
                    <div class="form-group">
                        <label for="statusDispatch">Status:</label>
                        <input type="text" class="form-control" id="statusDispatch" name="statusDispatch"  />
                    </div>
                    <div class="form-group">
                        <label for="notesDispatch">Notes:</label>
                        <input type="text" class="form-control" id="notesDispatch" name="notesDispatch"  />
                    </div>
                </div>
            </div>
            </form>  
        </div>                            
        <div class="modal-footer">                   
            <button class="btn btn-success" onclick="editDispatchTing()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
        </div>            
    </div>
</div>