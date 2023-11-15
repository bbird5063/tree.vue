<template>
	<div class="about">
		<h1>This is an tree page</h1>
		<tree-catalog :treeHtmlCss="treeHtmlCss" :sourceTree="sourceTree"></tree-catalog>
	</div>
</template>

<script>
import TreeCatalog from '@/components/TreeCatalog';
export default {
	components: {
		TreeCatalog,
	},
	data() {
		return {
			treeHtmlCss: {
				treeTitle: 'Период',
				rootName: 'Все',
				activeColor: 'blue',
				activeBold: true,
				activeUnderline: true,
			},
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
			},//
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
