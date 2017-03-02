    <!-- ADD ORIGINAL IPC ITEM -->
<!--    <div id="AddIPCItemModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
             modal content 
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>ADD ITEM</h3>                   
                </div>
                <div class="modal-body">                                        
                    <form role="form" id="addIPCItemsBulkform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addIPCItemsBulk" name="addIPCItemsBulk" >
                        <input type="hidden" id="returnpathid" name="returnpathid" value="<?php// echo $id ?>" >
                        <input type="hidden" id="ipcpage" name="ipcpage" value="<?php //echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
                        <div class="row">
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <select class="form-control" id="Ipcitem" name="Ipcitem">
                                    <option value="NONE">-- SELECT ITEM --</option>
                                    <option value="2">IPC</option>
                                    <option value="3">ASSOCIATION</option>
                                    <option value="4">GAC</option>
                                    <option value="5">CLUB</option>
                                </select>
                            </div> 
                        </div>
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <input class="form-group" type="file" name="file" id="file" />
                            </div> 
                        </div>
                        <div class="col-sm-4">
                           <input class="btn btn-default" type="submit" name="uploadBulkIPCs" value="upload" /> 
                        </div>
                        </div>                      
                    </form>                   
                                       
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteipc'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreipc'>+ Add More</button> 
                    <button class="btn btn-success" onclick="Addipcs()">Save</button>
                    <input class="btn btn-success" type="submit" name="uploadBulkIPCs" value="upload" />        
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>-->
    <!-- END ADD IPC ITEM -->
    
    <!-- MODAL ALERT -->
    
    


    <!-- ADD CLUBS ITEM -->
<!--    <div id="AddClubModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
             modal content 
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h3>ADD CLUBS</h3><hr>
                    <form role="form" id="addClubsBulkform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addIPCItemsBulk" name="addIPCItemsBulk" >
                        <input type="hidden" id="returnpathid" name="returnpathid" value="<?php// echo $id ?>" >
                        <input type="hidden" id="ipcpage" name="ipcpage" value="<?php //echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
                        <input type="hidden" id="Ipcitem" name="Ipcitem" value="5">
                        <div class="row">
                        
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <input class="form-group" type="file" name="clubfile" id="clubfile" />
                            </div> 
                        </div>
                        <div class="col-sm-4">
                           <button class="btn btn-success" onclick="uploadClubs()">Save</button>
                        </div>
                        </div>                      
                    </form>  
                    
                </div>
                <div class="modal-body">                                        
                                     
                                       
                </div>                            
                <div class="modal-footer">                   
                    <button type="button" class='btn btn-danger deleteipc'>- Delete</button>
                    <button type="button" class='btn btn-success addmoreipc'>+ Add More</button> 
                    <button class="btn btn-success" onclick="AddClubs()">Save</button>
                    <input class="btn btn-success" type="submit" name="uploadBulkIPCs" value="upload" />        
                    <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
                </div>
                </div>            
            </div>
        </div>-->
    <!-- END ADD CLUBS ITEM -->
    
    <!-- ADD IPC ITEM -->
    <div id="AddIPCItemModal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-md">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
                    <h3>ADD ITEM</h3>      
                    <?php }else{?>
                    <h3>ADD CLUB(S)</h3>
                    <?php } ?>
                </div>
                <div class="modal-body">                                        
                    <form role="form" id="addIPCItemsBulkform" onsubmit="return false" enctype="multipart/form-data" class="form-inline center-block">
                        <input type="hidden" id="addIPCItemsBulk" name="addIPCItemsBulk" >
                        <input type="hidden" id="returnpathid" name="returnpathid" value="<?php echo $id ?>" >
                        <input type="hidden" id="ipcpage" name="ipcpage" value="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
                        <div class="row">
                            <?php if($_SESSION['nasfam_usertype'] == '1'){ ?>
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <select class="form-control" id="Ipcitem" name="Ipcitem">
                                    <option value="NONE">-- SELECT ITEM --</option>
                                    <option value="2">IPC</option>
                                    <option value="3">ASSOCIATION</option>
                                    <option value="4">GAC</option>
                                    <option value="5">CLUB</option>
                                </select>
                            </div> 
                        </div>
                            <?php }else{ ?>
                            <input type="hidden" id="Ipcitem" name="Ipcitem" value="5" >
                            
                            <?php } ?>
                        <div class="col-sm-4"> 
                            <div class="form-group">
                                <input class="form-group" type="file" name="file" id="file" />
                            </div> 
                        </div>
<!--                        <div class="col-sm-4">
                           <button class="btn btn-success" onclick="Addipcs()">Save</button> 
                        </div>-->
                        </div>                      
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
    
        <div id="AlertModal" class="modal fade" role="dialog" >
            <div class="modal-dialog modal-md modal-warning">
            <!-- modal content -->
            <div class="modal-content">
                <div class="modal-body">                                        
                    <P>
                        PLEASE SELECT AN ITEM
                    </P>                
                       <!--<button type="button" class="btn btn-default" data-dismiss="modal">close</button>-->                
                </div>                            
                </div>            
            </div>
        </div>
    <!-- END MODAL ALERT -->