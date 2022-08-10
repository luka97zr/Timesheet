import Vuex from 'vuex'
import moment from 'moment'
import { isLoggedIn, logOut } from './shared/utils/auth'


export default {
	state: {
		isLoggedIn: false,
		user: {},
		calendar: null,
		startDate: null,
		endDate: null,
		totalHours: 0,
		gotToken: false,
		countries: [],
		clientsAlphabet: [],
		projectsAlphabet: [],
		categoriesAlphabet: [],
		clients: [],
		projects: [],
		leads: [],
		categories: [],
		employees: [],
		roles: []
	},
	mutations: {
		setUser(state, payload) {
			state.user = payload
		},
		setLoggedIn(state, payload) {
			state.isLoggedIn = payload;
		},
		setLogs(state,payload) {
			state.calendar = payload;
		},
		setStartDate(state,payload) {
			state.startDate = payload
		},
		setEndDate(state,payload) {
			state.endDate = payload
		},
		getCalculatedHours(state,payload) {
			state.totalHours = 0
			payload?.forEach(log => {
				state.totalHours += log['hours']
			});
		},
		setGettingToken(state,payload) {
			state.gotToken = payload;
		},
		setCountries(state, payload) {
			state.countries = payload;
		},
		setClientsAlphabet(state, payload) {
			state.clientsAlphabet = payload;
		},
		setAllClients(state, payload) {
			state.clients = payload;
		},
		setProjectsAlphabet(state, payload) {
			state.projectsAlphabet = payload;
		},
		setAllProjects(state, payload) {
			state.projects = payload;
		},
		setLeads(state,payload) {
			state.leads = payload;
		},
		setCategories(state,payload) {
			state.categories = payload;
		},
		setCategoriesAlphabet(state, payload) {
			state.categoriesAlphabet = payload;
		},
		setEmployees(state, payload) {
			state.employees = payload;
		},
		setRoles(state, payload) {
			state.roles = payload;
		}
	},
	actions: {
		async loadUser({commit,dispatch}) {
				try {
					const user = (await axios.get('/api/user')).data
					await commit('setUser',user.user);
					await commit('setLoggedIn', true)
				} catch(error) {
					dispatch('logout')
				}
		},
		logout({commit}) {
			commit('setUser',{});
			commit('setLoggedIn',false);
			logOut();
		},
		async calendarLogs({commit}) {
			try {
				const response = await axios.get(`/api/calendar/${moment(this.getters.getStartDate).format('YYYY-MM-DD')}/${moment(this.getters.getEndDate).format('YYYY-MM-DD')}`)
				commit('setLogs',response.data)
				commit('getCalculatedHours',response.data)
			} catch(error) {
				console.log(error)
			}
		},
		async getCountries({commit}) {
            try {
                const data = await axios.get('/api/country');
               	commit('setCountries', data.data)
            } catch(error) {
				console.log(error)
            }
        },
		async getClients({commit}) {
			try {
                const data = await axios.get(`/api/client/all`);
                commit('setAllClients', data.data.data);
            }catch(error) {

            }
		},
		async getLeads({commit}) {
			try {
                const data = await axios.get(`/api/leads`);
                commit('setLeads', data.data);
            }catch(error) {

            }
		},
		async getProjects({commit}) {
            try {
                const data = await axios.get(`/api/project/all`);
                commit('setAllProjects',data.data.data);
            }catch(error) {

            }
        },
		async getRoles({commit}) {
			try {
                const data = await axios.get(`/api/role`);
                commit('setRoles',data.data);
            } catch(error) {

            }
		}
	},
	getters: {
		async getUser(state) {
			return await state.user
		},
		getStartDate(state) {
			return state.startDate;
		},
		getEndDate(state) {
			return state.endDate
		},
		getCalendar(state) {
			return state.calendar
		},
		isUserAuth(state) {
			return state.isLoggedIn
		}
	}
}