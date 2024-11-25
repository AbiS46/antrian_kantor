<!-- app/Views/penjahit/index.php -->
<?php

/**
 * @var array $penjahit
 * @var string $userRole
 */
?>
<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">

    <h1 class="h3 mb-4 text-gray-800">PENJAHIT</h1>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success') ?></div>
    <?php endif; ?>

    <div class="mb-3">
        <form action="<?= base_url('penjahit'); ?>" method="get" class="form-inline">
            <label for="sort" class="mr-2">Urutkan Berdasarkan:</label>
            <select name="sort" id="sort" class="form-control mr-2">
                <option value="asc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : ''; ?>>No. SO (A-Z)</option>
                <option value="desc" <?= (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : ''; ?>>No. SO (Z-A)</option>
            </select>

            <label for="search" class="mr-2">Cari:</label>
            <input type="text" name="search" id="search" class="form-control mr-2" value="<?= isset($_GET['search']) ? $_GET['search'] : ''; ?>" placeholder="Masukkan disini">

            <button type="submit" class="btn btn-primary mr-2">Filter</button>
            <a href="<?= base_url('penjahit'); ?>" class="btn btn-danger">Hapus Filter</a>
        </form>
    </div>

    <div class="d-flex justify-content-between align-items-center p-2">
        <h5 class="mb-0 font-weight-bold">DATA ANTRIAN</h5>
        <?php if ($userRole === 'Admin'): ?>
            <a href="<?= base_url('penjahit/create'); ?>" class="btn btn-success mr-4">
                <i class="fas fa-solid fa-plus"></i>
            </a>
        <?php else: ?>
            <div class="btn btn-success">Hanya Admin</div>
        <?php endif; ?>
    </div>
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <div class="table-responsive" style="overflow-y: auto;">
        <table class="table table-striped">
            <thead class="thead-light">
                <tr>
                    <th scope="col">NO.</th>
                    <th scope="col">TGL ORDER</th>
                    <th scope="col">NO. SO</th>
                    <th scope="col">PENJUALAN</th>
                    <th scope="col">PELANGGAN</th>
                    <th scope="col">QTY(m)</th>
                    <th scope="col">DESKRIPSI</th>
                    <th scope="col">HARGA</th>
                    <th scope="col">DEADLINE</th>
                    <th scope="col">STATUS</th>
                    <th scope="col">AKSI</th>
                </tr>
            </thead>
            <tbody>
                <?php $no = 1;
                foreach ($penjahit as $data) : ?>
                    <tr>
                        <th><?= $no; ?></th>
                        <td><?= $data['tgl_order']; ?></td>
                        <td><?= $data['no_so']; ?></td>
                        <td><?= $data['penjualan']; ?></td>
                        <td><?= $data['pelanggan']; ?></td>
                        <td><?= $data['qty']; ?></td>
                        <!-- Batasi lebar kolom DESKRIPSI di tabel body -->
                        <td style="max-width: 260px;">
                            <?= $data['deskripsi']; ?>
                        </td>
                        <td>Rp. <?= number_format($data['harga']); ?></td>
                        <td><?= $data['deadline']; ?></td>
                        <td>
                            <!-- Dropdown untuk memindahkan data -->
                            <form action="" method="post" id="move-form-<?= $data['id']; ?>">
                                <select name="move_to" class="form-control" onchange="moveData(this, '<?= $data['id']; ?>')">
                                    <option value="">Pindah ke</option>
                                    <option value="po">Po</option>
                                    <option value="penjahit">Penjahit</option>
                                    <option value="bordir">Bordir</option>
                                    <option value="sablon">Sablon</option>
                                    <option value="packing">Packing</option>
                                    <option value="kirim">Kirim</option>
                                    <option value="galat">Galat</option>
                                    <option value="selesai">Selesai</option>
                                </select>
                            </form>

                            <script>
                                function moveData(selectElement, id) {
                                    const selectedValue = selectElement.value;
                                    if (selectedValue) {
                                        // Update action URL form
                                        const form = document.getElementById('move-form-' + id);
                                        form.action = "<?= base_url('move/penjahit'); ?>/" + selectedValue + "/" + id; // Update URL sesuai tabel yang dipilih
                                        form.submit(); // Submit the form
                                    }
                                }
                            </script>
                        </td>
                        <td>
                            <?php if ($userRole === 'Admin'): ?>
                                <a href="<?= base_url('penjahit/edit/' . $data['id']); ?>" class="btn btn-primary">
                                    <i class="fas fa-solid fa-pen"></i>
                                </a>

                                <a href="<?= base_url('penjahit/delete/' . $data['id']); ?>" class="btn btn-danger" onclick="return confirmDelete()">
                                    <i class="fas fa-trash"></i>
                                </a>

                                <script>
                                    function confirmDelete() {
                                        return confirm("Apakah Anda yakin ingin menghapus data ini?");
                                    }
                                </script>
                            <?php else: ?>
                                <!-- Tindakan jika bukan Admin -->
                                <div class="btn btn-danger justify-content-end">Hanya Admin</div>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php $no++;
                endforeach; ?>
            </tbody>
        </table>
    </div>

</div>
<?= $this->endSection(); ?>