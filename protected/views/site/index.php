<div class="mdl-grid">
    <h4 style="width: 100%;text-align: center;">Bienvenid@ <?= Yii::app()->user->name; ?></h4>
    <div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
        <?php if(Yii::app()->user->getRoles()->type == "Administrador"){ ?>
            <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--12-col-tablet mdl-cell--2-col-phone">
                <div class="mdl-card mdl-shadow--2dp pie-chart">
                    <div class="mdl-card__title">
                        <h2 class="mdl-card__title-text">Ingresos</h2>
                    </div>
                    <div class="mdl-card__supporting-text mdl-card--expand">
                        <div class="mdl-grid">
                            <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--12-col-tablet mdl-cell--12-col-phone form__article">
                                <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input type="date" class="mdl-textfield__input" name="desde" id="desde" value="<?= date("Y-m-d", strtotime("-1 month", strtotime(date("Y-m-d")))) ?>">
                                    <label class="mdl-textfield__label" for="desde">Desde</label>
                                </div>
                                <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                                    <input type="date" class="mdl-textfield__input" name="hasta" id="hasta" value="<?= date("Y-m-d"); ?>">
                                    <label class="mdl-textfield__label" for="hasta">Hasta</label>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone form__article">
                                <h3 class="text-color--smooth-gray">Por sucursal</h3>
                                <div id="chart" class="discrete-bar-chart__container">
                                    <svg width="960" height="500"></svg>
                                </div>
                            </div>
                            <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--6-col-tablet mdl-cell--4-col-phone form__article">
                                <h3 class="text-color--smooth-gray">Por vendedor</h3>
                                <div id="chartS" class="discrete-bar-chart__container">
                                    <svg width="960" height="500"></svg>
                                </div>
                                <!-- <table class="mdl-data-table mdl-js-data-table">
                                    <thead>
                                        <tr>
                                            <th class="mdl-data-table__cell--non-numeric">Vendedor</th>
                                            <th class="mdl-data-table__cell--non-numeric">Sucursal</th>
                                            <th class="mdl-data-table__cell--non-numeric">Recaudación</th>
                                        </tr>
                                    </thead>
                                    <tbody id="mib-tbody-dashboard">
                                        <tr>
                                            <td class="mdl-data-table__cell--non-numeric">Pepe</td>
                                            <td class="mdl-data-table__cell--non-numeric">To Kill a Mockingbird</td>
                                            <td class="mdl-data-table__cell--non-numeric">1960</td>
                                        </tr>
                                    </tbody>
                                </table> -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <div class="mdl-grid mdl-cell mdl-cell--3-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
    </div>
    
</div>