<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>

<!-- Refresh page every seconds -->
<meta http-equiv="refresh" content="60">

<?php
// Menggunakan instance database CodeIgniter
$db = \Config\Database::connect();

// Mendapatkan data dari tabel sablon
$querySablon = $db->query("SELECT * FROM sablon");
$sablon = $querySablon->getResultArray();

// Mendapatkan data dari tabel bordir
$queryBordir = $db->query("SELECT * FROM bordir");
$bordir = $queryBordir->getResultArray();

// Query untuk mendapatkan data teratas no_so
$queryTopNoSO = $db->query("
    SELECT no_so FROM bordir
    UNION
    SELECT no_so FROM galat
    UNION
    SELECT no_so FROM kirim
    UNION
    SELECT no_so FROM packing
    UNION
    SELECT no_so FROM penjahit
    UNION
    SELECT no_so FROM po
    UNION
    SELECT no_so FROM sablon
    UNION
    SELECT no_so FROM selesai
    ORDER BY no_so DESC
    LIMIT 1;
");
$topNoSO = $queryTopNoSO->getRow()->no_so ?? 'Tidak ada data';

?>

<div class="container-fluid">
    <?php if (session()->getFlashdata('msg')): ?>
        <div class="alert alert-success" role="alert">
            <?= session()->getFlashdata('msg') ?>
        </div>
    <?php endif; ?>
    <!-- Page Heading -->
    <!-- <h1 class="h3 mb-4 text-gray-800">BERANDA</h1> -->
    <h1 class="h3 mb-4 text-gray-800">
    BERANDA 
    <span class="badge badge-info" style="font-size: 1rem;">
        <?= $topNoSO; ?>
    </span>
</h1>

    <!-- Row for PO and PENJAHIT -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">PO</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $queryPO = $db->query("SELECT COUNT(*) as total FROM po");
                        $totalPO = $queryPO->getRow()->total ?? 0;
                        echo $totalPO;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/po'); ?>" class="btn btn-primary">Buka Antrian >></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">PENJAHIT</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $queryPenjahit = $db->query("SELECT COUNT(*) as total FROM penjahit");
                        $totalPenjahit = $queryPenjahit->getRow()->total ?? 0;
                        echo $totalPenjahit;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/penjahit'); ?>" class="btn btn-primary">Buka Antrian >></a>
            </div>
        </div>
    </div>

    <!-- Row for BORDIR and SABLON -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">BORDIR</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $queryBordirCount = $db->query("SELECT COUNT(*) as total FROM bordir");
                        $totalBordir = $queryBordirCount->getRow()->total ?? 0;
                        echo $totalBordir;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/bordir'); ?>" class="btn btn-primary">Buka Antrian >></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">SABLON</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $querySablonCount = $db->query("SELECT COUNT(*) as total FROM sablon");
                        $totalSablon = $querySablonCount->getRow()->total ?? 0;
                        echo $totalSablon;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/sablon'); ?>" class="btn btn-primary">Buka Antrian >></a>
            </div>
        </div>
    </div>

    <!-- Row for PACKING and KIRIM -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">PACKING</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $queryPacking = $db->query("SELECT COUNT(*) as total FROM packing");
                        $totalPacking = $queryPacking->getRow()->total ?? 0;
                        echo $totalPacking;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/packing'); ?>" class="btn btn-primary">Buka Antrian >></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-primary">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">KIRIM</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $queryKirim = $db->query("SELECT COUNT(*) as total FROM kirim");
                        $totalKirim = $queryKirim->getRow()->total ?? 0;
                        echo $totalKirim;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/kirim'); ?>" class="btn btn-primary">Buka Antrian >></a>
            </div>
        </div>
    </div>

    <!-- Row for GALAT and SELESAI -->
    <div class="row mb-3">
        <div class="col-md-6">
            <div class="card bg-danger">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">GALAT</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $queryGalat = $db->query("SELECT COUNT(*) as total FROM galat");
                        $totalGalat = $queryGalat->getRow()->total ?? 0;
                        echo $totalGalat;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/galat'); ?>" class="btn btn-danger">Buka Antrian >></a>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card bg-success">
                <div class="card-body d-flex justify-content-between align-items-center">
                    <div>
                        <h1 class="card-title font-weight-bolder text-white">SElESAI</h1>
                        <p class="card-text font-weight-bold text-white">Jumlah Antrian</p>
                    </div>
                    <h1 class="card-text font-weight-bold text-white text-center">
                        <?php
                        $querySelesai = $db->query("SELECT COUNT(*) as total FROM selesai");
                        $totalSelesai = $querySelesai->getRow()->total ?? 0;
                        echo $totalSelesai;
                        ?>
                    </h1>
                </div>
                <a href="<?= base_url('/selesai'); ?>" class="btn btn-success">Buka Antrian >></a>
            </div>
        </div>
    </div>

    <!-- Selesai -->
    <!-- <div class="card bg-success w-100">
        <div class="card-body d-flex justify-content-between align-items-center">
            <div>
                <h1 class="card-title font-weight-bolder text-white">SELESAI</h1>
                <p class="card-text font-weight-bold text-white">Jumlah Selesai</p>
            </div>
            <h1 class="card-text font-weight-bold text-white text-center">
                <?php
                $querySelesai = $db->query("SELECT COUNT(*) as total FROM selesai");
                $totalSelesai = $querySelesai->getRow()->total ?? 0;
                echo $totalSelesai;
                ?>
            </h1>
        </div>
        <a href="<?= base_url('/selesai'); ?>" class="btn btn-success">Buka Selesai >></a>
    </div> -->
</div>

<?= $this->endSection(); ?>