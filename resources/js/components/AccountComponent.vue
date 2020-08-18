<template>
    <div class="card">
        <div class="card-header" :id="`heading${account.id}`">
            <h2 class="mb-0">
                <button
                    class="btn btn-link btn-block text-left py-0 px-0"
                    type="button" 
                    data-toggle="collapse" 
                    :data-target="`#collapse${account.id}`" 
                    aria-expanded="true" 
                    :aria-controls="`collapse${account.id}`"
                >
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="my-0 text-uppercase font-weight-light">
                            {{ account.bank_name }}
                        </h4>
                        <span>
                            <img class="mx-2" :src="`https://www.countryflags.io/${account.country.abbr}/flat/32.png`">
                        </span>
                    </div>
                </button>
            </h2>
        </div>
        <div
            :id="`collapse${account.id}`"
            class="collapse"
            :aria-labelledby="`heading${account.id}`"
            data-parent="#accordionAccounts"
        >
            <div class="card-body">
                <ul class="list-unstyled">
                    <li>
                        PAIS: {{ account.country.name }}
                    </li>
                    <li>
                        MONEDA: {{ account.currency.symbol }}
                    </li>
                    <li>
                        CODIGO: {{ account.code }}
                    </li>
                    <li>
                        BANCO: {{ account.bank_name }}
                    </li>
                    <li>
                        NUMERO DE CUENTA: {{ account.bank_account }}
                    </li>
                    <li>
                        NOMBRES: {{ account.account_name }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'AccountComponent',
    props: {
        account: {
            type: Object,
            default: () => {}
        }
    }
}
</script>
