<template>
    <div>
        <div class="level">
            <img :src="avatar" alt="" width="50" height="50" class="mr-3 mb-2">

            <h1 v-text="user.name"></h1>
        </div>

        <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
            <image-upload name="avatar" @loaded="onLoad"></image-upload>
        </form>


    </div>
</template>

<script>
  import ImageUpload from './ImageUpload'

  export default {
    name: "AvatarForm",
    props: ['user'],
    data() {
      return {
        avatar: this.user.avatar_path,
      }
    },
    methods: {
      onLoad(avatar) {
        this.avatar = avatar.src;

        this.persist(avatar.file);
      },
      persist(avatar) {
        let data = new FormData();

        data.append('avatar', avatar);

        axios.post(`/api/users/${this.user.name}/avatar`, data)
          .then(() => flash('Avatar uploaded!'));
      }
    },
    computed: {
      canUpdate() {
        return this.authorize(user => user.id === this.user.id)
      }
    },
    components: {
      ImageUpload
    }
  }
</script>

<style scoped>

</style>