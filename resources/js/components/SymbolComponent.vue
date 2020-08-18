<template>
    <tr class="text-center">
        <td>
            <i
                v-if="symbol.is_default"
                class="fa fa-star text-warning"
                aria-hidden="true"
            >
            </i>
        </td>
        <th>
            <a :href="symbol.show_route">
                {{ symbol.name }}
            </a>
        </th>
        <td v-if="!!rates">
            <span
                v-if="rates === 'error'"
                class="badge badge-pill badge-danger"
            >
                ERROR
            </span>
            <span
                v-else
            >
                <span v-if="symbol.show_inverse">
                    {{ (1 / rates.api_rate ).toFixed(symbol.decimals) }}
                </span>
                <span v-else>
                    {{ rates.api_rate.toFixed(symbol.decimals) }}
                </span>
            </span>
        </td>
        <td v-if="!!rates">
            <span
                v-if="rates === 'error'"
                class="badge badge-pill badge-danger"
            >
                ERROR
            </span>
            <span
                v-else
            >
                <span v-if="symbol.show_inverse">
                    {{ (1 / rates.bid ).toFixed(symbol.decimals) }}
                </span>
                <span v-else>
                    {{ rates.bid.toFixed(symbol.decimals) }}
                </span>
            </span>
        </td>
        <td
            v-else
            colspan="2"
        >
            <button
                class="btn btn-block btn-success btn-sm"
                @click="fetchRates"
            >
                Consultar Tasa
            </button>
        </td>
        <td>{{ symbol.min_amount.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") }} {{ symbol.base.symbol }}</td>
        <td>{{ symbol.max_tier_1.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") }} {{ symbol.base.symbol }}</td>
        <td>{{ symbol.max_tier_2.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1,") }} {{ symbol.base.symbol }}</td>
        <td>
            <span
                v-if="symbol.spread_by === 'point'"
            >
                Puntos
            </span>
            <span
                v-else
            >
                Porcentaje
            </span>
        </td>
        <td>{{ symbol.offset }}</td>
        <td>
            <span
                v-if="symbol.is_active"
                class="badge badge-success"
            >
                Si
            </span>
            <span
                v-else
                class="badge badge-danger"
            >
                No
            </span>
        </td>
    </tr>
</template>

<script>
import axios from 'axios'

export default {
    name: 'SymbolComponent',
    props: {
        symbol: {
            type: Object,
            default: () => {}
        },
    },
    data: () => ({
        rates: null
    }),
    methods: {
        async fetchRates() {
            // this.showTest = false
            // this.showError = false
            try {
                const { data } = await axios.post(`/exchange_rate/${this.symbol.base.symbol}/${this.symbol.quote.symbol}/test`, {
                    offset: this.symbol.offset,
                    offset_by: this.symbol.offset_by,
                    min_pip_value: this.symbol.min_pip_value,
                    api_class: this.symbol.api_class
                })
                if(data.error || data === null) {
                    this.data = 'error'
                } else {
                    this.rates = data
                }
            } catch (error) {
                this.rate = 'error'
            }
        }
    }
}
</script>
