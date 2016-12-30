<div id="EditIPCModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 id="EditIPCModalTitle"></h3><br>
        </div>
        <div class="modal-body">                                                           
            <form role="form" id="updateIPCitemform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="updateIPCItem" name="updateIPCItem" >
                <input class="form-control" type="hidden" id="editid" name="editid" >
                <input class="form-control" type="hidden" id="editviewitem" name="editviewitem" >
                <input class="form-control" type="text" id="editviewname" name="editviewname" >
                <!--<input class="form-control" type="hidden" id="returnpathid" name="returnpathid" >-->
                <input type="hidden" id="returnpathid" name="returnpathid" value="<?php echo $id ?>" >
                <input type="hidden" id="ipcpage" name="ipcpage" value="<?php echo basename($_SERVER['PHP_SELF'], ".php"); ?>">
            </form>
        </div>                            
        <div class="modal-footer">
            <button class="btn btn-success" onclick="updateIPCitem()">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
    </div>            
    </div>
</div>


<div id="EditVillageModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-sm">
    <!-- modal content -->
    <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h3 id="EditVillageModalTitle"></h3><br>
        </div>
        <div class="modal-body">                                                           
            <form role="form" id="updateVillageform" enctype="multipart/form-data" onsubmit="return false">
                <input type="hidden" id="updateVillage" name="updateVillage" >
                <input class="form-control" type="hidden" id="editvillageid" name="editvillageid" >
                <label for="editvillagename">Village Name</label>                   
                <input class="form-control" type="text" id="editvillagename" name="editvillagename" >
                <label for="editviewhead">Village Head Man</label>
                <input class="form-control" type="text" id="editviewhead" name="editviewhead" >
            </form>
        </div>                            
        <div class="modal-footer">
            <button class="btn btn-success" onclick="updateVillage()">Update</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">close</button>
        </div>
    </div>            
    </div>
</div>