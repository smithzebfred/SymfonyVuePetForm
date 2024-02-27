<template>
  <div class="header-container">
    <img src="../assets/logo.png" width="100" />

    <div class="links">
      <a href="#" class="text-secondary text-decoration-none">Help</a>
      <a href="#" class="text-default text-decoration-none m-4"
        >Save and Finish Later</a
      >
    </div>
  </div>
</template>

<script>
export default {
  name: "HeaderComp",
};
</script>

<style scoped>
.header-container {
  box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
  padding: 10px;
  width: 100%;
  height: 60px;
  background-color: white;
  position: fixed;
  top: 0;
  z-index: 99;
  display: flex;
  align-items: center;
  justify-content: space-between;
}

.links {
  display: flex;
  align-items: center;
}

.links a {
  margin-left: 15px;
}

.text-default {
  color: #00a0e5;
}

@media (max-width: 768px) {
  .header-container {
    flex-direction: column;
    height: auto;
    padding: 10px;
  }

  .links {
    margin-top: 10px;
    justify-content: center;
  }

  .links a {
    margin: 0 5px;
  }
}
</style>
