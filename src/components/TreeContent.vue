<template>
	<div>
		<table class="table">
			<thead>
				<tr class="active">
					<th style="width: 10%">Дата</th>
					<th style="width: 12%">Раздел</th>
					<th style="width: 13%">Подраздел</th>
					<th style="width: 22%">Примечание</th>
					<th style="width: 7%">Н/БН</th>
					<th style="width: 8%">Вал.</th>
					<th style="width: 9%">Цена</th>
					<th style="width: 9%">Кол-во</th>
					<th style="width: 10%">Сумма</th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="row in rowsContent">
					<td>{{ row.DateDiaryBook }}</td>
					<td>{{ row.NameTypePayment }}</td>
					<td>{{ row.NameSubTypePayment }}</td>
					<td>{{ row.NoteForPayment }}</td>
					<td>{{ row.IsCash }}</td>
					<td>{{ row.NameCurrency }}</td>
					<td>{{ row.Price }}</td>
					<td>{{ row.AmountOfGoods }}</td>
					<td>{{ row.SumPayment }}</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
export default {
	props: {
		rowsContent: {
			type: Object,
			required: true,
		},
	},

	data() {
		return {
		}
	},

	methods: {},

	mounted() {
		console.log('----TreeContent.vue---------------------');
		console.log(this.rowsContent);
	},


}
</script>

<style>
/* 'scoped' не ставить*/
/*table {
	width: 100%;
}*/

html {
	font-family: sans-serif;
	-ms-text-size-adjust: 100%;
	-webkit-text-size-adjust: 100%
}

body {
	margin: 0
}

article,
aside,
details,
figcaption,
figure,
footer,
header,
hgroup,
main,
nav,
section,
summary {
	display: block
}

audio,
canvas,
progress,
video {
	display: inline-block;
	vertical-align: baseline
}

audio:not([controls]) {
	display: none;
	height: 0
}

[hidden],
template {
	display: none
}

a {
	background: transparent
}

a:active,
a:hover {
	outline: 0
}

abbr[title] {
	border-bottom: 1px dotted
}

b,
strong {
	font-weight: 700
}

dfn {
	font-style: italic
}

h1 {
	font-size: 2em;
	margin: .67em 0
}

mark {
	background: #ff0;
	color: #000
}

small {
	font-size: 80%
}

sub,
sup {
	font-size: 75%;
	line-height: 0;
	position: relative;
	vertical-align: baseline
}

sup {
	top: -.5em
}

sub {
	bottom: -.25em
}

img {
	border: 0
}

svg:not(:root) {
	overflow: hidden
}

figure {
	margin: 1em 40px
}

hr {
	-moz-box-sizing: content-box;
	box-sizing: content-box;
	height: 0
}

pre {
	overflow: auto
}

code,
kbd,
pre,
samp {
	font-family: monospace, monospace;
	font-size: 1em
}

button,
input,
optgroup,
select,
textarea {
	color: inherit;
	font: inherit;
	margin: 0
}

button {
	overflow: visible
}

button,
select {
	text-transform: none
}

button,
html input[type="button"],
input[type="reset"],
input[type="submit"] {
	-webkit-appearance: button;
	cursor: pointer
}

button[disabled],
html input[disabled] {
	cursor: default
}

button::-moz-focus-inner,
input::-moz-focus-inner {
	border: 0;
	padding: 0
}

input {
	line-height: normal
}

input[type="checkbox"],
input[type="radio"] {
	box-sizing: border-box;
	padding: 0
}

input[type="number"]::-webkit-inner-spin-button,
input[type="number"]::-webkit-outer-spin-button {
	height: auto
}

input[type="search"] {
	-webkit-appearance: textfield;
	-moz-box-sizing: content-box;
	-webkit-box-sizing: content-box;
	box-sizing: content-box
}

input[type="search"]::-webkit-search-cancel-button,
input[type="search"]::-webkit-search-decoration {
	-webkit-appearance: none
}

fieldset {
	border: 1px solid silver;
	margin: 0 2px;
	padding: .35em .625em .75em
}

legend {
	border: 0;
	padding: 0
}

textarea {
	overflow: auto
}

optgroup {
	font-weight: 700
}

table {
	border-collapse: collapse;
	border-spacing: 0
}

td,
th {
	padding: 0
}

body {
	margin: 0;
	padding: 0;
	text-align: left;
}



.table {
	width: 100%;
	border: none;
	margin-bottom: 20px;
}

.table thead th {
	font-weight: bold;
	text-align: left;
	border: none;
	padding: 10px 15px;
	background: #d8d8d8;
	font-size: 14px;
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
}

.table tbody td {
	text-align: left;
	border-left: 1px solid #ddd;
	border-right: 1px solid #ddd;
	padding: 10px 15px;
	font-size: 14px;
	vertical-align: top;
}

.table thead tr th:first-child,
.table tbody tr td:first-child {
	border-left: none;
}

.table thead tr th:last-child,
.table tbody tr td:last-child {
	border-right: none;
}

.table tbody tr:nth-child(even) {
	background: #f3f3f3;
}
</style>
