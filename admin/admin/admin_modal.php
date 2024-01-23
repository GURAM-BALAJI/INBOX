<!-- Add -->
<div class="modal fade" id="addnew">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Add New admin</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="admin_add.php" enctype="multipart/form-data">

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Type</label>

            <div class="col-sm-9">
              <select class="form-control" id="type" name="type">
                <option value="1">Admin</option>
                <option value="2">Chef</option>
                <option value="3">Delivery</option>
              </select>
            </div>
          </div>

          <div class="form-group">
            <label for="name" class="col-sm-3 control-label">Name</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="name" name="name" required>
            </div>
          </div>

          <div class="form-group">
            <label for="contact" class="col-sm-3 control-label">Contact</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="contact" name="contact" required>
            </div>
          </div>

          <div class="form-group">
            <label for="address" class="col-sm-3 control-label">Address</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="address" name="address" required>
            </div>
          </div>

          <div class="form-group">
            <label for="password" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-9">
              <input type="password" class="form-control" id="password" name="password" required>
            </div>
          </div>



          <div class="modal-footer">
            <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
                class="fa fa-close"></i> Close</button>
            <button type="submit" class="btn btn-primary btn-flat" name="add"><i class="fa fa-save"></i> Save</button>
          </div>
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
        <h4 class="modal-title"><b>Edit admin</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="admin_edit.php">
          <input type="hidden" class="adminid" name="id">

          <div class="form-group">
            <label for="edit_name" class="col-sm-3 control-label">Name</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_name" name="name" required>
            </div>
          </div>

          <div class="form-group">
            <label for="edit_contact" class="col-sm-3 control-label">Contact Info</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_contact" name="contact" required>
            </div>
          </div>

          <div class="form-group">
            <label for="edit_address" class="col-sm-3 control-label">Address</label>

            <div class="col-sm-9">
              <input type="text" class="form-control" id="edit_address" name="address" required>
            </div>
          </div>

          <div class="form-group">
            <label for="edit_password" class="col-sm-3 control-label">Password</label>

            <div class="col-sm-9">
              <input type="password" class="form-control" id="edit_password" name="password" required>
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
        <form class="form-horizontal" method="POST" action="admin_delete.php">
          <input type="hidden" class="adminid" name="id">
          <div class="text-center">
            <p>DELETE ADMIN</p>
            <h2 class="bold fullname"></h2>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default btn-flat pull-left" data-dismiss="modal"><i
            class="fa fa-close"></i> Close</button>
        <button type="submit" class="btn btn-danger btn-flat" name="delete"><i class="fa fa-trash"></i> Delete</button>
        </form>
      </div>
    </div>
  </div>
</div>


<!-- Activate -->
<div class="modal fade" id="activate">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><b>Activating...</b></h4>
      </div>
      <div class="modal-body">
        <form class="form-horizontal" method="POST" action="admin_activate.php">
          <input type="hidden" class="adminid" name="id">
          <div class="text-center">
            <p>ACTIVATE ADMIN</p>
            <h2 class="bold fullname"></h2>
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
        <form class="form-horizontal" method="POST" action="admin_deactivate.php">
          <input type="hidden" class="adminid" name="id">
          <div class="text-center">
            <p>DEACTIVATE ADMIN</p>
            <h2 class="bold admin_name"></h2>
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