<br><br>
<style>
    div{
        font-size: 20px;
    }
</style>
<div class="container">
    <center>
        <img src="<?php echo base_url('images\station.png') ?>" height="200" alt="logo"><p></p>
    </center>
    <div class="row">
        <div class="col-sm-12 p-2">
            <a href="<?php echo base_url('logout')?>" class="btn btn-outline-warning btn-lg form-control">
                <i class="fa-solid fa-right-from-bracket"></i> &nbsp;&nbsp;
                Logout
            </a> 
        </div>
    </div>
    <br>
    <div class="card border border-dark">
        <div class="card-header bg-info">
            Petrol available in your Town
        </div>
        <div class="card-body" id="#petrolavailabletown">

        </div>
    </div><br>
    <div class="card border border-dark">
        <div class="card-header bg-info">
            Petrol available in your District
        </div>
        <div class="card-body" id="#petrolavailabledistrict">

        </div>
    </div>
    <br><br>
</div>