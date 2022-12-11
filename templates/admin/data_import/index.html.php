<?php

/*
 * Copyright (c) 2022. Benjamin Wagner
 */

/**
 * @var object $response enthält Response-Daten des Controllers
 * @var object $schoolSubjects enthält die MySQL-Tabelle "school_subject"
 * @var Object $adminMenu Set of menu objects
 * @var Object $trans Translation object
 * @var Object $objects Translation object
 * @var Session $session Session-Objekt
 * @var array|false $userData Formulardaten des Benutzers
 * @var array $table Tabledata for current entitx
 * @var int $rows row count of current entity
 * @var int $currentPage current offset
 * @var string $text
 * @var array $file
 */


use Core\Component\SessionComponent\Session;

/**
 * Übergeordnetes Template
 */
$this->layout('_layout.standard.html',
    [
        'current_school_subject_id' => 0
    ]
);

?>

<?php $this->start('main') ?>
<div class="row g-3">
    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <div class="h5">Daten importieren</div>
                <div class="row g-3 mb-3">
                    <div class="col-12">
                        <div class="rounded-3 border border-2 p-3 bg-lighter bg-gradient shadow-sm d-flex justify-content-start align-items-center">
                            <i class="fa-solid fa-file-csv fa-2x me-2"></i>
                            <span>
                                Vorlage <a href="<?=$response->generateUrlFromString('/assets/uploads/vorlage_leitfragen.csv')?>" download>vorlage_leitfragen.csv</a> herunterladen.
                            </span>
                        </div>
                        </div>
                    <div class="col-12">
                        <p>Bitte überprüfen Sie die Daten vor dem Import. Fehler können zu Herausforderungen in der Datenbank führen, die eine manuelle Anpassung durch Administrator:innen notwenidg machen.</p>
                    </div>
                </div>
                <form method="post" enctype="multipart/form-data" class="row g-3">
                    <div class="col-12">
                        <label for="csv_upload" class="form-label"></label>
                        <input type="file" id="csv_upload" name="csv_upload" class="form-control" required>
                        <span class="form-text">Nur CSV-Dateien erlaubt.</span>
                    </div>
                    <div class="col-12">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="flexSwitchCheckDefault">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Datei enthält Spaltennamen?</label>
                        </div>
                    </div>
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary">Importieren</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="col-12">
        <div class="card shadow-sm">
            <div class="card-body">
                <hr>
                <?=$text?>
        </div>
    </div>
</div>
<?php $this->stop() ?>
