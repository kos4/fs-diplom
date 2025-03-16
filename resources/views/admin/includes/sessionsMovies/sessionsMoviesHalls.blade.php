@if ($halls)
    @foreach ($halls as $hall)
        <div class="conf-step__seances-hall">
            <h3 class="conf-step__seances-title">{{ $hall->name }}</h3>
            <div class="conf-step__seances-timeline">

            </div>
        </div>
    @endforeach
@endif

