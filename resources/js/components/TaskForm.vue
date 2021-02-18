<template>
  <form v-on:submit.prevent="addTask()" class="form">
    <input
      v-model="taskText"
      id="taskInput"
      class="form-control"
      placeholder="Title to task goes here"
      type="text"
    />
  </form>
</template>

<script>
export default {
  name: "TaskForm",
  data() {
    return {
      taskText: "",
    };
  },
  methods: {
    addTask() {
      this.$emit('newTask', this.taskText);
      this.taskText = '';
    },
  },
};
</script>

<style scoped>
.form {
  display: flex;
}
.form-control::placeholder {
  /* Chrome, Firefox, Opera, Safari 10.1+ */
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
  font-size: 20px;
}
</style>