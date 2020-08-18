<template>
    <table class="table align-items-center table-flush">
        <thead class="thead-light">
            <tr class="text-center">
                <th></th>
                <th scope="col">Par</th>
                <th scope="col">API</th>
                <th scope="col">Tasa</th>
                <th scope="col">Mínimo</th>
                <th scope="col">Nivel 1</th>
                <th scope="col">Nivel 2</th>
                <th scope="col">Tipo de Compensación</th>
                <th scope="col">Compensación</th>
                <th scope="col">Activo</th>
            </tr>
        </thead>
        <tbody>
            <SymbolComponent
                v-for="symbol in symbols"
                :key="symbol.id"
                :symbol="symbol"
            />
        </tbody>
    </table>
</template>

<script>
import SymbolComponent from '../../../components/SymbolComponent'

export default {
    name: 'Symbols',
    components: {
        SymbolComponent,
    },
    props: {
        data: {
            type: Object,
            default: () => {}
        }
    },
    data: () => ({
        symbols: []
    }),
    created () {
        this.symbols = this.data.data
    }
}
</script>
