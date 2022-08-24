<template>
    <table class="projects-table">
        <thead>
            <tr>
                <th class="small"><span>Date</span></th>
                <th class="small"><span>Employees</span></th>
                <th class="small"><span>Projects</span></th>
                <th class="small"><span>Categories</span></th>
                <th class="small"><span>Description</span></th>
                <th class="small"><span>Time</span></th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(entry, index) in data" :key="index">
                <td>{{entry.date}}</td>
                <td>{{employee}}</td>
                <td>{{entry.category_project.project.name}}</td>
                <td>{{entry.category_project.category.name}}</td>
                <td>Front-end Development</td>
                <td>{{entry.hours}}</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: ['data', 'employee']
}
</script>

<style>

</style>