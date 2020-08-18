<template>
    <div class="card">
        <div class="card-header border-0">
            <span>
                NUESTRAS CUENTAS BANCARIAS
            </span>
        </div>
        <div class="card-body">
            <div class="accordion" id="accordionAccounts">
                <AccountComponent
                    v-for="account in accounts"
                    :key="account.id"
                    :account="account"
                />
            </div>
        </div>
        <div
            v-if="showCreatePayment"
            class="card-body border-0"
        >
            <CreatePaymentComponent
                :createPaymentRoute="createPaymentRoute"
                :accounts="accounts"
                :order="order"
                :csrf="csrf"
                :rejectRoute="rejectRoute"
            />
        </div>
    </div>
</template>

<script>
import AccountComponent from './AccountComponent'
import CreatePaymentComponent from './CreatePayment'

export default {
    name: 'AccountsComponent',
    components: {
        AccountComponent,
        CreatePaymentComponent
    },
    props: {
        accounts: {
            type: Array,
            default: () => []
        },
        order: {
            type: Object,
            default: () =>{}
        },
        showCreatePayment: {
            type: Boolean,
            default: false
        },
        csrf: {
            type: String,
            default: ''
        },
        createPaymentRoute: {
            type: String,
            default: ''
        },
        rejectRoute: {
            type: String,
            default: ''
        }
    }
}
</script>
