@if ($halls)
    @foreach ($halls as $hall)
        <div class="conf-step__seances-hall">
            <h3 class="conf-step__seances-title">{{ $hall->name }}</h3>
            <div class="conf-step__seances-timeline" data-id="{{ $hall->id }}">
                @if($hall->movieSessions)
                    @foreach($hall->movieSessions as $movieSession)
                        <div class="conf-step__seances-movie js-movie-session" data-id="{{ $movieSession->id }}" data-movie-id="{{ $movieSession->movie->id }}" draggable="true" style="width: {{ ceil($movieSession->movie->runtime/2) }}px; left: {{ ceil($movieSession->startTime/2) }}px;">
                            <p class="conf-step__seances-movie-title">{{ $movieSession->movie->title }}</p>
                            <p class="conf-step__seances-movie-start">{{ $movieSession->movie_session_time }}</p>
                            <img src="{{ Vite::asset('resources/admin/i/trash.png') }}" class="conf-step__seances-movie-trash-hide" alt="trash">
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    @endforeach
@endif

