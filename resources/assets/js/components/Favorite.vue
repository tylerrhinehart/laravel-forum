<template>
    <button :class="classes" @click="toggle">
        <span class="fa fa-heart"></span>
        <span v-text="favoritesCount"></span>
    </button>
</template>

<script>
  export default {
    name: "Favorite",
    props: ['reply'],
    data() {
      return {
        favoritesCount: this.reply.favoritesCount,
        isFavorited: this.reply.isFavorited
      }
    },
    methods: {
      toggle() {
        return this.isFavorited ? this.destroy() : this.create();
      },
      destroy() {
        axios.delete(this.endpoint);

        this.isFavorited = false;
        this.favoritesCount--;
      },
      create() {
        axios.post(this.endpoint);

        this.isFavorited = true;
        this.favoritesCount++;
      }
    },
    computed: {
      classes() {
        return ['btn', this.isFavorited ? 'btn-dark' : 'btn-primary '];
      },
      endpoint() {
        return '/replies/' + this.reply.id + '/favorites';
      }
    }
  }
</script>

<style scoped>

</style>