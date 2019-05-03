@component('account.partials.file', compact('file'))

    @slot('links')
        <div class="level">
            <div class="level-left">
                <p class="level-item">
                    @if($file->isFree())
                        <span class="tag is-success">Free</span>
                    @else
                        <span class="tag is-primary">{{ money($file->price) }}</span>
                    @endif
                </p>

                <p class="level-item">
                    @if(!$file->approved)
                        <span class="tag is-danger has-text-white">Pending approval</span>
                    @else
                        <span class="tag is-primary">Approved</span>
                    @endif
                </p>


                <p class="level-item">
                    @if($file->live)
                        <span class="tag is-success">Live</span>
                    @else
                        <span class="tag is-danger">Not live</span>
                    @endif
                </p>
                <a href="#" class="level-item"><i class="fa fa-edit"> </i> Make changes</a>
            </div>
            <div class="level-right">
                <small class="level-item">Last modified: {{ $file->updated_at->diffForHumans() }}</small>
            </div>
        </div>
    @endslot

@endcomponent