<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <nav class="card bg-light overflow-hidden nav nav-pills flex-column flex-sm-row">
        <a class="flex-sm-fill text-sm-center nav-link <?= (@$_GET["tabs"] == "") ? "active" : ""; ?>" href="<?= base_url(); ?>/rht?tabs=">MembraSens</a>
        <a class="flex-sm-fill text-sm-center nav-link <?= (@$_GET["tabs"] == "1") ? "active" : ""; ?>" href="<?= base_url(); ?>/rht?tabs=1">Sensor Values</a>
        <a class="flex-sm-fill text-sm-center nav-link <?= (@$_GET["tabs"] == "2") ? "active" : ""; ?>" href="<?= base_url(); ?>/rht?tabs=2">RHT</a>
        <a class="flex-sm-fill text-sm-center nav-link <?= (@$_GET["tabs"] == "3") ? "active" : ""; ?>" href="<?= base_url(); ?>/rht?tabs=3">Pressure</a>
    </nav>

    <?php if ((@$_GET["tabs"] == "")) : ?>
        <div class="row justify-content-start">
            <div class="col-md-12 my-2">
                <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Concentration (ppm)</th>
                                <th scope="col">Voltage</th>
                                <th scope="col">Temp (°C)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td style="color:<?= $linechartcolors[0]; ?>;">
                                    <input id="isGraph0" type="checkbox" value="1" checked>
                                    Board 0 [0]
                                </td>
                                <td id="con_membrasens_0_0" onclick="spanbegin(0,0);">0</td>
                                <td id="volt_membrasens_0_0">0</td>
                                <td id="temp_membrasens_0_0">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[1]; ?>;">
                                    <input id="isGraph1" type="checkbox" value="1" checked>
                                    Board 0 [1]
                                </td>
                                <td id="con_membrasens_0_1" onclick="spanbegin(0,1);">0</td>
                                <td id="volt_membrasens_0_1">0</td>
                                <td id="temp_membrasens_0_1">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[2]; ?>;">
                                    <input id="isGraph2" type="checkbox" value="1" checked>
                                    Board 0 [2]
                                </td>
                                <td id="con_membrasens_0_2" onclick="spanbegin(0,2);">0</td>
                                <td id="volt_membrasens_0_2">0</td>
                                <td id="temp_membrasens_0_2">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[3]; ?>;">
                                    <input id="isGraph3" type="checkbox" value="1" checked>
                                    Board 0 [3]
                                </td>
                                <td id="con_membrasens_0_3" onclick="spanbegin(0,3);">0</td>
                                <td id="volt_membrasens_0_3">0</td>
                                <td id="temp_membrasens_0_3">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[4]; ?>;">
                                    <input id="isGraph4" type="checkbox" value="1" checked>
                                    Board 1 [0]
                                </td>
                                <td id="con_membrasens_1_0" onclick="spanbegin(1,0);">0</td>
                                <td id="volt_membrasens_1_0">0</td>
                                <td id="temp_membrasens_1_0">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[5]; ?>;">
                                    <input id="isGraph5" type="checkbox" value="1" checked>
                                    Board 1 [1]
                                </td>
                                <td id="con_membrasens_1_1" onclick="spanbegin(1,1);">0</td>
                                <td id="volt_membrasens_1_1">0</td>
                                <td id="temp_membrasens_1_1">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[6]; ?>;">
                                    <input id="isGraph6" type="checkbox" value="1" checked>
                                    Board 1 [2]
                                </td>
                                <td id="con_membrasens_1_2" onclick="spanbegin(1,2);">0</td>
                                <td id="volt_membrasens_1_2">0</td>
                                <td id="temp_membrasens_1_2">0</td>
                            </tr>
                            <tr>
                                <td style="color:<?= $linechartcolors[7]; ?>;">
                                    <input id="isGraph7" type="checkbox" value="1" checked>
                                    Board 1 [3]
                                </td>
                                <td id="con_membrasens_1_3" onclick="spanbegin(1,3);">0</td>
                                <td id="volt_membrasens_1_3">0</td>
                                <td id="temp_membrasens_1_3">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="row justify-content-start">
                    <div class="col-md-12 my-2">
                        <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">

                            <div class="card-body">
                                <div class="chart">
                                    <canvas id="lineChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    <?php endif ?>

    <?php if ((@$_GET["tabs"] == "1")) : ?>

        <div class="row justify-content-start">
            <div class="col-md-12 my-2">
                <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Sensor Name</th>
                                <th scope="col">Value</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sensor_values as $sensor_value) : ?>
                                <tr>
                                    <td nowrap>$sensor[<?= $sensor_value->sensor_reader_id; ?>][<?= $sensor_value->pin; ?>]</td>
                                    <td id="sensor_value_<?= $sensor_value->sensor_reader_id; ?>_<?= $sensor_value->pin; ?>"></td>
                                </tr>
                            <?php endforeach ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>
    <?php if ((@$_GET["tabs"] == "2")) : ?>
        <div class="row justify-content-start">
            <div class="col-md-12 my-2">
                <div class="card bg-light px-3 mb-md-0 mb-3 overflow-hidden">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">RH (%)</th>
                                <th scope="col">Temp(°C)</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Analyzer</td>
                                <td id="rh_analyzer">0</td>
                                <td id="temp_analyzer">0</td>
                            </tr>
                            <tr>
                                <td>Main Sensor</td>
                                <td id="rh_sensor">0</td>
                                <td id="temp_sensor">0</td>
                            </tr>
                            <tr>
                                <td>Pump</td>
                                <td id="rh_pump">0</td>
                                <td id="temp_pump">0</td>
                            </tr>
                            <tr>
                                <td>PSU</td>
                                <td id="rh_psu">0</td>
                                <td id="temp_psu">0</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    <?php endif ?>

    <?php if ((@$_GET["tabs"] == "3")) : ?>
        <div class="row justify-content-start">
            <div class="col-md-6 my-2">
                <div class="card bg-light px-3 mb-md-0 mb-3">
                    <span class="h5 py-0 font-weight-bold">Pressure</span>
                    <div class="m-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="h1 mr-1" id="pressure">0</h3>
                            <p>MBar</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 my-2">
                <div class="card bg-light px-3 mb-md-0 mb-3">
                    <span class="h5 py-0 font-weight-bold">Vacuum</span>
                    <div class="m-0 d-flex justify-content-between">
                        <div class="d-flex align-items-center">
                            <h3 class="h1 mr-1" id="vacuum">0</h3>
                            <p>MBar</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif ?>
</div>



<!-- Span Calibraton -->

<div class="modal fade" id="spanModal" tabindex="-1" role="dialog" aria-labelledby="spanModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="spanModalTitle"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Board</label>
                                <input type="text" id="spanboard" name="spanboard" readonly class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Port</label>
                                <input type="text" id="spanport" name="spanport" readonly class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Current Concetration (ppm)</label>
                                <input type="text" id="modal_current_concetration" name="modal_current_concetration" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Span Concetration (ppm)</label>
                                <input type="text" id="span_concetration" name="span_concetration" value="1" placeholder="Span Concetration" class="form-control">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button name="Save" type="button" class="btn btn-sm btn-primary mr-1" onclick="savingSetSpan(spanBoard,spanPort,document.getElementById('span_concetration').value);">Save</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>

                    <p class="alert alert-warning text-danger">
                        <i class="fas fa-info-circle fa-xs mr-1"></i> Pastikan aliran gas kalibrasi span Gas sudah terpasang dengan benar pada saluran sampling dengan laju alir 0.9 lpm
                    </p>
                    <p class="alert alert-warning text-danger">
                        <i class="fas fa-info-circle fa-xs mr-1"></i> Kesalahan penggunaan gas kalibrasi dapat mempengaruhi daya akurasi pengukuran pada sensor Gas
                    </p>
                </div>
            </div>
        </form>

    </div>
</div>

<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<script>
    var spanBeginCount = 0;
    var spanBoard = null;
    var spanPort = null;
    $(document).ready(function() {
        setInterval(() => {
            $.ajax({
                url: '<?= base_url('rht/sensor_values') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        <?php if (@$_GET["tabs"] == "") : ?>
                            $("#con_membrasens_0_0").html(data.con_membrasens_0_0);
                            $("#con_membrasens_0_1").html(data.con_membrasens_0_1);
                            $("#con_membrasens_0_2").html(data.con_membrasens_0_2);
                            $("#con_membrasens_0_3").html(data.con_membrasens_0_3);
                            $("#volt_membrasens_0_0").html(data.volt_membrasens_0_0);
                            $("#volt_membrasens_0_1").html(data.volt_membrasens_0_1);
                            $("#volt_membrasens_0_2").html(data.volt_membrasens_0_2);
                            $("#volt_membrasens_0_3").html(data.volt_membrasens_0_3);
                            $("#temp_membrasens_0_0").html(data.temp_membrasens_0_0);
                            $("#temp_membrasens_0_1").html(data.temp_membrasens_0_1);
                            $("#temp_membrasens_0_2").html(data.temp_membrasens_0_2);
                            $("#temp_membrasens_0_3").html(data.temp_membrasens_0_3);
                            $("#con_membrasens_1_0").html(data.con_membrasens_1_0);
                            $("#con_membrasens_1_1").html(data.con_membrasens_1_1);
                            $("#con_membrasens_1_2").html(data.con_membrasens_1_2);
                            $("#con_membrasens_1_3").html(data.con_membrasens_1_3);
                            $("#volt_membrasens_1_0").html(data.volt_membrasens_1_0);
                            $("#volt_membrasens_1_1").html(data.volt_membrasens_1_1);
                            $("#volt_membrasens_1_2").html(data.volt_membrasens_1_2);
                            $("#volt_membrasens_1_3").html(data.volt_membrasens_1_3);
                            $("#temp_membrasens_1_0").html(data.temp_membrasens_1_0);
                            $("#temp_membrasens_1_1").html(data.temp_membrasens_1_1);
                            $("#temp_membrasens_1_2").html(data.temp_membrasens_1_2);
                            $("#temp_membrasens_1_3").html(data.temp_membrasens_1_3);
                        <?php endif ?>

                        <?php if (@$_GET["tabs"] == "1") : ?>
                            for (var key in data.sensor_values) {
                                $("#sensor_value_" + data.sensor_values[key].sensor_reader_id + "_" + data.sensor_values[key].pin).html(data.sensor_values[key].value);
                            }
                        <?php endif ?>

                        <?php if (@$_GET["tabs"] == "2") : ?>
                            $("#rh_analyzer").html(data.rh_analyzer);
                            $("#temp_analyzer").html(data.temp_analyzer);
                            $("#rh_sensor").html(data.rh_sensor);
                            $("#temp_sensor").html(data.temp_sensor);
                            $("#rh_pump").html(data.rh_pump);
                            $("#temp_pump").html(data.temp_pump);
                            $("#rh_psu").html(data.rh_psu);
                            $("#temp_psu").html(data.temp_psu);
                        <?php endif ?>

                        <?php if (@$_GET["tabs"] == "3") : ?>
                            $("#vacuum").html(data.vacuum);
                            $("#pressure").html(data.pressure);
                        <?php endif ?>

                        try {
                            $("#modal_current_concetration").val($("#con_membrasens_" + spanBoard + "_" + spanPort).html());
                        } catch (err) {}
                    }
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
        }, 1000);
    });

    function savingSetSpan(board, port, span) {
        $.ajax({
            url: '<?= base_url('rht/savingSetSpan') ?>/' + board + "/" + port + "/" + span,
            dataType: 'json',
            success: function(data) {
                if (data !== null) {
                    console.log(data);
                }
            },
            error: function(xhr, status, err) {
                console.log(err);
            }
        })
    }

    function Xspanbegin(board, port) {
        spanBeginCount++;
        if (spanBeginCount > 4) {
            spanBoard = board;
            spanPort = port;
            spanBeginCount = 0;
            $('#spanboard').val(board);
            $('#spanport').val(port);
            $('#spanModalTitle').html("Set span to Membrasense board :" + board + "; port:" + port);
            $('#spanModal').modal('show');
        }
    }
</script>

<script src="<?= base_url('bootstrap/js/Chart.min.js') ?>"></script>
<script>
    $(document).ready(function() {
        var areaChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            animation: {
                duration: 0
            },
            legend: {
                display: false
            },
            scales: {
                xAxes: [{
                    gridLines: {
                        display: false,
                    }
                }],
                yAxes: [{
                    gridLines: {
                        display: false,
                    }
                }]
            }
        }

        var lineChartCanvas = $('#lineChart').get(0).getContext('2d')
        var lineChartOptions = $.extend(true, {}, areaChartOptions)
        lineChartOptions.datasetFill = false

        setInterval(() => {
            $.ajax({
                url: '<?= base_url('rht/sensor_value_logs') ?>',
                dataType: 'json',
                success: function(data) {
                    if (data !== null) {
                        let datasets_ = new Array();
                        i = 0;
                        data.datasets.forEach(function(object) {
                            if ($("#isGraph" + i).is(":checked")) {
                                obj = JSON.parse(object);
                                datasets_[i] = {
                                    borderColor: obj.borderColor,
                                    pointRadius: obj.pointRadius,
                                    data: JSON.parse(obj.data)
                                };
                            } else {
                                datasets_[i] = {
                                    borderColor: "",
                                    pointRadius: false,
                                    data: []
                                };
                            }
                            i++;
                        });

                        var areaChartData = {
                            labels: data.labels,
                            datasets: datasets_
                        }

                        // console.log(areaChartData);

                        var lineChartData = $.extend(true, {}, areaChartData)

                        var lineChart = new Chart(lineChartCanvas, {
                            type: 'line',
                            data: lineChartData,
                            options: lineChartOptions
                        })
                    }
                },
                error: function(xhr, status, err) {
                    console.log(err);
                }
            })
        }, 1000);
    });
</script>

<?= $this->endSection() ?>