<br><br>
<style>
    div {
        font-size: 20px;
    }
</style>
<div class="container">
    <div class="form-control">
        <h5>Hello, <?php echo $name; ?></h5>
    </div>&nbsp;
    <center>
        <img src="<?php echo base_url('images\station.png') ?>" height="200" alt="logo">
        <p></p>
    </center>
    <div class="row">
        <div class="col-sm-12 p-2">
            <a href="<?php echo base_url('logout') ?>" class="btn btn-outline-warning btn-lg form-control">
                <i class="fa-solid fa-right-from-bracket"></i> &nbsp;&nbsp;
                Logout
            </a>
        </div>
    </div>
    <br>
    <div class="card border border-dark">
        
        <div class="card-header bg-info">
            Petrol available in <?php echo $town; ?> Town
        </div>
        <div class="card-body" id="#petrolavailabletown">
            <table class="table table-bordered table-striped table-responsive-stack text-wrap" id="tableOne">
                <tbody id="towntablebody" class="text-wrap">
                    
                </tbody>
            </table>
        </div>
    </div><br>
    <div class="card border border-dark">
        <div class="card-header bg-info">
            Petrol available in <?php echo $district; ?> District
        </div>
        <div class="card-body" id="#petrolavailabledistrict">
            <table class="table table-bordered table-striped table-responsive-stack text-wrap" id="tableTwo">
                <tbody id="Districttablebody" class="text-wrap">
                    
                </tbody>
            </table>
        </div>
    </div>
    <br><br>
</div>
<style>
    .table-responsive-stack tr {
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        -webkit-box-orient: horizontal;
        -webkit-box-direction: normal;
        -ms-flex-direction: row;
        flex-direction: row;
    }

    .table-responsive-stack td,
    .table-responsive-stack th {
        display: block;
        -ms-flex: 1 1 auto;
        flex: 1 1 auto;
    }

    .table-responsive-stack .table-responsive-stack-thead {
        font-weight: bold;
    }

    @media screen and (max-width: 768px) {
        .table-responsive-stack tr {
            -webkit-box-orient: vertical;
            -webkit-box-direction: normal;
            -ms-flex-direction: column;
            flex-direction: column;
            border-bottom: 3px solid #ccc;
            display: block;
        }

        /*  IE9 FIX   */
        .table-responsive-stack td {
            float: left\9;
            width: 100%;
        }
    }
</style>
<script>
    $(document).ready(function() {
        fetch("<?php echo base_url('home/getPetrolDetailsTown')?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
        .then(response => {
            if (response.status == 200) {return response.json();}
            else {console.log('Backend Error..!');console.log(response.text());}
        })
        .then(data => {
            if (data.length>0) {
                data.forEach(function(item){
                    var val="";
                    if(item.numberingDistribution=="yes"){
                        val="Number Based";
                    }else{
                        val="Not Number Based";
                    }
                    var htmlText=`
                        <tr>
                            <td>${item.provider}</td>
                            <td>${item.stationName}</td>
                            <td>${item.stationAddress}</td>
                            <td>${item.date}</td>
                            <td>${val}</td>
                            <td>${item.nprange}</td>
                            <td>${item.stationPhone}</td>
                        </tr>
                    `;
                    $("#towntablebody").append(htmlText);
                });
            }else{
                $("#towntablebody").append("<div class='alert alert-danger'>No information available. Try again Later</div>");
            }
        })
        .catch(() => {console.log("Network connection error");});

        fetch("<?php echo base_url('home/getPetrolDetailsDistrict')?>",{method:'GET',mode: 'no-cors',cache: 'no-cache'})
        .then(response => {
            if (response.status == 200) {return response.json();}
            else {console.log('Backend Error..!');console.log(response.text());}
        })
        .then(data => {
            if (data.length>0) {
                data.forEach(function(item){
                    var val="";
                    if(item.numberingDistribution=="yes"){
                        val="Number Based";
                    }else{
                        val="Not Number Based";
                    }
                    var htmlText=`
                        <tr>
                            <td>${item.provider}</td>
                            <td>${item.stationName}</td>
                            <td>${item.stationAddress}</td>
                            <td>${item.town}</td>
                            <td>${item.date}</td>
                            <td>${val}</td>
                            <td>${item.nprange}</td>
                            <td>${item.stationPhone}</td>
                        </tr>
                    `;
                    $("#Districttablebody").append(htmlText);
                });
            }else{
                $("#Districttablebody").append("<div class='alert alert-danger'>No information available. Try again Later</div>");
            }
        })
        .catch(() => {console.log("Network connection error");});

        $('.table-responsive-stack').each(function(i) {
            var id = $(this).attr('id');
            $(this).find("th").each(function(i) {
                $('#' + id + ' td:nth-child(' + (i + 1) + ')').prepend('<span class="table-responsive-stack-thead">' + $(this).text() + ':</span> ');
                $('.table-responsive-stack-thead').hide();

            });
        });

        $('.table-responsive-stack').each(function() {
            var thCount = $(this).find("th").length;
            var rowGrow = 100 / thCount + '%';
            //console.log(rowGrow);
            $(this).find("th, td").css('flex-basis', rowGrow);
        });

        function flexTable() {
            if ($(window).width() < 768) {
                $(".table-responsive-stack").each(function(i) {
                    $(this).find(".table-responsive-stack-thead").show();
                    $(this).find('thead').hide();
                });

            } else {
                $(".table-responsive-stack").each(function(i) {
                    $(this).find(".table-responsive-stack-thead").hide();
                    $(this).find('thead').show();
                });
            }
        }
        flexTable();
        window.onresize = function(event) {
            flexTable();
        };
    });
</script>