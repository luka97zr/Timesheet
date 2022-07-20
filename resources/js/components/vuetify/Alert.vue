<template>
  <v-alert v-if="isSuccess" type="success" width="auto" >
    Client Successfully updated
    </v-alert>
</template>

<script>
export default {
 props: ['isSuccess']
}
</script>

<style>

</style>