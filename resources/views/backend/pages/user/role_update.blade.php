<!-- Add New Credit Card Modal -->
<div class="modal fade" id="upgradeRoleModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-simple modal-upgrade-role">
        <div class="modal-content p-3 p-md-5">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-4">
                    <h3>Upgrade Role</h3>
                    <p>Choose the best role for user.</p>
                </div>
                <div class="row g-3" >
                    <input type="hidden" name="userId" id="upgradeRoleModalUserId" value="">
                    <div class="col-sm-9">
                        <label class="form-label" for="chooseRole">Choose Role</label>
                        <select id="chooseRole" name="chooseRole" class="form-select" aria-label="Choose Role">
                        </select>
                    </div>
                    <div class="col-sm-3 d-flex align-items-end">
                        <button type="button" class="btn btn-primary" id="upgradeRoleBtn">Update</button>
                    </div>
                </div>
            </div>
            <hr class="mx-md-n5 mx-n3">
            <div class="modal-body">
                <h6 class="mb-0">You can set the role permission from <a href="{{route('admin.role.index')}}">Role Management</a></h6>
            </div>
        </div>
    </div>
</div>
<!--/ Add New Credit Card Modal -->
