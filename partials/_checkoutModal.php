<!-- Checkout Modal -->
<div class="modal fade" id="checkoutModal" tabindex="-1" role="dialog" aria-labelledby="checkoutModal" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="checkoutModal">Enter Your DETAILS:</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="partials/_manageCart.php" method="post">
                <div class="form-group">
                    <b><label for="skills">Skills:</label></b>
                    <input class="form-control" id="skills" name="skills" type="text" required minlength="3" maxlength="255" placeholder="e.g., Java, Management">
                </div>
                <div class="form-group">
                    <b><label for="language">Language:</label></b>
                    <input class="form-control" id="language" name="language" type="text" required minlength="3" maxlength="255" placeholder="e.g., English, Spanish">
                </div>
                <div class="form-group">
                    <b><label for="education">Education:</label></b>
                    <input class="form-control" id="education" name="education" type="text" required minlength="3" maxlength="255" placeholder="e.g., BSc Computer Science">
                </div>
                <div class="form-group">
                    <b><label for="experience">Experience (years):</label></b>
                    <input class="form-control" id="experience" name="experience" type="number" required min="0" max="50" placeholder="e.g., 5">
                </div>
                <div class="form-group">
                    <b><label for="address">Address:</label></b>
                    <input class="form-control" id="address" name="address" type="text" required minlength="3" maxlength="500" placeholder="1234 Main St">
                </div>
                <div class="form-group">
                    <b><label for="phone">Phone No:</label></b>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon">+91</span>
                        </div>
                        <input type="tel" class="form-control" id="phone" name="phone" required pattern="[0-9]{10}" maxlength="10" placeholder="xxxxxxxxxx">
                    </div>
                </div>
                <div class="form-group">
                    <b><label for="zipcode">Zip Code:</label></b>
                    <input type="text" class="form-control" id="zipcode" name="zipcode" required pattern="[0-9]{6}" maxlength="6" placeholder="xxxxxx">
                </div>
                <div class="form-group">
                    <b><label for="password">Password:</label></b>    
                    <input class="form-control" id="password" name="password" type="password" required minlength="4" maxlength="21" data-toggle="password" placeholder="Enter Password">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <input type="hidden" name="amount" value="<?php echo $totalPrice ?>">
                    <button type="submit" name="checkout" class="btn btn-success">Apply</button>
                </div>
            </form>
        </div>
        </div>
    </div>
</div>
