<template>
    <div class="row justify-content-center">
        <div class="col">
            <!-- Button trigger modal -->
            <FormComponent>
                <input type="text" class="d-none" name="user_id" :value='userId'>
                <button type="button" class="btn btn-danger btn-block" data-toggle="modal" data-target="#rejectIdentityModal">
                    Rechazar
                </button>

                <div
                    id="rejectIdentityModal"
                    class="modal fade"
                    tabindex="-1"
                    role="dialog"
                    aria-labelledby="rejectIdentityModalLabel"
                    aria-hidden="true"
                >
                    <div class="modal-dialog modal-lg">
                        <form :action="rejectRoute" method="post">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="rejectIdentityModalLabel">Rechazar Solicitud</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" class="d-none" name="user_id" :value="userId">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <TextareaComponent
                                        v-model="reasons"
                                        name="reasons"
                                        label="Observaciones"
                                        hint="El contenido de este campo será enviado al usuario, vía correo electrónico."
                                        :rules="requiredRules"
                                        rows="10"
                                    />
                                </div>
                                <div class="modal-footer pt-0">
                                    <div class=" col-6 col-md-3 px-0">
                                        <button type="button" class="btn btn-outline-dark btn-block" data-dismiss="modal">Close</button>
                                    </div>
                                    <div class="col-6 col-md-3 px-0">
                                        <button class="btn btn-danger btn-block" type="submit">
                                            Rechazar
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </FormComponent>
        </div>
        <div class="col">
            <FormComponent
                method="POST"
                :action="acceptRoute"
            >
                <input type="hidden" name="_token" :value="csrf">
                <input type="text" class="d-none" name="user_id" :value='userId'>
                <button class="btn btn-success btn-block" type="submit">
                    Aceptar
                </button>
            </FormComponent>
        </div>
    </div>
</template>

<script>
import FormComponent from './FormComponent'
import TextareaComponent from './TextareaComponent'

export default {
    name: 'UserDocumentEvaluationComponent',
    components: {
        FormComponent,
        TextareaComponent
    },
    props: {
        userId: {
            type: [String, Number],
            default: ''
        },
        acceptRoute: {
            type: String,
            default: ''
        },
        rejectRoute: {
            type: String,
            default: ''
        },
        csrf: {
            type: String,
            default: ''
        }
    },
    data: () => ({
        reasons: null,
        requiredRules: [
            v => !!v || 'Este campo es requerido'
        ]
    })
}
</script>
