<template>
	<div class="about">
		<h1>This is an about page</h1>
		<!--<my-tree :srcTree="srcTree"></my-tree>-->
		<my-kantor3 :sourceTree="sourceTree"></my-kantor3>
	</div>
</template>

<script>
export default {
	data() {
		return {
			sourceTree: {
				nameTable: 'credit',
				idField: 'Credit',
				nameField: 'NameCredit',
				indexField: 'UserIndex',
				childTable: {
					nameTable: 'typepayment',
					idField: 'ID_TypePayment',
					nameField: 'NameTypePayment',
					indexField: 'UserIndex',
					childTable: {
						nameTable: 'subtypepayment',
						idField: 'ID_SubTypePayment',
						nameField: 'NameSubTypePayment',
						indexField: 'UserIndex',
					},
				},
			},
		}
	},
	methods: {
		test() {
			alert('test()');
		},
	}
}
</script>

<style scoped></style>
