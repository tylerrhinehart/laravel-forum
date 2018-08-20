@forelse($threads as $thread)
    <div class="card mb-4">
        <div class="card-header">
            <div class="level">
                <div class="flex">
                    <h4>
                        <a href="{{ $thread->path() }}">
                            @if(auth()->check() && $thread->hasUpdatesFor(auth()->user()))
                                <strong>{{ $thread->title }}</strong>
                            @else
                                {{ $thread->title }}
                            @endif
                        </a>
                    </h4>

                    <h6>Posted by <a href="{{ route('profile', $thread->creator) }}">{{ $thread->creator->name }}</a></h6>
                </div>

                <a href="{{ $thread->path() }}">
                    <strong>{{ $thread->replies_count }} {{ str_plural('reply', $thread->replies_count) }}</strong>
                </a>
            </div>
        </div>

        <div class="card-body">
            <div class="body">{!! $thread->body !!}</div>
        </div>

        <div class="card-footer">
            {{ $thread->visits()->count() }} visits
        </div>
    </div>
@empty
    <p>There are no relevant results at this time.</p>
@endforelse