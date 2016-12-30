    <!-- ADD IPC ITEM -->
    <div id="AddFarmProduceItemModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>ADD ITEM(S)</h3>                   
                </div>
                <div class="modal-body">                                        
                    <form role="form" id="addFarmProduceBulkform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addFarmProduceBulk" name="addFarmProduceBulk" >                        
                        <div class="row">                       
                        <div class="col-lg-12"> 
                            <div class="form-group">
                                <input class="form-group" type="file" name="file" id="file" />
                            </div> 
                        </div>
<!--                        <div class="col-sm-4">
                           <input class="btn btn-default" type="submit" name="uploadBulkIPCs" value="upload" /> 
                        </div>-->
                        </div>                      
                    </form>                   
                                       
                </div>                            
                <div class="modal-footer">                   
<!--                    <button type="button" class='btn btn-danger deleteipc'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreipc'>+ Add More</button> -->
                    <button class="btn btn-success" onclick="Additems()">Save</button>
                    <!--<input class="btn btn-success" type="submit" name="uploadBulkIPCs" value="upload" />-->        
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD IPC ITEM -->
    
    
    
    <div id="EditFarmProduceModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 id="EditFarmProduceModalTitle"></h3><br>
        </div>
        <div class="modal-body">                                                           
            <form role="form" id="updateFarmProduceitemform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="updateFarmProduceitem" name="updateFarmProduceitem" >
                <input class="form-control" type="hidden" id="editid" name="editid" >
                <input class="form-control" type="hidden" id="viewcode" name="viewcode" >
                <input class="form-control" type="text" id="viewname" name="viewname" >
            </form>
        </div>                            
        <div class="modal-footer">
            <button class="btn btn-success" onclick="updateFarmProduceitem()">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
    </div>            
    </div>
</div> 