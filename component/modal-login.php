<!-- modal add user -->
<div class="modal fade" id="Modal-adduser" tabindex="-1" role="dialog" aria-labelledby="Model-adduser" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Created Account USER</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form class="modal-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="acc_email" name="acc_email" placeholder="Enter email" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">UserName</label>
                    <input type="text" class="form-control" id="acc_username" name="acc_username" placeholder="Enter UserName" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" class="form-control" id="acc_name" name="acc_name" placeholder="Enter Name" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Last Name</label>
                    <input type="text" class="form-control" id="acc_lastname" name="acc_lastname" placeholder="Enter LastName" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Password</label>
                    <input type="Password" class="form-control" id="acc_password" name="acc_password" placeholder="Enter Password" required>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Permissions</label>
                    <select class="form-control" id="acc_permission" name="acc_permission" required>
                    <option disabled selected value> -- select an Permissions -- </option>
                    <option value="0">Super Admin</option>
                    <option value="1">Admin</option>
                    <option value="2">Staff</option>
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="save">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>