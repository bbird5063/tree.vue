<template>
	<div class="main">
		{{ treeHtmlCss.treeTitle }}
		<ul class="Container" id="tree">
			<li id="root-" @click="tree" class="Node IsRoot IsLast ExpandClosed">
				<div class="Expand"></div>
				<div id="rootName" class="Content">{{ treeHtmlCss.rootName }}</div>
				<ul class="Container">
				</ul>
			</li>
		</ul>
	</div>
</template>

<script>
import axios from 'axios';
export default {
	props: {
		treeHtmlCss: {
			type: Object,
			required: true,
		},
		sourceTree: {
			type: Object,
			required: true,
		},
		sourceContent: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
			currentTree: {},
			node: {},
		}
	},

	methods: {
		tree(event) {
			if (!event) return; // при обновлении страницы event.target->error
			event = event || window.event
			let clickedElem = event.target || event.srcElement

			if (!clickedElem || !this.hasClass(clickedElem, 'Expand')) { // 'Expand'-квадратик (+/-)
				if (this.hasClass(clickedElem, 'Content')) {
					let elems = document.querySelectorAll('.Content');
					for (let elem of elems) {
						if (this.treeHtmlCss.activeBold) elem.style.fontWeight = 100;
						if (this.treeHtmlCss.activeColor) elem.style.color = 'black';
						if (this.treeHtmlCss.activeUnderline) elem.style.textDecoration = 'none';
					}
					if (clickedElem.id !== 'rootName') {
						this.loadContent(clickedElem.parentNode.id);
						if (this.treeHtmlCss.activeBold) clickedElem.style.fontWeight = 700;
						if (this.treeHtmlCss.activeColor) clickedElem.style.color = this.treeHtmlCss.activeColor;
						if (this.treeHtmlCss.activeUnderline) clickedElem.style.textDecoration = 'underline';
					}
				}
				return // клик не там или при обновлении страницы
			}

			// Node, на который кликнули (BB: было 'let node = ...')
			this.node = clickedElem.parentNode // <li> она parentNode для <div>(+/-)
			if (this.hasClass(this.node, 'ExpandLeaf')) {  // 'ExpandLeaf' - узел без квадратика (лист, ссылка-не папка)
				return // клик на листе
			}

			if (this.node.isLoaded || this.node.getElementsByTagName('LI').length) {
				// Узел уже загружен через axios(возможно он пуст)
				this.toggleNode(this.node)
				return
			}

			if (this.node.getElementsByTagName('LI').length) {
				// Узел не был загружен при помощи axios, но у него почему-то есть потомки
				// Например, эти узлы были в DOM дерева до вызова tree()
				// Как правило, это "структурные" узлы
				// ничего подгружать не надо
				this.toggleNode(this.node)
				return
			}

			// загрузить узел
			this.nextLevelTree(this.node);
			console.log('----currentTree----');
			console.table(this.currentTree);
			this.load(this.node)
		},

		hasClass(elem, className) {
			return new RegExp("(^|\\s)" + className + "(\\s|$)").test(elem.className)
		},

		toggleNode(node) {
			// определить новый класс для узла
			var newClass = this.hasClass(node, 'ExpandOpen') ? 'ExpandClosed' : 'ExpandOpen'
			// заменить текущий класс на newClass
			// регексп находит отдельно стоящий open|close и меняет на newClass
			var re = /(^|\s)(ExpandOpen|ExpandClosed)(\s|$)/
			this.node.className = node.className.replace(re, '$1' + newClass + '$3')
		},

		showLoading(on) {
			var expand = this.node.getElementsByTagName('DIV')[0]
			expand.className = on ? 'ExpandLoading' : 'Expand'
		},

		onLoaded(data) {
			for (var i = 0; i < data.length; i++) {
				var child = data[i]
				var li = document.createElement('LI')
				li.id = child.id

				li.className = "Node Expand" + (child.isFolder ? 'Closed' : 'Leaf')
				if (i == data.length - 1) li.className += ' IsLast'

				li.innerHTML = '<div class="Expand"></div><div class="Content">' + child.title + '</div>'
				if (child.isFolder) {
					li.innerHTML += '<ul class="Container"></ul>'
				}
				this.node.getElementsByTagName('UL')[0].appendChild(li)
			}

			this.node.isLoaded = true
			this.toggleNode(this.node)
		},

		async load(node) {
			try {
				this.showLoading(true)
				const url = '/php_modules/kantor/controller_tree.php';
				const response = await axios.get(url, { params: this.currentTree });
				console.log('----SQL-----------');
				console.log(response.data.sql);
				response.data && this.onLoaded(response.data.tree);
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.showLoading(false);
			}
		},

		async loadContent(id) {
			try {
				this.showLoading(true)
				const url = '/php_modules/kantor/controller_content.php';
				const response = await axios.get(url, { params: this.buildSQL(id) });
				console.log('----SQL-----------');
				console.log(response.data.sql);
				//response.data && this.onLoaded(response.data.tree);
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.showLoading(false);
			}
		},

		nextLevelTree(node) {
			//let ID_Table = node.id.slice(0, node.id.indexOf('-'));
			let ID_Table = node.id.slice(0, node.id.indexOf('='));
			this.currentTree = this.sourceTree;
			if (ID_Table == 'root') return;
			while (true) {
				if (!this.currentTree.childTable) {
					this.currentTree.id = node.id;
					return;
				}
				if (this.currentTree.idField === ID_Table) {
					this.currentTree = this.currentTree.childTable;
					this.currentTree.id = node.id;
					return;
				}
				this.currentTree = this.currentTree.childTable;
			}
		},

		buildSQL(id) {
			let
				sqlQuery = 'SELECT ',
				selectFields = '',
				hooks = '',
				leftJoin = '',
				orderBy = '',
				where = '\nWHERE ' + this.sourceContent.nameTable + '.' + id;

			for (let key in this.sourceContent.nameFields) {
				selectFields += ',' + this.sourceContent.nameTable + '.' + this.sourceContent.nameFields[key];
			};

			for (let key in this.sourceContent.childTables) {
				for (let ind in this.sourceContent.childTables[key].nameFields) {
					selectFields += ',' + this.sourceContent.childTables[key].nameTable + '.' + this.sourceContent.childTables[key].nameFields[ind];
					orderBy += ',' + this.sourceContent.childTables[key].nameTable + '.' + this.sourceContent.childTables[key].indexField;
				}

				hooks += '(';
				leftJoin += ' \nLEFT JOIN ' + this.sourceContent.childTables[key].nameTable + ' ON ' + this.sourceContent.nameTable + '.' + this.sourceContent.childTables[key].idField + '=' + this.sourceContent.childTables[key].nameTable + '.' + this.sourceContent.childTables[key].idField + ')';
			};

			selectFields = selectFields.substr(1);
			orderBy = orderBy.substr(1);
			sqlQuery += selectFields + ' \nFROM ' + hooks + ' ' + this.sourceContent.nameTable + leftJoin + ' ' + where + ' \nORDER BY ' + orderBy + ';';

			console.log(sqlQuery);
			return { sqlQuery };
		},
	},

	mounted() {
		this.currentTree = this.sourceTree;
		//this.tree();
	},
}
</script>

<style>
/* 'scoped' не ставить*/
.main {
	text-align: left;
}

.Container {
	padding: 0;
	margin: 0;
	/* добавил, иначе #App - center */
	text-align: left;
}

.Container li {
	list-style-type: none;
}

/* indent for all tree children excepts root */
.Node {
	background-image: url('~@/assets/img/tree/i.gif');
	background-position: top left;
	background-repeat: repeat-y;
	margin-left: 18px;
	zoom: 1;
}

.IsRoot {
	margin-left: 0;
}


/* left vertical line (grid) for all nodes */
.IsLast {
	background-image: url('~@/assets/img/tree/i_half.gif');
	background-repeat: no-repeat;
}

.ExpandOpen .Expand {
	background-image: url('~@/assets/img/tree/expand_minus.gif');
}

/* closed is higher priority than open */
.ExpandClosed .Expand {
	background-image: url('~@/assets/img/tree/expand_plus.gif');
}

/* highest priority */
.ExpandLeaf .Expand {
	background-image: url('~@/assets/img/tree/expand_leaf.gif');
}

.Content {
	min-height: 18px;
	margin-left: 18px;
}

* html .Content {
	height: 18px;
}

.Expand {
	width: 18px;
	height: 18px;
	float: left;
}

.ExpandOpen .Container {
	display: block;
}

.ExpandClosed .Container {
	display: none;
}

.ExpandOpen .Expand,
.ExpandClosed .Expand,
.Content {
	/*BB:.Content*/
	cursor: pointer;
}

.ExpandLeaf .Expand {
	cursor: auto;
}

.ExpandLoading {
	width: 18px;
	height: 18px;
	float: left;
	background-image: url('~@/assets/img/tree/expand_loading.gif');
}

#rootName {
	cursor: default;
}
</style>