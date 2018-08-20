{{--View the thread question--}}
<div class="card" v-if="!editing">
    <div class="card-header">
        <div class="level">
            <img src="{{ asset($thread->creator->avatar_path) }}" alt="{{ $thread->creator->name }}" width="25"
                 height="25" class="mr-3">

            <span class="flex">
                                    <a href="/profiles/{{  $thread->creator->name }}">{{ $thread->creator->name }}</a> posted:
                <span v-text="title"></span>
                                </span>
        </div>
    </div>

    <div class="card-body" v-html="body"></div>

    <div class="card-footer" v-if="authorize('owns', thread)">
        <button class="btn btn-warning" @click="editing = true">Edit</button>
    </div>
</div>

{{--Edit the thread question--}}
<div class="card" v-else>
    <div class="card-header">
        <div class="level">
            <input class="form-control" type="text" v-model="form.title">
        </div>
    </div>

    <div class="card-body">
        <div class="form-group">
            <wysiwyg name="body" v-model="form.body"></wysiwyg>
        </div>
    </div>

    <div class="card-footer">
        <div class="level">
            <button class="btn btn-primary" @click="udpate">Update</button>
            <button class="btn btn-warning" @click="resetForm">Cancel</button>

            @can ('update', $thread)
                <form method="POST" action="{{ $thread->path() }}" class="ml-auto">
                    {{ csrf_field() }}
                    {{ method_field('DELETE') }}

                    <button type="submit" class="btn btn-danger">Delete Thread</button>
                </form>
            @endcan
        </div>
    </div>
</div>