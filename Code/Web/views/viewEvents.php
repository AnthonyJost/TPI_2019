<?php $this->_t = 'Événements';?>
<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2>Prochains événements</h2>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec malesuada lorem maximus mauris scelerisque, at rutrum nulla dictum. Ut ac ligula sapien. Suspendisse cursus faucibus finibus.</p>
        </div>
        <div class="row">
        <?php foreach($events as $event): ?>
                <div class="col-lg-4 col-md-6">
                    <div class="categorie-item">
                        <div class="ci-thumb set-bg" data-setbg="img/categories/1.jpg"></div>
                        <div class="ci-text">
                            <h2><?= $event->title() ?></h2>
                            <time><?= $event->date() ?></time>
                        </div>
                    </div>
                </div>
        <?php endforeach; ?>
        </div>
    </div>
</section>
<!-- categories section end -->
