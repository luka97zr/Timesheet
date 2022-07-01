import Vuex from 'vuex'
import { isLoggedIn, logOut } from './shared/utils/auth'


export default {
	state: {
			isLoggedIn: false,
			user: {},
			calendar: []
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
		}
	},
	actions: {
		async loadUser({commit,dispatch}) {
			if(isLoggedIn()) {
				try {
					const user = (await axios.get('/user')).data
					commit('setUser',user);
					commit('setLoggedIn', true)
				} catch(error) {
					dispatch('logout')
				}
			}
		},
		logout({commit}) {
			commit('setUser',{});
			commit('setLoggedIn',false);
			logOut();
		},
		calendarLogs({commit},data) {
			commit('setLogs',data)
		}
	},
	getters: {
		async getUser(state) {
			return await state.user
		}
	}
}