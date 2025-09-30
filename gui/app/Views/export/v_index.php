<?= $this->extend('layouts/layouts') ?>
<?= $this->section('content') ?>
<div class="container-md py-3">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h3 class="h5">Filter</h3>
                    <div class="d-flex justify-content-between mb-3">
                        <form id="form-filter-date" class="form-inline">
                            <label class="sr-only">Begin Time</label>
                            <input type="date" name="begindate" class="form-control mr-1" title="Begin Time">
                            <label class="sr-only">End Time</label>
                            <input type="date" name="enddate" class="form-control mr-1" title="End Time">
                            <button type="button" id="btn-filter" class="btn btn-outline-primary" title="Filter">
                                <i class="fas fa-search"></i>
                            </button>
                        </form>

                    </div>
                    <div class="table-responsive">
                        <table id="export-tbl" class="table stripped">
                            <thead>
                                <tr>
                                    <th>ID STASIUN</th>
                                    <th>WAKTU</th>
                                    <?php foreach ($parameters as $parameter) : ?>
                                        <th><?= $parameter->caption_en; ?></th>
                                    <?php endforeach ?>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
<?= $this->endSection() ?>
<?= $this->section('css') ?>
<!-- Custom CSS Here -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<?= $this->endSection() ?>
<?= $this->section('js') ?>
<!-- Custom JS Here -->
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script>
    function requestDatatable(filter = "none") {
        let datatable;
        datatable = $('table[id="export-tbl"]').DataTable({
            "pageLength": 4,
            'bDestroy': true,
            searching: false,
            dom: 'Bfrtip',
            buttons: [{
                    text: 'Excel',
                    extend: 'excelHtml5',
                    className: 'btn btn-sm btn-info mb-3',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
                {
                    text: 'PDF',
                    extend: 'pdf',
                    className: 'btn btn-sm btn-danger mb-3',
                    exportOptions: {
                        modifier: {
                            page: 'all',
                            search: 'none'
                        }
                    }
                },
            ],
            ajax: `<?= base_url('export/datatable') ?>?${filter=="none"?"":filter}`,
            processing: true,
            serverSide: true,
            columns: [{
                    data: 'id_stasiun'
                },
                {
                    data: 'waktu'
                },
                <?php foreach ($parameters as $parameter) : ?> {
                        data: '<?= $parameter->code; ?>'
                    },
                <?php endforeach ?>
            ]
        });
    }
    try {
        requestDatatable();
    } catch (er) {
        console.log(er);
    }
</script>
<script>
    $(document).ready(function() {
        $('#btn-filter').click(function() {
            let form = $(this).closest('form');
            if (form.find('input').eq(0).val() === "" || form.find('input').eq(1).val() === "") {
                toastr.error('Anda harus menentukan range waktu!');
            } else {
                let filter = form?.serialize();
                requestDatatable(filter);
            }
        });
    });
</script>
<?= $this->endSection() ?>