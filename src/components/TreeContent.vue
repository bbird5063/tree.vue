<template>
	<div>
		<table>
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
/* 'scoped' не ставить*/
</style>
