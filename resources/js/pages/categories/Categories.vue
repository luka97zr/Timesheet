<template>
  <div class="wrapper">
        <section class="content">
            <div class="main-content">
                <h2 class="main-content__title">Category</h2>
                <div class="table-navigation">
                    <a href="javascript:;" class="table-navigation__create btn-modal"  @click="openModal()"><span>Create new category</span></a>
                    <form class="table-navigation__input-container" action="javascript:;">
                        <input type="text" class="table-navigation__search" v-model="search">
                        <button type="submit" class="icon__search"></button>
                    </form>
                </div>
                <div class="alphabet">
                    <ul class="alphabet__navigation">
                        <li class="alphabet__list" v-for="(letter,index) in getAlphabet" :key="index">
                            <a class="alphabet__button" href="javascript:;" :class="{'alphabet__button--disabled' : !checkCategoryName(letter)}" @click="searchCategory(letter)">{{letter}}</a>
                        </li>
                    </ul>
                </div>
                <category-accordion v-for="(category, index) in categories" :key="index" :category="category" @resend="refreshData()" @updated="updatedSuccessfuly()"></category-accordion>
                <alert v-if="isSuccess" :message="'Category Successfully updated'"></alert>
            </div>
            <div class="pagination" v-if="categories.length>0">
                <ul class="pagination__navigation">
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click="prevPage()">Previous</a>
                    </li>
                    <li class="pagination__list" v-for="(page, index) in numOfPages" :key="index">
                        <a class="pagination__button pagination__button--active" href="javascript:;" @click="goToPage(page)">{{page}}</a>
                    </li>
                    <li class="pagination__list">
                        <a class="pagination__button" href="javascript:;" @click="nextPage()">Next</a>
                    </li>
                </ul>
            </div>
        </section>
        <modal-categories
            :showModal="showNewModal"
            @closed="this.showNewModal = false"
            @closeModal="closeModal()"
            @created="createdSuccessfuly()"
            @resend="refreshData()">
        </modal-categories>
        <v-overlay value="overlay" v-if="!isLoaded"  opacity=".85">
            <v-progress-circular
                indeterminate
                size="64"
            ></v-progress-circular>
        </v-overlay>
        <alert v-if="isCreated" :message="'Category created successfuly'"></alert>
    </div>
</template>

<script>
import ModalCategories from '../../components/Modal/ModalCategories.vue'
import CategoryAccordion from './CategoryAccordion.vue'
import Alert from '../../components/vuetify/Alert.vue'
import getAlphabetMixin from '../../mixins/getAlphabetMixin';
import toggleModal from '../../mixins/toggleModalMixin';
import timeoutMixin from '../../mixins/timeoutMixin';
import succesMessage from '../../mixins/successMessageMixin';


export default {
    components: {
        ModalCategories,
        CategoryAccordion,
        Alert
    },
    data() {
        return {
            showNewModal: false,
            categories: [],
            categoryKey: null,
            numOfPages: null,
            isLoaded: true,
            perPage: 3,
            currentPage: 1,
            isSuccess: false,
            isCreated: false,
            search: '',
            typingTimer: null,
            categoriesAlphabet: null
        }
    },
    mixins: [getAlphabetMixin , toggleModal, timeoutMixin, succesMessage],
    created() {
        if(this.$store.state.categories.length === 0)  this.getCategoriesAlphabet();
        this.getCategories();
    },
    methods: {
        checkCategoryName(letter) {
            return (this.$store.state.categoriesAlphabet.includes(letter))? true : false;
        },
        nextPage() {
            if (this.currentPage >= this.numOfPages) return
            this.currentPage++;
            this.getCategories();
        },
        prevPage() {
            if (this.currentPage <= 1) return
            this.currentPage--;
            this.getCategories();
        },
        goToPage(page) {
            this.currentPage = page;
            this.getCategories();
        },
        refreshData() {
            this.getCategoriesAlphabet();
            this.getCategories();
        },
        categoryCreatedSuccessfuly() {
            this.isCreated = true;
            setTimeout(() => {
                this.isCreated = false;
            }, 2000);
        },
        async getCategoriesAlphabet() {
            try {
                this.isLoaded = false
                this.categoriesAlphabet = ( await axios.get(`/api/category/alphabet`)).data;
                this.isLoaded = true
                this.$store.commit('setCategoriesAlphabet', this.categoriesAlphabet)
            }catch(error) {

            }
        },
        async getCategories() {
            try {
                this.isLoaded = false
                const data =( await axios.get(`/api/category/?page=${this.currentPage}`)).data;
                this.categories = data.data;
                this.numOfPages = data.meta.last_page;
                this.isLoaded = true
            }catch(error) {

            }
        },
        async searchCategory(term) {
            try {
                this.currentPage = 1;
                await this.timeout(500);
                const data = (await axios.get(`/api/category/${term}?page=${this.currentPage}`)).data;
                this.categories = data.data;
                this.numOfPages = data.meta.last_page;
            }catch(error) {
                console.log(error);
            }
        }
    },
    watch: {
        search: {
            handler() {
               this.searchCategory(this.search)
            }
        },
    }
}
</script>

<style>

</style>