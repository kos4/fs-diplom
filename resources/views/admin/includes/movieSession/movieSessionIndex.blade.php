<section class="conf-step js-sessions-movies">
    <header class="conf-step__header conf-step__header_opened">
        <h2 class="conf-step__title">Сетка сеансов</h2>
    </header>
    <div class="conf-step__wrapper">
        <p class="conf-step__paragraph">
            <button class="conf-step__button conf-step__button-accent js-create-movie">Добавить фильм</button>
        </p>
        <div class="conf-step__movies js-movie-list">
            @include('admin.includes.movies.movieList')
        </div>

        <div class="conf-step__seances js-movie-session-halls">
            @include('admin.includes.movieSession.movieSessionHalls')
        </div>
    </div>
</section>
