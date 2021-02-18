<template>
  <div class="container">
    <div class="formContainer">
      <h3>Task List</h3>
      <task-form v-on:newTask="addTask($event)" />
    </div>
    <div class="shadow mb-5 bg-white rounded">
      <task-list v-on:taskUpdated="getTasks()" :tasks="this.tasks" />
      <div class="filters list-group-item">
        <div class="itemsCount">
          <p>{{`${this.itemsLeft} items left`}}</p>
        </div>
        <div>
          <button
            type="button"
            v-on:click="filterTasks(null)"
            class="btn btn-light"
          >
            All
          </button>
          <button
            type="button"
            v-on:click="filterTasks(false)"
            class="btn btn-light"
          >
            To do
          </button>
          <button
            type="button"
            v-on:click="filterTasks(true)"
            class="btn btn-light"
          >
            Done
          </button>
        </div>
      </div>
    </div>
  </div>
</template>


<script>
import TaskList from "./TaskList";
import TaskForm from "./TaskForm";
export default {
  name: "App",
  components: {
    TaskForm,
    TaskList,
  },
  data() {
    return {
      tasks: {},
      filter: null,
      itemsLeft: 0
    };
  },
  computed: {},
  methods: {
    addTask(taskText) {
      if (!taskText || taskText.length == 0) return;
      let task = {
        title: taskText,
        isDone: false,
      };
      axios.post("api/tasks", task).then((response) => {
        this.getTasks();
      });
    },
    getTasks() {
      if (this.filter == null) {
        axios.get("api/tasks").then((response) => {
          this.tasks = response.data.tasks;
          this.itemsLeft = response.data.itemsLeft
        });
      } else {
        axios.get(`api/tasks/search?isDone=${this.filter}`).then((response) => {
          this.tasks = response.data.tasks;
          this.itemsLeft = response.data.itemsLeft
        });
      }
    },
    filterTasks(isDone) {
      this.filter = isDone;
      this.getTasks();
    },
  },
  created() {
    this.getTasks();
    //this.interval = setInterval(() => this.getTasks(), 1000);
  },
  beforeDestroy() {
    clearInterval(this.interval);
  },
};
</script>

<style>
h3 {
  margin: 0;
  font-size: 30px;
  font-family:'Courier New', Courier, monospace;
  font-weight: bold;
}
.container {
  width: 500px;
  display: flex;
  justify-content: center;
  flex-direction: column;
  font-family: "Gill Sans", "Gill Sans MT", Calibri, "Trebuchet MS", sans-serif;
}
.formContainer {
  text-align: center;
}
body {
  margin: 0 !important;
}
.filters {
  width: 100%;
  background: rgba(0, 0, 0, 0.2);
  display: flex;
  justify-content: space-between;
}
.btn {
  margin-left: 10px;
}

.itemsCount{
  margin-left: 0;
  font-size: 20px;
}
</style>