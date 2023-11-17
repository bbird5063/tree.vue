<template>
	<div>
		<h1 class="header">This is an tree page</h1>
		<div class="flex-container">
			<div class="sidebar">
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

.container {
	display: grid;
	/* Шаблон и явно указать области */
	grid-template-areas:
		'header header'
		/*шаблон для 1 строки и на 2 колонки разтянут */
		'sidebar content';
	/*шаблон для 2 строки: 1 колонка сайдбар, 2 колонка контент */
	/* Сделаем отступы */
	grid-gap: 10px;
	/* Определим размеры */
	grid-template-columns: 250px 1fr;
	/* Теперь сайдбар будут статично всегда 150px, а контентная часть будет растягиваться в зависимости от размера экрана */

	/* Шаблоны для строк */
	grid-template-rows: 50px 1fr;
	/* header стратичный 50px, 2 строка будет расширятья */

}

.item {
	padding: 10px;
	border: 1px solid black;
}

/* Названия для областей: */
.header {
	grid-area: header;
	/* для названия области (безкавычек). Эти названия указаны в шаблоне выше */
}

.sidebar {
	grid-area: sidebar;
	align-self: start;
	border-right: 1px solid grey;
	/* Чтобы не растягиваться по высоте контента */
}

.content {
	grid-area: content;
}
</style>
