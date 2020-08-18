<div class="card">
    <img src="{{ $url }}" class="card-img-top" alt="{{ $title }}">
    <div class="card-body">
        <h5 class="card-title">{{ $title }}</h5>
        <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="{{ '#imageModal' . $name }}">
            Ver Imagen
        </button>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="{{ 'imageModal' . $name }}" tabindex="-1" role="dialog" aria-labelledby="{{ '#imageModal' . $name . 'Title' }}" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ '#imageModal' . $name . 'Title' }}">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <img src="{{ $url }}" class="img-fluid" alt="{{ $title }}">
            </div>
        </div>
    </div>
</div>