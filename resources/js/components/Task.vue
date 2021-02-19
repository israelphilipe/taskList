<template>
  <div v-if="this.task" class="taskContainer">
    <li :class="[this.task.isDone ? 'taskDone' : '', 'list-group-item list-group-item-action rounded-sm p-1']">
      <div class="taskItem">
        <p>{{ this.task.title }}</p>
        
        <div>
          <font-awesome-icon
            v-bind:style="{ color: this.checkColor }"
            icon="check-circle"
            class="icons"
            v-on:click="updateTask('update')"
          />
          <font-awesome-icon
            style="color: red"
            icon="trash-alt"
            class="icons"
            v-on:click="removeTask()"
          />
        </div>
      </div>
    </li>
  </div>
</template>

<script>
export default {
  name: "Task",
  props: ["task"],
  methods: {
    updateTask() {
      this.task["isDone"] = !this.task["isDone"];
      axios.patch(`api/tasks/${this.task.id}`, this.task).then((response) => {
          if(response.status == 200){
            this.$emit("taskUpdated", this.task);
          }else{
            console.log('something went wrong');
          }
    
      });
    },
    removeTask() {
      axios.delete(`api/tasks/${this.task.id}`).then((response) => {
        if(response.status == 200){
            this.$emit("taskUpdated", this.task);
          }else{
            console.log('something went wrong');
          }
      });
    },
  },
  computed: {
    checkColor() {
      return this.task.isDone ? "green" : "gray";
    },
  },
};
</script>

<style scoped>
.list-group-item {
  height: fit-content;
}
.taskContainer {
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
  font-size: 25px;
  height: fit-content;
}

.taskItem {
  display: flex;
  justify-content: space-between;
}

.icons {
  font-size: 25px;
  margin-left: 3px;
}

.taskDone{
  background: rgba(0, 0, 0, 0.25);
}

.taskDone p{
  
  text-decoration: line-through;
}
</style>