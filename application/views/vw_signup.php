<div class="container">
    <!-- signup start -->
    <br>
    <form id="signup" method="post">
        <div class="card border-dark">
            <!-- card header -->
            <div class="card-header  form-control-lg">
                <strong><center>SignUp</center></strong>
            </div>
            <!-- card body -->
            <div class="card-body">
                <input type="text" class="form-control-lg form-control rounded-3" required placeholder="First Name" id="fname"> &nbsp;
                <input type="text" class="form-control-lg form-control rounded-3" required placeholder="Last Name" id="lname"> &nbsp;
                <select name="district" required id="district" class="form-control-lg form-control rounded-3">
                    <option value="" disabled selected>Select your District</option>
                </select>&nbsp;
                <select name="town" required id="town" class="form-control-lg form-control rounded-3">
                    <option value="" disabled selected>Select your Town</option>
                </select>&nbsp;
                <input type="email" class="form-control-lg form-control rounded-3" required placeholder="Email"id="email">&nbsp;
                <input type="password" class="form-control-lg form-control rounded-3" required placeholder="Password" id="password">&nbsp;
                <div class="row">
                    <div class="col-12">
                        <div class="form-control form-control-lg">
                            <input type="checkbox" id="spagree" class="form-check-input" required> &nbsp;
                            I agree <a href="#">Terms and Conditions</a>
                        </div>&nbsp;
                        <hr>
                    </div>
                </div>
                <div class="row">
                    <!--Button Set-->
                    <div class="col-6"><button type="submit"
                            class="btn btn-outline-success btn-lg form-control">Submit</button></div>
                    <div class="col-6"><button type="reset"
                            class="btn btn-outline-danger btn-lg form-control">Clear</button></div>
                </div>
            </div>
        </div>
    </form>
    <!-- signup end -->
    <br>
    <a href="<?php echo base_url('/login');?>" class="btn form-control btn-lg btn-outline-primary">Login
        here</a>
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
    $(document).on("submit","#signup",(e)=>{
        e.preventDefault();
        var toServer=new FormData();
        toServer.append('firstname',$("#fname").val());
        toServer.append('lastname',$("#lname").val());
        toServer.append('district',$("#district").val());
        toServer.append('town',$("#town").val());
        toServer.append('email',$("#email").val());
        toServer.append('password',$("#password").val());
        fetch("<?php echo base_url('signup/addnewuser');?>",{
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
            if(data.result==true){
                alert("Signup Success. You can Login Now");
                if(data.url==null){
                    location.href="<?php echo base_url('login'); ?>";
                }else{
                    location.href=data.url;
                }
            }else{
                alert(data.message);
            }
        })
        .catch((e) => {
            console.log(e);
            alert("Reloading");
        });
    })
</script>
