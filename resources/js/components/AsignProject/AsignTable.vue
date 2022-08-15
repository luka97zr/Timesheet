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
                            <th>Projects</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{employee.name}}</td>
                            <td>{{employee.email}}</td>
                            <td>projekat</td>
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
                                    <li class="input__block" v-for="(project, index) in userProjects" :key="index" >{{ project.project.name }}<button>x</button></li>
                                </ul>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <select type="button" class="btn btn-info" v-model="projectSelect">
                                <option :value="null" disabled>All</option>
                                <option :value="project.id" v-for="(project, index) in all" :key="index">{{project.name}}</option>
                            </select>
                            <button type="submit" class="btn btn-info" @click="saveUserProjects()">Save</button>
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
            all: [],
            loaded: false,
            projectSelect: null
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
        checkProjects(item) {
            if(this.loaded)
            return this.userProjects.find((element) => {
               return (item.id===element.id)? true : false;
            });
        },
        saveUserProjects() {
            let key = undefined;
            this.all.findIndex((project, index) => {
                key = project.id === this.projectSelect;
            })
               console.log(key);
        },
        async showUserProjects() {
            try {
                this.all = this.$store.state.projects;
                this.userProjects = (await axios.post('/api/user/project', {
                    user_id: this.employee.id
                })).data.data
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