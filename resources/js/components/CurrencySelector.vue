<template>
    <div class="input-group input-group-lg">
        <input type="text" class="form-control">
        <div class="input-group-append">
            <button
                class="btn btn-primary dropdown-toggle"
                type="button"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
            >
                {{ selectedCurrency.symbol }}
            </button>
            <div class="dropdown-menu">
                <a
                    v-for="currency in currencies"
                    :key="currency.id"
                    class="dropdown-item"
                    @click.stop="selectCurrency(currency.id)"
                    href="#"
                >
                    <img
                        :src='`https://www.countryflags.io/${currency.country.abbr}/flat/32.png`'
                        height="32"
                    />
                    <span class="ml-2">
                        {{ currency.symbol }}
                    </span>
                    <small class="font-weight-light text-muted ml-2">
                        {{ currency.name }}
                    </small>
                </a>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'CurrencySelectorComponent',
    props: {
        label: {
            type: String,
            default: ''
        },
        currencies: {
            type: Array,
            default: () => []
        }
    },
    data: () => ({
        indexSelected: null,
    }),
    computed: {
        // selectCurrency () {
        //     cur = this.currencies.filter(item => item.id === this.indexSelected)
        // }
    },
    methods: {
        selectCurrency (id) {
            console.log(id)
        }
    }
}
</script>
