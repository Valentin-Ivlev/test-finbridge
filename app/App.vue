<template>
  <div class='container'>
    <a-typography-title>Сообщения</a-typography-title>
    <router-view></router-view>
  </div>
</template>

<script>
import MessagesList from './components/MessagesList.vue';

export default {
  components: {
    MessagesList
  }
}
</script>

<style scoped>
.container {
  padding: 2%;
}
</style>