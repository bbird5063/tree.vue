<template>
	<div class="main">
		Наше дерево:
		<ul class="Container" id="tree">
			<li @click="tree" class="Node IsRoot IsLast ExpandClosed">
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
			ulTree: '',
			node: '',
			url: '/php_modules/kantor/data.php',
		}
	},

	methods: {

		tree(event) {
			//let element = document.getElementById(id);

			//element.onclick = function (event) {
			event = event || window.event
			let clickedElem = event.target || event.srcElement

			console.log(clickedElem); // при загрузке undefined

			if (!clickedElem || !this.hasClass(clickedElem, 'Expand')) { // BB: '!clickedElem ||' потому что при загрузке: clickedElem==undefined
				return // клик не там
			}

			// Node, на который кликнули (BB: было 'let node = ...')
			this.node = clickedElem.parentNode
			if (this.hasClass(this.node, 'ExpandLeaf')) {
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
			this.load(this.node)
			//}
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

		onSuccess(data) {
			console.log(data);
			if (!data.errcode) {
				this.onLoaded(data)
				this.showLoading(false)
			} else {
				this.showLoading(false)
				this.onLoadError(data)
			}
		},

		onAjaxError(xhr, status) {
			this.showLoading(false)
			var errinfo = { errcode: status }
			if (xhr.status != 200) {
				// может быть статус 200, а ошибка
				// из-за некорректного JSON
				errinfo.message = xhr.statusText
			} else {
				errinfo.message = 'Некорректные данные с сервера'
			}
			this.onLoadError(errinfo)
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

		onLoadError(error) {
			var msg = "Ошибка " + error.errcode
			if (error.message) msg = msg + ' :' + error.message
			alert(msg)
		},

		load_OLD(node) {
			this.showLoading(true)

			$.ajax({
				url: this.url,
				data: this.node.id,
				dataType: "json",
				success: this.onSuccess,
				error: this.onAjaxError,
				cache: false
			})
		},

		async load(node) {
			try {
				this.showLoading(true)
				const response = await axios.get(this.url, { params: { id: this.node.id } });
				//this.ulTree = response.data.get;
				let data =  response.data.map(x => JSON.parse(x));
				console.log(data);
				data && this.onLoaded(data); // 
				
				//this.showLoading(false)
			} catch (e) {
				alert('Ошибка ' + e.name + ':' + e.message + '\n' + e.stack);
			} finally {
				this.showLoading(false);
			}
		}



	},

	mounted() {
		this.tree("tree", "/php_modules/kantor/data.php");
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