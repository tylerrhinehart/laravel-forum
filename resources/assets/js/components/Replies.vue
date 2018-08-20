<template>
    <div>
        <div v-for="(reply, index) in items" :key="reply.id">
            <reply :reply="reply" @deleted="remove(index)"></reply>
        </div>

        <paginator :dataSet="dataSet" @changed="fetch"></paginator>

        <new-reply @created="add" v-if="!$parent.locked"></new-reply>
        <p v-else>This thread has been locked. No more replies are allowed.</p>
    </div>
</template>

<script>
  import Reply from './Reply';
  import NewReply from './NewReply';
  import collection from '../mixins/collection';

  export default {
    name: "Replies",
    data() {
      return {
        dataSet: false,
      }
    },
    mixins: [collection],
    methods: {
      fetch(page) {
        axios.get(this.url(page)).then(this.refresh);
      },
      refresh({ data }) {
        this.dataSet = data;
        this.items = data.data

        window.scrollTo(0, 0);
      },
      url(page) {
        if (!page) {
          let query = location.search.match(/page=(\d+)/);

          page = query ? query[1] : 1;
        }

        return `${location.pathname}/replies?page=${page}`;
      }
    },
    created() {
      this.fetch();
    },
    components: {
      Reply,
      NewReply
    }
  }
</script>

<style scoped>

</style>