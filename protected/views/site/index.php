<div class="mdl-grid mdl-cell mdl-cell--9-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
    <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--12-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp pie-chart">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Ingresos</h2>
            </div>
            <div class="mdl-card__supporting-text mdl-card--expand">
                <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="date" class="mdl-textfield__input" name="desde" id="desde" value="<?= date("Y-m-d", strtotime("-1 month", strtotime(date("Y-m-d")))) ?>">
                    <label class="mdl-textfield__label" for="desde">Desde</label>
                </div>
                <div class="mdl-cell mdl-cell--6-col mdl-textfield mdl-js-textfield mdl-textfield--floating-label">
                    <input type="date" class="mdl-textfield__input" name="hasta" id="hasta" value="<?= date("Y-m-d"); ?>">
                    <label class="mdl-textfield__label" for="hasta">Hasta</label>
                </div>
                <div id="chart" class="discrete-bar-chart__container">
                    <svg width="960" height="500"></svg>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="mdl-cell mdl-cell--6-col-desktop mdl-cell--12-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp pie-chart">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Egresos</h2>
            </div>
            <div class="mdl-card__supporting-text">
                
            </div>
        </div>
    </div> -->

    
    <!-- Line chart-->
   <!--  <div class="mdl-cell mdl-cell--7-col-desktop mdl-cell--7-col-tablet mdl-cell--4-col-phone">
        <div class="mdl-card mdl-shadow--2dp line-chart">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">Startup Financing Cycle</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <div class="line-chart__container">

                </div>
            </div>
        </div>
    </div> -->
</div>
<div class="mdl-grid mdl-cell mdl-cell--3-col-desktop mdl-cell--12-col-tablet mdl-cell--4-col-phone mdl-cell--top">
    <!-- Robot card-->
    <!-- <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp todo">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">To-do list</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <ul class="mdl-list">

                </ul>
            </div>
            <div class="mdl-card__actions">
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">remove selected</button>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored ">
                    <i class="material-icons mdl-js-ripple-effect">add</i>
                </button>
            </div>
        </div>
    </div> -->
    <!-- ToDo_widget-->
   <!--  <div class="mdl-cell mdl-cell--12-col-desktop mdl-cell--6-col-tablet mdl-cell--2-col-phone">
        <div class="mdl-card mdl-shadow--2dp todo">
            <div class="mdl-card__title">
                <h2 class="mdl-card__title-text">To-do list</h2>
            </div>
            <div class="mdl-card__supporting-text">
                <ul class="mdl-list">

                </ul>
            </div>
            <div class="mdl-card__actions">
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect">remove selected</button>
                <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--fab mdl-shadow--8dp mdl-button--colored ">
                    <i class="material-icons mdl-js-ripple-effect">add</i>
                </button>
            </div>
        </div>
    </div> -->

</div>