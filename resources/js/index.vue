<template>
    <div class="container">
            <header-component v-if="!$route.meta.hideNavbar"></header-component>
            <router-view></router-view>
            <footer-component v-if="!$route.meta.hideNavbar"></footer-component>
    </div>
</template>
<script>
import HeaderComponent from './global/Header.vue'
import FooterComponent from './global/Footer.vue'
export default {
    components: {
        HeaderComponent,
        FooterComponent
    }
}
</script>
