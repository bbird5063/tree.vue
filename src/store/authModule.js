import axios from 'axios';

export const authModule = {
	state: () => ({
		dataUser: '',
		currModal: '',
		isLocalhost: false,
		authMode: 0,
		id: 0,

		authShow: false,
		currentPath: '',
	}),
	/*
	#login-modal-content, #signup-modal-content, #forgot-password-modal-content, #code-modal-content, #password-modal-content, #user-modal-content, #exit-modal-content
	*/

	mutations: {
		setDataUser(state, dataUser) {
			state.dataUser = dataUser;
		},
		setCurrModal(state, currModal) {
			state.currModal = currModal;
		},
		setIsLocalhost(state, bool) {
			state.isLocalhost = bool;
		},
		setAuthMode(state, authMode) {
			state.authMode = authMode;
		},
		setId(state, id) {
			state.id = id;
		},
		setAuthShow(state, bool) {
			state.authShow = bool;
		},
		setCurrentPath(state, currentPath) {
			state.currentPath = currentPath;
		},
	},

	actions: {
		async updateUser({ state, commit }) {
			try {
				const response = await axios.post('/php_modules/auth/controller_update.php');
				console.log('==response.data.user_data===========================');
				console.log(response.data.user_data);
				console.log(response.data);
				if (response.data.user_data) {
					commit('setDataUser', response.data.user_data);
				}
				else {
					commit('setDataUser', '');
				}
				response.data.new_num ? commit('auth/setAuthMode', response.data.new_num) : '';
				console.log(state.dataUser);

			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			}
		},

	},

	namespaced: true,
};
