<template>
    <div class="card-body">
        <div
            v-if="user.address && user.address.verified_at"
            class="pl-lg-4"
        >
            <div class="alert alert-success" role="alert">
                Verificación <strong>Nivel 2</strong> completada.
            </div>
        </div>
        <div
            v-else-if="user.address && !user.address.verified_at"
            class="pl-lg-4"
        >
            <div class="alert alert-danger" role="alert">
                Pendiente verificación <strong>Nivel 2</strong>.
            </div>
        </div>
        <div
            v-else-if="user.identity && !user.identity.verified_at"
            class="pl-lg-4"
        >
            <div class="alert alert-danger" role="alert">
                Pendiente verificación <strong>Nivel 1</strong>.
            </div>
        </div>
        <div
            v-else-if="user.identity && user.identity.verified_at" 
            class="pl-lg-4"
        >
            <div class="alert alert-success" role="alert">
                Verificación <strong>Nivel 1</strong> completada.
            </div>
        </div>

        <UserInclude :user="user" />
        <hr class="my-4" />
        <IdentityInclude
            :user="user"
            :validateIdentityRoute="validateIdentityRoute"
            :unvalidateIdentityRoute="unvalidateIdentityRoute"
            :csrf="csrf"
        />
        <hr class="my-4" />
        <AddressInclude
            :user="user"
            :validateAddressRoute="validateAddressRoute"
            :unvalidateAddressRoute="unvalidateAddressRoute"
            :csrf="csrf"
        />
    </div>
</template>

<script>
import UserInclude from './includes/User'
import IdentityInclude from './includes/Identity'
import AddressInclude from './includes/Address'

export default {
    name: 'ShowUser',
    components: {
        UserInclude,
        IdentityInclude,
        AddressInclude
    },
    props: {
        user: {
            type: Object,
            default: () => {}
        },
        validateIdentityRoute: {
            type: String,
            default: () => {}
        },
        unvalidateIdentityRoute: {
            type: String,
            default: () => {}
        },
        validateAddressRoute: {
            type: String,
            default: () => {}
        },
        unvalidateAddressRoute: {
            type: String,
            default: () => {}
        },
        csrf: {
            type: String,
            default: ''
        }
    }
}
</script>
