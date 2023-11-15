<template>
  <button class="btn">
    <slot></slot>
  </button>
</template>

<script>
export default {
  name: 'my-button',
};
</script>

<style scoped>
/* button {
  cursor: pointer;
}
.btn {
  height: 37px;
  padding: 10px 15px;
  margin: 5px;
  background: none;
  color: teal;
  border: 1px solid teal;
  cursor: pointer;
} */
</style>
