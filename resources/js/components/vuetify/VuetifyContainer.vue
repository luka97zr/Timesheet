<template>
  <v-app>
    <v-main>
        <v-container>
            <slot></slot>
        </v-container>
    </v-main>
    </v-app>
</template>

<script>
export default {

}
</script>

<style>
.v-application--wrap {
  min-height: unset;
}
</style>