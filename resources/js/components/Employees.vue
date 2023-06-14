<template>
  <div class="flex">
    <div class="customCard" v-for="emp in emps">
      <br>
      <span class="label">Name:</span> <div class="info">{{emp.user.name}}</div>
      <hr>
      <span class="label">rh:</span> <div class="info">{{emp.rh.name}}</div>
      <hr>
      <br><br>
      <div class="btns">
      <span class="btnN" @click="submit(emp, 'no')">delete</span>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return{
      emps: []
    }
  },
  created() {
    axios.get('/employees/all')
    .then(res => {
      this.emps = res.data
    })
  },
  methods: {
    submit(emp, verdict) {
      axios.post('/user/employees/fire', {emp, verdict})
      .then(res => console.log(res.data))
      .catch(err => console.log(err))
    }
  }
}
</script>

<style>
.flex{
  display: flex;
  flex-wrap: wrap;
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