<ul class="conf-step__selectors-box">
    @foreach ($halls as $hall)
        <li>
            <input type="radio" class="conf-step__radio" name="chairs-hall" value="{{ $hall->id }}" {{ $loop->first ? 'checked' : '' }}>
            <span class="conf-step__selector">{{ $hall->name }}</span>
        </li>
    @endforeach
</ul>

