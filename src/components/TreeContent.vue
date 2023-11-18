<template>
	<div>
		<table class="table">
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
table {
	border-collapse: collapse;
	border-spacing: 0;
	/* Фиксируем ширину колонок */
	table-layout: fixed;
}

td,
th {
	padding: 0;
}

body {
	margin: 0;
	padding: 0;
	text-align: left;
}

/*=============================*/
.table {
	width: 100%;
	margin-bottom: 20px;
	border: 1px solid #dddddd;
	border-collapse: collapse;
}

.table th {
	font-weight: bold;
	padding: 5px;
	background: #efefef;
	border: 1px solid #dddddd;
}

.table td {
	border: 1px solid #dddddd;
	padding: 5px;
}
</style>
