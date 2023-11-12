<template>
	<div class="main">
		Наше дерево:
		<ul class="Container" id="tree">
			<li id="root-" @click="tree" class="Node IsRoot IsLast ExpandClosed">
				<div class="Expand"></div>
				<div class="Content">Каталог</div>
				<ul class="Container">
				</ul>
			</li>
		</ul>
	</div>
</template>

<script>
import axios from 'axios';
export default {
	name: 'my-kantor3',
	props: {
		sourceTree: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
			currentTree: {},
			node: {},
			urlOld: '/php_modules/kantor/data.php',
			url: '/php_modules/kantor/controller_tree.php',
		}
	},

	methods: {

		tree(event) {
			if (!event) return; // при обновлении страницы event.target->error
			event = event || window.event
			let clickedElem = event.target || event.srcElement

			console.log(clickedElem); // при загрузке undefined

			if (!clickedElem || !this.hasClass(clickedElem, 'Expand')) { // 'Expand'-квадратик (+/-)
				return // клик не там или при обновлении страницы
			}

			// Node, на который кликнули (BB: было 'let node = ...')
			this.node = clickedElem.parentNode // <li> она parentNode для <div>(+/-)
			if (this.hasClass(this.node, 'ExpandLeaf')) {  // 'ExpandLeaf' - узел без квадратика (лист, ссылка-не папка)
				return // клик на листе
			}

			if (this.node.isLoaded || this.node.getElementsByTagName('LI').length) {
				// Узел уже загружен через AJAX(возможно он пуст)
				this.toggleNode(this.node)
				return
			}

			if (this.node.getElementsByTagName('LI').length) {
				// Узел не был загружен при помощи AJAX, но у него почему-то есть потомки
				// Например, эти узлы были в DOM дерева до вызова tree()
				// Как правило, это "структурные" узлы
				// ничего подгружать не надо
				this.toggleNode(this.node)
				return
			}

			// загрузить узел
			this.nextLevelTree(this.node);
			this.load(this.node)
		},

		hasClass(elem, className) {
			console.log(elem, elem.className);
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

		async load_OLD(node) {
			try {
				this.showLoading(true)
				!this.currentTree && alert('currentTree пустой!');
				const response = await axios.get(this.urlOld, { params: { id: this.node.id } });
				console.log('----response.data OLD-----------');
				console.log(response.data);
				response.data && this.onLoaded(response.data);
				//this.nextLevelTree();
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.showLoading(false);
			}
		},

		async load(node) {
			try {
				this.showLoading(true)
				!this.currentTree && alert('currentTree пустой!');
				const response = await axios.get(this.url, { params: this.currentTree });
				console.log('----response.data NEW-----------');
				console.log(response.data);
				console.log('----SQL-----------');
				console.log(response.data.sql);
				response.data && this.onLoaded(response.data.tree);
				//this.nextLevelTree(this.node.id);
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.showLoading(false);
			}
		},

		nextLevelTree(node) {
			let ID_Table = node.id.slice(0, node.id.indexOf('-'));
			console.log('ID_Table: ' + ID_Table);
			this.currentTree = this.sourceTree;
			if (ID_Table == 'root') return;
			while (true) {
				if (!this.currentTree.childTable) return;
				if (this.currentTree.idField === ID_Table) {
					this.currentTree = this.currentTree.childTable;
					return;
				}
				this.currentTree = this.currentTree.childTable;
			}
		},
	},

	mounted() {
		this.currentTree = this.sourceTree;
		this.tree();
	},


}
</script>

<style>
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
.ExpandClosed .Expand {
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
</style>