<template>
    <div>
        <nav class="navbar navbar-light fixed-top bg-secondary d-flex justify-content-between">
            <button
                type="button"
                class="navbar-toggler"
                @click="toggleSidebar"
            >
                <i class="fa fa-bars" aria-hidden="true"></i>
            </button>

            <a class="navbar-brand pt-0" href="/">
                <img src="/admin/img/brand/blue.png" class="navbar-brand-img" alt="andean wide logo">
            </a>

            <!-- <a class="navbar-brand" href="#">HOME</a> -->
            <div class="dropdown" aria-labelledby="navbarDropdownMenuLink">
                <button
                    class="btn btn-link dropdown-toggle text-uppercase mx-0"
                    type="button"
                    id="dropdownMenu2"
                    data-toggle="dropdown"
                    aria-haspopup="true"
                    aria-expanded="false"
                >
                    {{ user.name ? user.name : 'Usuario' }}
                </button>
                <div class="dropdown-menu dropdown-menu-right">
                    <span class="dropdown-item-text my-2"><strong>Bienvenido</strong></span>
                    <div
                        v-for="(item, index) in menu"
                        :key="index"
                    >
                        <div v-if="item.label === 'divider'" class="dropdown-divider" />
                        <div v-else-if="item.label !== 'divider' && !!item.method">
                            <a class="dropdown-item px-4" href="#"  @click.prevent="submitForm(index)">
                                <i :class="item.iconClass" aria-hidden="true"></i>
                                {{ item.label }}
                            </a>
                            <form :action="item.route" method="post" class="d-none" :ref="`form_${index}`">
                                <input type="hidden" name="_token" :value="csrf" />
                            </form>
                        </div>
                        <a v-else class="dropdown-item px-4" :href="item.route">
                            <i :class="item.iconClass" aria-hidden="true"></i>
                            {{ item.label }}
                        </a>
                    </div>
                </div>
            </div>
        </nav>

        <div class="content-wrapper">
            <SidebarComponent
                :menu="sidebarMenu"
                :user="user"
                :hidden="hideSidebar"
                :adminLayout="adminLayout"
            />
            <div class="w-100" style="margin-top: 70px">
                <slot></slot>
            </div>
            <div :class="`overlay ${ !hideSidebar ? 'active' : '' }`" @click="hideSidebar = true"/>
        </div>
    </div>
</template>

<script>
import SidebarComponent from './Sidebar'

export default {
    name: 'Navbar',
    components: {
        SidebarComponent
    },
    props: {
        user: {
            type: Object,
            default: () => {}
        },
        menu: {
            type: Array,
            default: () => []
        },
        sidebarMenu: {
            type: Array,
            default: () => []
        },
        csrf: {
            type: String,
            default: ''
        },
        adminLayout: {
            type: Boolean,
            default: false
        }
    },
    data: () => ({
        hideSidebar: true,
    }),
    methods: {
        submitForm(index) {
            this.$refs[`form_${index}`][0].submit()
        },
        toggleSidebar() {
            this.hideSidebar = !this.hideSidebar
        }
    }
}
</script>

<style scoped>
    .navbar-brand-img {
        max-height: 48px;
    }

    .content-wrapper {
        display: flex;
        width: 100%;
        align-items: stretch;
    }

    .btn-link {
        color: #3C4D69;
    }

    .overlay {
        display: none;
        position: fixed;
        /* full screen */
        width: 100vw;
        height: 100vh;
        /* transparent black */
        background: rgba(0, 0, 0, 0.7);
        /* middle layer, i.e. appears below the sidebar */
        z-index: 998;
        opacity: 0;
        /* animate the transition */
        transition: all 300s ease-in-out 50ms;
    }

    .overlay.active {
        display: block;
        opacity: 1;
    }


    @media (max-width: 768px) {
        .navbar-brand-img {
            max-height: 32px;
        }
    }
</style>