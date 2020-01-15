<template>
    <div class="text-center mt-12" :key="loading" v-show="loading">
        <div class="loader"></div>
    </div>
</template>

<script>
import { mapGetters } from 'vuex'

export default {
    name: 'Loading',

    computed: {
        ...mapGetters(['loading'])
    }
}
</script>

<style scoped>
.loader {
  display: inline-block;
  width: 80px;
  height: 80px;
}
.loader:after {
  content: " ";
  display: block;
  width: 64px;
  height: 64px;
  margin: 8px;
  border-radius: 50%;
  border: 6px solid #667EEA;
  border-color: #667EEA transparent #667EEA transparent;
  animation: loaders 1.2s linear infinite;
}
@keyframes loaders {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>