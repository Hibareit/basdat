<?php include 'layouts/header.php' ?>

<section class="p-4 ml-5 mr-5 w-50">
    <form action="function.php" method="POST">
        <div class="mb-3">
            <label for="nama" class="form-label">Nama Client</label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Masukkan nama client..." required>
        </div>
        
        <div class="mb-3">
            <label class="form-label">Gender</label>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="genderL" value="L" required>
                <label class="form-check-label" for="genderL">Laki-laki</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="gender" id="genderP" value="P">
                <label class="form-check-label" for="genderP">Perempuan</label>
            </div>
        </div>
        
        <div class="mb-3">
            <label for="weight" class="form-label">Berat Badan (kg)</label>
            <input type="number" class="form-control" name="weight" id="weight" placeholder="Masukkan berat badan...">
        </div>
        
        <div class="mb-3">
            <label for="pengalaman" class="form-label">Pengalaman Gym</label>
            <select class="form-select" name="pengalaman" id="pengalaman">
                <option value="Pemula">Pemula</option>
                <option value="Menengah">Menengah</option>
                <option value="Profesional">Profesional</option>
            </select>
        </div>
        
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="tambah_client">Simpan</button>
        </div>
    </form>
</section>

<?php