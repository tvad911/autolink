import Vuex from 'vuex'
import Vue from 'vue'
import createPersistedState from 'vuex-persistedstate'

Vue.use(Vuex)

var store = new Vuex.Store({
	state: {
		counter: 0
	},

	mutations: {
		increment(state) {
		state.counter ++
		}
	},

	plugins: [createPersistedState()]
})

export default store;