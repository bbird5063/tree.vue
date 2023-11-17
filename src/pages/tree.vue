<template>
	<div>
		<h1 class="header">This is an tree page</h1>
		<div class="flex-container">
			<div class="tree">
				<tree-catalog @loadContent="loadContent" :urlControllers="urlControllers" :treeHtmlCss="treeHtmlCss"
					:sourceTree="sourceTree" :sourceContent="sourceContent">
				</tree-catalog>
			</div>
			<div class="content">
				<tree-content :rowsContent="rowsContent"></tree-content>
			</div>
		</div>
	</div>
</template>

<script>
import TreeCatalog from '@/components/TreeCatalog';
import TreeContent from '@/components/TreeContent';
export default {
	components: {
		TreeCatalog,
		TreeContent,
	},
	data() {
		return {
			urlControllers: {
				treeController: '/php_modules/kantor/controller_tree.php',
				contentController: '/php_modules/kantor/controller_content.php',
			},

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

			rowsContent: {},

		}
	},

	methods: {
		test() {
			alert('test()');
		},

		loadContent(rowsContent) {
			this.rowsContent = rowsContent;
			console.log('====loadContent(rowsContent)=========================');
			console.log(rowsContent);
		}
	}
}
</script>

<style scoped>
/* scoped*/
.flex-container {
	display: flex;
	justify-content: space-between;
	flex-wrap: wrap;
}

.tree {
	width: 240px;
	height: 400px;
	margin: 5px;
	overflow: auto;
	border-right: 1px solid grey;
	border-bottom: 1px solid grey;
}

.content {
	width: 970px;
	overflow: auto;
}
</style>
