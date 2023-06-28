<form action="index.php?controller=site&action=add" method="post">
    <input type="hidden" name="submit" value="1">
    <h4>Basic information</h4>
    <div class="form-group">
        <label for="name" class="required-label">Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="username" class="required-label">Username</label>
        <input type="text" name="username" placeholder="Username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email" class="required-label">Email</label>
        <input type="text" name="email" placeholder="Email" class="form-control email-validate" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" placeholder="Phone" class="form-control">
    </div>
    <div class="form-group">
        <label for="website">Website</label>
        <input type="text" name="website" placeholder="Website" class="form-control">
    </div>
    <div class="row">
        <!-- two columns for pc one for mobile -->
        <div class="col-md-6">
            <h4>Address</h4>
            <div class="form-group">
                <label for="street">Street</label>
                <input type="text" name="street" placeholder="Street" class="form-control">
            </div>
            <div class="form-group">
                <label for="suite">Suite</label>
                <input type="text" name="suite" placeholder="Suite" class="form-control">
            </div>
            <div class="form-group">
                <label for="city" class="required-label">City</label>
                <input type="text" name="city" placeholder="City" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="zipcode">Zipcode</label>
                <input type="text" name="zipcode" placeholder="Zipcode" class="form-control">
            </div>
            <div class="form-group">
                <label for="lat">Latitude</label>
                <input type="text" name="lat" placeholder="Latitude" class="form-control">
            </div>
            <div class="form-group">
                <label for="lng">Longitude</label>
                <input type="text" name="lng" placeholder="Longitude" class="form-control">
            </div>
        </div>
        <div class="col-md-6">
            <h4>Company</h4>
            <div class="form-group">
                <label for="companyName">Name</label>
                <input type="text" name="companyName" placeholder="Company" class="form-control">
            </div>
            <div class="form-group">
                <label for="catchPhrase">Catch Phrase</label>
                <input type="text" name="catchPhrase" placeholder="Catch Phrase" class="form-control">
            </div>
            <div class="form-group">
                <label for="bs">BS</label>
                <input type="text" name="bs" placeholder="BS" class="form-control">
            </div>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Add User</button>
</form>