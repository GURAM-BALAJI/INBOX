<!-- Add -->
<div class="modal fade" id="addnew">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Add New slogan</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="slogan_add.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="slogan_sentance" class="col-sm-3 control-label">Sentance</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control"  name="slogan_sentance" cols="50" rows="5" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i>
                    Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><b>Edit slogan</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="slogan_edit.php" enctype="multipart/form-data">
                    <input type="hidden" class="slogan_id" name="id">
                    <div class="form-group">
                        <label for="slogan_sentance" class="col-sm-3 control-label">Sentance</label>
                        <div class="col-sm-9">
                            <textarea type="text" class="form-control" id="slogan_sentance" name="slogan_sentance" cols="50" rows="5" required></textarea>
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                        class="fa fa-close"></i> Close</button>
                <button type="submit" class="btn btn-success btn-flat" name="edit"><i class="fa fa-check-square-o"></i>
                    Update</button>
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
                <form class="form-horizontal" method="POST" action="slogan_delete.php">
                    <input type="hidden" class="delete_slogan_id" name="id">
                    <div class="text-center">
                        <p>DELETE SLOGAN</p>
                        <h2 class="bold delete_slogan_sentance"></h2>
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


