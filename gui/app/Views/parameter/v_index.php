<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-1">
    <div class="row">
        <div class="col-md-12">
            <h2 class="h3 text-light border-bottom">Gas</h2>
        </div>
        <?php foreach ($gases as $gas) : ?>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="h4"><?= $gas->caption_id ?></h4>
                            <div>
                                <?php if ($gas->is_view) : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="my-0"><?= $gas->formula ?></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-warning btn-span-calibration" data-id="<?= $gas->id ?>">
                                Span Calibration
                            </button>
                            &nbsp;&nbsp;&nbsp;
                            <button class="btn btn-sm btn-info btn-edit" data-id="<?= $gas->id ?>">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-12">
            <h2 class="h3 text-light border-bottom">Flow Meter</h2>
        </div>
        <?php foreach ($flow_meters as $flow_meter) : ?>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="h4"><?= $flow_meter->caption_id ?></h4>
                            <div>
                                <?php if ($flow_meter->is_view) : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="my-0"><?= $flow_meter->formula ?></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-info btn-edit" data-id="<?= $flow_meter->id ?>">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-12">
            <h2 class="h3 text-light border-bottom">Partikulat</h2>
        </div>
        <?php foreach ($particulates as $particulat) : ?>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="h4"><?= $particulat->caption_id ?></h4>
                            <div>
                                <?php if ($particulat->is_view) : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="my-0"><?= $particulat->formula ?></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-info btn-edit" data-id="<?= $particulat->id ?>">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <?php foreach ($particulate_flows as $p_flow) : ?>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="h4"><?= $p_flow->caption_id ?></h4>
                            <div>
                                <?php if ($p_flow->is_view) : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="my-0"><?= $p_flow->formula ?></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-info btn-edit" data-id="<?= $p_flow->id ?>">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <div class="col-md-12">
            <h2 class="h3 text-light border-bottom">Cuaca</h2>
        </div>
        <?php foreach ($weathers as $weather) : ?>
            <div class="col-md-6 my-3">
                <div class="card">
                    <div class="bg-light px-3 py-2">
                        <div class="d-flex justify-content-between">
                            <h4 class="h4"><?= $weather->caption_id ?></h4>
                            <div>
                                <?php if ($weather->is_view) : ?>
                                    <span class="badge badge-success">Aktif</span>
                                <?php else : ?>
                                    <span class="badge badge-danger">Tidak Aktif</span>
                                <?php endif; ?>
                            </div>
                        </div>
                        <p class="my-0"><?= $weather->formula ?></p>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-sm btn-info btn-edit" data-id="<?= $weather->id ?>">
                                Edit
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

</div>
<div class="modal fade" id="paramModal" tabindex="-1" role="dialog" aria-labelledby="paramModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <form action="<?= base_url('parameter') ?>" method="post">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Edit Parameter</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="hidden" name="id">
                                <input type="text" name="code" value="<?= old('code', @$parameter->code) ?>" placeholder="Name" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Caption</label>
                                <input type="text" name="caption_id" value="<?= old('caption_id', @$parameter->caption_id) ?>" placeholder="Caption" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Molecular Mass</label>
                                <input type="text" id="molecular_mass" name="molecular_mass" value="<?= old('molecular_mass', @$parameter->molecular_mass) ?>" placeholder="Molecular Mass" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group  'is-invalid' : '' ?>">
                                <label class="d-block">View</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_view" type="radio" id="showed" value="1" <?= ((int) old('is_view', @$parameter->is_view)) == 1 ? 'checked="checked"' : null ?>">
                                    <label class="form-check-label text-success" for="showed">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_view" type="radio" id="hidden" value="0" <?= ((int) old('is_view', @$parameter->is_view)) == 0 ? 'checked="checked"' : null ?>>
                                    <label class="form-check-label text-danger" for="hidden">Tidak Aktif</label>
                                </div>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group  'is-invalid' : '' ?>">
                                <label class="d-block">Graph</label>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_graph" type="radio" id="showed-graph" value="1" <?= ((int) old('is_graph', @$parameter->is_graph)) == 1 ? 'checked="checked"' : null ?>>
                                    <label class="form-check-label text-success" for="showed-graph">Aktif</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" name="is_graph" type="radio" id="hidden-graph" value="0" <?= ((int) old('is_graph', @$parameter->is_graph)) == 0 ? 'checked="checked"' : null ?>>
                                    <label class="form-check-label text-danger" for="hidden-graph">Tidak Aktif</label>
                                </div>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label>Sensor Value</label>
                                <select id="sensor_value_id" name="sensor_value_id" class="form-control">
                                    <option value="" selected disabled>Select Sensor Value</option>
                                    <?php foreach ($sensor_values as $sensor) : ?>
                                        <option value="<?= $sensor->id; ?>"><?= @$sensor->driver; ?> [<?= @$sensor->sensor_reader_id; ?>][<?= $sensor->pin ?>]</option>
                                    <?php endforeach; ?>
                                </select>
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="form-group">
                                <label>Current Sensor Value</label>
                                <div class="input-group">
                                    <textarea type="text" id="voltage" class="form-control" readonly></textarea>
                                    <!--span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" onclick="$('#voltage1').val($('#voltage').val());">Set V1</button>
                                        <button type="button" class="btn btn-info btn-flat" onclick="$('#voltage2').val($('#voltage').val());">Set V2</button>
                                    </span-->
                                </div>
                                <input type="hidden" name="" id="sensor_pin">
                                <input type="hidden" name="" id="sensor_reader_id">
                            </div>
                        </div>
                    </div>
                    <div id="content-formula">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small">Voltage 1</label>
                                    <input type="text" id="voltage1" name="voltage1" value="<?= old('voltage1', @$parameter->voltage1) ?>" placeholder="Voltage 1" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="small">Concentration 1</label>
                                    <input type="text" id="concentration1" name="concentration1" value="<?= old('concentration1', @$parameter->concentration1) ?>" placeholder="Concentration 1" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="small">Voltage 2</label>
                                    <input type="text" id="voltage2" name="voltage2" value="<?= old('voltage2', @$parameter->voltage2) ?>" placeholder="Voltage 2" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="small">Concentration 2</label>
                                    <input type="text" id="concentration2" name="concentration2" value="<?= old('concentration2', @$parameter->concentration2) ?>" placeholder="Concentration 2" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Formula</label>
                                <div class="input-group">
                                    <input type="text" id="formula" name="formula" value="<?= old('formula', @$parameter->formula) ?>" placeholder="Formula" class="form-control">
                                    <div class="invalid-feedback">

                                    </div>
                                    <span class="input-group-btn">
                                        <button type="button" class="btn btn-info btn-flat" id="btnGenerate">Generate Formula</button>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button name="Save" type="submit" class="btn btn-sm btn-primary mr-1">Save</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
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
                    <p class="alert alert-warning text-danger">
                        <i class="fas fa-info-circle fa-xs mr-1"></i> Pastikan aliran gas kalibrasi span <span id="spanGas"></span> sudah terpasang dengan benar pada saluran sampling dengan laju alir 0.9 lpm
                    </p>
                    <p class="alert alert-warning text-danger">
                        <i class="fas fa-info-circle fa-xs mr-1"></i> Kesalahan penggunaan gas kalibrasi dapat mempengaruhi daya akurasi pengukuran pada sensor Gas
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Cylinder Gas No</label>
                                <input type="hidden" name="id">
                                <input type="text" name="cylinder_gas_no" value="<?= old('cylinder_gas_no') ?>" placeholder="Cylinder Gas No" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Span Concetration</label>
                                <input type="text" name="span_concetration" value="<?= old('span_concetration') ?>" placeholder="Span Concetration" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" name="username" value="<?= old('username') ?>" placeholder="Username" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" value="<?= old('password') ?>" placeholder="Password" class="form-control">
                                <div class="invalid-feedback">

                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="modal-footer">
                    <div class="d-flex justify-content-end">
                        <button name="Save" type="submit" class="btn btn-sm btn-primary mr-1">Start</button>
                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                    </div>
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
<!-- Custom JS Here -->
<script>
    $(document).ready(function() {
        var intervalChange, intervalFirst;
        // Close Modal
        $('#paramModal').on('hidden.bs.modal', function() {
            clearInterval(intervalChange)
            clearInterval(intervalFirst)
        })
        $('.btn-edit').click(function(e) {
            e.preventDefault();
            let param_id = $(this).attr('data-id');
            var btnEdit = $(this);
            btnEdit.html(`<i class="fas fa-spinner fa-spin"></i>`);
            try {
                $.ajax({
                    url: '<?= base_url('parameter/detail') ?>',
                    data: {
                        id: param_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            let parameter = data.data;
                            if (parameter?.p_type != "gas") {
                                $('#content-formula').hide();
                                $('#btnGenerate').hide();
                            } else {
                                $('#btnGenerate').show();
                                $('#content-formula').show();
                            }
                            $('input[name="id"]').val(parameter?.id);
                            $('input[name="code"]').val(parameter?.code);
                            $('input[name="caption_id"]').val(parameter?.caption_id);
                            $('input[name="molecular_mass"]').val(parameter?.molecular_mass);
                            $(`input[name="is_view"][value="${parameter?.is_view}"]`).attr('checked', true);
                            $(`input[name="is_graph"][value="${parameter?.is_graph}"]`).attr('checked', true);
                            $('select[name="sensor_value_id"]').val(parameter?.sensor_value_id);
                            $('input[name="voltage1"]').val(parameter?.voltage1);
                            $('input[name="voltage2"]').val(parameter?.voltage2);
                            $('input[name="concentration1"]').val(parameter?.concentration1);
                            $('input[name="concentration2"]').val(parameter?.concentration2);
                            $('input[name="formula"]').val(parameter?.formula);
                            $('#paramModal').modal('show');
                            btnEdit.html(`Edit`);
                            clearInterval(intervalFirst);
                            clearInterval(intervalChange);
                            intervalFirst = setInterval(() => {
                                getCurrentVoltage();
                            }, 1000);
                        }
                    }
                })
            } catch (err) {

            }
        });
        // Span Calibration
        $('.btn-span-calibration').click(function() {
            let param_id = $(this).attr('data-id');
            var btnEdit = $(this);
            btnEdit.html(`<i class="fas fa-spinner fa-spin"></i>`);
            try {
                $.ajax({
                    url: '<?= base_url('parameter/detail') ?>',
                    data: {
                        id: param_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data.success) {
                            let parameter = data.data;
                            $('#spanModalTitle').html(`${parameter?.caption_id} Span Calibration`);
                            $('#spanGas').html(parameter?.caption_id);
                            $('#spanModal').modal('show');
                            btnEdit.html(`Span Calibration`);
                        }
                    }
                })
            } catch (err) {
                console.log(err);
            }
        })

        $('#sensor_value_id').change(function() {
            clearInterval(intervalChange);
            intervalChange = setInterval(() => {
                getCurrentVoltage();
            }, 1000);
            try {
                clearInterval(intervalFirst);
            } catch (err) {

            }
        })
        $('#btnGenerate').click(function() {
            try {
                generate_formula();
            } catch (err) {
                toastr.error(err);
            }
        })
        $('#paramModal').find('button[name="Save"]').click(function() {
            setTimeout(() => {
                location.reload();
            }, 1000);
        });

        function getCurrentVoltage() {
            let sensor_value_id = $('#sensor_value_id').val();
            if (sensor_value_id === null) {
                return;
            }
            try {
                $.ajax({
                    url: '<?= base_url('parameter/voltage') ?>',
                    data: {
                        sensor_value_id: sensor_value_id
                    },
                    dataType: 'json',
                    success: function(data) {
                        if (data?.success) {
                            try {
                                $('#voltage').val(data?.data?.value);
                                $('#sensor_pin').val(data?.data?.pin);
                                $('#sensor_reader_id').val(data?.data?.sensor_reader_id);
                            } catch (err) {
                                toastr.error(err);
                            }
                        }
                    }
                })

            } catch (err) {

            }
        }

        function generate_formula() {
            setTimeout(() => {
                let a = 0.0;
                let b = 0.0;
                let sign = "";
                let pin = $('#sensor_pin').val();
                let sensor_reader_id = $('#sensor_reader_id').val();
                let concentration2 = parseFloat($("#concentration2").val());
                let concentration1 = parseFloat($("#concentration1").val());
                let voltage1 = parseFloat($("#voltage1").val());
                let voltage2 = parseFloat($("#voltage2").val());
                let molecular_mass = parseFloat($("#molecular_mass").val()) * 1000;
                a = (concentration2 - concentration1) / (voltage2 - voltage1);
                b = concentration1 - (a * voltage1);
                console.log(a);
                console.log(b);
                if (b < 0) {
                    b = b * -1;
                    sign = "-";
                } else sign = "+";
                let formula = "round(((" + a + " * " + "explode(\";\",$sensor[" + sensor_reader_id + "][" + pin + "])[1]) " + sign + " " + b + ") * " + molecular_mass + " / 24.45,2)";
                // let formula = "round((" + a + " * " + "$sensor[" + sensor_reader_id + "][" + pin + "]) " + sign + " " + b + ",6)";
                $("#formula").val(formula);
            }, 500);
        }
    })
</script>
<?= $this->endSection() ?>