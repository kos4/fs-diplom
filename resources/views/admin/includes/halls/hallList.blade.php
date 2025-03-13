@if ($halls)
    <ul class="conf-step__list">
        @foreach ($halls as $hall)
            <li class="js-hall-element" data-id="{{ $hall->id }}">
                <a href="javascript:;">{{ $hall->name }}</a>
                <button class="conf-step__button conf-step__button-trash" data-id="{{ $hall->id }}"></button>
            </li>
        @endforeach
    </ul>
@endif
