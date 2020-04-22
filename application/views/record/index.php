<div class="container">
    <?php if ($this->session->flashdata('flash')) : ?>
    <div class="row mt-3">
        <div class="col-md-6">
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                MEDICAL RECORD DATA <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        </div>
    </div>
    <?php endif; ?>
    <div class="row mt-5">
        <div class="col">
            <h3 class="text-center">MEDICAL RECORD DATA</h3>
            <?php if (empty($record)) : ?>
            <div class="alert alert-danger" role="alert">
                Data tidak ditemukan
            </div>
            <?php endif; ?>

            <table class="table mt-5">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">MEDICAL RECORD ID</th>
                        <th class="text-center" scope="col">RESERVATION ID</th>
                        <th class="text-center" scope="col">DISEASE ID</th>
                        <th class="text-center" scope="col">CAPTION</th>
                        <th class="text-center" scope="col">ACTION</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><?php foreach ($record as $rd) : ?>
                        <td class="text-center"><?= $rd['medical_record_id']; ?></td>
                        <td class="text-center"><?= $rd['reservation_id']; ?></td>
                        <td class="text-center"><?= $rd['disease_id']; ?></td>
                        <td class="text-center"><?= $rd['caption']; ?></td>
                        <td class="text-center">
                            <a href="<?= base_url(); ?>record/hapus/<?= $rd['id'] ?>" class="badge badge-danger float-center" onclick="return confirm('Apakah anda yakin menghapus data ini?');" ?>DELETE</a>
                            <a href="<?= base_url(); ?>record/ubah/<?= $rd['id'] ?>" class="badge badge-success float-center" ?>UPDATE</a>
                        </td>
                    </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
            <div class="row mt-3">
                <div class="col md-6 text-center mt-5">
                    <a href="<?= base_url(); ?>record/tambah " class="btn btn-primary">INSERT MEDICAL RECORD</a>
                </div>
            </div>

        </div>
    </div>
</div> 