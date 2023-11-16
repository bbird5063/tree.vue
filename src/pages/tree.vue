<template>
	<div class="about">
		<h1>This is an tree page</h1>
		<tree-catalog :treeHtmlCss="treeHtmlCss" :sourceTree="sourceTree" :sourceContent="sourceContent"></tree-catalog>
	</div>
</template>

<script>
import TreeCatalog from '@/components/TreeCatalog';//
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
			},

			sourceContent: {
				nameTable: 'DiaryBookPayment',
				nameFields: [
					'*'
				],
				indexField: '',
				childTables: [
					{
						nameTable: 'DiaryBook',
						idField: 'ID_DiaryBook',
						nameFields: [
							'DateDiaryBook'
						],
						indexField: 'DateDiaryBook',
					},
					{
						nameTable: 'TypePayment',
						idField: 'ID_TypePayment',
						nameFields: [
							'NameTypePayment'
						],
						indexField: 'UserIndex',
					},
					{
						nameTable: 'SubTypePayment',
						idField: 'ID_SubTypePayment',
						nameFields: [
							'NameSubTypePayment'
						],
						indexField: 'UserIndex',
					},
					{
						nameTable: 'Cash',
						idField: 'ID_Cash',
						nameFields: [
							'IsCash'
						],
						indexField: 'ID_Cash',
					},
					{
						nameTable: 'Currency',
						idField: 'ID_Currency',
						nameFields: [
							'NameCurrency'
						],
						indexField: 'ID_Currency',
					},
				],
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
