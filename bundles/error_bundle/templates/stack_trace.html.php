<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Error Handler</title>
</head>
<body class="container bg-light">
<div class="card my-3">
    <div class="card-header">
        <h1>Stack Trace</h1>
        <h3 class="mb-0"><?= $this->getException()->getMessage() ?></h3>
        <h5>An error occurred in line <?= $this->getException()->getLine() ?> in "<a href="file://<?= $this->getException()->getFile() ?>" download type="application/octet-stream"><?= $this->getException()->getFile() ?></a>"</h5>
    </div>
    <ul class="list-group list-group-flush">
        <?php foreach($this->getException()->getTrace() as $key => $content): ?>
            <li class="list-group-item">
                <div class="row">
                    <div class="col-12">
                        <span><?= $content["file"] ?? 'Dateiname nicht anwendbar' ?></span>
                    </div>
                    <div class="row col-12">
                        <div class="row">
                            <div class="col-2 fw-bold">Line</div>
                            <div class="col-10"><?= $content["line"]?? 'nicht anwendbar' ?></div>
                        </div>
                        <div class="row">
                            <div class="col-2 fw-bold">Class</div>
                            <div class="col-10"><?= $content["class"] ?? 'nicht anwendbar' ?></div>
                        </div>
                        <div class="row">
                            <div class="col-2 fw-bold">Method</div>
                            <div class="col-10"><?= $content["function"] ?? 'nicht anwendbar' ?></div>
                        </div>
                        <div class="row">
                            <div class="col-2 fw-bold">Arguments</div>
                            <div class="col-10">
                        <pre>
                        <?php foreach ($content["args"] as $argument): ?>

                            <code>
                                    <?= print_r($argument) ?>
                                </code>

                        <?php endforeach ?>
                            </pre>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
        <?php endforeach ?>
    </ul>
</div>



<!-- Optional JavaScript; choose one of the two! -->

<!-- Option 1: Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

<!-- Option 2: Separate Popper and Bootstrap JS -->
<!--
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
-->
</body>
</html>