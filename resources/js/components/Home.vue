<template>
  <div>
    {{user.name}}'s dashboard!
  </div>
</template>

<script>
export default {
    data() {
        return{
            user: JSON.parse(localStorage.getItem('user'))
        }
    }
}
</script>

<style>

</style>