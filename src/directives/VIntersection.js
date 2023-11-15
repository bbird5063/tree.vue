export default {
  mounted(el, binding) {
    console.log(el);
    const options = {
      rootMargin: '0px',
      threshold: 1.0,
    };
    const callback = (entries, observer) => {
      // только стрелочная. при function не будет доступна loadMorePosts()
      // if (entries[0].isIntersecting && this.page < this.totalPages) {
      if (entries[0].isIntersecting) {
        //this.loadMorePosts(); // меняем
        binding.value();
      }
    };
    const observer = new IntersectionObserver(callback, options);
    observer.observe(el); // меняем на el. Передаем ссылку на нужный DOM-элемент
  },

  name: 'intersection',
};
