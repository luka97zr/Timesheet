<template>
    <div class="container">
            <header-component v-if="!$route.meta.hideNavbar"></header-component>
            <modal v-if="$route.meta.modal">
                <modal-clients v-if="$route.name==='clients'"></modal-clients>
                <modal-projects v-if="$route.name==='projects'"></modal-projects>
                <modal-categories v-if="$route.name==='categories'"></modal-categories>
                <modal-employees v-if="$route.name==='employees'"></modal-employees>
            </modal>
            <router-view></router-view>
            <footer-component v-if="!$route.meta.hideNavbar"></footer-component>
    </div>
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
