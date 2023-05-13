<template>
  <div class="flex">
    <div class="customCard" v-for="app in apps">
      <br>
      Name: {{app.user.name}}
      <hr>
      rh: {{app.rh.name}}
      <hr>
      message: <br> {{app.message}}
      <br><br>
      <div class="btns">
        <span @click="submit('yes')">accept</span>
      <span @click="submit('no')">decline</span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return{
      apps: []
    }
  },
  created() {
    axios.get('/application/all')
    .then(res => {
      this.apps = res.data
    })
  },
  methods: {
    submit(verdict) {
      // axios.post('/application/judge', {'application_ud'})
    }
  }
}
</script>

<style>
.flex{
  display: flex;
}
span{
  cursor: pointer;
}
.customCard{
  border: 1px solid black;
  border-radius: 4px;
  width: 300px;
  margin: 4px;
  padding: 5px;
}
.btns{
  display: flex;
  justify-content: space-between;
}
</style>