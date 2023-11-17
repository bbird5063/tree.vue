<template>
	<div>
		<table>
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
table {
	width: 100%;
}
</style>
