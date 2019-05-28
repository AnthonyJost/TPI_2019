<?php
require_once "model/eventsManager.php";
$event = getEventTitle();
?>

<!-- categories section -->
<section class="categories-section spad">
    <div class="container">
        <div class="section-title">
            <h2><?=$event['Title']?></h2>
        </div>
        <div class="row">
            <div class="col-lg-4 col-md-6">
                <div class="categorie-item">
                    <div class="ci-thumb set-bg" data-setbg="img/categories/1.jpg"></div>
                    <form class="signup-form" method="post" action="">
                        <input type="text" name="idEvents" value="" hidden>
                        <label>Titre</label>
                        <input type="text" name="Title" value=""><br/>
                        <label>Date</label>
                        <input type="date" name="Date" value=""><br/><br/>
                        <button type="submit" class="site-btn">Modifier</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- categories section end -->
