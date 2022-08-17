<template>
    <div class="project-wrap">
        <div class="container">
            <div class="table-wrapper">
                <div class="table-title">
                    <div class="row">
                        <div class="col-sm-6">
                            <h2>Asign <b>Projects</b></h2>
                        </div>
                    </div>
                </div>
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{employee.name}}</td>
                            <td>{{employee.email}}</td>
                            <td>
                                <a href="#editEmployeeModal" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" @click="openModal()">&#xE254;</i></a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <div id="editEmployeeModal" class="modal fade" :class="{'active' : isModalOpen}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form>
                        <div class="modal-header">
                            <h4 class="modal-title">Edit</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true" @click="closeModal()">&times;</button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <h5>Projects</h5>
                                <ul class="project__dropdown" v-if="userProjects">
                                    <li class="input__block" v-for="(project, index) in userProjects" :key="index" >{{ project.name }}<button>x</button></li>
                                </ul>
                                <div class="text-center" v-if="loading">
                                    <v-progress-circular
                                    indeterminate
                                    color="primary"
                                    ></v-progress-circular>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <select type="button" class="btn btn-info" v-model="projectSelect">
                                <option :value="null" disabled>All</option>
                                <option :value="project.id" v-for="(project, index) in allProjects" :key="index" >{{project.name}}</option>
                            </select>
                            <button type="submit" class="btn btn-info" @click.prevent="saveUserProjects()">Add Project</button>
                            <button type="submit" class="btn btn-info" @click.prevent="updateUserProjects()">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['employee'],
    data() {
        return {
            isModalOpen: false,
            checkedProjects: [],
            userProjects: null,
            activeProjects: [],
            allProjects: [],
            loading: false,
            projectSelect:null,
        }
    },
    methods: {
        openModal() {
            this.isModalOpen = true;
            this.showUserProjects();
        },
        closeModal() {
            this.isModalOpen = false;
        },
        saveUserProjects() {
            if (!this.projectSelect) return
            const projectIndex = this.allProjects.findIndex(project => project.id === this.projectSelect);
            const data = this.allProjects.splice(projectIndex, 1);
            this.userProjects.push(data[0]);
            this.projectSelect = null;
        },
        async showUserProjects() {
            try {
                this.loading = true;
                this.userProjects = (await axios.post('/api/user/project', {
                    user_id: this.employee.id
                })).data.data.map(project => project.project)
                this.loading = false;
                this.allProjects = [...this.$store.state.projects].filter(project => !this.userProjects.find(userProject => userProject.id === project.id))
            }catch(error) {
                console.log(error)
            }
        },
        async updateUserProjects() {
            try {
                let payload = [];
                payload = this.userProjects.map(project => {
                    return {
                        user_id: this.employee.id,
                        project_id: project.id
                    }
                });
                await axios.post('/api/user/project/store', {
                    projects: payload
                });
                this.$emit('updated');
                this.closeModal();

            }catch(error) {
                console.log(error)
            }
        }
    },
}
</script>

<style>
.modal.active {
    display: block;
    visibility: visible;
    opacity: 1;
}
.input__block {
    display: flex;
    align-items: center;
    justify-content: space-between;
}
.project__dropdown {
    overflow: auto;
    height: 100px
}
.form-control {
    max-width: 20px;
}
</style>