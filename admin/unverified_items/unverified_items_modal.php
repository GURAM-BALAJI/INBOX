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
                <form class="form-horizontal" method="POST" action="unverified_items_delete.php">
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

<!--Approving item-->
<div class="modal fade" id="offer">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Approving Item..</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="unverified_items_offer.php">
                    <input type="hidden" class="itemofferid" name="id">
                    <div class="form-group">
                        <label for="offer" class="col-sm-3 control-label">Update Cost</label>
                        <div class="col-sm-9">
                            <input type="number" step="any" class="form-control offer" id="offer" name="offer" required>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="addoffer"><i class="fa fa-check"></i>
                    Approved</button>
                </form>
            </div>
        </div>
    </div>
</div>