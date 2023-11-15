<template>
	<div>
		<navbar @openModal="openModal"></navbar>
		<div></div>
		<div class="app">
			<h2>authMode = {{ $store.state.auth.authMode }}</h2>
			<h3>ID(route) = {{ $route.params.id }}</h3>
			<h3>ID(store) = {{ $store.state.auth.id }}</h3>
			<!-- <router-view> - в него будут встраиваться компоненты из router.js -->
			<router-view @openModal="openModal"></router-view>
			<auth-form :nameModal="nameModal"></auth-form>
		</div>
	</div>
</template>

<script>
import Navbar from '@/components/Navbar';
import AuthForm from '@/components/auth/AuthForm';

export default {
	components: {
		Navbar,
		AuthForm,
	},
	data() {
		return {
			nameModal: '',
		}
	},
	methods: {
		openModal(openNameModal) {
			this.nameModal = openNameModal;
		}
	},
	mounted() {
		if (
			location.hostname.includes('192.168.0.100') ||
			location.hostname.includes('localhost')
		) {
			this.$store.commit('auth/setIsLocalhost', true);
		} else {
			this.$store.commit('auth/setIsLocalhost', false);
			this.$store.dispatch('auth/updateUser');
		}
		console.log('==dataUser========================');
		console.table(this.$store.state.auth.dataUser);
	}
};
</script>

<style>
* {
	margin: 0;
	padding: 0;
	box-sizing: border-box;
}

.app {
	padding: 20px;
}

.app_btns {
	display: flex;
	/* кнопка и список напротив друга  */
	justify-content: space-between;
	align-items: center;
	margin: 0;
}

table,
td,
th {
	border-collapse: collapse;
	border: 3px solid #245488;
}

td {
	padding: 5px;
}

.page__wrapper {
	display: flex;
	margin-top: 15px;
	align-items: center;
}

.page {
	border: 1px solid black;
	padding: 10px;
	cursor: pointer;
}

.current-page {
	border: 2px solid teal;
	cursor: pointer;
}
</style>
