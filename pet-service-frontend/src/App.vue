<template>
  <HeaderComp />
</template>

<script>

import HeaderComp from "./components/Header.vue";

export default {
  name: "App",
  components: {
    HeaderComp,
  
  },
};
</script>

<style>
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  display: flex;
  justify-content: center;
  align-items: center;
  flex-direction: column;
  min-height: 100vh;
  background-color: #e0dfdf;
  padding: 50px;
}

</style>
