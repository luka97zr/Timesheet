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
	},
	actions: {
		async loadUser({commit,dispatch, getters}) {
				try {
					const user = (await axios.get('/api/user')).data
					commit('setUser',user.user);
					commit('setLoggedIn', true)
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
				const response = await axios.get(`/api/calendar/${moment(this.getters.getStartDate).format('YYYY-MM-DD')}/${moment(this.getters.getEndDate).format('YYYY-MM-DD')}?id=1`)
				commit('setLogs',response.data)
				commit('getCalculatedHours',response.data)
			} catch(error) {
				console.log(error)
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