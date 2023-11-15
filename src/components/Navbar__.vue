<template>
	<nav class="navbar navbar-expand-lg navbar-light bg-light navbar-fixed-top">
		<div class="container-fluid">
			<a class="navbar-brand" href="#" @click="$router.push('/1/0')">{{ $store.state.auth.currModal }} HS({{
				$store.state.auth.authMode }})</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
				aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Переключатель навигации">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarSupportedContent">
				<ul class="navbar-nav me-auto mb-2 mb-lg-0">

					<li v-for="point in menu" class="nav-item">
						<a class="nav-link" :class="{ active: point.name == currentPoint }" href="#"
							@click.prevent="activePoint(point)">{{ point.name }}</a>
					</li>

					<li v-if="$store.state.auth.dataUser" class="nav-item dropdown">
						<a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button"
							data-bs-toggle="dropdown" aria-expanded="false">
							{{ $store.state.auth.dataUser.login }}
						</a>
						<ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
							<li>
								<a @click.prevent="openAuthModal('user-modal-content', 3)" class="nav-link" href="#"
									data-bs-toggle="modal" data-bs-target="#login-signup-modal">Профиль</a>
							</li>
							<li>
								<a @click.prevent="
									openAuthModal('forgot-password-modal-content', 3)
									" class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#login-signup-modal">Изменить пароль</a>
							</li>
							<li>
								<hr class="dropdown-divider" />
							</li>
							<li>
								<a @click.prevent="openAuthModal('exit-modal-content', 0)" class="nav-link" href="#"
									data-bs-toggle="modal" data-bs-target="#login-signup-modal">Выход</a>
							</li>
						</ul>
					</li>
					<li v-else class="nav-item navbar-right">
						<a @click.prevent="openAuthModal('login-modal-content', 0)" href="#" class="nav-link" data-bs-toggle="modal"
							data-bs-target="#login-signup-modal">Вход</a>
					</li>
				</ul>
			</div>
		</div>
	</nav>
</template>

<script>
import { mapState, mapGetters, mapActions, mapMutations } from 'vuex';
export default {
	data() {
		return {
			currentPoint: '',
			menu: [
				{ path: '/PageTest5', name: 'P5' },
				{ path: '/PageTest6', name: 'P6' },
				{ path: '/PageTest7', name: 'P7' },
				{ path: '/PageTest8', name: 'P8' },
				{ path: '/PageTest9', name: 'P9' },
			],
		};
	},
	methods: {
		...mapActions({
			fadeOut: 'auth/fadeOut',
			fadeIn: 'auth/fadeIn',
		}),
		activePoint(point) {
			this.$router.push(point.path);
			this.currentPoint = point.name;
		},
		openAuthModal(authModal, authMode) {
			this.$emit('openModal', authModal);
			this.$store.commit('auth/setAuthMode', authMode);
		},
	},
};
</script>

<style scoped></style>
