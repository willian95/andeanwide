<template>
    <div class="card border-0">
        <div class="card-header border-bottom-0">
            <span class="text-uppercase">
                BENEFICIARIO: {{ recipient.name }} {{ recipient.lastname }}
            </span>
            <img :src="`https://www.countryflags.io/${recipient.country.abbr}/flat/32.png`">
        </div>
        <div :class="`${!!collapsable ? 'collapse': ''}`" id="collapseRecipient">
            <div class="card-body pb-0">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <InputComponent
                            :value="recipient.country.name"
                            label="País"
                            name="country_name"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            v-model="recipient.dni"
                            label="Número de Documento de Identidad"
                            name="dni"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <InputComponent
                            v-model="recipient.bank_name"
                            label="Banco"
                            name="bank_name"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <InputComponent
                            v-model="recipient.code"
                            label="IBAN/SWIFT"
                            name="code"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            v-model="recipient.bank_account"
                            label="Numero de Cuenta"
                            name="bank_account"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <InputComponent
                            v-model="recipient.email"
                            label="Correo Electrónico"
                            name="email"
                            :disabled="true"
                        />
                    </div>
                    <div class="col-12 col-md-6">
                        <InputComponent
                            v-model="recipient.phone"
                            label="Numero Telefónico"
                            name="phone"
                            :disabled="true"
                        />
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <InputComponent
                            v-model="recipient.address"
                            label="Dirección"
                            name="address"
                            :disabled="true"
                        />
                    </div>
                </div>
            </div>
        </div>
        <a
            v-if="collapsable"
            class="d-block w-100 text-center py-2"
            data-toggle="collapse"
            href="#collapseRecipient"
            role="button"
            aria-expanded="false"
            aria-controls="collapseRecipient"
            @click="showDown = !showDown"
        >
            <i v-if="showDown" class="fa fa-caret-down" aria-hidden="true"></i>
            <i v-else class="fa fa-caret-up" aria-hidden="true"></i>
        </a>
    </div>
</template>

<script>
import InputComponent from './InputComponent'

export default {
    name: 'ViewRecipientComponent',
    components: {
        InputComponent
    },
    props: {
        recipient: {
            type: Object,
            default: () => {}
        },
        collapsable: {
            type: Boolean,
            default: false
        }
    },
    data: () => ({
        showDown: true
    })
}
</script>

<style scoped>
    .card-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
</style>
