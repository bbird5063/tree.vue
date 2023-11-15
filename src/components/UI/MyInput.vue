<template>
	<!-- 2. ':value="modelValue"' - это значение из пропса. Оно появится в инпуте -->
	<!-- 3. '@input="updateInput"' - при вводе в инпут вызывается "updateInput" -->
	<input :value="modelValue" @input="updateInput" class="input" type="text" />
</template>

<script>
export default {
	name: 'my-input',
	props: {
		/* 1. прийдет значение из v-model="..." */
		modelValue: [String, Number] // тоже тип: String или Number
	},
	methods: {
		/* 4. $emit сгенеририрует событие, получит значение event.target.value и отправит его в v-model="..." в родительском 'my-input' */
		updateInput(event) {
			this.$emit('update:modelValue', event.target.value)
		}
	}
}
</script>

<style scoped>
.input
{
	width: 100%;
	border: 1px solid teal;
	padding: 10px 15px;
	margin-top: 15px;
}
</style>