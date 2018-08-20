<reply :attributes="{{ $reply }}" inline-template v-cloak>
    <div id="reply-{{ $reply->id }}" class="card">
        <div class="card-header">
            <div class="level">
                <h5 class="flex">
                    <a href="/profiles/{{  $reply->owner->name }}">{{ $reply->owner->name }}</a> said
                    {{ $reply->created_at->diffForHumans() }}
                </h5>
                @if (Auth::check())
                    <div>
                        <favorite :reply="{{ $reply }}"></favorite>
                    </div>
                @endif
            </div>
        </div>

        <div class="card-body">
            <div v-if="editing">
                <div class="form-group">
                    <textarea class="form-control" cols="30" rows="5" v-model="body"></textarea>
                </div>

                <button class="btn btn-sm btn-primary" @click="update">Update</button>
                <button class="btn btn-sm btn-link" @click="editing = false">Cancel</button>
            </div>
            <div v-else v-text="body"></div>
        </div>
        @can ('update', $reply)
            <div class="card-footer level">
                <button class="btn btn-primary btn-sm mr-1" @click="editing = true">Edit</button>
                <button class="btn btn-danger btn-sm" @click="destroy">Delete</button>
            </div>
        @endif
    </div>

</reply>