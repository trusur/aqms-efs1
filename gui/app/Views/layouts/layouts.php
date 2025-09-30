<!DOCTYPE html>
<html lang="<?= session()->get('web_lang') ? session()->get('web_lang') : 'en' ?>">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TRUSUR AQMS FS2</title>
    <?= $this->include('layouts/css') ?>
    <?= $this->renderSection('css') ?>
    <!-- Custom CSS -->
</head>

<body id="capture-body">
    <!-- Navbar -->
    <?= $this->include('layouts/navbar') ?>
    <!-- End of Navar -->
    <div id="layout-content">
        <?= $this->renderSection('content') ?>
    </div>
    <div class="modal fade" id="captureModal" tabindex="-1" role="dialog" aria-labelledby="captureModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Result Capture</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="overflow-auto" id="capture-result" style="max-height: 56vh;"></div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="ispModal" tabindex="-1" role="dialog" aria-labelledby="ispModalTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Internet Connection Detail</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table class="table table-stripped">
                        <tr>
                            <th>Status</th>
                            <td id="status">
                                <span class="badge badge-danger">Disconnect</span>
                            </td>
                        </tr>
                        <tr>
                            <th>ISP</th>
                            <td id="isp">-</td>
                        </tr>
                        <tr>
                            <th>IP Address</th>
                            <td id="ipAddress">-</td>
                        </tr>
                        <tr>
                            <th>Region</th>
                            <td id="regionName">-</td>
                        </tr>
                        <tr>
                            <th>Time Zone</th>
                            <td id="timezone">-</td>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <div class="position-fixed" style="bottom:4vh">
        <button id="btn-capture" class="btn btn-dark rounded border border-light btn-sm btn-info" title="Capture" data-intro="Screenshoot layar">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-capture" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M4 8v-2a2 2 0 0 1 2 -2h2"></path>
                <path d="M4 16v2a2 2 0 0 0 2 2h2"></path>
                <path d="M16 4h2a2 2 0 0 1 2 2v2"></path>
                <path d="M16 20h2a2 2 0 0 0 2 -2v-2"></path>
                <circle cx="12" cy="12" r="3"></circle>
            </svg>
        </button>
    </div>

    <?= $this->include('layouts/js') ?>
    <?= $this->renderSection('js') ?>
</body>

</html>