<template>
	<!--
	ExpandOpen
	ExpandClosed
	ExpandLeaf - открыт и вообще нет [+/-]
	IsLast - заканчвеит левую линию в узле
	-->
	<!--<div @click="tree_toggle(arguments[0])">-->
	<div>
		<div id="test"></div>
		<div @click="tree_toggle">
			<div id="periodTree">
				Tree
			</div>
			<ul class="Container">
				<li class="Node IsRoot IsLast ExpandClosed">
					<div class="Expand"></div>
					<div onclick="test" class="Content" role="tree" for="all" style="cursor:pointer">Все</div>
					<ul v-html="ulTree" id="tree-tree" class="Container">

					</ul>
				</li>
			</ul>
		</div>
	</div>
</template>

<script>
import axios from 'axios';
export default {
	name: 'my-kantor2',
	props: {
		sourceTree: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
			url: '/php_modules/kantor/tree_controller.php',
			post: 'idPage=tree',
			ulTree: '',
		}
	},

	methods: {
		test() {
			alert('test()');
		},
		test2() {
			alert('test2()');
		},
		async loadTree() {
			console.log('loadTree()');
			try {
				const response = await axios.post(this.url, this.post);

				console.log(response.data.strTree);
				this.ulTree = response.data.strTree;

			} catch (e) {
				alert('Ошибка в loadTree()!');
			}
		},

		async loadContent(el) {
			if (el.getAttribute('for')) {
				console.log('----loadContent(el)-----------------');
				console.log(el.getAttribute('for'));
				const urlSourceTree = '/php_modules/kantor/source_controller.php';
				try {
					const response = await axios.get(urlSourceTree, { params: this.sourceTree });

					console.log(response.data.get);

				} catch (e) {
					alert('Ошибка в loadContent(el)!');
				}



			}
		},

		tree_toggle(event) {
			event = event || window.event
			let clickedElem = event.target || event.srcElement

			if (!this.hasClass(clickedElem, 'Expand')) {
				this.loadContent(clickedElem); // BB
				return // клик не там
			}

			// Node, на который кликнули
			let node = clickedElem.parentNode
			if (this.hasClass(node, 'ExpandLeaf')) {
				return // клик на листе
			}

			// определить новый класс для узла
			let newClass = this.hasClass(node, 'ExpandOpen') ? 'ExpandClosed' : 'ExpandOpen'
			// заменить текущий класс на newClass
			// регексп находит отдельно стоящий open|close и меняет на newClass
			let re = /(^|\s)(ExpandOpen|ExpandClosed)(\s|$)/
			node.className = node.className.replace(re, '$1' + newClass + '$3')
		},

		hasClass(elem, className) {
			return new RegExp("(^|\\s)" + className + "(\\s|$)").test(elem.className)
		},
	},

	mounted() {
		this.loadTree();
		//this.tree_toggle(arguments[0]);
	},


}
</script>

<script setup>
window.onload = function () {

	let el = document.querySelector("#test"); // с window.onload - работает
	//let el = document.getElementById("test"); // с window.onload - работает
	//document.getElementById("test").innerHTML = "<h3>Использовал innerHTML</h3>";
	el.innerHTML = '<h3>1. Использовал innerHTML</h3>';
};

document.addEventListener('click', function (event) {
	if (!event.target.matches('.Content')) return;
	//if (!event.target.matches("div[role='tree1']")) return; // работает
	if (event.target.getAttribute('for')) {
		console.log(event.target.getAttribute('role')); // работает

		let strWhereTree = event.target.getAttribute('for');
		console.log(strWhereTree);
		//document.getElementById("test").innerHTML = "<h3>Использовал innerHTML</h3>"; // работает
		//this.test();
		//test();
		/*
			let dv = document.querySelector(".Content");
			console.log(dv.getAttribute('role'));
		*/
	}
});

/*
let dv = document.querySelector(".Content"); // не работает
dv.onclick = function () {
	///alert(dv.getAttribute('role')); // ("span[rel='bottom']")
	alert('qwert');
};
*/
/*
function al(msg) {
	alert(msg);
}
*/
</script>


<style> /*  scoped убрал - иначе т.к. это компонент эти не работают */

 #periodTree {
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
 /* отступ для всех дочерних элементов дерева, кроме корня */
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
 /* левая вертикальная линия (сетка) для всех узлов */
 .IsLast {
 	background-image: url('~@/assets/img/tree/i_half.gif');
 	background-repeat: no-repeat;
 }

 .ExpandOpen .Expand {
 	background-image: url('~@/assets/img/tree/expand_minus.gif');
 }

 /* closed is higher priority than open */
 /* закрытый имеет более высокий приоритет, чем открытый */
 .ExpandClosed .Expand {
 	background-image: url('~@/assets/img/tree/expand_plus.gif');
 }

 /* highest priority */
 /* наивысший приоритет */
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