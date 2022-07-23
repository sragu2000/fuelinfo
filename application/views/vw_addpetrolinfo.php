<br><br>
<center>
    <img src="<?php echo base_url('images\station.png') ?>" height="200" alt="logo"><p></p>
</center>
<div class="container">
    <form id="info" method="post">
        <select class="form-control" id="stationname" required>
            <option value="" selected>Select Station Type</option>
            <option value="ceypetco">Ceypetco</option>
            <option value="ceypetco">Lanka IOC</option>
        </select><p></p>
        <input type="text" id="stationaddress" required class="form-control" placeholder="Petrol Station Address Note"><p></p>
        <input type="date" id="date" required class="form-control" placeholder="Date"><p></p>
        <div class="form-control form-control-lg">
            <input type="checkbox" id="spagree" class="form-check-input" required> &nbsp;
            <span style="color: red;">
                I declare that, Following information is correct&nbsp;
            </span>
        </div>&nbsp;
        <div class="row">
            <div class="col-md-6 p-2">
                <input type="submit" class="btn btn-success btn-lg form-control">
            </div>
            <div class="col-md-6 p-2">
                <input type="reset" class="btn btn-warning btn-lg form-control">
            </div>
        </div>
    </form>
    <a href="<?php echo base_url('home'); ?>" class="btn btn-info form-control btn-lg">Back to Home Page</a>
</div>
