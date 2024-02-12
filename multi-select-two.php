<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Form with Bootstrap Validator</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/css/bootstrapvalidator.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/habibmhamadi/multi-select-tag@2.0.1/dist/css/multi-select-tag.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <h2>Form with Bootstrap Validator</h2>
                <form id="myForm" class="form-horizontal" method="post">
                    <div class="form-group">
                        <label for="intendedUse" class="control-label">Intended use:</label>
                        <select id="intendedUse" name="intendedUse[]" class="form-control" multiple >
                            
                            <option value="test1">Test 1</option>
                            <option value="test2">Test 2</option>
                            <option value="test3">Test 3</option>
                        </select>
                        <!-- Error message container -->
                        <div class="help-block with-errors" id="intendedUseError"></div>
                    </div>


                    <div class="form-group">
                        <label for="manager_id" class="control-label">Manager Name:</label>
                        <select id="manager_id" name="manager_id[]" class="form-control" multiple >
                            
                            <option value="manger1">manger1 1</option>
                            <option value="manger2">manger 2</option>
                            <option value="manger3">manger 3</option>
                        </select>
                        <!-- Error message container -->
                        <div class="help-block with-errors" id="intendedUseError"></div>
                    </div>
                   
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.4.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js"></script>
    <script src="multi.js"></script>

    <script>
$(document).ready(function() {
    // Initialize multi-select tag
    new MultiSelectTag('intendedUse');
    new MultiSelectTag('manager_id');

    // Initialize Bootstrap Validator
    var validator = $('#myForm').bootstrapValidator({
        feedbackIcons: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            'intendedUse[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select at least one option'
                    }
                }   
            },
            'manager_id[]': {
                validators: {
                    notEmpty: {
                        message: 'Please select Manager Name'
                    }
                }   
            }
        }
    }).data('bootstrapValidator');

    // Function to validate both fields
    function validateFields(fieldId, errorMessageSelector) {
        var selectedOptions = $(fieldId).val();
        if (!selectedOptions || selectedOptions.length === 0) {
            // Show error message
            $(errorMessageSelector).show();
            $(fieldId).closest('.form-group').addClass('has-error');
            return false; // Field is not valid
        } else {
            // Hide error message
            $(errorMessageSelector).hide();
            $(fieldId).closest('.form-group').removeClass('has-error');
            return true; // Field is valid
        }
    }

    // On form submit, validate both fields
    $('#myForm').submit(function(event) {
        // Validate both fields
        var isValidIntendedUse = validateFields('#intendedUse', 'small[data-bv-validator-for="intendedUse[]"]');
        var isValidManagerId = validateFields('#manager_id', 'small[data-bv-validator-for="manager_id[]"]');
        
        // Return the overall validation result
        return isValidIntendedUse && isValidManagerId;
    });
});

    </script>
        

</body>
</html>
