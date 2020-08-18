<template>
    <div :class="`sidebar ${ hidden ? 'hidden' : '' }`">
        <div class="sidebar-header">
            <div v-if="!adminLayout">
                <h3 class="my-0 text-white">{{ user.name ? `${user.name} ${user.lastname}` : 'USUARIO' }}</h3>
                <small class="text-uppercase" v-if="user.identity && user.identity.verified_at && user.address && user.addres.verified_at">
                    Cuenta Verificada - Nivel 2
                </small>
                <small class="text-uppercase" v-else-if="user.identity && user.identity.verified_at">
                    Cuenta Verificada - Nivel 1
                </small>
                <small class="text-uppercase" v-else>
                    Cuenta No Verificada
                </small>
                <br>
                <small>{{ user.email }}</small>
            </div>
            <div v-else>
                <h3 class="my-0 text-white">{{ user.email }}</h3>
            </div>
        </div>
        <ul class="list-unstyled components">
            <li
                v-for="(item, index) in menu"
                :key="index"
            >
                <a
                    class="sidebar-item"
                    v-if="item.label !== 'divider'"
                    :href="item.route"
                >
                    <i :class="`${item.iconClass} mr-2`" aria-hidden="true"></i>
                    {{ item.label }}
                </a>
                <div 
                    v-else
                    class="dropdown-divider"
                >
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    name: 'Sidebar',
    props: {
        menu: {
            type: Array,
            default: () => []
        },
        user: {
            type: Object,
            default: () => {}
        },
        hidden: {
            type: Boolean,
            default: false
        },
        adminLayout: {
            type: Boolean,
            default: false,
        }
    },
    data: () => ({})
}
</script>

<style scoped>
    .sidebar {
        min-width: 350px;
        max-width: 350px;
        min-height: 100vh;
        max-height: 100vh;
        position: fixed;
        border: none;
        top: 81px;
        left: 0;
        height: 100vh;
        background: white;
        z-index: 999;
        transition: all 300ms ease-in-out 50ms;
        transform-origin: center left;
    }


    .sidebar.hidden {
        margin-left: -350px;
    }

    .sidebar-header {
        display: block;
        padding: 1.5rem 1rem;
        background-color: #3C4D69;
        border: 1px solid #3c4d69;
        color: white;
    }

    .sidebar-item {
        display: block;
        padding: 1rem;
        text-decoration: none;
        transition: all 300ms ease-in-out 50ms;
        color: #323235;
        font-size: 0.85rem;
    }

    .sidebar-item:hover {
        background-color: #3C4D69;
        color: white;
        text-decoration: none;
    }

    @media (max-width: 768px) {
        .sidebar {
            min-width: 250px;
            max-width: 250px;
            top: 74.8px
        }

        .sidebar.hidden {
            margin-left: -250px;
        }
    }
</style>