<template>
  <div class="container">
    <div class="formContainer">
      <h3>Task List</h3>
      <task-form v-on:newTask="addTask($event)" />
    </div>
    <div class="shadow mb-5 bg-white rounded">
      <task-list v-on:taskUpdated="getTasks()" :tasks="this.tasks" />
      <div class="options list-group-item">
        <div class="itemsCount">
          <p>{{ `${this.itemsLeft} items left` }}</p>
        </div>
        <div>
          <div class="filterButtons">
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

          <div class="clearOptions">
            <p v-on:click="clearCompleted()" class="btn btn-link">Clear Done</p>
            <p v-on:click="clearAll()" class="btn btn-link">Clear all</p>
          </div>
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
      itemsLeft: 0,
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
          this.itemsLeft = response.data.itemsLeft;
        });
      } else {
        axios.get(`api/tasks/search?isDone=${this.filter}`).then((response) => {
          this.tasks = response.data.tasks;
          this.itemsLeft = response.data.itemsLeft;
        });
      }
    },
    filterTasks(isDone) {
      this.filter = isDone;
      this.getTasks();
    },
    clearCompleted(){
      axios.delete(`api/tasks/clearCompleted`).then((response) => {
          console.log(response);
          this.getTasks();
      });
    },
    clearAll(){
      axios.delete(`api/tasks/clearAll`).then((response) => {
          console.log(response);
          this.getTasks();
      })
    }
  },
  created() {
    this.getTasks();
  },
};
</script>

<style>
h3 {
  color: white;
  margin: 0;
  font-size: 30px;
  font-family: "Courier New", Courier, monospace;
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
.options {
  padding: 0px;
  width: 100%;
  background-color: rgba(0, 0, 0, 0.7);
  display: flex;
  justify-content: space-between;
}

.filterButtons{
  display: flex;
  justify-content: center;
}
.btn {
  margin-left: 10px;
}

.itemsCount {
  color: white;
  margin: auto;
  margin-left: 10px;
  font-size: 20px;
}

.clearOptions {
  display: flex;
  justify-content: space-between;
  padding: 0;
  margin: 0;
}

.btn-link {
  font-weight: bold;
  color: white;
  margin: 0px;
  display: inline;
  font-size: 15px;
}
</style>