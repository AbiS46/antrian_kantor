<!-- app/Views/sablon/create.php -->
<?= $this->extend('templates/index'); ?>

<?= $this->section('content'); ?>
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800">Tambah Antrian</h1>
    <form id="sablonForm" action="<?= base_url('sablon/simpan'); ?>" method="POST">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="tgl_order">Tanggal Order</label>
                    <input type="date" name="tgl_order" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="no_so">No. SO</label>
                    <input type="text" name="no_so" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="penjualan">Penjualan</label>
                    <input type="text" name="penjualan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="pelanggan">Pelanggan</label>
                    <input type="text" name="pelanggan" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="qty">Quantity (m / pcs)</label>
                    <input type="number" name="qty" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <label for="deskripsi">Deskripsi</label>
                    <textarea name="deskripsi" class="form-control" required></textarea>
                </div>
                <div class="form-group">
                    <label for="harga">Harga</label>
                    <input type="text" name="harga" class="form-control" id="harga" required>
                </div>
                <div class="form-group">
                    <label for="deadline">Deadline</label>
                    <input type="date" name="deadline" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control" required>
                        <option value="Sablon">Sablon</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end pr-2">
            <button type="button" class="btn btn-secondary mr-2" onclick="window.history.back();">Kembali</button>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script>
    // Format harga input
    const hargaInput = document.getElementById('harga');

    // Format harga saat input
    hargaInput.addEventListener('input', function(event) {
        let value = event.target.value.replace(/[^,\d]/g, '');
        event.target.value = formatRupiah(value);
    });

    // Format harga dengan format Rupiah
    function formatRupiah(angka, prefix = 'Rp. ') {
        let number_string = angka.replace(/[^,\d]/g, '').toString(),
            split = number_string.split(','),
            sisa = split[0].length % 3,
            rupiah = split[0].substr(0, sisa),
            ribuan = split[0].substr(sisa).match(/\d{3}/gi);

        if (ribuan) {
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }

        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix + rupiah;
    }

    // Remove non-numeric characters before form submission
    document.getElementById('sablonForm').addEventListener('submit', function(event) {
        const hargaInput = document.getElementById('harga');
        let value = hargaInput.value.replace(/[^\d]/g, ''); // Remove non-numeric characters
        hargaInput.value = value; // Set the value to the sanitized value
    });

    // Remove invalid class and feedback when user starts typing
    document.querySelectorAll('#sablonForm [required]').forEach(function(field) {
        field.addEventListener('input', function() {
            if (field.value) {
                field.classList.remove('is-invalid');
                const feedback = field.nextElementSibling;
                if (feedback && feedback.classList.contains('invalid-feedback')) {
                    feedback.remove();
                }
            }
        });
    });
</script>

<?= $this->endSection(); ?>