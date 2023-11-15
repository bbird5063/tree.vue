<template>
	<div class="navbar">
		<div @click="$router.push('/')">tree.vue</div>
		<div class="navbar__btns">
			<my-button @click="$router.push('/tree')">Tree</my-button>
		</div>
	</div>
</template>

<script>
export default {
}
</script>

<style scoped>
.navbar {
	height: 50px;
	background-color: lightgray;
	box-shadow: 2px 2px 4px gray;
	display: flex;
	align-items: center;
	padding: 0 15px;
}

.navbar__btns {
	margin-left: auto;
}
</style>
