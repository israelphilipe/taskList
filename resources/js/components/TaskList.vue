<template>
  <div class="list">
    <ul v-for="(task, index) in this.tasks" :key="index" class="list-group">
      <task v-on:taskUpdated="updateTask($event)" :task="task" />
    </ul>
  </div>
</template>

<script>
import Task from "./Task";
export default {
  name: "TaskList",
  props: ['tasks'],
  components: {
    Task,
  },
  methods: {
    updateTask(event){
      this.$emit('taskUpdated',event);
    }
  },
  
};
</script>

<style>
</style>