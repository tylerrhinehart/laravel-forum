<template>
    <li class="nav-item dropdown" v-if="notifications.length">
        <a id="notificationsDropdown" class="nav-link dropdown-toggle" href="#" role="button"
           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
            <i class="fa fa-bell"></i>
        </a>

        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a v-for="notification in notifications" class="dropdown-item"
               :href="notification.data.link" v-text="notification.data.message" @click="markAsRead(notification)">
            </a>

        </div>
    </li>
</template>

<script>
  export default {
    name: "UserNotifications",
    data() {
      return {
        notifications: false
      }
    },
    methods: {
      markAsRead(notification) {
        axios.delete('/profiles/' + window.App.user.name + '/notifications/' + notification.id);
      }
    },
    created() {
      axios.get('/profiles/' + window.App.user.name + '/notifications')
        .then(response => this.notifications = response.data);
    }
  }
</script>

<style scoped>

</style>