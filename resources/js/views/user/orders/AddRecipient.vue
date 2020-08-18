<template>
    <div>
        <OrderComponent
            :order="order"
        />
        <div class="card my-4">
            <div class="card-header border-bottom-0">
                <span>
                    Beneficiarios
                </span>
                <CreateRecipientComponent
                    :preSelectedCountryId="order.currency_received.country.id"
                    :preSelectedCountryName="order.currency_received.country.name"
                    :createRecipientRoute="createRecipientRoute"
                    :csrf="csrf"
                    :orderId="order.id"
                />
            </div>
            <div class="card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th class="text-center"></th>
                            <th class="text-center">País</th>
                            <th class="text-center">Nombres</th>
                            <th class="text-center">Banco</th>
                            <th class="text-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr
                            v-for="recipient in recipients"
                            :key="recipient.id"
                        >
                            <th class="text-center" style="padding-top: 1.4rem;">
                                <div class="form-check">
                                    <input
                                        class="form-check-input "
                                        type="radio"
                                        :value="recipient.id"
                                        v-model="recipient_id" 
                                    >
                                </div>
                            </th>
                            <td class="text-center">
                                <img class="mr-2" :src="`https://www.countryflags.io/${recipient.country.abbr}/flat/32.png`">
                                {{ recipient.country.name }}
                            </td>
                            <td class="text-center">
                                {{ recipient.name }} {{ recipient.lastname }}
                            </td>
                            <td class="text-center">
                                {{ recipient.bank_name }}
                            </td>
                            <td class="text-center">
                                <button
                                    type="button"
                                    class="btn btn-success btn-sm"
                                    data-toggle="modal"
                                    :data-target="`#recipient_${recipient.id}_Modal`"
                                >
                                    Ver Beneficiaro
                                </button>
                                <div
                                    class="modal fade"
                                    :id="`recipient_${recipient.id}_Modal`"
                                    tabindex="-1"
                                    role="dialog"
                                    :aria-labelledby="`#recipient_${recipient.id}_ModalLabel`"
                                    aria-hidden="true"
                                >
                                    <div class="modal-dialog modal-dialog-centered modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" :id="`recipient_${recipient.id}_ModalLabel`">BENEFICIARIO</h5>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        <div class="modal-body pb-0">
                                            <ViewRecipient
                                                :recipient="recipient"
                                            />
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-dark btn-block" data-dismiss="modal">Cerrar</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-footer">
                <FormComponent
                    method="POST"
                    :action="addRecipientRoute"
                >
                    <input type="hidden" name="order_id" :value="order.id">
                    <input type="hidden" name="recipient_id" :value="recipient_id">
                    <input type="hidden" name="_token" :value="csrf">
                    <div class="row">
                        <div class="col-12">
                            <TextareaComponent
                                v-model="reason"
                                label="Motivo"
                                name="reason"
                                :rules="requiredRules"
                            />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <button
                                type="submit"
                                :class="`btn ${!recipient_id ? 'btn-secondary' : 'btn-success'} btn-block`"
                                :disabled="!recipient_id"
                            >
                                <i v-if="!!recipient_id" class="fa fa-plus-circle mr-2" aria-hidden="true"></i>
                                <i v-else class="fa fa-ban mr-2" aria-hidden="true"></i>
                                Agregar Beneficiario
                            </button>
                        </div>
                    </div>
                </FormComponent>
            </div>
        </div>
    </div>    
</template>

<script>
import OrderComponent from '../../../components/OrderComponent'
import CreateRecipientComponent from '../../../components/CreateRecipient'
import ViewRecipient from '../../../components/ViewRecipient'
import FormComponent from '../../../components/FormComponent'
import TextareaComponent from '../../../components/TextareaComponent'

export default {
    name: 'AddRecipientView',
    components: {
        OrderComponent,
        CreateRecipientComponent,
        ViewRecipient,
        FormComponent,
        TextareaComponent
    },
    props: {
        addRecipientRoute: {
            type: String,
            default: ''
        },
        createRecipientRoute: {
            type: String,
            default: ''
        },
        csrf: {
            type: String,
            default: ''
        },
        order: {
            type: Object,
            default: () => {}
        },
        recipients: {
            type: Array,
            default: () => []
        }
    },
    data: () => ({
        recipient_id: null,
        reason: '',
        requiredRules: [
            v => !!v || 'Este campo es requerido.'
        ]
    })
}
</script>

<style scoped>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    td {
        vertical-align: middle;
    }
</style>
