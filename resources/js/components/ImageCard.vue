<template>
    <div>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title text-uppercase">{{ imageTitle }}</h5>
            </div>
            <img :src="imageUrl" class="card-img-top" :alt="imageTitle">
            <div class="card-body">
                <button type="button" class="btn btn-success btn-block" data-toggle="modal" :data-target="`#imageModal${imageName}`">
                    Ver Imagen
                </button>
            </div>
        </div>

        <!-- Modal -->
        <div
            class="modal fade"
            :id="`imageModal${imageName}`"
            tabindex="-1"
            role="dialog"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-uppercase">{{ imageTitle }}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <img :src="imageUrl" class="w-100" :alt="imageTitle">
                        <slot></slot>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'ImageCard',
    props: {
        imageUrl: {
            type: String,
            default: ''
        },
        imageTitle: {
            type: String,
            default: ''
        },
        imageName: {
            type: String,
            default: ''
        }
    }
}
</script>
