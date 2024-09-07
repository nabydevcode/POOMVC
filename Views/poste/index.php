<h1> La principale des poste</h1>
<div class="container">
    <div class="row">
        <?php foreach ($donnee as $value): ?>
            <div class="col-4 g-2 ">
                <div class="card" style="width: 100%">
                    <div class="card-body">
                        <h5 class="card-title">
                            <?= $value->titre ?>
                        </h5>
                        <p class="card-text">
                            <?= $value->message ?>
                        </p>
                        <a href="#" class="card-link">
                            <?= $value->created_At ?>
                        </a>
                        <a href="#" class="card-link">
                            <?= $value->actif ?>
                        </a>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
</div>