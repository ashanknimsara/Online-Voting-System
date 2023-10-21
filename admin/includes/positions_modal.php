<!DOCTYPE html>
<html>
<head>
    <!-- Include necessary CSS and JavaScript libraries here -->
</head>
<body>
    <!-- Add New Position Modal -->
    <div class="modal fade" id="addnew">
        <div class="modal-dialog">
            <div class="modal-content" style="background-color: #d8d1bd; color: black; font-size: 15px; font-family: Times">
                <div class="modal-header">
                    <button type="button" class="btn btn-close btn-curve pull-right" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <h4 class="modal-title"><b>Add New Position</b></h4>
                </div>
                <div class="modal-body">
                    <form class="form-horizontal" method="POST" action="positions_add.php" onsubmit="return validateForm()">
                        <div class="form-group">
                            <label for="description" class="col-sm-3 control-label">Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="description" name="description" required>
                                <div id="description-error" style="color: red;"></div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="max_vote" class="col-sm-3 control-label">Maximum Vote</label>
                            <div class="col-sm-9">
                                <input type="number" class="form-control" id="max_vote" name="max_vote" required>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-curve pull-left" style="background-color: #FFDEAD; color: black; font-size: 12px; font-family: Times" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-primary btn-curve" style="background-color: #9CD095; color: black; font-size: 12px; font-family: Times" name="add"><i class="fa fa-save"></i> Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

 <!-- Edit Position Modal -->
<div class="modal fade" id="edit">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #d8d1bd; color: black; font-size: 15px; font-family: Times">
            <div class="modal-header">
                <button type="button" class="btn btn-close btn-curve pull-right" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title"><b>Edit Position</b></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" method="POST" action="positions_edit.php" onsubmit="return validateFormEdit()">
                    <input type="hidden" class="id" name="id">
                    <div class="form-group">
                        <label for="edit_description" class="col-sm-3 control-label">Description</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="edit_description" name="description">
                            <div id="edit_description-error" style="color: red;"></div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="edit_max_vote" class="col-sm-3 control-label">Maximum Vote</label>
                        <div class="col-sm-9">
                            <input type="number" class="form-control" id="edit_max_vote" name="max_vote">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default btn-curve pull-left" style="background-color: #FFDEAD; color: black; font-size: 12px; font-family: Times" data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
                    <button type="submit" class="btn btn-success btn-curve" style="background-color: #9CD095; color: black; font-size: 12px; font-family: Times" name="edit"><i class="fa fa-check-square-o"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Delete -->
<div class="modal fade" id="delete">
    <div class="modal-dialog">
        <div class="modal-content" style="background-color: #d8d1bd ;color:black ; font-size: 15px; font-family:Times ">
            <div class="modal-header">
              <button type="button"class=" btn btn-close btn-curve pull-right"  data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><b>Deleting...</b></h4>
            </div>
            <div class="modal-body">
              <form class="form-horizontal" method="POST" action="positions_delete.php">
                <input type="hidden" class="id" name="id">
                <div class="text-center">
                    <p>DELETE POSITION</p>
                    <h2 class="bold description"></h2>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default btn-curve pull-left" style='background-color:  #FFDEAD ;color:black ; font-size: 12px; font-family:Times' data-dismiss="modal"><i class="fa fa-close"></i> Close</button>
              <button type="submit" class="btn btn-danger btn-curve" style='background-color: #ff8e88 ;color:black ; font-size: 12px; font-family:Times' name="delete"><i class="fa fa-trash"></i> Delete</button>
              </form>
            </div>
        </div>
    </div>
</div>


    <script>
        function validateForm() {
            var descriptionInput = document.getElementById("description");
            var descriptionError = document.getElementById("description-error");
            var descriptionValue = descriptionInput.value.trim();

            // Check if the description is empty or contains the "<script>" or <alert> tags
            if (descriptionValue === "" || descriptionValue.includes("<script>") || descriptionValue.includes("<alert>") || descriptionValue.includes("<")|| descriptionValue.includes(">") ) {
                descriptionError.textContent = "Please input a valid description.";
                return false; // Prevent form submission
            }

            // If the description is valid, clear any previous error message
            descriptionError.textContent = "";

            // Continue with form submission
            return true;
        }
        function validateFormEdit() {
        var editDescriptionInput = document.getElementById("edit_description");
        var editDescriptionError = document.getElementById("edit_description-error");
        var editDescriptionValue = editDescriptionInput.value.trim();

        // Check if the edit description is empty or contains the "<script>" tag
        if (editDescriptionValue === "" || editDescriptionValue.includes("<script>")) {
            editDescriptionError.textContent = "Please input a valid description.";
            return false; // Prevent form submission
        }

        // If the edit description is valid, clear any previous error message
        editDescriptionError.textContent = "";

        // Continue with form submission
        return true;
    }
    </script>
</body>
</html>

