<template>
    <div>
        <input id="wysiwyg" type="hidden" :name="name" :value="value">
        <trix-editor ref="wysiwyg" input="wysiwyg" :placeholder="placeholder"></trix-editor>
    </div>
</template>

<script>
  import Trix from 'trix';

  export default {
    name: "Wysiwyg",
    props: ['name', 'value', 'placeholder', 'shouldClear'],
    mounted() {
      this.$refs.wysiwyg.addEventListener('trix-change', e => {
        this.$emit('input', e.target.innerHTML);
      });

      this.$watch('shouldClear', () => {
        this.$refs.wysiwyg.value = '';
      });
    }
  }
</script>

<style scoped>

</style>