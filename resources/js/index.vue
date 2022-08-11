<template>
    <v-app>
        <v-main>
            <v-container>
                <div class="container-wrap">
                    <header-component v-if="!$route.meta.hideNavbar"></header-component>
                        <router-view></router-view>
                    <footer-component v-if="!$route.meta.hideNavbar"></footer-component>
                </div>
            </v-container>
        </v-main>
    </v-app>
</template>
<script>
import HeaderComponent from './global/Header.vue'
import FooterComponent from './global/Footer.vue'
import Modal from './components/Modal/Modal.vue'
import ModalClients from './components/Modal/ModalClients.vue'
import ModalProjects from './components/Modal/ModalProjects.vue'
import ModalCategories from './components/Modal/ModalCategories.vue'
import ModalEmployees from './components/Modal/ModalEmployees.vue'
export default {
    components: {
        HeaderComponent,
        FooterComponent,
        Modal,
        ModalClients,
        ModalProjects,
        ModalCategories,
        ModalEmployees
    }
}
</script>
