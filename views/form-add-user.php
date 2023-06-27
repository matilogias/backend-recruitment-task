<!-- form to add user -->
<!-- Name input | Username input | Email input | Address input | Phone Input | Company Input -->
<form action="index.php?controller=site&action=add" method="post">
    <input type="hidden" name="submit" value="1">
    <div class="form-group">
        <label for="name">Name</label>
        <input type="text" name="name" placeholder="Name" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" placeholder="Email" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="street">Street</label>
        <input type="text" name="street" placeholder="Street" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="suite">Suite</label>
        <input type="text" name="suite" placeholder="Suite" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="city">City</label>
        <input type="text" name="city" placeholder="City" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="zipcode">Zipcode</label>
        <input type="text" name="zipcode" placeholder="Zipcode" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="lat">Latitude</label>
        <input type="text" name="lat" placeholder="Latitude" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="lng">Longitude</label>
        <input type="text" name="lng" placeholder="Longitude" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="phone">Phone</label>
        <input type="text" name="phone" placeholder="Phone" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="website">Website</label>
        <input type="text" name="website" placeholder="Website" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="company">Company</label>
        <input type="text" name="company" placeholder="Company" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="catchPhrase">Catch Phrase</label>
        <input type="text" name="catchPhrase" placeholder="Catch Phrase" class="form-control" required>
    </div>
    <div class="form-group">
        <label for="bs">BS</label>
        <input type="text" name="bs" placeholder="BS" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Add User</button>
</form>