<section class="conf-step js-config-hall">
    <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Конфигурация залов</h2>
    </header>
    <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">Выберите зал для конфигурации:</p>
        @if ($halls)
            @include('admin.includes.configHall.configHallList')

            <form action="">
                @csrf
                @method('PATCH')
                <div class="js-config-hall">
                    @include('admin.includes.configHall.configHall', ['hall' => $halls->first()])
                </div>

                <fieldset class="conf-step__buttons text-center">
                    <button class="conf-step__button conf-step__button-regular" type="reset">Отмена</button>
                    <input type="submit" value="Сохранить" class="conf-step__button conf-step__button-accent">
                </fieldset>
            </form>
        @endif
    </div>
</section>
