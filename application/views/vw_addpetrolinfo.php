<br><br>
<center>
    <img src="<?php echo base_url('images\station.png') ?>" height="200" alt="logo"><p></p>
</center>
<div class="container">
    <form id="info" method="post">
        <select class="form-control" name="provider" id="provider" required>
            <option value="" selected>Select Station Type</option>
            <option value="Ceypetco">Ceypetco</option>
            <option value="Lanka IOC">Lanka IOC</option>
        </select><p></p>
        <input type="text" name="stationname" id="stationname" required class="form-control" placeholder="Petrol Station Name"><p></p>
        <input type="text" name="stationaddress" id="stationaddress" required class="form-control" placeholder="Petrol Station Address"><p></p>
        <select name="district" required id="district" class="form-control">
            <option value="" disabled selected>Select District</option>
        </select><p></p>
        <select name="town" required id="town" class="form-control">
            <option value="" disabled selected>Select Town</option>
        </select><p></p>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="Petrol Station Phone (Optional)"><p></p>
        <input type="date" name="date" id="date" required class="form-control" placeholder="Date"><p></p>
        <select class="form-control" name="base" id="base" required>
            <option value="" selected>Is petrol distribution based on Last number ?</option>
            <option value="yes">Yes</option>
            <option value="no">No</option>
        </select><p></p>
        <div id="vehiclenumber"></div>
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
    <br><br>
</div>
<script>
    $(document ).ready(function() {
        fetch("<?php echo base_url('cities/cities-and-postalcode-by-district-min.json') ?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
        .then(response => {
            if (response.status == 200) {return response.json();}
            else {console.log('Backend Error..!');console.log(response.text());}
        })
        .then(data => {
            if (Object.keys(data).length>0) {
                Object.keys(data).forEach(function(item){
                    var htmltext=`<option value="${item}">${item}</option>`;
                    $("#district").append(htmltext)
                });
            }
        })
        .catch((e) => {console.log(e);});
    });

    $(document).on("change","#district",(e)=>{
        $("#town").empty();
        fetch("<?php echo base_url('cities/cities-and-postalcode-by-district-min.json') ?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
        .then(response => {
            if (response.status == 200) {return response.json();}
            else {console.log('Backend Error..!');console.log(response.text());}
        })
        .then(data => {
            if (Object.keys(data).length>0) {
                data[$('#district').find(":selected").text()].forEach(function(item){
                    var htmltext=`<option value="${item.city}">${item.city}</option>`;
                    $("#town").append(htmltext)
                });
            }
        })
        .catch((e) => {console.log(e);});
    })

    $(document).on("change","#base",(e)=>{
        document.getElementById("vehiclenumber").innerHTML="";
        if($("#base").val()=="yes"){
            htmltext=`<input type="text" class="form-control" name="lastnumber" id="lastnumber" placeholder="Last number range"><p></p>`;
            $("#vehiclenumber").append(htmltext);
        }else{
            htmltext=`<input type="text" class="form-control" name="lastnumber" id="lastnumber" value="All" disabled><p></p>`;
            $("#vehiclenumber").append(htmltext);
        }
    });
    $(document).on("submit","#info",(e)=>{
            e.preventDefault();
            var toServer=new FormData();
            toServer.append('provider',$("#provider").val());
            toServer.append('stationname',$("#stationname").val());
            toServer.append('stationaddress',$("#stationaddress").val());
            toServer.append('phone',$("#phone").val());
            toServer.append('date',$("#date").val());
            toServer.append('base',$("#base").val());
            toServer.append('lastnumber',$("#lastnumber").val());
            toServer.append('district',$("#district").val());
            toServer.append('town',$("#town").val());
            fetch("<?php echo base_url('admin/addPetrolRecord');?>",{
                method:'POST',
                body: toServer,
                mode: 'no-cors',
                cache: 'no-cache'})
            .then(async response => {
                try {
                    const data = await response.json()
                    console.log('response data', data);
                    return data;
                }catch(err) {
                    console.log('Error happened here!')
                    console.error(err)
                }
            })
            .then(data => {
                alert(data.message);
            })
            .catch((e) => {
                console.log(e);
                alert(e);
            });
        })
</script>