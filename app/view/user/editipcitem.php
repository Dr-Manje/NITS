<!-- ADD IPC ITEM -->
    <div id="EditIPCModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>EDIT ITEM</h3>                   
                </div>
                <div class="modal-body">                                        
                    <form role="form" id="addIPCItemsBulkform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addIPCItemsBulk" name="addIPCItemsBulk" >
                                              
                    </form>                   
                                       
                </div>                            
                <div class="modal-footer">                   
<!--                    <button type="button" class='btn btn-danger deleteipc'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreipc'>+ Add More</button> -->
                    <button class="btn btn-success" onclick="Addipcs()">Save</button>
                    <!--<input class="btn btn-success" type="submit" name="uploadBulkIPCs" value="upload" />-->        
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>
    <!-- END ADD IPC ITEM -->