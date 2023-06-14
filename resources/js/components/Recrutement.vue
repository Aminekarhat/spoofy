<template>
  <div class="flex">
    <div class="customCard" v-for="app in apps">
      <br>
      <span class="label">Name:</span> <div class="info">{{app.user.name}}</div>
      <hr>
      <span class="label">rh:</span> <div class="info">{{app.rh.name}}</div>
      <hr>
      <span class="label">message:</span> <br> <div class="info">{{app.message}}</div>
      <br><br>
      <div class="btns">
        <span class="btnY" @click="submit(app, 'yes')">accept</span>
      <span class="btnN" @click="submit(app, 'no')">decline</span>
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
    submit(app, verdict) {
      axios.post('/user/application/judge', {app, verdict})
      .then(res => console.log(res.data))
      .catch(err => console.log(err))
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
  border: 1px solid #129FF8;
  border-radius: 4px;
  width: 300px;
  margin: 8px;
  padding: 12px;
}
.btns{
  display: flex;
  justify-content: space-between;
}
.label{
  opacity: .8;
}
.info{
  font-size: 14px;
}
.btnY, .btnN{
  padding: 0.8rem 1.2rem;
  border-radius: 4px;
  color: white;
  text-transform: capitalize;
}
.btnY{
  background: green;

}
.btnN{
  background: red;
}
</style>