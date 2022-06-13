<template>
    <tr>
        <td class="project-table__name">
            <select class="project-table__select">
                <option>Choose client</option>
                <option>Client name 1</option>
                <option>Client name 2</option>
                <option>Client name 3</option>
                <option>Client name 4</option>
            </select>
        </td>
        <td class="project-table__name">
            <select class="project-table__select">
                <option value="">Choose project</option>
                <option value="">Choose category</option>
            </select>
        </td>
        <td class="project-table__name">
            <select class="project-table__select">
                <option value="">Choose category</option>
                <option value="">Choose category</option>
            </select>
            <span class="validationMessage" style="display: none;"></span>
        </td>
        <td class="project-table__name">
            <input type="text"  class="in-text medium" v-model="description" ref="description">
        </td>
        <td class="project-table__name">
            <input type="text" class="in-text" v-model.number="hours" ref="hours">
        </td>
        <td class="project-table__name">
            <input type="text" class="in-text" v-model.number="overtime" ref="overtime">
        </td>
    </tr>
</template>

<script>
export default {
    expose: ['description', 'hours','overtime'],
    data() {
        return {
            description: '',
            overtime: null,
            hours: null,
        }
    },
    mounted() {
        // this.$refs.input
    }
}
</script>

<style>

</style>