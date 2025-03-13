<section class="conf-step js-hall">
    <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Управление залами</h2>
    </header>
    <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Доступные залы:</p>
        <div class="js-hall-list">
            @include('admin.includes.halls.hallList')
        </div>
        <button class="conf-step__button conf-step__button-accent js-create-hall">Создать зал</button>
    </div>
</section>
