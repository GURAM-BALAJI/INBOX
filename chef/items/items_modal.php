<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New Items</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="items_add.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="Category" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="Category" name="Category" required>
                                <option value="">Select Category</option>
                                <option value="0">Veg</option>
                                <option value="1">Non-veg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meal_type" class="col-sm-3 control-label">Meal type</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="meal_type" name="meal_type" required>
                            <option value="">Select Meal type</option>
                                <option value="1">Breakfast</option>
                                <option value="2">Lunch</option>
                                <option value="3">Dinner</option>
                                <option value="4">Singles</option>
                                <option value="5">Snacks</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item_name" class="col-sm-3 control-label">Item_Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="item_name" name="item_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" accept="image/*">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Amount</label>

                        <div class="col-sm-9">
                            <input type="number" step="any" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>
                  
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                        <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i>
                            Add</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="items_delete.php">
                    <input type="hidden" class="catid" name="id">
                    <div class="text-center">
                        <p>DELETE ITEM</p>
                        <h2 class="bold itemname"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i>
                    Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!--active-->
<div class="modal fade" id="activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Activating...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="items_activate.php">
                    <input type="hidden" class="itemstatus1" name="id">
                    <div class="text-center">
                        <p>ACTIVATE ITEM</p>
                        <h2 class="bold itemname1"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="activate"><i class="fa fa-check"></i>
                    Activate</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Not Activate -->
<div class="modal fade" id="not_activate">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Deactivating...</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="items_deactivate.php">
                    <input type="hidden" class="itemstatus2" name="id">
                    <div class="text-center">
                        <p>DEACTIVATE ITEM</p>
                        <h2 class="bold itemname2"></h2>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="deactivate"><i class="fa fa-check"></i>
                    Deactivate</button>
                </form>
            </div>
        </div>
    </div>
</div>
