<div class="container">
    <div class="row mt-3">
        <div class="col">
            <div class="card">
                <div class="card-header text-center">
                    MEDICAL RECORD INSERT FORM
                </div>
                <div class="card-body">
                    <form action="" method="post">
                        <div class="form-group">
                            <label for="nama">Medical Record ID</label>
                            <input type="text" class="form-control" id="medical_record_id" name="medical_record_id">
                            <small class="form-text text-danger"><?= form_error('medical_record_id') ?>.</small>
                        </div>
                        <div class="form-group">
                            <label for="nim">Reservation ID</label>
                            <input type="text" class="form-control" id="reservation_id" name='reservation_id'>
                            <small class="form-text text-danger"><?= form_error('reservation_id') ?>.</small>
                        </div>
                        <div class="form-group">
                            <label for="text">Disease ID</label>
                            <input type="text" class="form-control" id="disease_id" name='disease_id'>
                            <small class="form-text text-danger"><?= form_error('disease_id') ?>.</small>
                        </div>
                        <div class="form-group">
                            <label for="text">Caption</label>
                            <input type="text" class="form-control" id="medical_record_caption" name='medical_record_caption'>
                            <small class="form-text text-danger"><?= form_error('medical_record_caption') ?>.</small>
                        </div>
                        <button type="submit" name="tambah" class="btn btn-primary float-right">INSERT DATA</button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div> 