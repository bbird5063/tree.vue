<template>
	<div v-html="ulTree">
	</div>
</template>

<script>
import axios from 'axios';
export default {
	name: 'my-tree',
	props: {
		srcTree: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
			url: '/php_modules/tree/controller_tree.php',
			ulTree: '',
		}
	},

	methods: {
		async loadTree() {
			try {
				const response = await axios.get(
					this.url,
					{
						params: this.srcTree,
					}
				);

				console.log(response.data.get);
				console.log(response.data.test);
				this.ulTree = response.data.test;

			} catch (e) {
				alert('Ошибка!');
			}
		},

	},
	mounted() {
		this.loadTree();
	},


}
</script>

<style scoped></style>