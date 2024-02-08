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
                        <label for="Category" class="col-sm-3 control-label">Non-Veg/Veg</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="Category" name="Category" required>
                                <option value="">Select Non-Veg/Veg</option>
                                <option value="0">Veg</option>
                                <option value="1">Non-veg</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="meal_type" class="col-sm-3 control-label">Category</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="meal_type" name="meal_type" required>
                                <option value="" required>Select Category</option>
                                <?php
                                $stmt = $conn->prepare("SELECT category_id, category_name FROM category WHERE category_delete=0");
                                $stmt->execute();
                                foreach ($stmt as $row) {
                                    echo "<option value=" . $row['category_id'] . ">" . $row['category_name'] . "</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="item_name" class="col-sm-3 control-label">Item Name</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="item_name" name="item_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="photo" class="col-sm-3 control-label">Item Photo</label>
                        <div class="col-sm-9">
                            <input type="file" id="photo" name="photo" accept="image/*" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="amount" class="col-sm-3 control-label">Price</label>

                        <div class="col-sm-9">
                            <input type="number" step="any" class="form-control" id="amount" name="amount" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                                class="fa fa-close"></i> Close</button>
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
                        <p>You can see this item in Menu</p>
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
                        <p>You can't see this item in Menu</p>
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

<!--Update Price-->
<div class="modal fade" id="offer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Update Price</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="items_offer.php">
                    <input type="hidden" class="itemofferid" name="id">
                    <div class="form-group">
                        <label for="offer" class="col-sm-3 control-label">Update Price</label>
                        <div class="col-sm-9">
                            <input type="number" step="any" class="form-control offer" id="offer" name="offer" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="addoffer"><i class="fa fa-check"></i>
                    Save</button>
                </form>
            </div>
        </div>
    </div>
</div>